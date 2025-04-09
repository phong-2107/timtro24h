<?php
ob_start();
?>

<link rel="stylesheet" href="/public/styles/user/UserProfile.css">

<div class="user-profile">
  <div class="user-profile__container">
    <?php include __DIR__ . '/components/profile/Sidebar.php'; ?>
    
    <div class="profile-form">
      <div class="profile-form__container">
        <div class="profile-form__title">
          <div class="profile-form__title-text">Đổi mật khẩu</div>
        </div>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="POST" action="?action=do_change_password">
          <div class="profile-form__field">
            <div class="profile-form__field-group">
              <div class="profile-form__label">
                <div class="profile-form__label-text">Mật khẩu cũ</div>
              </div>
              <input
                type="password"
                name="currentPassword"
                class="profile-form__input"
                value=""
              />
            </div>
          </div>

          <div class="profile-form__field">
            <div class="profile-form__field-group">
              <div class="profile-form__label">
                <div class="profile-form__label-text">Mật khẩu mới</div>
              </div>
              <input
                type="password"
                name="newPassword"
                class="profile-form__input"
                value=""
              />
            </div>
          </div>

          <div class="profile-form__field">
            <div class="profile-form__field-group">
              <div class="profile-form__label">
                <div class="profile-form__label-text">Xác nhận mật khẩu</div>
              </div>
              <input
                type="password"
                name="acceptPassword"
                class="profile-form__input"
                value=""
              />
            </div>
          </div>

          <button type="submit" name="change_password" class="profile-form__button-cpw profile-form__button--accept">Xác nhận</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>