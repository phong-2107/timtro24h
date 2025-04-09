<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    // Process form data here
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $acceptPassword = $_POST['acceptPassword'];
    
    // Validate passwords
    $errors = [];
    
    if (empty($currentPassword)) {
        $errors[] = "Vui lòng nhập mật khẩu hiện tại";
    }
    
    if (empty($newPassword)) {
        $errors[] = "Vui lòng nhập mật khẩu mới";
    }
    
    if ($newPassword !== $acceptPassword) {
        $errors[] = "Mật khẩu xác nhận không khớp";
    }
    
    // If no errors, proceed with password change
    if (empty($errors)) {
        // Update password in database
        // ...
        
        $successMessage = "Mật khẩu đã được thay đổi thành công!";
    }
}
?>

<div class="profile-form">
  <div class="profile-form__container">
    <div class="profile-form__title">
      <div class="profile-form__title-text">Đổi mật khẩu</div>
    </div>
    
    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
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