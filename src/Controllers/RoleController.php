<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\Role;

class RoleController {
    private $roleModel;

    public function __construct($conn) {
        $this->roleModel = new Role($conn);
    }

    // Hiển thị danh sách Role
    public function index() {
        $roles = $this->roleModel->all();
        include_once __DIR__ . '/../views/role/index.php';
    }

    // Hiển thị chi tiết Role
    public function show($id) {
        $role = $this->roleModel->find($id);
        if (!$role) {
            echo "Role không tồn tại.";
            return;
        }
        include_once __DIR__ . '/../views/role/show.php';
    }

    // Hiển thị form thêm Role
    public function createForm() {
        $error = '';
        include_once __DIR__ . '/../views/role/create.php';
    }

    // Xử lý thêm mới Role
    public function store() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenRole = $_POST['tenRole'] ?? '';
            if (empty($tenRole)) {
                $error = 'Tên quyền không được để trống!';
                include_once __DIR__ . '/../views/role/create.php';
                return;
            }

            $this->roleModel->create($tenRole);
            header('Location: ?action=role_index');
            exit();
        }
        include_once __DIR__ . '/../views/role/create.php';
    }

    // Hiển thị form sửa Role
    public function editForm($id) {
        $role = $this->roleModel->find($id);
        $error = '';
        if (!$role) {
            echo "Role không tồn tại.";
            return;
        }
        include_once __DIR__ . '/../views/role/edit.php';
    }

    // Xử lý cập nhật Role
    public function update($id) {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenRole = $_POST['tenRole'] ?? '';
            if (empty($tenRole)) {
                $error = 'Tên quyền không được để trống!';
                $role = ['id' => $id, 'tenRole' => $tenRole];
                include_once __DIR__ . '/../views/role/edit.php';
                return;
            }

            $this->roleModel->update($id, $tenRole);
            header('Location: ?action=role_index');
            exit();
        }
    }

    // Xoá Role
    public function delete($id) {
        $this->roleModel->delete($id);
        header('Location: ?action=role_index');
        exit();
    }
}