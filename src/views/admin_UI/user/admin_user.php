<?php
$title = "Danh sách Người dùng";
ob_start();

// Giữ lại các giá trị filter
$searchValue = htmlspecialchars($_GET['search'] ?? '');
$filterGender = $_GET['gender'] ?? '';
$filterStatus = $_GET['status'] ?? '';
?>

<div class="quan-ly-nguoi-dung">
  <div class="recent-orders">
    <div class="table-content">
      <div class="table-header">
        <div class="user-table-title">
          <i class="fa-solid fa-users"></i> Danh sách người dùng
        </div>

        <!-- Thanh công cụ -->
        <div class="table-tools">
          <!-- Tìm kiếm -->
          <form method="GET" action="" class="user-search-form">
            <input type="hidden" name="action" value="user_index">
            <input type="text" name="search" placeholder="Tìm theo tên, email, ID hoặc SĐT..." value="<?= $searchValue ?>">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>

          <!-- Nút filter toggle -->
          <button id="filter-toggle" class="filter-toggle">
            <i class="fa-solid fa-filter"></i> Bộ lọc
          </button>

          <!-- Nút reset -->
          <a href="?action=user_index" class="reset-btn">
            <i class="fa-solid fa-rotate-right"></i>
          </a>
        </div>
      </div>

      <!-- Form bộ lọc -->
      <form method="GET" action="" id="filter-form" class="filter-form collapsed">
        <input type="hidden" name="action" value="user_index">
        <div class="filter-row">
          <label>Giới tính:</label>
          <select name="gender">
            <option value="">Tất cả</option>
            <option value="Nam" <?= $filterGender == 'Nam' ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= $filterGender == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
          </select>
          <label>Trạng thái:</label>
          <select name="status">
            <option value="">Tất cả</option>
            <option value="1" <?= $filterStatus == '1' ? 'selected' : '' ?>>Hoạt động</option>
            <option value="0" <?= $filterStatus == '0' ? 'selected' : '' ?>>Vô hiệu</option>
          </select>
          <button type="submit">Lọc</button>
        </div>
      </form>

      <table class="user-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Trạng thái</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $index => $user): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($user['hoTen']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['soDienThoai']) ?></td>
            <td><?= htmlspecialchars($user['diaChi']) ?></td>
            <td><?= htmlspecialchars($user['gioiTinh']) ?></td>
            <td>
              <span class="<?= ($user['trangThai'] ?? 1) == 1 ? 'status-active' : 'status-disabled' ?>">
                <?= ($user['trangThai'] ?? 1) == 1 ? 'Hoạt động' : 'Vô hiệu' ?>
              </span>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!-- PHÂN TRANG -->
      <div class="pagination-wrapper">
        <div class="pagination">
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a class="page-link <?= $i == $currentPage ? 'active' : '' ?>" href="?action=user_index&page=<?= $i ?>&search=<?= $searchValue ?>&gender=<?= $filterGender ?>&status=<?= $filterStatus ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>
        </div>
      </div>

    </div>
  </div>
</div>


<script>
  const toggle = document.getElementById("filter-toggle");
  const form = document.getElementById("filter-form");
  toggle.addEventListener("click", () => {
    form.classList.toggle("expanded");
  });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout_admin.php';