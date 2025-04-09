<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\User;

class ProfileController {
    private $userModel;
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        $this->userModel = new User($conn);
    }

    // Hiển thị trang thông tin cá nhân
    public function showProfile() {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit();
        }
        
        $userId = $_SESSION['user_id'];
        $userData = $this->userModel->find($userId);
        
        if (!$userData) {
            $_SESSION['error'] = "Không tìm thấy thông tin người dùng!";
            header('Location: ?action=home');
            exit();
        }
        
        include_once __DIR__ . '/../views/profile.php';
    }
    
    // Xử lý cập nhật thông tin cá nhân
    public function updateProfile() {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit();
        }
        
        $userId = $_SESSION['user_id'];
        $userData = $this->userModel->find($userId);
        
        if (!$userData) {
            $_SESSION['error'] = "Không tìm thấy thông tin người dùng!";
            header('Location: ?action=home');
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $displayName = $_POST['displayName'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            
            // Validate dữ liệu
            if (empty($displayName) || empty($email) || empty($phone)) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin bắt buộc!";
                header('Location: ?action=profile');
                exit();
            }
            
            // Cập nhật thông tin người dùng
            $data = [
                ':hoTen' => $displayName,
                ':email' => $email,
                ':soDienThoai' => $phone,
                ':diaChi' => $address,
                // Giữ nguyên các trường khác
                ':gioiTinh' => $userData['gioiTinh'],
                ':taiKhoan' => $userData['taiKhoan'],
                ':matKhau' => $userData['matKhau'],
                ':loaiUser' => $userData['loaiUser'],
                ':role_id' => $userData['role_id']
            ];
            
            $result = $this->userModel->update($userId, $data);
            
            if ($result) {
                $_SESSION['success'] = "Cập nhật thông tin thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật thông tin!";
            }
            
            header('Location: ?action=profile');
            exit();
        }
    }
    
    // Hiển thị trang đổi mật khẩu
    public function showChangePassword() {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit();
        }
        
        include_once __DIR__ . '/../views/user/change_password.php';
    }
    
    // Xử lý đổi mật khẩu
    public function changePassword() {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit();
        }
        
        $userId = $_SESSION['user_id'];
        $userData = $this->userModel->find($userId);
        
        if (!$userData) {
            $_SESSION['error'] = "Không tìm thấy thông tin người dùng!";
            header('Location: ?action=home');
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $currentPassword = $_POST['currentPassword'] ?? '';
            $newPassword = $_POST['newPassword'] ?? '';
            $acceptPassword = $_POST['acceptPassword'] ?? '';
            
            // Validate dữ liệu
            if (empty($currentPassword) || empty($newPassword) || empty($acceptPassword)) {
                $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin!";
                header('Location: ?action=change_password');
                exit();
            }
            
            // Kiểm tra mật khẩu hiện tại
            if ($userData['matKhau'] !== $currentPassword) { // Lưu ý: Trong thực tế nên dùng password_verify()
                $_SESSION['error'] = "Mật khẩu hiện tại không chính xác!";
                header('Location: ?action=change_password');
                exit();
            }
            
            // Kiểm tra mật khẩu mới trùng khớp
            if ($newPassword !== $acceptPassword) {
                $_SESSION['error'] = "Mật khẩu xác nhận không khớp!";
                header('Location: ?action=change_password');
                exit();
            }
            
            // Cập nhật mật khẩu mới
            $data = [
                ':hoTen' => $userData['hoTen'],
                ':email' => $userData['email'],
                ':soDienThoai' => $userData['soDienThoai'],
                ':diaChi' => $userData['diaChi'],
                ':gioiTinh' => $userData['gioiTinh'],
                ':taiKhoan' => $userData['taiKhoan'],
                ':matKhau' => $newPassword, // Trong thực tế nên dùng password_hash()
                ':loaiUser' => $userData['loaiUser'],
                ':role_id' => $userData['role_id']
            ];
            
            $result = $this->userModel->update($userId, $data);
            
            if ($result) {
                $_SESSION['success'] = "Đổi mật khẩu thành công!";
                header('Location: ?action=profile');
                exit();
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi đổi mật khẩu!";
                header('Location: ?action=change_password');
                exit();
            }
        }
    }
}