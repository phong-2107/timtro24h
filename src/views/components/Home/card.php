<link rel="stylesheet" href="/public/styles/home/Card.css">


<?php
if (!isset($room) || !is_array($room)) {
    echo '<div style="color: red;">Lỗi: Không có dữ liệu phòng trọ!</div>';
    return; // Dừng nếu không có dữ liệu
}
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$id = $room['id'];
$title = $room['tieuDe'];
$location = $room['diaChiCuThe'] . ', ' . ($room['diaDiem']['quanHuyen'] ?? '') . ', ' . ($room['diaDiem']['tinhThanh'] ?? '');
$price = number_format($room['gia'] / 1000000, 1) . ' Triệu / Tháng';
$area = $room['dienTich'] . 'm²';
$timeAgo = 'Vừa đăng';
$imageSrc = $room['hinhAnh'][0] ?? '/public/images/6.jpg';
$detailUrl = "?action=phongtro_detail&id=" . urlencode($id);
$isHot = true;

// Rút gọn tiêu đề
$displayTitle = (mb_strlen($title) > 19) ? mb_substr($title, 0, 16) . '...' : $title;

// Escape dữ liệu để tránh lỗi
$displayTitle = htmlspecialchars($displayTitle, ENT_QUOTES, 'UTF-8');
$location = htmlspecialchars($location, ENT_QUOTES, 'UTF-8');



// // Kiểm tra đăng nhập
// $isLoggedIn = isset($_SESSION['user_id']);
// $userId = $_SESSION['user_id'] ?? null;

// // URL toggle yêu thích
// $toggleUrl = "?action=yeuthich_add&user=$userId&phong=$id";
// ?>



<a href="<?= $detailUrl ?>" class="card card-instance">
    <div class="card card-instance">
        <div class="label-wrapper"
            style="background-image: url('<?= htmlspecialchars($imageSrc) ?>'); background-position: center; background-size: cover;">
            <?php if ($isHot): ?>
            <div class="label">
                <div class="for-sale">Hot</div>
            </div>
            <?php endif; ?>
        </div>

        <div class="text-icons">
            <div class="text-icons-2">
                <div class="content-3">
                    <div class="title-4">
                        <div class="text-wrapper-19"><?= $displayTitle ?></div>

                        <!-- Icon Yêu Thích -->
                        <!-- <a href="<?= $isLoggedIn ? $toggleUrl : 'javascript:void(0)' ?>" class="fav-icon"
                            onclick="<?php if (!$isLoggedIn): ?>alert('Vui lòng đăng nhập để sử dụng tính năng yêu thích!'); return false;<?php endif; ?>">
                            <img class="vector-2" src="https://cdn-icons-png.flaticon.com/512/833/833472.png"
                                alt="Yêu thích" width="20" />
                        </a> -->
                    </div>
                    <div class="text-wrapper-20"><?= $location ?></div>
                </div>
                <div class="text-wrapper-21"><?= $price ?></div>
            </div>

            <div class="text-icons-3">
                <div class="size">
                    <div class="icon-text">
                        <img class="img-3" alt="Size fullscreen"
                            src="https://c.animaapp.com/m8uerufgJVBeV6/img/size-fullscreen-svgrepo-com-1.svg" />
                        <div class="text">
                            <div class="text-wrapper-22"><?= $area ?></div>
                        </div>
                    </div>
                    <div class="text-wrapper-23">Diện tích</div>
                </div>

                <div class="total-area">
                    <div class="total-area-2">
                        <img class="img-3" alt="Time icon"
                            src="https://c.animaapp.com/m8uerufgJVBeV6/img/time-svgrepo-com-1.svg" />
                        <div class="text-2">
                            <div class="text-wrapper-24"><?= $timeAgo ?></div>
                        </div>
                    </div>
                    <div class="text-wrapper-25">Thời gian</div>
                </div>
            </div>
        </div>
    </div>
</a>