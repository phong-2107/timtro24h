<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\PhongTro;
use QLPhongTro\Models\DiaDiem;

class AD_RC {
    private $phongTroModel;
    private $diaDiemModel;

    public function __construct($conn) {
        $this->phongTroModel = new PhongTro($conn);
        $this->diaDiemModel = new DiaDiem($conn);
    }

    public function dashboard() {
        $dsPhongTro = $this->phongTroModel->all();
        include_once __DIR__ . '/../views/admin/dashboard/index.php';
    }

    // Danh sách phòng trọ (cho admin_room)
    public function index() {
        $search = $_GET['search'] ?? '';
        $currentPage = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        $phongTros = $this->phongTroModel->getAll($search, $limit, $offset);
        $totalPages = ceil($this->phongTroModel->count($search) / $limit);

        include_once __DIR__ . '/../views/admin_UI/room/admin_room.php';
    }

    // Lấy phòng trọ theo ID (json - phục vụ popup)

    public function get() {
        $id = $_GET['id'] ?? 0;
        $phong = $this->phongTroModel->find($id);
    
        // Đổi tên key để khớp với frontend form
        echo json_encode([
            'id' => $phong['id'],
            'tenPhong' => $phong['tieuDe'],
            'giaThue' => $phong['gia'],
            'diaChi' => $phong['diaChiCuThe'],
            'dienTich' => $phong['dienTich'],
            'trangThai' => $phong['trangThai'],
            'moTa' => $phong['moTa']
        ]);
    }
    
    // Tạo mới phòng trọ (xử lý popup)
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':tieuDe' => $_POST['tenPhong'],
                ':diaChiCuThe' => $_POST['diaChi'],
                ':diaDiem_id' => 1, // gán tạm, có thể lấy từ POST nếu có filter
                ':gia' => $_POST['giaThue'],
                ':dienTich' => $_POST['dienTich'],
                ':moTa' => '',
                ':trangThai' => $_POST['trangThai'],
                ':nguoiDang_id' => 1 // hardcode admin / user ID nếu chưa login
            ];
            $this->phongTroModel->create($data);
            header('Location: ?action=room_index');
        }
    }

    // Cập nhật phòng trọ (xử lý popup)
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                ':tieuDe' => $_POST['tenPhong'],
                ':diaChiCuThe' => $_POST['diaChi'],
                ':diaDiem_id' => 1,
                ':gia' => $_POST['giaThue'],
                ':dienTich' => $_POST['dienTich'],
                ':moTa' => '',
                ':trangThai' => $_POST['trangThai'],
                ':nguoiDang_id' => 1
            ];
            $this->phongTroModel->update($id, $data);
            header('Location: ?action=room_index');
        }
    }

    // Xoá phòng trọ
    public function delete() {
        $id = $_GET['id'] ?? 0;
        $this->phongTroModel->delete($id);
        header('Location: ?action=phongtro_index');
    }

    // Giao diện chi tiết (nếu có)
    public function show($id) {
        $phong = $this->phongTroModel->find($id);
        if (!$phong) {
            echo "Phòng trọ không tồn tại.";
            return;
        }
        include_once __DIR__ . '/../views/phongtro/show.php';
    }

    // Giao diện tạo mới (không dùng popup)
    public function createForm() {
        $error = '';
        $diaDiems = $this->diaDiemModel->all();
        include_once __DIR__ . '/../views/phongtro/create.php';
    }

    // Hiển thị form tạo mới phòng trọ
    public function createRoomPage() {
        $error = '';
        $success = '';
        $diaDiems = $this->diaDiemModel->all();
        include_once __DIR__ . '/../views/admin/room/create-room.php';
    }

    // Xử lý lưu phòng trọ mới
    // Xử lý lưu phòng trọ mới
public function storeRoom() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            ':tieuDe' => $_POST['tenPhong'],
            ':diaChiCuThe' => $_POST['diaChi'],
            ':diaDiem_id' => $_POST['diaDiem_id'] ?? 1, // lấy từ form
            ':gia' => $_POST['giaThue'],
            ':dienTich' => $_POST['dienTich'],
            ':moTa' => $_POST['moTa'] ?? '',
            ':trangThai' => $_POST['trangThai'] ?? 'Còn trống',
            ':nguoiDang_id' => $_SESSION['user_id'] ?? 1,
        ];

        $this->phongTroModel->create($data);
        header('Location: index.php?action=manager&page=room');
        exit();
    }
}



    // Giao diện chỉnh sửa (không dùng popup)
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

    // Tìm kiếm riêng (nếu có view riêng)
    public function search() {
        $keyword = $_GET['keyword'] ?? '';
        $results = $this->phongTroModel->search($keyword);
        include_once __DIR__ . '/../views/phongtro/search.php';
    }
    
}