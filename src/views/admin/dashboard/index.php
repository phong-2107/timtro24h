<?php
// Nếu chưa có $featuredRooms (khi gọi view trực tiếp), fallback tránh lỗi
if (!isset($featuredRooms)) $featuredRooms = [];
?>
<div class="admin-dashboard">
    <!-- Summary Cards Section -->
    <div class="summary-cards">
        <div class="summary-card">
            <div class="card-header">
                <h3>Tin Phòng</h3>
                <span class="period">THÁNG NÀY</span>
            </div>
            <div class="card-value">4,235</div>
        </div>

        <div class="summary-card">
            <div class="card-header">
                <h3>Người Dùng</h3>
                <span class="period">THÁNG NÀY</span>
            </div>
            <div class="card-value">2,571</div>
        </div>

        <div class="summary-card">
            <div class="card-header">
                <h3>Liên Hệ</h3>
                <span class="period">MỤC TIÊU THÁNG: 1000</span>
            </div>
            <div class="card-value">734</div>
        </div>
    </div>

    <!-- Room Listings Table -->
    <div class="room-listings-section">
        <div class="section-header">
            <h2>Tin Phòng Nổi Bật</h2>
            <a href="index.php?action=manager&page=room" class="view-all">Xem Tất Cả</a>
        </div>

        <div class="table-container">
            <table class="room-listings-table">
                <thead>
                    <tr>
                        <th>TT</th>
                        <th>TÊN PHÒNG</th>
                        <th>GIÁ</th>
                        <th>LOẠI PHÒNG</th>
                        <th>TRẠNG THÁI</th>
                        <th>NGÀY ĐĂNG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($featuredRooms as $index => $room): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($room['tieuDe']) ?></td>
                        <td><?= number_format($room['gia']) . ' đ' ?></td>
                        <td>Phòng trọ</td>
                        <td>
                            <span
                                class="status-badge <?= $room['trangThai'] === 'Còn trống' ? 'available' : 'pending' ?>">
                                <?= htmlspecialchars($room['trangThai']) ?>
                            </span>
                        </td>
                        <td><?= date('d/m/Y', strtotime($room['created_at'] ?? 'now')) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>