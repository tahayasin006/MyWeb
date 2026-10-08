<?php
require __DIR__ . '/config.php';
if ($adminPassword === '' || strpos($adminPassword, 'BURAYA') !== false) { http_response_code(403); exit('config.php içinde $adminPassword belirleyin.'); }
$u = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '';
$pw = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
if ($u !== 'admin' || !hash_equals($adminPassword, $pw)) {
  header('WWW-Authenticate: Basic realm="3Byaz Yonetim"'); http_response_code(401); exit('Giriş gerekli');
}
header('X-Robots-Tag: noindex');
$orders = order_all();
$labels = ['odendi' => 'ÖDENDİ', 'bekliyor' => 'Bekliyor', 'basarisiz' => 'Başarısız'];
$colors = ['odendi' => '#1a9f4b', 'bekliyor' => '#d98a00', 'basarisiz' => '#d12c2c'];
?>
<!DOCTYPE html><html lang="tr"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex">
<title>Siparişler | 3Byaz</title>
<style>body{font-family:Arial,sans-serif;background:#f4f4f4;margin:0;padding:16px}h1{font-size:20px}.o{background:#fff;border-radius:10px;padding:14px;margin-bottom:12px;border-left:5px solid #999;font-size:14px;line-height:1.6}.s{font-weight:700}small{color:#777}</style></head><body>
<h1>Siparişler (<?= count($orders) ?>)</h1>
<?php foreach ($orders as $o): $st = $o['status']; $c = $o['customer']; ?>
<div class="o" style="border-color:<?= h(isset($colors[$st]) ? $colors[$st] : '#999') ?>">
  <span class="s" style="color:<?= h(isset($colors[$st]) ? $colors[$st] : '#999') ?>"><?= h(isset($labels[$st]) ? $labels[$st] : $st) ?></span>
  &nbsp;<b><?= h($o['oid']) ?></b> <small><?= h($o['created']) ?></small><br>
  <?php foreach ($o['items'] as $i): ?>• <?= h($i['name']) ?> x<?= (int)$i['qty'] ?><br><?php endforeach; ?>
  Kargo: <?= $o['shipping'] > 0 ? number_format($o['shipping'], 2, ',', '.') . ' TL' : 'Ücretsiz' ?> &nbsp;|&nbsp; <b>Toplam: <?= number_format($o['total'], 2, ',', '.') ?> TL</b><br>
  👤 <?= h($c['name']) ?> &nbsp; 📞 <?= h($c['phone']) ?> &nbsp; ✉️ <?= h($c['email']) ?><br>
  📍 <?= h($c['address']) ?><?php if (!empty($c['note'])): ?><br>📝 <?= h($c['note']) ?><?php endif; ?>
</div>
<?php endforeach; if (!$orders): ?><p>Henüz sipariş yok.</p><?php endif; ?>
</body></html>
