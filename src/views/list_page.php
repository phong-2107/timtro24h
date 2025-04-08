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
        <?php 
            include __DIR__ . '/list/categories.php';
        ?>

        <div style="margin-left: 20px;">
            <h2>Bản đồ (Map)</h2>
            <p>Phần này bạn có thể tích hợp Google Map hoặc bất kỳ map nào (Vietmap, Leaflet...).</p>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
include __DIR__ . '/layouts/main.php'; 