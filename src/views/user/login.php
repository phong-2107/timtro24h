<!-- src/views/user/login.php -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập - QL Phòng Trọ</title>
    <link rel="stylesheet" href="/public/styles/user/SignIn.css">
</head>

<body>
    <div class="sign-in">
        <div class="container">
            <div class="logo">
                <a href="/"><img src="/public/images/logo1.png" alt="logo"></a>
            </div>

            <form class="form" method="post" action="/public/index.php?action=do_login">
                <div class="form-group">
                    <label for="taiKhoan">Tên đăng nhập</label>
                    <input id="taiKhoan" name="taiKhoan" type="text" placeholder="Email đăng nhập"
                        value="<?= htmlspecialchars($_POST['taiKhoan'] ?? '') ?>" required />
                </div>

                <div class="form-group">
                    <label for="matKhau">Mật khẩu</label>
                    <input id="matKhau" name="matKhau" type="password" placeholder="Mật khẩu" required />
                </div>

                <?php if (!empty($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <div class="options">
                    <label class="remember">
                        <input type="checkbox" name="remember" <?= isset($_POST['remember']) ? 'checked' : '' ?> />
                        Ghi nhớ tài khoản
                    </label>
                    <a href="#" class="forgot">Quên mật khẩu?</a>
                </div>

                <button type="submit" class="login-btn">Đăng nhập</button>

                <div class="divider"><span>Hoặc</span></div>

                <button type="button" class="google-btn">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"
                        alt="Google" />
                </button>

                <div class="register">
                    Chưa có tài khoản? <a href="/public/index.php?action=register">Đăng ký</a>
                </div>
            </form>
        </div>

        <div class="footer">
            <p>Được tạo bởi</p>
            <div class="footer-logo">
                <img src="/public/images/logo1.png" alt="logo">
            </div>
        </div>
    </div>
</body>

</html>