<?php
namespace QLPhongTro\Models;

class PhongTroHinhAnh {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy hình ảnh theo phòng trọ
    public function getByPhongTro($phongTroId) {
        $stmt = $this->conn->prepare("SELECT * FROM PhongTro_HinhAnh WHERE phongTro_id = :id");
        $stmt->execute([':id' => $phongTroId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Thêm ảnh cho phòng trọ
    public function addImage($phongTroId, $imageUrl) {
        $stmt = $this->conn->prepare("
            INSERT INTO PhongTro_HinhAnh (phongTro_id, hinhAnh)
            VALUES (:phongTro_id, :hinhAnh)
        ");
        return $stmt->execute([
            ':phongTro_id' => $phongTroId,
            ':hinhAnh' => $imageUrl
        ]);
    }

    // Xoá ảnh theo ID
    public function delete($imageId) {
        $stmt = $this->conn->prepare("DELETE FROM PhongTro_HinhAnh WHERE id = :id");
        return $stmt->execute([':id' => $imageId]);
    }
}
