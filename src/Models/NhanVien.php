<?php
namespace QLPhongTro\Models;

class NhanVien {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy danh sách nhân viên
    public function all() {
        $stmt = $this->conn->query("
            SELECT u.*, nv.chucVu
            FROM User u
            JOIN NhanVien nv ON u.id = nv.user_id
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Lấy thông tin nhân viên theo ID
    public function find($id) {
        $stmt = $this->conn->prepare("
            SELECT u.*, nv.chucVu
            FROM User u
            JOIN NhanVien nv ON u.id = nv.user_id
            WHERE u.id = :id
        ");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Tạo mới nhân viên
    public function create($userData, $chucVu) {
        // Tạo user trước
        $userStmt = $this->conn->prepare("
            INSERT INTO User (hoTen, soDienThoai, email, diaChi, gioiTinh, taiKhoan, matKhau, loaiUser, role_id)
            VALUES (:hoTen, :soDienThoai, :email, :diaChi, :gioiTinh, :taiKhoan, :matKhau, 'NhanVien', :role_id)
        ");
        $userStmt->execute($userData);
        $userId = $this->conn->lastInsertId();

        // Tạo bản ghi nhân viên
        $nvStmt = $this->conn->prepare("INSERT INTO NhanVien (user_id, chucVu) VALUES (:user_id, :chucVu)");
        $nvStmt->execute([':user_id' => $userId, ':chucVu' => $chucVu]);

        return $userId;
    }
}
