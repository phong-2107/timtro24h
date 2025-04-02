<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\DiaDiem;

class DiaDiemController {
    private $diaDiemModel;

    public function __construct($conn) {
        $this->diaDiemModel = new DiaDiem($conn);
    }

    // Hiển thị danh sách địa điểm
    public function index() {
        $diaDiems = $this->diaDiemModel->all();
        include_once __DIR__ . '/../views/diadiem/index.php'; // cần tạo file này
    }

    // Xem chi tiết địa điểm theo ID
    public function show($id) {
        $diaDiem = $this->diaDiemModel->find($id);
        if (!$diaDiem) {
            echo "Địa điểm không tồn tại.";
            return;
        }
        include_once __DIR__ . '/../views/diadiem/show.php'; // cần tạo file này
    }

    // Hiển thị form thêm địa điểm
    public function createForm() {
        $error = '';
        include_once __DIR__ . '/../views/diadiem/create.php'; // cần tạo file này
    }

    // Xử lý thêm địa điểm
    public function store() {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':tinhThanh' => $_POST['tinhThanh'] ?? '',
                ':quanHuyen' => $_POST['quanHuyen'] ?? '',
                ':phuongXa' => $_POST['phuongXa'] ?? '',
            ];

            // Validate đơn giản
            if (empty($data[':tinhThanh']) || empty($data[':quanHuyen']) || empty($data[':phuongXa'])) {
                $error = 'Vui lòng nhập đầy đủ thông tin địa điểm!';
                include_once __DIR__ . '/../views/diadiem/create.php';
                return;
            }

            $this->diaDiemModel->create($data);
            header('Location: ?action=diaDiem_index');
            exit();
        }

        include_once __DIR__ . '/../views/diadiem/create.php';
    }
}