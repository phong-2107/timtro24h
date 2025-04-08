<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\KhachHangYeuThich;
use QLPhongTro\Models\PhongTro;

class KhachHangYeuThichController {
    private $yeuThichModel;
    private $phongTroModel;

    public function __construct($conn) {
        $this->yeuThichModel = new KhachHangYeuThich($conn);
        $this->phongTroModel = new PhongTro($conn);
    }

    // Danh sách phòng trọ yêu thích của một khách hàng
    public function index($khachHangId) {
        $roomsData = $this->yeuThichModel->getPhongTroYeuThich($khachHangId);
        include_once __DIR__ . '/../views/yeuthich/index.php';
    }

    // Thêm vào yêu thích
    public function add($khachHangId, $phongTroId) {
        $this->yeuThichModel->add($khachHangId, $phongTroId);
        header("Location: ?action=phongtro_detail&id=$phongTroId");
        exit;
    }

    // Xóa khỏi yêu thích
    public function remove($khachHangId, $phongTroId) {
        $this->yeuThichModel->remove($khachHangId, $phongTroId);
        header("Location: ?action=yeuthich_index&user=$khachHangId");
        exit;
    }

    // (Tùy chọn) Kiểm tra có yêu thích hay chưa → để hiển thị nút trái tim màu
    public function check($khachHangId, $phongTroId) {
        return $this->yeuThichModel->isYeuThich($khachHangId, $phongTroId);
    }
}