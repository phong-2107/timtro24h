<?php
namespace QLPhongTro\Models;

class KhachHangYeuThich {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy danh sách phòng trọ yêu thích của một khách hàng
    public function getPhongTroYeuThich($khachHangId) {
        $stmt = $this->conn->prepare("
            SELECT pt.* FROM KhachHang_YeuThich kyt
            JOIN PhongTro pt ON pt.id = kyt.phongTro_id
            WHERE kyt.khachHang_id = :khachHangId
        ");
        $stmt->execute([':khachHangId' => $khachHangId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Kiểm tra phòng trọ có nằm trong danh sách yêu thích của khách hàng không
    public function isYeuThich($khachHangId, $phongTroId) {
        $stmt = $this->conn->prepare("
            SELECT 1 FROM KhachHang_YeuThich
            WHERE khachHang_id = :khachHangId AND phongTro_id = :phongTroId
        ");
        $stmt->execute([
            ':khachHangId' => $khachHangId,
            ':phongTroId' => $phongTroId
        ]);
        return $stmt->fetchColumn() ? true : false;
    }

    // Thêm phòng trọ vào danh sách yêu thích
    public function add($khachHangId, $phongTroId) {
        $stmt = $this->conn->prepare("
            INSERT IGNORE INTO KhachHang_YeuThich (khachHang_id, phongTro_id)
            VALUES (:khachHangId, :phongTroId)
        ");
        return $stmt->execute([
            ':khachHangId' => $khachHangId,
            ':phongTroId' => $phongTroId
        ]);
    }

    // Xoá phòng trọ khỏi danh sách yêu thích
    public function remove($khachHangId, $phongTroId) {
        $stmt = $this->conn->prepare("
            DELETE FROM KhachHang_YeuThich
            WHERE khachHang_id = :khachHangId AND phongTro_id = :phongTroId
        ");
        return $stmt->execute([
            ':khachHangId' => $khachHangId,
            ':phongTroId' => $phongTroId
        ]);
    }
}