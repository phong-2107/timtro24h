<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng ký - QL Phòng Trọ</title>
    <link rel="stylesheet" href="/public/styles/user/SignIn.css">
</head>

<body>
    <div class="sign-in">
        <div class="container">
            <div class="logo">
                <a href="/"><img src="/public/images/logo1.png" alt="logo"></a>
            </div>

            <form class="form" method="POST" action="/public/index.php?action=do_register">
                <div class="form-group">
                    <label for="hoTen">Họ tên</label>
                    <input id="hoTen" name="hoTen" type="text" placeholder="Nhập họ tên"
                        value="<?= htmlspecialchars($_POST['hoTen'] ?? '') ?>" required />
                </div>

                <div class="form-group">
                    <label for="soDienThoai">Số điện thoại</label>
                    <input id="soDienThoai" name="soDienThoai" type="text" placeholder="Nhập số điện thoại"
                        value="<?= htmlspecialchars($_POST['soDienThoai'] ?? '') ?>" required />
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" placeholder="Nhập email"
                        value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />
                </div>

                <div class="form-group">
                    <label for="diaChi">Địa chỉ</label>
                    <input id="diaChi" name="diaChi" type="text" placeholder="Nhập địa chỉ"
                        value="<?= htmlspecialchars($_POST['diaChi'] ?? '') ?>" />
                </div>

                <div class="form-group">
                    <label>Giới tính</label>
                    <select name="gioiTinh" class="form-select" required>
                        <option value="Nam" <?= (($_POST['gioiTinh'] ?? '') === 'Nam') ? 'selected' : '' ?>>Nam</option>
                        <option value="Nữ" <?= (($_POST['gioiTinh'] ?? '') === 'Nữ') ? 'selected' : '' ?>>Nữ</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="taiKhoan">Tài khoản</label>
                    <input id="taiKhoan" name="taiKhoan" type="text" placeholder="Tài khoản"
                        value="<?= htmlspecialchars($_POST['taiKhoan'] ?? '') ?>" required />
                </div>

                <div class="form-group">
                    <label for="matKhau">Mật khẩu</label>
                    <input id="matKhau" name="matKhau" type="password" placeholder="Mật khẩu" required />
                </div>

                <?php if (!empty($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <!-- Ẩn role_id, luôn là CUSTOMER (id = 3) -->
                <input type="hidden" name="role_id" value="3">
                <input type="hidden" name="loaiUser" value="KhachHang">

                <button type="submit" class="login-btn">Đăng ký</button>

                <div class="register">
                    Đã có tài khoản? <a href="/public/index.php?action=login">Đăng nhập</a>
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