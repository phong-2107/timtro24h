<?php
namespace QLPhongTro\Models;

class User {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function all() {
        $stmt = $this->conn->query("SELECT * FROM User");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM User WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO User (hoTen, soDienThoai, email, diaChi, gioiTinh, taiKhoan, matKhau, loaiUser, role_id)
            VALUES (:hoTen, :soDienThoai, :email, :diaChi, :gioiTinh, :taiKhoan, :matKhau, :loaiUser, :role_id)
        ");
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    public function update($id, $data) {
        $data[':id'] = $id;
        $stmt = $this->conn->prepare("
            UPDATE User SET hoTen = :hoTen, soDienThoai = :soDienThoai, email = :email,
            diaChi = :diaChi, gioiTinh = :gioiTinh, taiKhoan = :taiKhoan,
            matKhau = :matKhau, loaiUser = :loaiUser, role_id = :role_id
            WHERE id = :id
        ");
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM User WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}