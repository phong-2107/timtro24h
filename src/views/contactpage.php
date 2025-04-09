<?php
// Bắt đầu session trước khi sử dụng
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();

// Hiển thị debug session - Chỉ dùng khi debug
/*
echo "<div style='background:#f1f1f1; padding:10px; margin:10px; border:1px solid #ccc;'>";
echo "<strong>DEBUG SESSION:</strong><br>";
echo "Session ID: " . session_id() . "<br>";
echo "Toàn bộ session: <pre>";
print_r($_SESSION);
echo "</pre>";
echo "</div>";
*/

// Kiểm tra xem có thông báo từ session không
$success_message = $_SESSION['contact_success'] ?? '';
$error_message = $_SESSION['contact_error'] ?? '';
?>
<link rel="stylesheet" href="/public/styles/contact/contact.css" />

<div class="contact-container">
  <div class="contact-wrapper">
    <div class="contact-form-section">
      <div class="contact-content">
        <div class="contact-form-card">
          <div class="form-header">
            <h2 class="form-title">Liên Hệ</h2>
            <p class="form-subtitle">
              Mọi thắc mắc liên hệ với chúng tôi theo hướng dẫn bên dưới!
            </p>
          </div>

                    <!-- Hiển thị thông báo thành công nếu có -->
          <?php if (!empty($success_message)): ?>
          <div class="alert alert-success" role="alert">
              <i class="fa fa-check-circle" aria-hidden="true"></i> 
              <?php echo htmlspecialchars($success_message); ?>
          </div>
          <?php endif; ?>

          <!-- Hiển thị thông báo lỗi nếu có -->
          <?php if (!empty($error_message)): ?>
          <div class="alert alert-danger" role="alert">
              <i class="fa fa-exclamation-circle" aria-hidden="true"></i> 
              <?php echo htmlspecialchars($error_message); ?>
          </div>
          <?php endif; ?>

          <form method="POST" action="index.php?action=contact_submit">
            <div class="form-group">
              <div class="input-container">
                <input type="text" name="name" placeholder="Họ & Tên" class="form-input" required />
              </div>
            </div>

            <div class="form-group">
              <div class="input-container">
              <input type="email" name="email" placeholder="Mail" class="form-input" required
              value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
              </div>
            </div>

            <div class="form-group">
              <div class="input-container">
                <input type="tel" name="phone" placeholder="Số Điện Thoại" class="form-input" required />
              </div>
            </div>

            <div class="form-group">
              <div class="textarea-container">
                <textarea name="message" placeholder="Nội Dung" class="form-textarea" required></textarea>
              </div>
            </div>

            <button type="submit" class="submit-button">GỬI NGAY</button>
          </form>
        </div>

        <div class="contact-info-section">
          <!-- Phần thông tin liên hệ giữ nguyên -->
          <div class="info-header">
            <h2 class="info-title">THÔNG TIN LIÊN HỆ</h2>
          </div>

          <div class="info-content">
            <div class="info-item">
              <img
                class="info-icon"
                alt="Email icon"
                src="https://c.animaapp.com/9cQhdlZc/img/frame.svg"
              />
              <div class="info-text">info@gmail.com</div>
            </div>

            <div class="info-item">
              <img
                class="info-icon"
                alt="Phone icon"
                src="https://c.animaapp.com/9cQhdlZc/img/vector.svg"
              />
              <div class="info-text">+84345651206</div>
            </div>

            <div class="info-item">
              <img
                class="info-icon"
                alt="Location icon"
                src="https://c.animaapp.com/9cQhdlZc/img/vector-2.svg"
              />
              <div class="info-text">Thủ Đức, Tp. Hồ Chí Minh</div>
            </div>

            <div class="info-item">
              <img
                class="info-icon"
                alt="Website icon"
                src="https://c.animaapp.com/9cQhdlZc/img/vector-2.svg"
              />
              <div class="info-text">www.timtro24h.com</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="map-container">
      <?php include __DIR__ . '/components/Home/map.php'; ?>
    </div>
  </div>
</div>

<!-- Thêm CSS mới cho thông báo -->
<style>
.alert {
  padding: 15px;
  margin-bottom: 20px;
  border: 1px solid transparent;
  border-radius: 4px;
}
.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
}
.alert-danger {
  color: #721c24;
  background-color: #f8d7da;
  border-color: #f5c6cb;
}
</style>


<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/layouts/main.php'; ?>