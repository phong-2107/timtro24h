<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\User;

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new User($conn);
    }

    // Hiển thị trang đăng nhập (GET)
    public function showLogin() {
        // session_start();
        $error = $_GET['error'] ?? '';
        include_once __DIR__ . '/../views/user/login.php';
    }

    // Xử lý đăng nhập (POST)
    public function login() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taiKhoan = $_POST['taiKhoan'] ?? '';
            $matKhau = $_POST['matKhau'] ?? '';

            // Tìm user theo tài khoản
            $users = $this->userModel->all(); // Có thể tối ưu với findByTaiKhoan()
            foreach ($users as $user) {
                if ($user['taiKhoan'] === $taiKhoan && password_verify($matKhau, $user['matKhau'])) {
                    $_SESSION['user'] = $user;
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_role'] = $user['loaiUser'];
                    
                    header('Location: ?action=dashboard');
                    exit();
                }
            }

            // Đăng nhập thất bại → quay lại trang login + lỗi
            $error = 'Sai tài khoản hoặc mật khẩu!';
            header('Location: ?action=login&error=' . urlencode($error));
            exit();
        }

        // Nếu không phải POST, chuyển về form đăng nhập
        header('Location: ?action=login');
        exit();
    }

    // Hiển thị form đăng ký
    public function showRegister() {
        // session_start();
        $error = $_GET['error'] ?? '';
        include_once __DIR__ . '/../views/user/register.php';
    }

    // Xử lý đăng ký
    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':hoTen' => $_POST['hoTen'] ?? '',
                ':soDienThoai' => $_POST['soDienThoai'] ?? '',
                ':email' => $_POST['email'] ?? '',
                ':diaChi' => $_POST['diaChi'] ?? '',
                ':gioiTinh' => $_POST['gioiTinh'] ?? 'Nam',
                ':taiKhoan' => $_POST['taiKhoan'] ?? '',
                ':matKhau' => password_hash($_POST['matKhau'] ?? '', PASSWORD_DEFAULT),
                ':loaiUser' => $_POST['loaiUser'] ?? 'KhachHang', 
                ':role_id' => $_POST['role_id'] ?? 3 
            ];
    
            // Kiểm tra tài khoản đã tồn tại
            foreach ($this->userModel->all() as $u) {
                if ($u['taiKhoan'] === $data[':taiKhoan']) {
                    $error = 'Tài khoản đã tồn tại!';
                    header('Location: ?action=register&error=' . urlencode($error));
                    exit();
                }
            }
    
            // Tạo tài khoản
            $newId = $this->userModel->create($data);
           // Lấy lại user vừa tạo từ DB theo ID
            $newUser = $this->userModel->find($newId);

            // Lưu vào session
            $_SESSION['user_id'] = $newId;
            $_SESSION['user'] = $newUser;
$_SESSION['user_role'] = $newUser['loaiUser'];
    
            header('Location: ?action=dashboard');
            exit();
        }
    
        header('Location: ?action=register');
        exit();
    }
    

    // Logout
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();  
        session_destroy(); 
        header('Location: /public/index.php?action=home');
        exit();
    }
    
}