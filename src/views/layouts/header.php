<?php
// Giả sử đã có session_start() ở index.php
$user = $_SESSION['user'] ?? null;
?>

<!-- Header -->
<link rel="stylesheet" href="/styles/common/Header.css" />

<div class="header">
    <div class="navbar-wrapper">
        <div class="navbar">

            <!-- Logo -->
            <a href="/public/index.php" class="logo">
                <div class="logo-2"></div>
            </a>

            <!-- Menu chính -->
            <div class="frame-2">
                <div class="frame-3">
                    <a href="/public/index.php/?action=phongtro_roompage" class="text-wrapper-8">Phòng trọ</a>
                    <a href="/?action=role_index" class="text-wrapper-8">Danh Mục</a>
                    <a href="/?action=news" class="text-wrapper-8">Tin Tức</a>
                    <a href="/?action=diadiem_index" class="text-wrapper-8">Địa Điểm</a>
                </div>
            </div>

            <!-- Đăng nhập / đăng ký hoặc thông tin user -->
            <div class="frame-2">
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['taiKhoan'])): ?>
                <div class="user-info">
                    <span>Hi! <strong><?= htmlspecialchars($_SESSION['user']['taiKhoan']) ?></strong></span>
                    <form method="GET" action="/public/index.php" style="margin:0;">
                        <input type="hidden" name="action" value="logout">
                        <button type="submit" class="logout" title="Đăng xuất">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
                <?php else: ?>
                <a href="/public/index.php?action=login" class="SIGN-IN">Đăng Nhập</a>
                <div class="SIGN-UP-wrapper">
                    <a href="/public/index.php?action=register" class="SIGN-UP">Đăng Ký</a>
                </div>
                <?php endif; ?>
            </div>


        </div>
    </div>
</div>