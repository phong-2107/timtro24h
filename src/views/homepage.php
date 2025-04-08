<?php
ob_start();

// Gọi model
use QLPhongTro\Models\PhongTro;
use QLPhongTro\Models\DiaDiem;

// Kết nối CSDL (giả sử đã khởi tạo $conn ở index.php hoặc trước đó)
$phongTroModel = new PhongTro($conn);
$diaDiemModel  = new DiaDiem($conn);

// Lấy dữ liệu giống useEffect(fetchRooms & fetchDiaDiem)
$roomsData = $phongTroModel->all();
$locations = $diaDiemModel->all();
?>

<div class="home">
    <div class="div-2">
        <?php 
            $diaDiems = $locations;
            include __DIR__ . '/components/Home/slider.php';
        ?>
        <?php include __DIR__ . '/components/Home/categories.php'; ?>
        <?php include __DIR__ . '/components/Home/location.php'; ?>
        <?php include __DIR__ . '/components/Home/map.php'; ?>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/layouts/main.php'; ?>