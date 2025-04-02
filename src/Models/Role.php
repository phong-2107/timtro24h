<?php
namespace QLPhongTro\Models;

class Role {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy tất cả role
    public function all() {
        $stmt = $this->conn->query("SELECT * FROM Role");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Lấy role theo ID
    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM Role WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Thêm role mới
    public function create($tenRole) {
        $stmt = $this->conn->prepare("INSERT INTO Role (tenRole) VALUES (:tenRole)");
        $stmt->execute([':tenRole' => $tenRole]);
        return $this->conn->lastInsertId();
    }

    // Cập nhật role
    public function update($id, $tenRole) {
        $stmt = $this->conn->prepare("UPDATE Role SET tenRole = :tenRole WHERE id = :id");
        return $stmt->execute([':tenRole' => $tenRole, ':id' => $id]);
    }

    // Xoá role
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM Role WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
