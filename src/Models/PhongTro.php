<?php
namespace QLPhongTro\Models;

class PhongTro {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    // Lấy tất cả phòng trọ (kèm tìm kiếm + phân trang)
    public function getAll($search = '', $limit = 10, $offset = 0) {
        $sql = "SELECT * FROM PhongTro WHERE 1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (tieuDe LIKE :kw OR moTa LIKE :kw OR diaChiCuThe LIKE :kw)";
            $params[':kw'] = '%' . $search . '%';
        }

        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Đếm tổng phòng trọ cho phân trang
    public function count($search = '') {
        $sql = "SELECT COUNT(*) as total FROM PhongTro WHERE 1";
        $params = [];

        if (!empty($search)) {
            $sql .= " AND (tieuDe LIKE :kw OR moTa LIKE :kw OR diaChiCuThe LIKE :kw)";
            $params[':kw'] = '%' . $search . '%';
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row['total'] ?? 0;
    }

    // Lấy tất cả phòng trọ (không phân trang)
    public function all() {
        $stmt = $this->conn->query("SELECT * FROM PhongTro ORDER BY id DESC");
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
    public function getHinhAnhByPhongTroId($id) {
        $stmt = $this->conn->prepare("SELECT hinhAnh FROM phongtro_hinhanh WHERE phongTro_id = :id");
        $stmt->execute([':id' => $id]);
        return array_map(fn($row) => 'images/room/' . $row['hinhAnh'], $stmt->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getFirstImage($phongTroId) {
        $stmt = $this->conn->prepare("SELECT hinhAnh FROM phongtro_hinhanh WHERE phongTro_id = :id LIMIT 1");
        $stmt->execute([':id' => $phongTroId]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? '/public/images/room/' . $row['hinhAnh'] : '/public/images/room/1.jpg';
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

    public function getByDiaDiem($diaDiem_id) {
        $stmt = $this->conn->prepare("
            SELECT * 
            FROM PhongTro
            WHERE diaDiem_id = :diaDiem_id
        ");
        $stmt->execute([':diaDiem_id' => $diaDiem_id]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function getByPage($page, $limit) {
        $offset = ($page - 1) * $limit;
        $stmt = $this->conn->prepare("SELECT * FROM PhongTro LIMIT :offset, :limit");
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function paginate($limit, $offset) {
        $stmt = $this->conn->prepare("SELECT * FROM PhongTro ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, \PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        foreach ($results as &$row) {
            $row['image'] = $this->getFirstImage($row['id']);
            $row['title'] = $row['tieuDe'];
            $row['code'] = 'Mã-' . str_pad($row['id'], 4, '0', STR_PAD_LEFT); // Tạo mã giả
            $row['price'] = number_format($row['gia'], 0, ',', '.') . ' đ';
            $row['type'] = 'Phòng trọ';
            $row['date'] = date('d/m/Y'); // hoặc lấy từ DB nếu có
        }
    
        return $results;
    }
    
    
    public function countAll() {
        $stmt = $this->conn->query("SELECT COUNT(*) as total FROM PhongTro");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function advancedSearch($locationId = null, $priceSQL = '', $areaSQL = '') {
        $sql = "
            SELECT pt.*, dd.tinhThanh, dd.quanHuyen
            FROM PhongTro pt
            JOIN DiaDiem dd ON pt.diaDiem_id = dd.id
            WHERE 1
        ";
        $params = [];
    
        if (!empty($locationId)) {
            $sql .= " AND pt.diaDiem_id = :location_id";
            $params[':location_id'] = $locationId;
        }
    
        if (!empty($priceSQL)) {
            $sql .= " AND ($priceSQL)";
        }
    
        if (!empty($areaSQL)) {
            $sql .= " AND ($areaSQL)";
        }
    
        $sql .= " ORDER BY pt.id DESC";
    
        $stmt = $this->conn->prepare($sql);
        foreach ($params as $key => $val) {
            $stmt->bindValue($key, $val);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    
    
}