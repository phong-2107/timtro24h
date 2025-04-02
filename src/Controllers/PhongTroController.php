<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\PhongTro;
use QLPhongTro\Models\DiaDiem;

class PhongTroController {
    private $phongTroModel;
    private $diaDiemModel;

    public function __construct($conn) {
        $this->phongTroModel = new PhongTro($conn);
        $this->diaDiemModel = new DiaDiem($conn); // để lấy danh sách địa điểm cho form
    }

    // Hiển thị danh sách phòng trọ
    public function index() {
        $dsPhongTro = $this->phongTroModel->all();
        include_once __DIR__ . '/../views/phongtro/index.php';
    }

    // Xem chi tiết phòng trọ
    public function show($id) {
        $phong = $this->phongTroModel->find($id);
        if (!$phong) {
            echo "Phòng trọ không tồn tại.";
            return;
        }
        include_once __DIR__ . '/../views/phongtro/show.php';
    }

    // Hiển thị form tạo mới
    public function createForm() {
        $error = '';
        $diaDiems = $this->diaDiemModel->all();
        include_once __DIR__ . '/../views/phongtro/create.php';
    }

    // Xử lý tạo mới
    public function store() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':tieuDe' => $_POST['tieuDe'] ?? '',
                ':diaChiCuThe' => $_POST['diaChiCuThe'] ?? '',
                ':diaDiem_id' => $_POST['diaDiem_id'] ?? null,
                ':gia' => $_POST['gia'] ?? 0,
                ':dienTich' => $_POST['dienTich'] ?? 0,
                ':moTa' => $_POST['moTa'] ?? '',
                ':trangThai' => $_POST['trangThai'] ?? 'Còn trống',
                ':nguoiDang_id' => $_POST['nguoiDang_id'] ?? null
            ];

            if (empty($data[':tieuDe']) || empty($data[':diaChiCuThe']) || !$data[':diaDiem_id']) {
                $error = "Vui lòng nhập đầy đủ thông tin bắt buộc.";
                $diaDiems = $this->diaDiemModel->all();
                include_once __DIR__ . '/../views/phongtro/create.php';
                return;
            }

            $this->phongTroModel->create($data);
            header('Location: ?action=phongtro_index');
            exit();
        }
    }

    // Hiển thị form sửa
    public function editForm($id) {
        $phong = $this->phongTroModel->find($id);
        $diaDiems = $this->diaDiemModel->all();
        $error = '';

        if (!$phong) {
            echo "Phòng trọ không tồn tại.";
            return;
        }

        include_once __DIR__ . '/../views/phongtro/edit.php';
    }

    // Xử lý cập nhật
    public function update($id) {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':tieuDe' => $_POST['tieuDe'] ?? '',
                ':diaChiCuThe' => $_POST['diaChiCuThe'] ?? '',
                ':diaDiem_id' => $_POST['diaDiem_id'] ?? null,
                ':gia' => $_POST['gia'] ?? 0,
                ':dienTich' => $_POST['dienTich'] ?? 0,
                ':moTa' => $_POST['moTa'] ?? '',
                ':trangThai' => $_POST['trangThai'] ?? 'Còn trống',
                ':nguoiDang_id' => $_POST['nguoiDang_id'] ?? null
            ];

            $this->phongTroModel->update($id, $data);
            header('Location: ?action=phongtro_index');
            exit();
        }
    }

    // Xoá phòng trọ
    public function delete($id) {
        $this->phongTroModel->delete($id);
        header('Location: ?action=phongtro_index');
        exit();
    }

    // Tìm kiếm
    public function search() {
        $keyword = $_GET['keyword'] ?? '';
        $results = $this->phongTroModel->search($keyword);
        include_once __DIR__ . '/../views/phongtro/search.php';
    }
}