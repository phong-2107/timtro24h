<?php
ob_start();
session_start();

$user = $_SESSION['user'] ?? null;
?>

<link rel="stylesheet" href="/public/styles/user/UserProfile.css">

<div class="user-profile">
    <div class="user-profile__container">
        <?php include __DIR__ . '/../components/profile/sidebar.php'; ?>
        <?php include __DIR__ . '/../components/profile/profile_form.php'; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';