<?php
require_once __DIR__.'/../../app/helpers.php'; require_admin();
$products=db()->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
$orders=db()->query("SELECT * FROM orders ORDER BY id DESC LIMIT 50")->fetchAll();
?><!doctype html><html lang="tr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>3Byaz Admin</title><style>body{font-family:Arial;margin:0;background:#f5f5f5}.head{background:#111;color:#fff;padding:18px}.wrap{width:min(1200px,94%);margin:25px auto}.box{background:#fff;padding:20px;border-radius:12px;margin-bottom:20px}table{width:100%;border-collapse:collapse}td,th{padding:10px;border-bottom:1px solid #eee;text-align:left}a{color:#ff6a00}</style></head><body><div class="head">3Byaz Yönetim Paneli — <a href="../index.php">Mağazaya Git</a></div><div class="wrap">
<div class="box"><h2>Ürünler</h2><table><tr><th>ID</th><th>Ürün</th><th>Fiyat</th><th>Stok</th></tr><?php foreach($products as $p):?><tr><td><?=$p['id']?></td><td><?=htmlspecialchars($p['name'])?></td><td><?=$p['price']?> TL</td><td><?=$p['stock']?></td></tr><?php endforeach;?></table></div>
<div class="box"><h2>Son Siparişler</h2><table><tr><th>Sipariş</th><th>Müşteri</th><th>Toplam</th><th>Ödeme</th><th>Durum</th></tr><?php foreach($orders as $o):?><tr><td><?=htmlspecialchars($o['order_no'])?></td><td><?=htmlspecialchars($o['customer_name'])?></td><td><?=$o['total']?> TL</td><td><?=$o['payment_status']?></td><td><?=$o['order_status']?></td></tr><?php endforeach;?></table></div>
</div></body></html>
