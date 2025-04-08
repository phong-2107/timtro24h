<?php
ob_start(); 
?>

<link rel="stylesheet" href="/public/styles/detail/style.css" />

<div class="detail-property">
    <div class="div-3">
        <?php include __DIR__ . '../components/Details/ContentDetail.php'; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/layouts/main.php'; ?>