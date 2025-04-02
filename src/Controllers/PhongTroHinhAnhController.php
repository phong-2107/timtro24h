<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\PhongTroHinhAnh;

class PhongTroHinhAnhController {
    private $model;

    public function __construct($conn) {
        $this->model = new PhongTroHinhAnh($conn);
    }

    // Danh sách hình ảnh theo phòng trọ
    public function index($phongTroId) {
        $images = $this->model->getByPhongTro($phongTroId);
        include_once __DIR__ . '/../views/phongtro_hinhanh/index.php';
    }

    // Xử lý upload hình ảnh mới
    public function upload($phongTroId) {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $file = $_FILES['image'];
            $fileName = time() . '_' . basename($file['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Lưu vào DB
                $publicUrl = 'uploads/' . $fileName; // lưu theo đường dẫn public
                $this->model->addImage($phongTroId, $publicUrl);
                header("Location: ?action=phongtrohinhanh_index&id=$phongTroId");
                exit();
            } else {
                $error = "Tải ảnh lên thất bại!";
            }
        }

        // Hiển thị lại danh sách ảnh với lỗi nếu có
        $images = $this->model->getByPhongTro($phongTroId);
        include_once __DIR__ . '/../views/phongtro_hinhanh/index.php';
    }

    // Xoá hình ảnh
    public function delete($imageId, $phongTroId) {
        $this->model->delete($imageId);
        header("Location: ?action=phongtrohinhanh_index&id=$phongTroId");
        exit();
    }
}