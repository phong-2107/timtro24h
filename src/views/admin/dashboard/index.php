<?php
// views/admin/dashboard/index.php

// Example data for room listings (in real implementation, this would come from the controller)
$featuredRooms = [
    [
        'id' => 1,
        'title' => "Phòng trọ số 1",
        'code' => "4751/4501",
        'price' => "1,000,000 đ",
        'type' => "Phòng trọ",
        'status' => "Hiện",
        'date' => "27/3/2025",
        'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
    ],
    [
        'id' => 2,
        'title' => "Phòng trọ số 2",
        'code' => "4751/4501",
        'price' => "1,000,000 đ",
        'type' => "Phòng trọ",
        'status' => "Hiện",
        'date' => "27/3/2025",
        'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
    ],
    [
        'id' => 3,
        'title' => "Phòng trọ số 3",
        'code' => "4751/4501",
        'price' => "1,000,000 đ",
        'type' => "Phòng trọ",
        'status' => "Hiện",
        'date' => "27/3/2025",
        'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
    ],
    [
        'id' => 4,
        'title' => "Phòng trọ số 4",
        'code' => "4751/4501",
        'price' => "1,000,000 đ",
        'type' => "Phòng trọ",
        'status' => "Hiện",
        'date' => "27/3/2025",
        'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
    ],
    [
        'id' => 5,
        'title' => "Phòng trọ số 5",
        'code' => "4751/4501",
        'price' => "1,000,000 đ",
        'type' => "Phòng trọ",
        'status' => "Hiện",
        'date' => "27/3/2025",
        'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
    ]
];
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
                        <th>MÃ PHÒNG</th>
                        <th>GIÁ</th>
                        <th>LOẠI PHÒNG</th>
                        <th>TRẠNG THÁI</th>
                        <th>NGÀY ĐĂNG</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($featuredRooms as $index => $room): ?>
                        <tr>
                            <td>
                                <div class="room-image-container">
                                    <img src="<?php echo htmlspecialchars($room['image']); ?>" alt="<?php echo htmlspecialchars($room['title']); ?>" class="room-thumbnail">
                                </div>
                            </td>
                            <td class="title-cell"><?php echo htmlspecialchars($room['title']); ?></td>
                            <td><?php echo htmlspecialchars($room['code']); ?></td>
                            <td><?php echo htmlspecialchars($room['price']); ?></td>
                            <td><?php echo htmlspecialchars($room['type']); ?></td>
                            <td>
                                <span class="status-badge <?php echo $room['status'] === 'Hiện' ? 'available' : 'pending'; ?>">
                                    <?php echo htmlspecialchars($room['status']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($room['date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>