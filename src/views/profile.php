<?php
ob_start();
// Lấy thông tin từ $userData được truyền vào từ controller
?>

<link rel="stylesheet" href="/public/styles/user/UserProfile.css">

<div class="user-profile">
  <div class="user-profile__container">
    <?php include __DIR__ . '/components/profile/Sidebar.php'; ?>
    
    <div class="profile-form">
      <div class="profile-form__container">
        <div class="profile-form__title">
          <div class="profile-form__title-text">Thông tin cá nhân</div>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="POST" action="?action=update_profile" enctype="multipart/form-data">
          <div class="profile-form__field">
            <div class="profile-form__field-group">
              <div class="profile-form__label">
                <div class="profile-form__label-text">Tên hiển thị</div>
              </div>
              <input
                type="text"
                name="displayName"
                class="profile-form__input"
                value="<?php echo htmlspecialchars($userData['hoTen']); ?>"
              />
            </div>
          </div>

          <div class="profile-form__avatar-section">
            <div class="profile-form__avatar-group">
              <div class="profile-form__avatar-label">
                <div class="profile-form__label-text">Ảnh đại diện</div>
              </div>
              <div class="profile-form__avatar-image"></div>
            </div>
          </div>

          <label class="profile-form__button profile-form__button--secondary">
            Thay đổi ảnh
            <input type="file" name="avatar" style="display:none">
          </label>

          <div class="profile-form__field">
            <div class="profile-form__field-group">
              <div class="profile-form__label">
                <div class="profile-form__label-text">Email</div>
              </div>
              <input
                type="email"
                name="email"
                class="profile-form__input"
                value="<?php echo htmlspecialchars($userData['email']); ?>"
              />
            </div>
          </div>

          <div class="profile-form__field">
            <div class="profile-form__field-group">
              <div class="profile-form__label">
                <div class="profile-form__label-text">Số điện thoại</div>
              </div>
              <input
                type="tel"
                name="phone"
                class="profile-form__input"
                value="<?php echo htmlspecialchars($userData['soDienThoai']); ?>"
              />
            </div>
          </div>

          <div class="profile-form__field">
            <div class="profile-form__field-group">
              <div class="profile-form__label">
                <div class="profile-form__label-text">Địa chỉ</div>
              </div>
              <input
                type="text"
                name="address"
                class="profile-form__input"
                value="<?php echo htmlspecialchars($userData['diaChi']); ?>"
              />
            </div>
          </div>
          
          <div class="profile-form__button-wrapper">
            <a href="?action=change_password" class="profile-form__button profile-form__button--secondary">Đổi mật khẩu</a>
            <button type="submit" name="save_profile" class="profile-form__button profile-form__button--primary">Lưu thay đổi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>