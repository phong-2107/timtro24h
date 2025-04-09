<?php
ob_start(); 

use QLPhongTro\Models\PhongTro;
use QLPhongTro\Models\DiaDiem;

// $phongTroModel = new PhongTro($conn);
// $diaDiemModel  = new DiaDiem($conn);

// $roomsData = $phongTroModel->all();
// $locations = $diaDiemModel->all();
?>

<!-- CSS cho ListPage -->
<link rel="stylesheet" href="/public/styles/list/Categories.css">
<link rel="stylesheet" href="/public/styles/list/Style.css">

<div class="list" style="margin-top: 100px;">
    <div class="div-2">
        <?php include __DIR__ . '/list/find.php'; ?>

        <?php 
            include __DIR__ . '/list/categories.php';
        ?>

        <?php include __DIR__ . '/components/Home/map.php'; ?>

    </div>
</div>

<?php 
$content = ob_get_clean(); 
include __DIR__ . '/layouts/main.php'; 