<?php
// views/admin/room/index.php

// Example data (in real implementation, this would come from the controller)
$rooms = $rooms ?? [];
$currentPage = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
$totalPages = $totalPages ?? 1;
// If no room data is passed, use sample data for display purposes
if (empty($rooms)) {
    $rooms = [
        [
            'id' => 1,
            'title' => "Phòng trọ số 1",
            'code' => "47514501",
            'price' => "1.000.000 đ",
            'type' => "Phòng trọ",
            'status' => "Hiện",
            'date' => "27/3/2025",
            'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
        ],
        [
            'id' => 2,
            'title' => "Phòng trọ số 1",
            'code' => "47514501",
            'price' => "1.000.000 đ",
            'type' => "Phòng trọ",
            'status' => "Hiện",
            'date' => "27/3/2025",
            'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
        ],
        [
            'id' => 3,
            'title' => "Phòng trọ số 1",
            'code' => "47514501",
            'price' => "1.000.000 đ",
            'type' => "Phòng trọ",
            'status' => "Hiện",
            'date' => "27/3/2025",
            'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
        ],
        [
            'id' => 4,
            'title' => "Phòng trọ số 1",
            'code' => "47514501",
            'price' => "1.000.000 đ",
            'type' => "Phòng trọ",
            'status' => "Ẩn",
            'date' => "27/3/2025",
            'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
        ],
        [
            'id' => 5,
            'title' => "Phòng trọ số 1",
            'code' => "47514501",
            'price' => "1.000.000 đ",
            'type' => "Phòng trọ",
            'status' => "Hiện",
            'date' => "27/3/2025",
            'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
        ],
        [
            'id' => 6,
            'title' => "Phòng trọ số 1",
            'code' => "47514501",
            'price' => "1.000.000 đ",
            'type' => "Phòng trọ",
            'status' => "Hiện",
            'date' => "27/3/2025",
            'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
        ],
        [
            'id' => 7,
            'title' => "Phòng trọ số 1",
            'code' => "47514501",
            'price' => "1.000.000 đ",
            'type' => "Phòng trọ",
            'status' => "Hiện",
            'date' => "27/3/2025",
            'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
        ],
        [
            'id' => 8,
            'title' => "Phòng trọ số 1",
            'code' => "47514501",
            'price' => "1.000.000 đ",
            'type' => "Phòng trọ",
            'status' => "Hiện",
            'date' => "27/3/2025",
            'image' => "https://xaydungaau.com/wp-content/uploads/2023/12/thiet-ke-noi-that-phong-tro-an-tuong-tien-nghi.jpg"
        ]
    ];
}
?>

<div class="room-management-container">
    <div class="header-section">
        <h1 class="title">Tin phòng</h1>
        <div class="actions">
            <a href="index.php?page=create-room" class="post-button">Đăng tin</a>
            <div class="search-container">
                <form action="index.php" method="GET">
                    <input type="hidden" name="action" value="manager">
                    <input type="hidden" name="page" value="room">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Tìm kiếm" 
                        value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" 
                        class="search-input"
                    >
                    <button type="submit" class="search-button">
                        <span class="search-icon">⌕</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="table-container">
        <table class="room-table">
            <thead>
                <tr>
                    <th>TT</th>
                    <th>Tên Phòng</th>
                    <th>Mã Phòng</th>
                    <th>Giá</th>
                    <th>Loại Phòng</th>
                    <th>Trạng Thái</th>
                    <th>Ngày đăng</th>
                    <th class="actions-th">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($rooms)): ?>
                    <tr>
                        <td colspan="8" class="no-data">Không có dữ liệu</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($rooms as $index => $room): ?>
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
                            <td class="actions-td">
                                <div class="dropdown-container">
                                    <button class="action-button" onclick="toggleDropdown(<?php echo $room['id']; ?>)">...</button>
                                    <div id="dropdown-<?php echo $room['id']; ?>" class="dropdown-menu" style="display:none;">
                                        <a href="index.php?action=room_update&id=<?php echo $room['id']; ?>" class="dropdown-item">
                                            <span class="icon edit-icon">✎</span>
                                            Sửa
                                        </a>
                                        <button onclick="confirmDelete(<?php echo $room['id']; ?>)" class="dropdown-item">
                                            <span class="icon delete-icon">🗑</span>
                                            Xóa
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="pagination">
        <button class="pagination-item prev" <?php if (isset($_GET['page_num']) && $_GET['page_num'] <= 1) echo 'disabled'; ?>>
            &lt;
        </button>
        
        <button class="pagination-item <?php if (!isset($_GET['page_num']) || $_GET['page_num'] == 1) echo 'active'; ?>">
            1
        </button>
        
        <button class="pagination-item <?php if (isset($_GET['page_num']) && $_GET['page_num'] == 2) echo 'active'; ?>">
            2
        </button>
        
        <span class="pagination-ellipsis">...</span>
        
        <button class="pagination-item">
            23
        </button>
        
        <button class="pagination-item">
            24
        </button>
        
        <button class="pagination-item next">
            &gt;
        </button>
    </div>
</div>

<script>
// Handle dropdown toggling
let activeDropdown = null;

function toggleDropdown(roomId) {
    const dropdownId = `dropdown-${roomId}`;
    const dropdown = document.getElementById(dropdownId);
    
    // Close any open dropdown
    if (activeDropdown && activeDropdown !== dropdownId) {
        document.getElementById(activeDropdown).style.display = 'none';
    }
    
    // Toggle current dropdown
    if (dropdown.style.display === 'none') {
        dropdown.style.display = 'block';
        activeDropdown = dropdownId;
    } else {
        dropdown.style.display = 'none';
        activeDropdown = null;
    }
}

// Close dropdown when clicking elsewhere
document.addEventListener('click', function(event) {
    if (!event.target.matches('.action-button') && activeDropdown) {
        document.getElementById(activeDropdown).style.display = 'none';
        activeDropdown = null;
    }
});

// Handle delete confirmation
function confirmDelete(id) {
    if (confirm('Bạn có chắc chắn muốn xóa tin phòng này?')) {
        window.location.href = `index.php?action=room_delete&id=${id}`;
    }
}

// Handle pagination clicks
document.querySelectorAll('.pagination-item:not(.prev):not(.next)').forEach(button => {
    button.addEventListener('click', function() {
        const page = this.textContent.trim();
        window.location.href = `index.php?action=manager&page=room&page_num=${page}`;
    });
});

// Handle prev/next pagination
document.querySelector('.pagination-item.prev').addEventListener('click', function() {
    if (!this.hasAttribute('disabled')) {
        const currentPage = <?php echo isset($_GET['page_num']) ? intval($_GET['page_num']) : 1; ?>;
        if (currentPage > 1) {
            window.location.href = `index.php?action=manager&page=room&page_num=${currentPage - 1}`;
        }
    }
});

document.querySelector('.pagination-item.next').addEventListener('click', function() {
    const currentPage = <?php echo isset($_GET['page_num']) ? intval($_GET['page_num']) : 1; ?>;
    window.location.href = `index.php?action=manager&page=room&page_num=${currentPage + 1}`;
});
</script>