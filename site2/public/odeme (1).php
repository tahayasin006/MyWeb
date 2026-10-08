<?php
// Sepeti doğrular, iyzico'dan ödeme sayfası (checkout form) alır. Fiyatlar SUNUCUDA hesaplanır.
require __DIR__ . '/config.php';
require __DIR__ . '/products.php';
header('Content-Type: application/json; charset=utf-8');

function fail($m, $c = 400) { http_response_code($c); echo json_encode(['ok' => false, 'error' => $m], JSON_UNESCAPED_UNICODE); exit; }
function cents_fmt($c) { return number_format($c / 100, 2, '.', ''); }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') fail('Geçersiz istek.', 405);
if (!$cardEnabled) fail('Online ödeme şu an aktif değil. Lütfen WhatsApp ile sipariş verin.', 503);

$in = json_decode(file_get_contents('php://input'), true);
if (!is_array($in)) fail('Geçersiz veri.');
$c = isset($in['customer']) && is_array($in['customer']) ? $in['customer'] : [];
$name    = trim(preg_replace('/\s+/', ' ', (string)(isset($c['name']) ? $c['name'] : '')));
$phone   = trim((string)(isset($c['phone']) ? $c['phone'] : ''));
$email   = trim((string)(isset($c['email']) ? $c['email'] : ''));
$city    = trim((string)(isset($c['city']) ? $c['city'] : ''));
$address = trim((string)(isset($c['address']) ? $c['address'] : ''));
$note    = mb_substr(trim((string)(isset($c['note']) ? $c['note'] : '')), 0, 300);

if (mb_strlen($name) < 3 || mb_strlen($name) > 80 || strpos($name, ' ') === false) fail('Lütfen ad ve soyadınızı birlikte yazın.');
$digits = preg_replace('/\D/', '', $phone);
if (strlen($digits) < 10) fail('Lütfen geçerli bir telefon numarası yazın.');
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) fail('Kartla ödeme için geçerli bir e-posta adresi gerekli.');
if (mb_strlen($city) < 2 || mb_strlen($city) > 40) fail('Lütfen il bilgisini yazın.');
if (mb_strlen($address) < 10 || mb_strlen($address) > 400) fail('Lütfen teslimat adresinizi eksiksiz yazın.');

// Telefonu +90xxxxxxxxxx biçimine getir
$gsm = substr($digits, -10);
$gsm = '+90' . $gsm;

// Ad / soyad ayır
$pos = strrpos($name, ' ');
$first = substr($name, 0, $pos);
$last = substr($name, $pos + 1);

// Sepet (fiyatlar kuruş cinsinden, sunucudan)
$items = []; $subtotalC = 0;
$rawItems = isset($in['items']) && is_array($in['items']) ? $in['items'] : [];
foreach ($rawItems as $it) {
  $id = isset($it['id']) ? (int)$it['id'] : -1;
  $qty = isset($it['qty']) ? (int)$it['qty'] : 0;
  if (!isset($products[$id]) || $qty < 1 || $qty > 99) fail('Sepetinizde geçersiz bir ürün var. Sayfayı yenileyip tekrar deneyin.');
  $p = $products[$id];
  $priceC = (int)round($p['price'] * 100);
  $items[] = ['id' => $id, 'name' => $p['name'], 'cat' => $p['cat'], 'priceC' => $priceC, 'qty' => $qty];
  $subtotalC += $priceC * $qty;
}
if (!$items) fail('Sepetiniz boş.');

$shippingC = ($subtotalC >= (int)round($freeShipping * 100)) ? 0 : (int)round($shippingFee * 100);
$totalC = $subtotalC + $shippingC;

$oid = '3B' . date('ymdHis') . strtoupper(bin2hex(random_bytes(3)));

// iyzico sepet kalemleri: adet yok, her adet ayrı satır. Toplam = price olmalı.
$basket = [];
foreach ($items as $i) {
  for ($n = 1; $n <= $i['qty']; $n++) {
    $basket[] = ['id' => 'P' . $i['id'] . '-' . $n, 'name' => $i['name'], 'category1' => $i['cat'], 'itemType' => 'PHYSICAL', 'price' => cents_fmt($i['priceC'])];
  }
}
if ($shippingC > 0) {
  $basket[] = ['id' => 'KARGO', 'name' => 'Kargo', 'category1' => 'Kargo', 'itemType' => 'PHYSICAL', 'price' => cents_fmt($shippingC)];
}

$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '85.34.78.112';
if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) { $ip = $_SERVER['HTTP_CF_CONNECTING_IP']; }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]); }

$addr = ['contactName' => $name, 'city' => $city, 'country' => 'Turkey', 'address' => $address];
$body = [
  'locale' => 'tr',
  'conversationId' => $oid,
  'price' => cents_fmt($totalC),
  'paidPrice' => cents_fmt($totalC),
  'currency' => 'TRY',
  'basketId' => $oid,
  'paymentGroup' => 'PRODUCT',
  'callbackUrl' => $siteUrl . '/iyzico-donus.php',
  'enabledInstallments' => array_values($iyzico['installments']),
  'buyer' => [
    'id' => 'M' . substr(md5($email), 0, 10),
    'name' => $first, 'surname' => $last,
    'identityNumber' => '11111111111', // iyzico zorunlu alan; gerçek TC istemiyoruz
    'email' => $email, 'gsmNumber' => $gsm,
    'registrationAddress' => $address, 'city' => $city, 'country' => 'Turkey', 'ip' => $ip,
  ],
  'shippingAddress' => $addr,
  'billingAddress' => $addr,
  'basketItems' => $basket,
];

$r = iyzico_request('/payment/iyzipos/checkoutform/initialize/auth/ecom', $body);
if (!is_array($r) || !isset($r['status']) || $r['status'] !== 'success' || empty($r['token'])) {
  error_log('iyzico initialize hatası: ' . json_encode($r, JSON_UNESCAPED_UNICODE));
  fail('Ödeme başlatılamadı. Lütfen tekrar deneyin ya da WhatsApp ile sipariş verin.', 502);
}

$payUrl = !empty($r['paymentPageUrl']) ? $r['paymentPageUrl']
  : ($iyzico['sandbox'] ? 'https://sandbox-cpp.iyzipay.com' : 'https://cpp.iyzipay.com') . '?token=' . urlencode($r['token']) . '&lang=tr';

$orderItems = [];
foreach ($items as $i) { $orderItems[] = ['id' => $i['id'], 'name' => $i['name'], 'price' => $i['priceC'] / 100, 'qty' => $i['qty']]; }
order_save($oid, [
  'oid' => $oid, 'status' => 'bekliyor', 'created' => date('Y-m-d H:i:s'), 'token' => $r['token'],
  'items' => $orderItems, 'subtotal' => $subtotalC / 100, 'shipping' => $shippingC / 100, 'total' => $totalC / 100,
  'customer' => ['name' => $name, 'phone' => $phone, 'email' => $email, 'address' => $city . ' - ' . $address, 'note' => $note],
]);

echo json_encode(['ok' => true, 'url' => $payUrl], JSON_UNESCAPED_UNICODE);
