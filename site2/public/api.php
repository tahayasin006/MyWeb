<?php
require_once __DIR__.'/../app/helpers.php';

$action = $_GET['action'] ?? '';

if ($action === 'products') {
    $stmt = db()->query("SELECT * FROM products WHERE active=1 ORDER BY id DESC");
    json_response(['ok'=>true,'products'=>$stmt->fetchAll()]);
}

if ($action === 'product') {
    $id = (int)($_GET['id'] ?? 0);
    $stmt = db()->prepare("SELECT * FROM products WHERE id=? AND active=1");
    $stmt->execute([$id]);
    $p = $stmt->fetch();
    if (!$p) json_response(['ok'=>false,'message'=>'Ürün bulunamadı'],404);
    json_response(['ok'=>true,'product'=>$p]);
}

if ($action === 'create-order' && $_SERVER['REQUEST_METHOD']==='POST') {
    $data = json_decode(file_get_contents('php://input'), true) ?: [];
    $items = $data['items'] ?? [];
    $customer = $data['customer'] ?? [];

    if (!$items || !$customer['name'] || !$customer['email'] || !$customer['phone'] || !$customer['address']) {
        json_response(['ok'=>false,'message'=>'Eksik bilgi'],422);
    }

    $pdo = db();
    $pdo->beginTransaction();
    try {
        $subtotal = 0;
        $validated = [];

        foreach ($items as $item) {
            $id = (int)$item['id'];
            $qty = max(1,(int)$item['quantity']);
            $stmt = $pdo->prepare("SELECT id,name,price,stock FROM products WHERE id=? AND active=1 FOR UPDATE");
            $stmt->execute([$id]);
            $p = $stmt->fetch();
            if (!$p || $p['stock'] < $qty) throw new Exception('Stok yetersiz: '.($p['name'] ?? 'ürün'));
            $subtotal += ((float)$p['price']) * $qty;
            $validated[] = [$p,$qty];
        }

        $shipping = $subtotal >= 750 ? 0 : 59.90;
        $total = $subtotal + $shipping;
        $orderNo = order_no();

        $stmt = $pdo->prepare("INSERT INTO orders
          (order_no,customer_name,email,phone,address,city,district,postal_code,subtotal,shipping,total,payment_method)
          VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->execute([
          $orderNo,$customer['name'],$customer['email'],$customer['phone'],$customer['address'],
          $customer['city'] ?? '',$customer['district'] ?? '',$customer['postal_code'] ?? '',
          $subtotal,$shipping,$total,$data['payment_method'] ?? 'iyzico'
        ]);
        $orderId = (int)$pdo->lastInsertId();

        $stmtItem = $pdo->prepare("INSERT INTO order_items
          (order_id,product_id,product_name,quantity,unit_price) VALUES (?,?,?,?,?)");
        $stmtStock = $pdo->prepare("UPDATE products SET stock=stock-? WHERE id=?");
        foreach ($validated as [$p,$qty]) {
            $stmtItem->execute([$orderId,$p['id'],$p['name'],$qty,$p['price']]);
            $stmtStock->execute([$qty,$p['id']]);
        }
        $pdo->commit();

        json_response([
          'ok'=>true,'order_id'=>$orderId,'order_no'=>$orderNo,
          'total'=>number_format($total,2,'.','')
        ]);
    } catch(Throwable $e) {
        $pdo->rollBack();
        json_response(['ok'=>false,'message'=>$e->getMessage()],400);
    }
}

json_response(['ok'=>false,'message'=>'Geçersiz işlem'],404);
