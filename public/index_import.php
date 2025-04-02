<?php
require __DIR__ . '/../vendor/autoload.php';

use NguyenPhong\BtComposerQlsv\Controllers\ExcelImportController;

// Khởi tạo controller và xử lý upload
$controller = new ExcelImportController();
$result = $controller->handleUpload();

// Biến truyền sang view
$sheetData = $result['sheetData'] ?? [];
$message   = $result['message'] ?? '';

// Include file view template
include __DIR__ . '/../src/views/template.php';