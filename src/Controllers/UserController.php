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
    
            $users = $this->userModel->all(); // Hoặc sử dụng findByTaiKhoan nếu có
    
            foreach ($users as $user) {
                if ($user['taiKhoan'] === $taiKhoan && password_verify($matKhau, $user['matKhau'])) {
                    $_SESSION['user'] = $user;
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_role'] = $user['loaiUser'];
    
                    // 👉 Chuyển hướng tùy theo vai trò
                    if ($user['loaiUser'] === 'Admin' || $user['loaiUser'] === 'NhanVien') {
                        header('Location: /public/index.php?action=manager&page=dashboard');
                        exit();
                    } else {
                        header('Location: /public/index.php');
                        exit();
                    }
                }
            }
    
            // Sai tài khoản hoặc mật khẩu
            $error = 'Sai tài khoản hoặc mật khẩu!';
            header('Location: /public/index.php?action=login&error=' . urlencode($error));
            exit();
        }
    
        // Không phải POST → trở lại form
        header('Location: /public/index.php?action=login');
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
    
            header('Location: /public/index.php?action=home');
            exit();
        }
    
        header('Location: ?action=register');
        exit();
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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();  
        session_destroy(); 
        header('Location: /public/index.php?action=home');
        exit();
    }
    

    // Hiển thị profile người dùng
    public function profile() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $user = $this->userModel->find($userId);
        include_once __DIR__ . '/../views/user/profile.php';
    }

    public function updateProfile() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':hoTen' => $_POST['displayName'] ?? '',
                ':soDienThoai' => $_POST['phone'] ?? '',
                ':email' => $_POST['email'] ?? '',
                ':diaChi' => $_POST['address'] ?? '',
                ':gioiTinh' => $_SESSION['user']['gioiTinh'] ?? 'Nam',
                ':taiKhoan' => $_SESSION['user']['taiKhoan'],
                ':matKhau' => $_SESSION['user']['matKhau'],
                ':loaiUser' => $_SESSION['user']['loaiUser'],
                ':role_id' => $_SESSION['user']['role_id'],
            ];

            $this->userModel->update($userId, $data);
            $_SESSION['user'] = $this->userModel->find($userId);
        }

        header('Location: ?action=profile');
        exit();
    }
}