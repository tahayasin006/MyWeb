<?php
// iyzico ödeme sonrası müşteriyi buraya POST ile yönlendirir (callbackUrl). Sonucu iyzico'dan DOĞRULAYIP siparişi günceller.
require __DIR__ . '/config.php';

function go($state) { header('Location: ' . $GLOBALS['siteUrl'] . '/index.php?odeme=' . $state, true, 303); exit; }

$token = isset($_POST['token']) ? trim((string)$_POST['token']) : '';
if ($token === '' || !$cardEnabled) { go('basarisiz'); }

$r = iyzico_request('/payment/iyzipos/checkoutform/auth/ecom/detail', ['locale' => 'tr', 'token' => $token]);
if (!is_array($r) || empty($r['basketId'])) { error_log('iyzico detail hatası: ' . json_encode($r, JSON_UNESCAPED_UNICODE)); go('basarisiz'); }

$o = order_load($r['basketId']);
if (!$o || !isset($o['token']) || !hash_equals($o['token'], $token)) { go('basarisiz'); }

$paid = (isset($r['status']) && $r['status'] === 'success' && isset($r['paymentStatus']) && $r['paymentStatus'] === 'SUCCESS');

if ($o['status'] === 'bekliyor') {
  $o['updated'] = date('Y-m-d H:i:s');
  if ($paid) {
    $o['status'] = 'odendi';
    $o['paid_amount'] = isset($r['paidPrice']) ? (float)$r['paidPrice'] : $o['total'];
    $o['payment_id'] = isset($r['paymentId']) ? $r['paymentId'] : '';
    if (isset($r['installment'])) { $o['installment'] = (int)$r['installment']; }
  } else {
    $o['status'] = 'basarisiz';
    $o['fail_reason'] = isset($r['errorMessage']) ? $r['errorMessage'] : '';
  }
  order_save($o['oid'], $o);

  if ($paid && $ownerEmail !== '') {
    $body = "Yeni ödeme alındı!\nSipariş No: {$o['oid']}\nToplam: " . number_format($o['paid_amount'], 2, ',', '.') . " TL\n\n";
    foreach ($o['items'] as $i) { $body .= "- {$i['name']} x{$i['qty']}\n"; }
    $cu = $o['customer'];
    $body .= "\nMüşteri: {$cu['name']}\nTelefon: {$cu['phone']}\nE-posta: {$cu['email']}\nAdres: {$cu['address']}\n";
    if ($cu['note'] !== '') { $body .= "Not: {$cu['note']}\n"; }
    @mail($ownerEmail, '=?UTF-8?B?' . base64_encode('Yeni ödeme alındı: ' . $o['oid']) . '?=', $body, "Content-Type: text/plain; charset=UTF-8\r\n");
  }
}
go(($o['status'] === 'odendi') ? 'basarili' : 'basarisiz');
