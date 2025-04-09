<?php
// views/admin/user/index.php

// Example data (in real implementation, this would come from the controller)
$users = $users ?? [];

// If no user data is passed, use sample data for display purposes
if (empty($users)) {
    $users = [
        [
            'id' => 1,
            'name' => "Nguyễn Văn A",
            'email' => "vana@gmail.com",
            'phone' => "0937373728",
            'address' => "Nhơn Trạch, Đồng Nai",
            'created_at' => "02/10/2021",
            'gender' => "Nam",
            'status' => "Hoạt động"
        ],
        [
            'id' => 2,
            'name' => "Nguyễn Văn A",
            'email' => "vana@gmail.com",
            'phone' => "0937373728",
            'address' => "Nhơn Trạch, Đồng Nai",
            'created_at' => "02/10/2021",
            'gender' => "Nam",
            'status' => "Hoạt động"
        ],
        [
            'id' => 3,
            'name' => "Nguyễn Văn A",
            'email' => "vana@gmail.com",
            'phone' => "0937373728",
            'address' => "Nhơn Trạch, Đồng Nai",
            'created_at' => "02/10/2021",
            'gender' => "Nam",
            'status' => "Hoạt động"
        ],
        [
            'id' => 4,
            'name' => "Nguyễn Văn A",
            'email' => "vana@gmail.com",
            'phone' => "0937373728",
            'address' => "Nhơn Trạch, Đồng Nai",
            'created_at' => "02/10/2021",
            'gender' => "Nam",
            'status' => "Hoạt động"
        ],
        [
            'id' => 5,
            'name' => "Nguyễn Văn A",
            'email' => "vana@gmail.com",
            'phone' => "0937373728",
            'address' => "Nhơn Trạch, Đồng Nai",
            'created_at' => "02/10/2021",
            'gender' => "Nam",
            'status' => "Vô hiệu"
        ],
        [
            'id' => 6,
            'name' => "Nguyễn Văn A",
            'email' => "vana@gmail.com",
            'phone' => "0937373728",
            'address' => "Nhơn Trạch, Đồng Nai",
            'created_at' => "02/10/2021",
            'gender' => "Nam",
            'status' => "Hoạt động"
        ],
        [
            'id' => 7,
            'name' => "Nguyễn Văn A",
            'email' => "vana@gmail.com",
            'phone' => "0937373728",
            'address' => "Nhơn Trạch, Đồng Nai",
            'created_at' => "02/10/2021",
            'gender' => "Nam",
            'status' => "Hoạt động"
        ],
        [
            'id' => 8,
            'name' => "Nguyễn Văn A",
            'email' => "vana@gmail.com",
            'phone' => "0937373728",
            'address' => "Nhơn Trạch, Đồng Nai",
            'created_at' => "02/10/2021",
            'gender' => "Nam",
            'status' => "Hoạt động"
        ]
    ];
}
?>

<div class="user-management-container">
    <div class="header-section">
        <h1 class="title">Người dùng</h1>
        <div class="actions">
            <div class="search-container">
                <form action="index.php" method="GET">
                    <input type="hidden" name="action" value="manager">
                    <input type="hidden" name="page" value="nguoi-dung">
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
        <table class="user-table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Người Dùng</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Địa Chỉ</th>
                    <th>Ngày Sinh</th>
                    <th>Giới Tính</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="8" class="no-data">Không có dữ liệu</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td class="name-cell"><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td><?php echo htmlspecialchars($user['address']); ?></td>
                            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                            <td><?php echo htmlspecialchars($user['gender']); ?></td>
                            <td>
                                <?php if ($user['status'] === 'Hoạt động'): ?>
                                    <span class="status-badge available">Hoạt động</span>
                                <?php else: ?>
                                    <span class="status-badge pending">Vô hiệu</span>
                                <?php endif; ?>
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
// Handle pagination clicks
document.querySelectorAll('.pagination-item:not(.prev):not(.next)').forEach(button => {
    button.addEventListener('click', function() {
        const page = this.textContent.trim();
        window.location.href = `index.php?action=manager&page=nguoi-dung&page_num=${page}`;
    });
});

// Handle prev/next pagination
document.querySelector('.pagination-item.prev').addEventListener('click', function() {
    if (!this.hasAttribute('disabled')) {
        const currentPage = <?php echo isset($_GET['page_num']) ? intval($_GET['page_num']) : 1; ?>;
        if (currentPage > 1) {
            window.location.href = `index.php?action=manager&page=nguoi-dung&page_num=${currentPage - 1}`;
        }
    }
});

document.querySelector('.pagination-item.next').addEventListener('click', function() {
    const currentPage = <?php echo isset($_GET['page_num']) ? intval($_GET['page_num']) : 1; ?>;
    window.location.href = `index.php?action=manager&page=nguoi-dung&page_num=${currentPage + 1}`;
});
</script>