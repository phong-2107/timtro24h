<?php

namespace QLPhongTro\Controllers;

use QLPhongTro\Models\KhachHang;

class KhachHangController {
    private $model;

    public function __construct($conn) {
        $this->model = new KhachHang($conn);
    }

    // Hiển thị danh sách khách hàng
    public function index() {
        $dsKhachHang = $this->model->all();
        include_once __DIR__ . '/../views/khachhang/index.php';
    }

    // Chi tiết khách hàng
    public function show($id) {
        $khachHang = $this->model->find($id);
        if (!$khachHang) {
            echo "Không tìm thấy khách hàng.";
            return;
        }
        include_once __DIR__ . '/../views/khachhang/show.php';
    }

    // Danh sách phòng trọ yêu thích
    public function yeuThich($userId) {
        $danhSachYeuThich = $this->model->getDanhSachYeuThich($userId);
        include_once __DIR__ . '/../views/khachhang/yeuthich.php';
    }

    // Thêm phòng trọ yêu thích
    public function themYeuThich($userId, $phongTroId) {
        $this->model->addYeuThich($userId, $phongTroId);
        header("Location: ?action=khachhang_yeuthich&userId=$userId");
        exit();
    }

    // Xoá phòng trọ khỏi yêu thích
    public function xoaYeuThich($userId, $phongTroId) {
        $this->model->removeYeuThich($userId, $phongTroId);
        header("Location: ?action=khachhang_yeuthich&userId=$userId");
        exit();
    }

    public function getPhongTroYeuThichBySession()
{
    session_start();
    if (!isset($_SESSION['username'])) {
        echo "Bạn cần đăng nhập để xem danh sách yêu thích.";
        return;
    }

    // Lấy Khách Hàng theo email đăng nhập
    $khachHangModel = new \QLPhongTro\Models\KhachHang(Database::getConnection());
    $khachHang = $khachHangModel->getByEmail($_SESSION['username']);

    if (!$khachHang) {
        echo "Không tìm thấy khách hàng.";
        return;
    }

    $modelYeuThich = new \QLPhongTro\Models\KhachHangYeuThich(Database::getConnection());
    $roomsData = $modelYeuThich->getPhongTroYeuThich($khachHang['id']);

    $totalPages = 1;
    $page = 1;
    $locations = []; // nếu muốn hiển thị theo địa điểm

    include __DIR__ . '/../views/follow.php';
}

}