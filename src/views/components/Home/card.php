<link rel="stylesheet" href="/public/styles/home/Card.css">

<?php
// Lấy dữ liệu để hiển thị
$id = $room['id'];
$title = $room['tieuDe'];
$location = $room['diaChiCuThe'] . ', ' . ($room['diaDiem']['quanHuyen'] ?? '') . ', ' . ($room['diaDiem']['tinhThanh'] ?? '');
$price = number_format($room['gia'] / 1000000, 1) . ' Triệu / Tháng';
$area = $room['dienTich'] . 'm²';
$timeAgo = 'Vừa đăng';
$isHot = true;
$imageSrc = $room['hinhAnh'][0] ?? '/public/images/6.jpg';

// Link đến trang chi tiết phòng trọ
$detailUrl = "?action=phongtro_detail&id=" . urlencode($id);

// Nếu muốn cắt ngắn title để giống logic React
$displayTitle = (mb_strlen($title) > 19)
    ? (mb_substr($title, 0, 16) . '...')
    : $title;

// Nên htmlspecialchars để tránh lỗi XSS
$displayTitle = htmlspecialchars($displayTitle, ENT_QUOTES, 'UTF-8');
$location = htmlspecialchars($location, ENT_QUOTES, 'UTF-8');
?>

<a href="<?= $detailUrl ?>" class="card card-instance">
    <!-- Thêm một div bọc bên trong để mô phỏng cấu trúc 2 tầng như trong card.jsx -->
    <div class="card card-instance">
        <div class="label-wrapper" style="background-image: url('<?= htmlspecialchars($imageSrc, ENT_QUOTES, 'UTF-8') ?>');
                    background-position: center;
                    background-size: cover;">
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
                        <div class="text-wrapper-19">
                            <?= $displayTitle ?>
                        </div>
                        <img class="vector-2" alt="Vector" src="https://c.animaapp.com/m8uerufgJVBeV6/img/vector.svg" />
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
                        <img class="img-3" alt="Time svgrepo com"
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