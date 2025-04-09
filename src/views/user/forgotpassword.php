<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Khôi phục mật khẩu - QL Phòng Trọ</title>
    <link rel="stylesheet" href="/public/styles/user/forgotpassword.css">
</head>

<body>
    <div class="page-wrapper">
        <div class="sign-in">
            <div class="container">
                <div class="logo">
                    <a href="/"><img src="/public/images/logo1.png" alt="logo"></a>
                </div>
                
                <h2 class="auth-title">Khôi phục mật khẩu</h2>
                
                <form class="form" method="post" action="/public/index.php?action=do_forgot_password">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            placeholder="Nhập email để khôi phục mật khẩu"
                            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" 
                            required 
                        />
                    </div>

                    <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])): ?>
                        <p class="error"><?= htmlspecialchars($_SESSION['error']) ?></p>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['message']) && !empty($_SESSION['message'])): ?>
                        <p class="success-message"><?= htmlspecialchars($_SESSION['message']) ?></p>
                        <?php unset($_SESSION['message']); ?>
                    <?php endif; ?>

                    <button type="submit" class="forgot-btn" style="background-color: #3b82f6; color: #fff;">Gửi mật khẩu mới</button>
                    
                    <div class="back-to-login" style="margin-top: 15px; text-align: center;">
                        <a href="/public/index.php?action=login" style="color: #3b82f6; text-decoration: none;">Quay lại đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="footer-login">
            <p class="footer-copy">Được tạo bởi</p>
            <div class="footer-logo">
                <img src="/public/images/logo1.png" alt="logo">
            </div>
        </div>
    </div>
</body>

</html>