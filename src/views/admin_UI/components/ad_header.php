<div class="header-container">
  <div class="header-content">
    <div class="user-box">
      <div class="user-info" onclick="toggleDropdown()">
        <div class="user-avatar-border">
          <span class="username">Nguyễn Thanh Phong</span>
        </div>
      </div>
      <div class="dropdown-menu" id="dropdown">
        <a href="#" class="dropdown-item">
          <i class="fa fa-cog"></i> Cài đặt tài khoản
        </a>
        <a href="https://trotot24h.vn" class="dropdown-item">
          <i class="fa fa-globe"></i> Đi đến TroTot.24H
        </a>
        <a href="logout.php" class="dropdown-item logout">
          <i class="fa fa-sign-out-alt"></i> Đăng xuất
        </a>
      </div>
    </div>
  </div>
</div>
<script>
function toggleDropdown() {
  const dropdown = document.getElementById("dropdown");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}
document.addEventListener("click", function (e) {
  const dropdown = document.getElementById("dropdown");
  const userInfo = document.querySelector(".user-info");
  if (!userInfo.contains(e.target)) {
    dropdown.style.display = "none";
  }
});
</script>
