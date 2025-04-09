<?php
// components/profile/Sidebar.php
$currentPath = $_SERVER['REQUEST_URI'];
$isProfilePage = strpos($currentPath, 'action=profile') !== false;
$isChangePasswordPage = strpos($currentPath, 'action=change_password') !== false;
?>

<div class="sidebar">
  <!-- User Info Section -->
  <div class="sidebar__user-info">
    <div class="sidebar__avatar"></div>
    <div class="sidebar__username">
      <div class="sidebar__username-text"><?php echo isset($userData['hoTen']) ? htmlspecialchars($userData['hoTen']) : 'Người dùng'; ?></div>
    </div>
  </div>
  
  <!-- Personal Info Button -->
  <a href="?action=profile" class="sidebar__menu-item <?php echo $isProfilePage ? 'sidebar__menu-item--active' : ''; ?>">
    <img
      class="sidebar__menu-icon"
      alt="Profile Icon"
      src="https://c.animaapp.com/Av7kc8aL/img/icon.svg"
    />
    <div class="sidebar__menu-text">
      <div class="sidebar__menu-label">Thông tin cá nhân</div>
    </div>
  </a>
  
  <!-- Logout Button -->
  <a href="?action=logout" class="sidebar__menu-item sidebar__menu-item--logout">
    <div class="sidebar__menu-icon-wrapper">
      <img
        class="sidebar__logout-icon"
        alt="Logout"
        src="https://c.animaapp.com/Av7kc8aL/img/group-16@2x.png"
      />
    </div>
    <div class="sidebar__menu-text">
      <div class="sidebar__menu-label">Đăng xuất</div>
    </div>
  </a>
</div>