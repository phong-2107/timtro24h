<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\User;

class UserController {
    private $userModel;

    public function __construct($conn) {
        $this->userModel = new User($conn);
    }

    // Hiển thị trang đăng nhập
    public function showLogin() {
        $error = '';
        include_once __DIR__ . '/../views/user/login.php';
    }

    // Xử lý đăng nhập
    public function login() {
        session_start();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taiKhoan = $_POST['taiKhoan'] ?? '';
            $matKhau = $_POST['matKhau'] ?? '';

            // Tìm user theo tài khoản
            $users = $this->userModel->all(); // hoặc viết hàm findByTaiKhoan()
            foreach ($users as $user) {
                if ($user['taiKhoan'] === $taiKhoan && password_verify($matKhau, $user['matKhau'])) {
                    $_SESSION['user'] = $user;
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_role'] = $user['loaiUser'];
                    
                    // Điều hướng
                    header('Location: ?action=dashboard');
                    exit();
                }
            }

            $error = 'Sai tài khoản hoặc mật khẩu!';
        }

        include_once __DIR__ . '/../views/user/login.php';
    }

    // Hiển thị trang đăng ký
    public function showRegister() {
        $error = '';
        include_once __DIR__ . '/../views/user/register.php';
    }

    // Xử lý đăng ký
    public function register() {
        session_start();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':hoTen' => $_POST['hoTen'] ?? '',
                ':soDienThoai' => $_POST['soDienThoai'] ?? '',
                ':email' => $_POST['email'] ?? '',
                ':diaChi' => $_POST['diaChi'] ?? '',
                ':gioiTinh' => $_POST['gioiTinh'] ?? 'Nam',
                ':taiKhoan' => $_POST['taiKhoan'] ?? '',
                ':matKhau' => password_hash($_POST['matKhau'] ?? '', PASSWORD_DEFAULT),
                ':loaiUser' => $_POST['loaiUser'] ?? 'SinhVien',
                ':role_id' => $_POST['role_id'] ?? 2
            ];

            // Kiểm tra tài khoản đã tồn tại?
            $allUsers = $this->userModel->all();
            foreach ($allUsers as $u) {
                if ($u['taiKhoan'] === $data[':taiKhoan']) {
                    $error = 'Tài khoản đã tồn tại!';
                    include_once __DIR__ . '/../views/user/register.php';
                    return;
                }
            }

            $newId = $this->userModel->create($data);
            $_SESSION['user_id'] = $newId;
            $_SESSION['user'] = $data;
            $_SESSION['user_role'] = $data[':loaiUser'];

            header('Location: ?action=dashboard');
            exit();
        }

        include_once __DIR__ . '/../views/user/register.php';
    }

    public function index() {
        $search = $_GET['search'] ?? null;
        $currentPage = $_GET['page'] ?? 1;
        $perPage = 10;
        $offset = ($currentPage - 1) * $perPage;
    
        if ($search) {
            $users = $this->userModel->search($search, $perPage, $offset);
            $totalUsers = $this->userModel->countSearchResults($search);
        } else {
            $users = $this->userModel->paginate($perPage, $offset);
            $totalUsers = $this->userModel->countAll();
        }
    
        $totalPages = ceil($totalUsers / $perPage);
    
        include __DIR__ . '/../views/admin_UI/user/admin_user.php';
    }
    
    
    // Logout
    public function logout() {
        session_start();
        session_destroy();
        header('Location: ?action=login');
        exit();
    }
}