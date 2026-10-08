<?php
// ======================================================
// 3BYAZ - AYARLAR (config.php)
// ======================================================

function h($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

// >>> WhatsApp numaran (başında 90, boşluksuz). <<<
$whatsapp = "905554460644";

// >>> KARGO <<<
$freeShipping = 750;      // Bu tutar ve üzeri siparişte kargo ücretsiz
$shippingFee  = 79.90;    // ÖRNEK kargo ücreti: kendi kargo ücretinle değiştir
$paymentNote  = "Kartla ödeyebilir ya da WhatsApp'tan sipariş verip havale/EFT ile ödeyebilirsin.";

// >>> Yeni sipariş bildirimi bu e-postaya gelir (boş bırakırsan gönderilmez) <<<
$ownerEmail = "info@3byaz.com";

// >>> SİTE ADRESİ: boş bırakırsan otomatik algılanır. Gerekirse örn. "https://www.3byaz.com" yaz (sonunda / olmasın) <<<
$siteUrl = "https://3byaz.com.tr";
if ($siteUrl === "" && isset($_SERVER['HTTP_HOST'])) {
  $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
  $siteUrl = ($https ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
}

// >>> ONLINE ÖDEME (iyzico) <<<
// iyzico panelinden: Ayarlar > Firma Ayarları > API Anahtarları bölümünden API Key ve Secret Key'i kopyala.
// DİKKAT: Test (sandbox) ve Canlı anahtarlar FARKLIDIR. Test panelinden aldığın anahtarla sandbox=true kullan.
// Anahtarları yazana kadar sitede "Kartla Öde" butonu GÖRÜNMEZ, site sadece WhatsApp ile çalışır.
$iyzico = [
  'api_key'      => 'BURAYA_API_KEY',
  'secret_key'   => 'BURAYA_SECRET_KEY',
  'sandbox'      => true,                 // Deneme için true. Gerçek satışa geçerken false yap ve CANLI anahtarları yaz.
  'installments' => [1, 2, 3, 6, 9],      // Müşterinin seçebileceği taksitler (sadece peşin için [1])
];
$iyzico['base_url'] = $iyzico['sandbox'] ? 'https://sandbox-api.iyzipay.com' : 'https://api.iyzipay.com';
$cardEnabled = strpos($iyzico['api_key'] . $iyzico['secret_key'], 'BURAYA') === false;

// iyzico API isteği (IYZWSv2 imzalı)
function iyzico_request($path, $body) {
  global $iyzico;
  $json = json_encode($body, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  $rnd = (string)round(microtime(true) * 1000) . bin2hex(random_bytes(4));
  $signature = hash_hmac('sha256', $rnd . $path . $json, $iyzico['secret_key']);
  $auth = base64_encode('apiKey:' . $iyzico['api_key'] . '&randomKey:' . $rnd . '&signature:' . $signature);
  $ch = curl_init($iyzico['base_url'] . $path);
  curl_setopt_array($ch, [
    CURLOPT_POST => true, CURLOPT_POSTFIELDS => $json, CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 25, CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'Accept: application/json', 'Authorization: IYZWSv2 ' . $auth, 'x-iyzi-rnd: ' . $rnd],
  ]);
  $res = curl_exec($ch);
  curl_close($ch);
  return $res === false ? null : json_decode($res, true);
}

// >>> Sipariş listesi sayfası (admin-siparisler.php) şifresi. Kullanıcı adı: admin <<<
$adminPassword = 'BURAYA_YONETICI_SIFRESI';

// ---------- Sipariş kayıt yardımcıları ----------
define('ORDER_DIR', __DIR__ . '/data/orders');
function order_path($oid) { return ORDER_DIR . '/' . $oid . '.php'; }
function order_save($oid, $d) {
  if (!is_dir(ORDER_DIR)) { @mkdir(ORDER_DIR, 0755, true); }
  // Dosya .php olduğu için tarayıcıdan açılsa bile içerik görünmez.
  return file_put_contents(order_path($oid), "<?php http_response_code(404); exit; ?>\n" . json_encode($d, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
}
function order_load($oid) {
  if (!preg_match('/^[A-Za-z0-9]+$/', (string)$oid)) return null;
  $f = order_path($oid);
  if (!is_file($f)) return null;
  $raw = file_get_contents($f);
  $pos = strpos($raw, "\n");
  return $pos === false ? null : json_decode(substr($raw, $pos + 1), true);
}
function order_all() {
  $out = [];
  $files = glob(ORDER_DIR . '/*.php');
  if ($files) { foreach ($files as $f) { $o = order_load(basename($f, '.php')); if ($o) $out[] = $o; } }
  usort($out, function($a, $b) { return strcmp($b['created'], $a['created']); });
  return $out;
}
