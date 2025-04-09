<div class="room-management-container">
    <div class="header-section">
        <h1 class="title">Thêm phòng trọ mới</h1>
    </div>

    <form action="/public/index.php?action=room_store" method="POST" class="create-room-form">
        <div class="form-group">
            <label for="tenPhong" class="form-label">Tiêu đề phòng</label>
            <input type="text" id="tenPhong" name="tenPhong" class="form-input" placeholder="Nhập tiêu đề phòng trọ"
                required>
        </div>

        <div class="form-row">
            <div class="form-group half">
                <label for="giaThue" class="form-label">Giá thuê (VNĐ)</label>
                <input type="number" id="giaThue" name="giaThue" class="form-input" placeholder="Ví dụ: 1500000"
                    required>
            </div>

            <div class="form-group half">
                <label for="dienTich" class="form-label">Diện tích (m²)</label>
                <input type="number" id="dienTich" name="dienTich" class="form-input" step="0.1" placeholder="Ví dụ: 20"
                    required>
            </div>
        </div>

        <div class="form-group">
            <label for="diaChi" class="form-label">Địa chỉ cụ thể</label>
            <input type="text" id="diaChi" name="diaChi" class="form-input"
                placeholder="Ví dụ: Số 1, Đường ABC, Phường XYZ..." required>
        </div>

        <div class="form-group">
            <label for="diaDiem_id" class="form-label">Khu vực (Tỉnh / Huyện)</label>
            <select name="diaDiem_id" id="diaDiem_id" class="form-select" required>
                <option value="">-- Chọn khu vực --</option>
                <?php foreach ($diaDiems as $dd): ?>
                <option value="<?= $dd['id'] ?>"><?= $dd['tinhThanh'] ?> - <?= $dd['quanHuyen'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="moTa" class="form-label">Mô tả chi tiết</label>
            <textarea id="moTa" name="moTa" class="form-input" rows="4"
                placeholder="Thông tin thêm về phòng..."></textarea>
        </div>

        <div class="form-group">
            <label for="trangThai" class="form-label">Trạng thái</label>
            <select name="trangThai" id="trangThai" class="form-select">
                <option value="Còn trống">Còn trống</option>
                <option value="Đã thuê">Đã thuê</option>
            </select>
        </div>

        <div class="form-actions">
            <a href="index.php?action=manager&page=room" class="btn btn-cancel">Huỷ</a>
            <button type="submit" class="btn btn-primary">Lưu phòng</button>
        </div>
    </form>
</div>

<style>
.create-room-form {
    max-width: 720px;
    margin: 0 auto;
    background: #fff;
    padding: 2.5rem;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-row {
    display: flex;
    gap: 1rem;
}

.form-group.half {
    flex: 1;
}

.form-label {
    display: block;
    margin-bottom: 0.6rem;
    font-weight: 500;
    color: #333;
}

.form-input,
.form-select {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    font-size: 14px;
    transition: border 0.2s;
}

.form-input:focus,
.form-select:focus {
    border-color: #4c7cf4;
    outline: none;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
}

.btn {
    padding: 10px 20px;
    font-weight: 500;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.2s ease;
}

.btn-primary {
    background-color: #4c7cf4;
    color: #fff;
}

.btn-cancel {
    background-color: #e0e0e0;
    color: #333;
}

.btn:hover {
    opacity: 0.9;
}
</style>