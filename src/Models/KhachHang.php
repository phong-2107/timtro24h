<?php
namespace QLPhongTro\Models;

class KhachHang {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy danh sách khách hàng (kết hợp từ bảng User)
    public function all() {
        $stmt = $this->conn->query("SELECT * FROM User WHERE loaiUser = 'KhachHang'");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Lấy khách hàng theo ID
    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM User WHERE id = :id AND loaiUser = 'KhachHang'");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Lấy danh sách phòng trọ yêu thích của khách hàng
    public function getDanhSachYeuThich($userId) {
        $stmt = $this->conn->prepare("
            SELECT p.* FROM KhachHang_YeuThich kyt
            JOIN PhongTro p ON p.id = kyt.phongTro_id
            WHERE kyt.khachHang_id = :userId
        ");
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Thêm phòng trọ vào danh sách yêu thích
    public function addYeuThich($userId, $phongTroId) {
        $stmt = $this->conn->prepare("
            INSERT IGNORE INTO KhachHang_YeuThich (khachHang_id, phongTro_id)
            VALUES (:userId, :phongTroId)
        ");
        return $stmt->execute([':userId' => $userId, ':phongTroId' => $phongTroId]);
    }

    // Xóa phòng trọ khỏi danh sách yêu thích
    public function removeYeuThich($userId, $phongTroId) {
        $stmt = $this->conn->prepare("
            DELETE FROM KhachHang_YeuThich WHERE khachHang_id = :userId AND phongTro_id = :phongTroId
        ");
        return $stmt->execute([':userId' => $userId, ':phongTroId' => $phongTroId]);
    }
}
