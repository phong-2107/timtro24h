<div class="profile-form">
    <div class="profile-form__container">
        <div class="profile-form__title">
            <div class="profile-form__title-text">Thông tin cá nhân</div>
        </div>

        <form method="POST" action="?action=profile_update">
            <div class="profile-form__field">
                <div class="profile-form__field-group">
                    <div class="profile-form__label">
                        <div class="profile-form__label-text">Tên hiển thị</div>
                    </div>
                    <input type="text" name="displayName" class="profile-form__input"
                        value="<?= htmlspecialchars($user['hoTen'] ?? '') ?>" />
                </div>
            </div>

            <div class="profile-form__avatar-section">
                <div class="profile-form__avatar-group">
                    <div class="profile-form__avatar-label">
                        <div class="profile-form__label-text">Ảnh đại diện</div>
                    </div>
                    <div class="profile-form__avatar-image">
                        <?php if (!empty($user['anhDaiDien'])): ?>
                        <img src="<?= htmlspecialchars($user['anhDaiDien']) ?>" alt="avatar" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <button type="button" class="profile-form__button profile-form__button--secondary">
                Thay đổi ảnh
            </button>

            <div class="profile-form__field">
                <div class="profile-form__field-group">
                    <div class="profile-form__label">
                        <div class="profile-form__label-text">Email</div>
                    </div>
                    <input type="email" name="email" class="profile-form__input"
                        value="<?= htmlspecialchars($user['email'] ?? '') ?>" />
                </div>
            </div>

            <div class="profile-form__field">
                <div class="profile-form__field-group">
                    <div class="profile-form__label">
                        <div class="profile-form__label-text">Số điện thoại</div>
                    </div>
                    <input type="tel" name="phone" class="profile-form__input"
                        value="<?= htmlspecialchars($user['soDienThoai'] ?? '') ?>" />
                </div>
            </div>

            <div class="profile-form__field">
                <div class="profile-form__field-group">
                    <div class="profile-form__label">
                        <div class="profile-form__label-text">Địa chỉ</div>
                    </div>
                    <input type="text" name="address" class="profile-form__input"
                        value="<?= htmlspecialchars($user['diaChi'] ?? '') ?>" />
                </div>
            </div>

            <div class="profile-form__button-wrapper">
                <a href="?action=changepassword" class="profile-form__button profile-form__button--secondary">
                    Đổi mật khẩu
                </a>
                <button type="submit" class="profile-form__button profile-form__button--primary">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>