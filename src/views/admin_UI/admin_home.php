<?php
$title = "Admin - Trang Chủ";
ob_start();
?>

<?php include __DIR__ . '/components/ad_statistics.php'; ?>

<section class="featured-room-list">

  <?php include __DIR__ . '/components/ad_table.php'; ?>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layout_admin.php';
?>
