<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_profile'])) {
    // Process form data here
    // Update the user profile in database
    
    // For demonstration, just update the local data
    $userData = [
        'displayName' => $_POST['displayName'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'address' => $_POST['address']
    ];
    
    // Display success message
    $successMessage = "Thông tin đã được cập nhật thành công!";
}
?>
<div class="profile-form">
  <div class="profile-form__container">
    <div class="profile-form__title">
      <div class="profile-form__title-text">Thông tin cá nhân</div>
    </div>

    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>

    <form method="POST" action="" enctype="multipart/form-data">
      <div class="profile-form__field">
        <div class="profile-form__field-group">
          <div class="profile-form__label">
            <div class="profile-form__label-text">Tên hiển thị</div>
          </div>
          <input
            type="text"
            name="displayName"
            class="profile-form__input"
            value="<?php echo htmlspecialchars($userData['displayName']); ?>"
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
            value="<?php echo htmlspecialchars($userData['phone']); ?>"
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
            value="<?php echo htmlspecialchars($userData['address']); ?>"
          />
        </div>
      </div>
      
      <div class="profile-form__button-wrapper">
        <a href="/profile/change-password" class="profile-form__button profile-form__button--secondary">Đổi mật khẩu</a>
        <button type="submit" name="save_profile" class="profile-form__button profile-form__button--primary">Lưu thay đổi</button>
      </div>
    </form>
  </div>
</div>