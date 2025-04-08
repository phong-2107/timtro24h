<?php
namespace QLPhongTro\Models;
use PDO;
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
    public function paginate($limit, $offset) {
        $stmt = $this->conn->prepare("SELECT * FROM User LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function search($keyword, $limit, $offset) {
        $sql = "
            SELECT * FROM User 
            WHERE hoTen LIKE :kw OR email LIKE :kw OR taiKhoan LIKE :kw OR soDienThoai LIKE :kw 
            LIMIT :limit OFFSET :offset
        ";
        $stmt = $this->conn->prepare($sql);
        $search = "%$keyword%";
        $stmt->bindValue(':kw', $search);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countSearchResults($keyword) {
        $sql = "
            SELECT COUNT(*) as total FROM User 
            WHERE hoTen LIKE :kw OR email LIKE :kw OR taiKhoan LIKE :kw OR soDienThoai LIKE :kw
        ";
        $stmt = $this->conn->prepare($sql);
        $search = "%$keyword%";
        $stmt->bindValue(':kw', $search);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    public function searchWithFilters($keyword, $gender, $status, $limit, $offset) {
        $sql = "SELECT * FROM User WHERE 1=1";
        $params = [];
    
        if (!empty($keyword)) {
            $sql .= " AND (hoTen LIKE :kw OR email LIKE :kw OR taiKhoan LIKE :kw OR soDienThoai LIKE :kw)";
            $params[':kw'] = '%' . $keyword . '%';
        }
        if (!empty($gender)) {
            $sql .= " AND gioiTinh = :gender";
            $params[':gender'] = $gender;
        }
        if ($status !== null && $status !== '') {
            $sql .= " AND trangThai = :status";
            $params[':status'] = $status;
        }
    
        $sql .= " LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
    
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countWithFilters($keyword, $gender, $status) {
        $sql = "SELECT COUNT(*) as total FROM User WHERE 1=1";
        $params = [];
    
        if (!empty($keyword)) {
            $sql .= " AND (hoTen LIKE :kw OR email LIKE :kw OR taiKhoan LIKE :kw OR soDienThoai LIKE :kw)";
            $params[':kw'] = '%' . $keyword . '%';
        }
        if (!empty($gender)) {
            $sql .= " AND gioiTinh = :gender";
            $params[':gender'] = $gender;
        }
        if ($status !== null && $status !== '') {
            $sql .= " AND trangThai = :status";
            $params[':status'] = $status;
        }
    
        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
    
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    public function countAll() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM User");
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
}