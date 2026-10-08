<?php
declare(strict_types=1);

define('DB_HOST', 'localhost');
define('DB_NAME', 'mekyapid_MySon');
define('DB_USER', 'mekyapid_MySon');
define('DB_PASS', 'OmerAli2020.');

define('BASE_URL', 'https://3byaz.com.tr');

define('IYZICO_API_KEY', 'BURAYA_IYZICO_API_KEY');
define('IYZICO_SECRET_KEY', 'BURAYA_IYZICO_SECRET_KEY');
define('IYZICO_BASE_URL', 'https://sandbox-api.iyzipay.com');

define('WHATSAPP_PHONE', '905554460644');

session_start();

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',
            DB_USER,
            DB_PASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
    return $pdo;
}
