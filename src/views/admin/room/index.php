<?php
// views/admin/room/index.php

$currentPage = isset($_GET['page_num']) ? intval($_GET['page_num']) : 1;
$totalPages = $totalPages ?? 1;
$rooms = $rooms ?? [];
?>

<div class="room-management-container">
    <div class="header-section">
        <h1 class="title">Tin phòng</h1>
        <div class="actions">
            <a href="index.php?action=manager&page=create-room" class="post-button">Đăng tin</a>
            <div class="search-container">
                <form action="index.php" method="GET">
                    <input type="hidden" name="action" value="manager">
                    <input type="hidden" name="page" value="room">
                    <input type="text" name="search" placeholder="Tìm kiếm"
                        value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>" class="search-input">
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
                            <img src="<?php echo htmlspecialchars($room['image'] ?? '/public/images/room/1.jpg'); ?>"
                                alt="<?php echo htmlspecialchars($room['title']); ?>" class="room-thumbnail">
                        </div>
                    </td>
                    <td class="title-cell"><?php echo htmlspecialchars($room['title']); ?></td>
                    <td><?php echo htmlspecialchars($room['code']); ?></td>
                    <td><?php echo htmlspecialchars($room['price']); ?></td>
                    <td><?php echo htmlspecialchars($room['type']); ?></td>
                    <td>
                        <span class="status-badge <?= $room['trangThai'] === 'Còn trống' ? 'available' : 'pending' ?>">
                            <?= htmlspecialchars($room['trangThai']) ?>
                        </span>
                    </td>
                    <td><?php echo htmlspecialchars($room['date']); ?></td>
                    <td class="actions-td">
                        <div class="dropdown-container">
                            <button class="action-button"
                                onclick="toggleDropdown(<?php echo $room['id']; ?>)">...</button>
                            <div id="dropdown-<?php echo $room['id']; ?>" class="dropdown-menu" style="display:none;">
                                <a href="/public/index.php?action=room_update&id=<?php echo $room['id']; ?>"
                                    class="dropdown-item">
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

    <div class="pagination">
        <?php if ($currentPage > 1): ?>
        <a class="pagination-item prev"
            href="index.php?action=manager&page=room&page_num=<?php echo $currentPage - 1; ?>">&lt;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a class="pagination-item <?php echo $i === $currentPage ? 'active' : ''; ?>"
            href="index.php?action=manager&page=room&page_num=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
        <a class="pagination-item next"
            href="index.php?action=manager&page=room&page_num=<?php echo $currentPage + 1; ?>">&gt;</a>
        <?php endif; ?>
    </div>
</div>

<script>
let activeDropdown = null;

function toggleDropdown(roomId) {
    const dropdownId = `dropdown-${roomId}`;
    const dropdown = document.getElementById(dropdownId);
    if (activeDropdown && activeDropdown !== dropdownId) {
        document.getElementById(activeDropdown).style.display = 'none';
    }
    if (dropdown.style.display === 'none') {
        dropdown.style.display = 'block';
        activeDropdown = dropdownId;
    } else {
        dropdown.style.display = 'none';
        activeDropdown = null;
    }
}
document.addEventListener('click', function(event) {
    if (!event.target.matches('.action-button') && activeDropdown) {
        document.getElementById(activeDropdown).style.display = 'none';
        activeDropdown = null;
    }
});

function confirmDelete(id) {
    if (confirm('Bạn có chắc chắn muốn xóa tin phòng này?')) {
        window.location.href = `/public/index.php?action=room_delete&id=${id}`;
    }
}
</script>