<div class="sidebar">
    <div class="sidebar__user-info">
        <div class="sidebar__avatar">
            <?php if (!empty($user['anhDaiDien'])): ?>
            <img src="<?= htmlspecialchars($user['anhDaiDien']) ?>" alt="avatar" />
            <?php endif; ?>
        </div>
        <div class="sidebar__username">
            <div class="sidebar__username-text">
                <?= htmlspecialchars($user['hoTen'] ?? 'Người dùng') ?>
            </div>
        </div>
    </div>

    <button class="sidebar__menu-item sidebar__menu-item--active">
        <img class="sidebar__menu-icon" alt="Profile Icon" src="https://c.animaapp.com/Av7kc8aL/img/icon.svg" />
        <div class="sidebar__menu-text">
            <div class="sidebar__menu-label">Thông tin cá nhân</div>
        </div>
    </button>

    <form method="GET" action="/public/index.php">
        <input type="hidden" name="action" value="logout">
        <button type="submit" class="sidebar__menu-item sidebar__menu-item--logout">
            <div class="sidebar__menu-icon-wrapper">
                <img class="sidebar__logout-icon" alt="Logout"
                    src="https://c.animaapp.com/Av7kc8aL/img/group-16@2x.png" />
            </div>
            <div class="sidebar__menu-text">
                <div class="sidebar__menu-label">Đăng xuất</div>
            </div>
        </button>
    </form>
</div>