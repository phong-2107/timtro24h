<?php
require_once __DIR__ . '/../vendor/autoload.php';

use QLPhongTro\Config\Database;

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    if ($conn) {
        echo "✅ Kết nối database thành công!";
    }
} catch (Exception $e) {
    echo "❌ Kết nối database thất bại: " . $e->getMessage();
}
