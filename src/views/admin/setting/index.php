<?php
// views/admin/setting/index.php

// Lấy dữ liệu người dùng hiện tại (giả định từ session hoặc database)
$userData = $userData ?? [
    'display_name' => 'Nguyen Van A',
    'email' => 'vana@gmail.com',
    'phone' => '0937373728'
];
?>

<div class="settings-container">
    <div class="settings-header">
        <h1 class="settings-title">Cài đặt</h1>
        <div class="display-options">
            <button class="display-option" title="Chế độ sáng">
                <span class="icon-set light-mode-icon">☀</span>
            </button>
            <button class="display-option" title="Chế độ tối">
                <span class="icon-set dark-mode-icon">☾</span>
            </button>
            <button class="display-option" title="Hiển thị màn hình">
                <span class="icon-set screen-icon">⊞</span>
            </button>
        </div>
    </div>

    <div class="settings-content">
        <div class="settings-section">
            <div class="settings-column">
                <h2 class="section-title">Thông tin tài khoản</h2>
                
                <form id="accountInfoForm" method="POST" action="index.php?action=manager&page=update-account">
                    <div class="form-group">
                        <label for="displayName">Tên hiển thị</label>
                        <input 
                            type="text" 
                            id="displayName" 
                            name="display_name" 
                            class="form-input" 
                            value="<?php echo htmlspecialchars($userData['display_name'] ?? ''); ?>"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input" 
                            value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input 
                            type="tel" 
                            id="phone" 
                            name="phone" 
                            class="form-input" 
                            value="<?php echo htmlspecialchars($userData['phone'] ?? ''); ?>"
                        >
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
            
            <div class="settings-column">
                <h2 class="section-title">Đổi mật khẩu</h2>
                
                <form id="passwordChangeForm" method="POST" action="index.php?action=manager&page=change-password">
                    <div class="form-group">
                        <label for="currentPassword">Mật khẩu cũ</label>
                        <input 
                            type="password" 
                            id="currentPassword" 
                            name="current_password" 
                            class="form-input"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="newPassword">Mật khẩu mới</label>
                        <input 
                            type="password" 
                            id="newPassword" 
                            name="new_password" 
                            class="form-input"
                        >
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmPassword">Xác nhận mật khẩu</label>
                        <input 
                            type="password" 
                            id="confirmPassword" 
                            name="confirm_password" 
                            class="form-input"
                        >
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Xác nhận thay đổi</button>
                        <button type="button" class="btn btn-danger" id="cancelPasswordChange">Hủy bỏ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Hủy form đổi mật khẩu
document.getElementById('cancelPasswordChange').addEventListener('click', function() {
    document.getElementById('passwordChangeForm').reset();
});

// Chuyển đổi chế độ sáng/tối
document.querySelectorAll('.display-option').forEach(button => {
    button.addEventListener('click', function() {
        // Logic chuyển đổi chế độ hiển thị có thể thêm sau
        console.log('Đã nhấp vào nút hiển thị:', this.title);
    });
});

// Kiểm tra mật khẩu mới trùng khớp
document.getElementById('passwordChangeForm').addEventListener('submit', function(event) {
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (newPassword !== confirmPassword) {
        event.preventDefault();
        alert('Mật khẩu xác nhận không khớp với mật khẩu mới');
    }
});
</script>