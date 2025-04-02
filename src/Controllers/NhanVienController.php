<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\NhanVien;
use QLPhongTro\Models\Role;

class NhanVienController {
    private $model;
    private $roleModel;

    public function __construct($conn) {
        $this->model = new NhanVien($conn);
        $this->roleModel = new Role($conn);
    }

    // Hiển thị danh sách nhân viên
    public function index() {
        $dsNhanVien = $this->model->all();
        include_once __DIR__ . '/../views/nhanvien/index.php';
    }

    // Xem chi tiết nhân viên
    public function show($id) {
        $nhanVien = $this->model->find($id);
        if (!$nhanVien) {
            echo "Không tìm thấy nhân viên.";
            return;
        }
        include_once __DIR__ . '/../views/nhanvien/show.php';
    }

    // Hiển thị form thêm nhân viên
    public function createForm() {
        $error = '';
        $roles = $this->roleModel->all();
        include_once __DIR__ . '/../views/nhanvien/create.php';
    }

    // Xử lý thêm nhân viên mới
    public function store() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $userData = [
                ':hoTen' => $_POST['hoTen'] ?? '',
                ':soDienThoai' => $_POST['soDienThoai'] ?? '',
                ':email' => $_POST['email'] ?? '',
                ':diaChi' => $_POST['diaChi'] ?? '',
                ':gioiTinh' => $_POST['gioiTinh'] ?? 'Nam',
                ':taiKhoan' => $_POST['taiKhoan'] ?? '',
                ':matKhau' => password_hash($_POST['matKhau'] ?? '', PASSWORD_DEFAULT),
                ':role_id' => $_POST['role_id'] ?? 2,
            ];

            $chucVu = $_POST['chucVu'] ?? 'Nhân viên hỗ trợ';

            // Validate
            if (empty($userData[':taiKhoan']) || empty($userData[':matKhau'])) {
                $error = 'Vui lòng nhập đầy đủ tài khoản và mật khẩu.';
                $roles = $this->roleModel->all();
                include_once __DIR__ . '/../views/nhanvien/create.php';
                return;
            }

            // Tạo mới
            $this->model->create($userData, $chucVu);
            header('Location: ?action=nhanvien_index');
            exit();
        }
    }
}