<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

// Kết nối MySQL sử dụng MySQLi
$conn = new mysqli('localhost', 'root', '', 'internship_management');
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$errorMessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Sử dụng prepared statement để lấy thông tin user theo username từ bảng users
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Kiểm tra mật khẩu nhập vào với mật khẩu đã mã hóa trong cơ sở dữ liệu
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $username;
            include __DIR__ . '/../src/views/template.php';
            exit;
        } else {
            $errorMessage = "Invalid Username or Password";
        }
    } else {
        $errorMessage = "Invalid Username or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
    }

    .login-container {
        margin-top: 100px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
    }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Đăng nhập</h3>
                        <?php if(!empty($errorMessage)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errorMessage; ?>
                        </div>
                        <?php endif; ?>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Nhập username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Nhập mật khẩu" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-block">Đăng nhập</button>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-3">© <?= date("Y"); ?> Hệ thống quản lý sinh viên</p>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>