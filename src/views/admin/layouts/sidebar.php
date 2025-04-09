<?php
// views/admin/layouts/sidebar.php

// Get current page for sidebar highlighting
$currentPage = $_GET['page'] ?? 'dashboard';

// Helper function to check if a menu item is active
function isActive($menuPath, $currentPage) {
    if ($menuPath === 'dashboard') {
        return $currentPage === $menuPath;
    }
    // For other routes, check if the current path starts with the menu path
    return strpos($currentPage, $menuPath) === 0;
}
?>

<div class="admin-sidebar">
    <div class="logo-container">
        <a href="index.php?action=manager&page=dashboard" class="logo-link">
            <img src="https://c.animaapp.com/m8twrcooYWMm14/img/logo.png" alt="TimTro24H" class="logo">
        </a>
    </div>

    <nav class="sidebar-menu">
        <ul>
            <li class="<?php echo isActive('dashboard', $currentPage) ? 'active' : ''; ?>">
                <a href="index.php?action=manager&page=dashboard">
                    <img src="https://c.animaapp.com/W9WTQKAn/img/dashboard-1.svg" class="menu-icon" alt="">
                    <span>Trang Chủ</span>
                </a>
            </li>
            <li class="<?php echo isActive('room', $currentPage) ? 'active' : ''; ?>">
                <a href="index.php?action=manager&page=room">
                    <img src="https://c.animaapp.com/W9WTQKAn/img/home-1.svg" class="menu-icon" alt="">
                    <span>Tin Phòng</span>
                </a>
            </li>
            <li class="<?php echo isActive('tin-tuc', $currentPage) ? 'active' : ''; ?>">
                <a href="index.php?action=manager&page=diadiem">
                    <img src="https://c.animaapp.com/W9WTQKAn/img/smartphone-1.svg" class="menu-icon" alt="">
                    <span>Địa Điểm</span>
                </a>
            </li>
            <li class="<?php echo isActive('user', $currentPage) ? 'active' : ''; ?>">
                <a href="index.php?action=manager&page=user">
                    <img src="https://c.animaapp.com/W9WTQKAn/img/users-1.svg" class="menu-icon" alt="">
                    <span>Người Dùng</span>
                </a>
            </li>
            <li class="<?php echo isActive('tin-tuc', $currentPage) ? 'active' : ''; ?>">
                <a href="index.php?action=manager&page=tin-tuc">
                    <img src="https://c.animaapp.com/W9WTQKAn/img/smartphone-1.svg" class="menu-icon" alt="">
                    <span>Tin Tức</span>
                </a>
            </li>
            <li class="<?php echo isActive('quyen', $currentPage) ? 'active' : ''; ?>">
                <a href="index.php?action=manager&page=quyen">
                    <img src="https://c.animaapp.com/W9WTQKAn/img/key-1.svg" class="menu-icon" alt="">
                    <span>Quyền</span>
                </a>
            </li>
            <li class="<?php echo isActive('setting', $currentPage) ? 'active' : ''; ?>">
                <a href="index.php?action=manager&page=setting">
                    <img src="https://c.animaapp.com/W9WTQKAn/img/settings.svg" class="menu-icon" alt="">
                    <span>Cài Đặt</span>
                </a>
            </li>
            <li class="divider"></li>
            <li class="<?php echo isActive('dong-xuat', $currentPage) ? 'active' : ''; ?>">
                <a href="index.php?action=logout">
                    <img src="https://c.animaapp.com/W9WTQKAn/img/log-out-1.svg" class="menu-icon" alt="">
                    <span>Đăng Xuất</span>
                </a>
            </li>
        </ul>
    </nav>
    <p class="copyright-admin">copyright @timtro24h</p>
</div>