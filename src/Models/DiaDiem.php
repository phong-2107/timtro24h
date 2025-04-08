<?php
namespace QLPhongTro\Models;

class DiaDiem {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy danh sách tất cả địa điểm
    public function all() {
        $stmt = $this->conn->query("SELECT * FROM DiaDiem");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Lấy địa điểm theo ID
    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM DiaDiem WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Thêm địa điểm mới
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO DiaDiem (tinhThanh, quanHuyen, phuongXa)
            VALUES (:tinhThanh, :quanHuyen, :phuongXa)
        ");
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

        // Lấy danh sách phòng trọ theo id địa điểm
    public function getPhongTroByDiaDiemId($diaDiemId) {
        $stmt = $this->conn->prepare("
            SELECT * FROM PhongTro
            WHERE diaDiem_id = :id
        ");
        $stmt->execute([':id' => $diaDiemId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}