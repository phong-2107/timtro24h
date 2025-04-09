<?php
// views/admin/layouts/header.php

// Get current page for title
$currentPage = $_GET['page'] ?? 'dashboard';

// Page name mapping
$pageNames = [
    'dashboard' => 'Trang Chủ',
    'room' => 'Tin Phòng',
    'user' => 'Người Dùng',
    'news' => 'Tin Tức',
    'key' => 'Quyền',
    'setting' => 'Cài Đặt',
    'dong-xuat' => 'Đăng Xuất'
];

// User info (in real implementation, this would come from session)
$userName = $_SESSION['user_name'] ?? "Nguyễn Thanh Phong";
?>

<div class="admin-header">
    <div class="left-section">
        <span class="menu-title">Quản Trị</span>
        <span class="divider">|</span>
        <span class="current-page">
            <?php echo isset($pageNames[$currentPage]) ? $pageNames[$currentPage] : 'Trang Chủ'; ?>
        </span>
    </div>
    <div class="right-section">
        <div class="user-info">
            <span class="username"><?php echo htmlspecialchars($userName); ?></span>
            <!-- <a href="index.php?action=logout" class="logout-btn">
                <img class="fa fa-sign-out" src="https://c.animaapp.com/W9WTQKAn/img/log-out-1.svg" alt="Logout">
            </a> -->
        </div>
    </div>
</div>