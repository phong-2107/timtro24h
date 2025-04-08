<?php
require_once '../src/Config/Database.php';

use QLPhongTro\Config\Database;

try {
    $conn = Database::getInstance()->getConnection();

    $sql = "

    CREATE TABLE IF NOT EXISTS DiaDiem (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tinhThanh VARCHAR(100),
        quanHuyen VARCHAR(100),
        phuongXa VARCHAR(100)
    );

    CREATE TABLE IF NOT EXISTS Role (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tenRole VARCHAR(100) NOT NULL
    );

    CREATE TABLE IF NOT EXISTS User (
        id INT AUTO_INCREMENT PRIMARY KEY,
        hoTen VARCHAR(100),
        soDienThoai VARCHAR(20),
        email VARCHAR(100),
        diaChi VARCHAR(255),
        gioiTinh ENUM('Nam', 'Nữ') DEFAULT 'Nam',
        taiKhoan VARCHAR(100) NOT NULL UNIQUE,
        matKhau VARCHAR(255) NOT NULL,
        loaiUser ENUM('KhachHang', 'NhanVien') DEFAULT 'KhachHang',
        role_id INT,
        FOREIGN KEY (role_id) REFERENCES Role(id)
    );

    CREATE TABLE IF NOT EXISTS NhanVien (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        chucVu VARCHAR(100),
        FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE
    );

    CREATE TABLE IF NOT EXISTS PhongTro (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tieuDe VARCHAR(255),
        diaChiCuThe VARCHAR(255),
        diaDiem_id INT,
        gia DECIMAL(10,2),
        dienTich FLOAT,
        moTa TEXT,
        trangThai ENUM('Chưa thuê', 'Đã thuê') DEFAULT 'Chưa thuê',
        nguoiDang_id INT,
        FOREIGN KEY (diaDiem_id) REFERENCES DiaDiem(id),
        FOREIGN KEY (nguoiDang_id) REFERENCES User(id)
    );

    CREATE TABLE IF NOT EXISTS PhongTro_HinhAnh (
        id INT AUTO_INCREMENT PRIMARY KEY,
        phongTro_id INT,
        hinhAnh VARCHAR(255),
        FOREIGN KEY (phongTro_id) REFERENCES PhongTro(id) ON DELETE CASCADE
    );

    CREATE TABLE IF NOT EXISTS KhachHang_YeuThich (
        id INT AUTO_INCREMENT PRIMARY KEY,
        khachHang_id INT,
        phongTro_id INT,
        UNIQUE(khachHang_id, phongTro_id),
        FOREIGN KEY (khachHang_id) REFERENCES User(id) ON DELETE CASCADE,
        FOREIGN KEY (phongTro_id) REFERENCES PhongTro(id) ON DELETE CASCADE
    );

    ";

    $conn->exec($sql);
    echo "✅ Tạo bảng thành công!";
} catch (Exception $e) {
    echo "❌ Lỗi khi tạo bảng: " . $e->getMessage();
}
