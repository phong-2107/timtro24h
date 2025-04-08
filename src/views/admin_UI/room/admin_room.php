<?php 
$title = "Danh sách Phòng trọ";
ob_start();
$searchValue = htmlspecialchars($_GET['search'] ?? '');
?>

<div class="quan-ly-phong-tro">
  <div class="recent-orders">
    <div class="table-content">
      <div class="table-header">
        <div class="user-table-title">
          <i class="fa-solid fa-house"></i> Danh sách phòng trọ
        </div>

        <div class="table-tools">
          <form method="GET" action="" class="user-search-form">
            <input type="hidden" name="action" value="room_index">
            <input type="text" name="search" placeholder="Tìm theo tên, địa chỉ..." value="<?= $searchValue ?>">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>

          <button id="btn-add-room" class="add-btn">
            <i class="fa fa-plus"></i> Thêm phòng
          </button>
        </div>
      </div>

      <table class="user-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Tên phòng</th>
            <th>Giá thuê</th>
            <th>Địa chỉ</th>
            <th>Diện tích</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($phongTros as $index => $phong): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($phong['tieuDe']) ?></td>
            <td><?= number_format($phong['gia']) ?> VNĐ</td>
            <td><?= htmlspecialchars($phong['diaChiCuThe']) ?></td>
            <td><?= htmlspecialchars($phong['dienTich']) ?> m²</td>
            <td>
              <span class="<?= $phong['trangThai'] == 1 ? 'status-active' : 'status-disabled' ?>">
                <?= $phong['trangThai'] == 1 ? 'Đang thuê' : 'Trống' ?>
              </span>
            </td>
            <td>
              <button class="edit-btn" data-id="<?= $phong['id'] ?>"><i class="fa fa-edit"></i></button>
              <a href="?action=room_delete&id=<?= $phong['id'] ?>" class="delete-btn" onclick="return confirm('Xoá phòng này?');">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="pagination-wrapper">
        <div class="pagination">
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a class="page-link <?= $i == $currentPage ? 'active' : '' ?>" href="?action=room_index&page=<?= $i ?>&search=<?= $searchValue ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- POPUP ADD/EDIT -->
<div id="room-modal" class="modal hidden">
  <div class="modal-content">
    <span class="close-modal">&times;</span>
    <h2 id="modal-title">Thêm phòng</h2>
    <form id="room-form" method="POST" action="">
      <input type="hidden" name="id" id="room-id">
      <div>
        <label for="tenPhong">Tên phòng:</label>
        <input type="text" name="tenPhong" id="tenPhong" required>
      </div>
      <div>
        <label for="giaThue">Giá thuê:</label>
        <input type="number" name="giaThue" id="giaThue" required>
      </div>
      <div>
        <label for="diaChi">Địa chỉ:</label>
        <input type="text" name="diaChi" id="diaChi" required>
      </div>
      <div>
        <label for="dienTich">Diện tích:</label>
        <input type="text" name="dienTich" id="dienTich" required>
      </div>
      <div>
        <label for="moTa">Mô tả:</label>
        <textarea name="moTa" id="moTa" rows="3" placeholder="Nhập mô tả chi tiết..." style="width:100%; padding:6px; margin:8px 0;"></textarea>
      </div>
      <div>
        <label for="trangThai">Trạng thái:</label>
        <select name="trangThai" id="trangThai">
          <option value="1">Đang thuê</option>
          <option value="0">Trống</option>
        </select>
      </div>
      <button type="submit">Lưu</button>
    </form>
  </div>
</div>

<script>
  const modal = document.getElementById('room-modal');
  const closeModal = document.querySelector('.close-modal');
  const addBtn = document.getElementById('btn-add-room');
  const form = document.getElementById('room-form');
  const title = document.getElementById('modal-title');

  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      fetch(`?action=room_get&id=${id}`)
        .then(res => res.json())
        .then(data => {
          form.action = '?action=room_update';
          title.textContent = "Chỉnh sửa phòng";
          document.getElementById('room-id').value = data.id;
          document.getElementById('tenPhong').value = data.tieuDe;
          document.getElementById('giaThue').value = data.gia;
          document.getElementById('diaChi').value = data.diaChiCuThe;
          document.getElementById('dienTich').value = data.dienTich;
          document.getElementById('trangThai').value = data.trangThai;
          document.getElementById('moTa').value = data.moTa || '';
          modal.classList.remove('hidden');
        });
    });
  });

  addBtn.addEventListener('click', () => {
    form.action = '?action=room_create';
    form.reset();
    document.getElementById('room-id').value = '';
    title.textContent = "Thêm phòng mới";
    modal.classList.remove('hidden');
  });

  closeModal.addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  window.addEventListener('click', (e) => {
    if (e.target == modal) modal.classList.add('hidden');
  });
</script>

<style>
.modal.hidden { display: none; }
.modal {
  position: fixed; top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0,0,0,0.5); display: flex;
  justify-content: center; align-items: center;
}
.modal-content {
  background: white; padding: 20px; border-radius: 10px;
  width: 400px;
}
.modal-content input, .modal-content select, .modal-content textarea {
  width: 100%; margin: 8px 0; padding: 6px; border-radius: 4px; border: 1px solid #ccc;
}
.modal-content button { margin-top: 10px; }
.close-modal {
  position: absolute; right: 20px; top: 10px;
  font-size: 20px; cursor: pointer;
}
.add-btn, .edit-btn, .delete-btn {
  background: #4caf50; color: white; border: none;
  padding: 5px 10px; border-radius: 4px; cursor: pointer;
}
.edit-btn { background: #2196f3; }
.delete-btn { background: #f44336; }
</style>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout_admin.php';
?>
