<?php
// src/views/admin_UI/layouts/admin_layout.php

// Xác định nội dung hiển thị dựa trên tham số page
$page = $_GET['page'] ?? 'dashboard';

// Mapping trang và đường dẫn view tương ứng
$viewMapping = [
    'dashboard' => __DIR__ . '/../dashboard/index.php',
    'room' => __DIR__ . '/../room/index.php',
    'create-room' => __DIR__ . '/../create-room/index.php',
    'user' => __DIR__ . '/../user/index.php',
    'setting' => __DIR__ . '/../setting/index.php',
    'tin-tuc' => __DIR__ . '/../tin-tuc/index.php',
];

$contentView = $viewMapping[$page] ?? $viewMapping['dashboard'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimTro24H - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/admin/admin.css">   
    <link rel="stylesheet" href="/public/styles/admin/variables.css">


    
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar Component -->
        <?php include 'sidebar.php'; ?>

        <!-- Content Area -->
        <div class="admin-content">
            <!-- Header Component -->
            <?php include 'header.php'; ?>

            <!-- Main Content Area -->
            <div class="admin-main">
                <?php include $contentView; ?>
            </div>
        </div>
    </div>

    <script src="/assets/js/admin.js"></script>
</body>
</html>