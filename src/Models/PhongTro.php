<?php
namespace QLPhongTro\Models;

class PhongTro {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy tất cả phòng trọ
    public function all() {
        $stmt = $this->conn->query("SELECT * FROM PhongTro");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Lấy phòng trọ theo ID
    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM PhongTro WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Thêm phòng trọ mới
    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO PhongTro (tieuDe, diaChiCuThe, diaDiem_id, gia, dienTich, moTa, trangThai, nguoiDang_id)
            VALUES (:tieuDe, :diaChiCuThe, :diaDiem_id, :gia, :dienTich, :moTa, :trangThai, :nguoiDang_id)
        ");
        $stmt->execute($data);
        return $this->conn->lastInsertId();
    }

    // Cập nhật phòng trọ
    public function update($id, $data) {
        $data[':id'] = $id;
        $stmt = $this->conn->prepare("
            UPDATE PhongTro 
            SET tieuDe = :tieuDe, diaChiCuThe = :diaChiCuThe, diaDiem_id = :diaDiem_id,
                gia = :gia, dienTich = :dienTich, moTa = :moTa, trangThai = :trangThai, nguoiDang_id = :nguoiDang_id
            WHERE id = :id
        ");
        return $stmt->execute($data);
    }

    // Xoá phòng trọ
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM PhongTro WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Lấy phòng trọ theo người đăng
    public function getByNguoiDang($nguoiDang_id) {
        $stmt = $this->conn->prepare("SELECT * FROM PhongTro WHERE nguoiDang_id = :nguoiDang_id");
        $stmt->execute([':nguoiDang_id' => $nguoiDang_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Tìm kiếm phòng trọ theo từ khóa (tựa đề, mô tả, địa chỉ)
    public function search($keyword) {
        $like = '%' . $keyword . '%';
        $stmt = $this->conn->prepare("
            SELECT * FROM PhongTro 
            WHERE tieuDe LIKE :kw OR moTa LIKE :kw OR diaChiCuThe LIKE :kw
        ");
        $stmt->execute([':kw' => $like]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}