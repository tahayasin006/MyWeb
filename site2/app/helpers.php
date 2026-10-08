<?php
require_once __DIR__.'/config.php';

function json_response(array $data, int $status=200): never {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function order_no(): string {
    return '3BYZ-'.date('ymd').'-'.strtoupper(bin2hex(random_bytes(3)));
}

function require_admin(): void {
    if (empty($_SESSION['admin_id'])) {
        header('Location: ../admin/login.php');
        exit;
    }
}
