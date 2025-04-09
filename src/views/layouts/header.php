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
                    <a href="/?action=role_index" class="text-wrapper-8">Yêu Thích</a>
                    <a href="/public/index.php/?action=news" class="text-wrapper-8">Tin Tức</a>
                    <a href="/public/index.php/?action=contact" class="text-wrapper-8">Liên Hệ</a>
                </div>
            </div>

            <!-- Đăng nhập / đăng ký hoặc thông tin user -->
            <div class="frame-2">
                <?php if (isset($_SESSION['user']) && !empty($_SESSION['user']['taiKhoan'])): ?>
                <div class="user-info">
                    <div class="user-dropdown">
                        <div class="user-toggle" onclick="toggleDropdown()" style="cursor: pointer;">
                            <span>Hi! <strong><?= htmlspecialchars($_SESSION['user']['taiKhoan']) ?></strong></span>
                            <i class="fa-solid fa-bars"></i>
                        </div>

                        <div class="dropdown-box" id="dropdownBox" style="display: none;">
                            <div class="dropdown-item">
                                <a href="?action=profile">Hồ sơ</a>
                            </div>
                            <div class="dropdown-item">
                                <a href="?action=setting">Cài đặt</a>
                            </div>
                            <div class="dropdown-item" style="color: red;">
                                <form method="GET" action="/public/index.php" style="margin: 0;">
                                    <input type="hidden" name="action" value="logout">
                                    <button type="submit" class="logout"
                                        style="background: none; border: none; color: red; cursor: pointer;">
                                        <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
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

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('dropdownBox');
    dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
}
</script>