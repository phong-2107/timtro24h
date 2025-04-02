<link rel="stylesheet" href="/public/styles/home/Card.css">

<?php
$title = $room['tieuDe'];
$location = $room['diaChiCuThe'] . ', ' . ($room['diaDiem']['quanHuyen'] ?? '') . ', ' . ($room['diaDiem']['tinhThanh'] ?? '');
$price = number_format($room['gia'] / 1000000, 1) . ' Triệu / Tháng';
$area = $room['dienTich'] . 'm²';
$timeAgo = 'Vừa đăng';
$isHot = true;
$imageSrc = $room['hinhAnh'][0] ?? '/public/images/6.jpg';
?>

<div class="card card-instance">
    <div class="label-wrapper card-2"
        style="background-image: url('<?= htmlspecialchars($imageSrc) ?>'); background-position: center; background-size: cover;">
        <?php if ($isHot): ?>
        <div class="label">
            <div class="for-sale">Hot</div>
        </div>
        <?php endif; ?>
    </div>

    <div class="text-icons card-4">
        <div class="text-icons-2">
            <div class="content-3">
                <div class="title-4">
                    <div class="text-wrapper-19"><?= htmlspecialchars($title) ?></div>
                    <img class="vector-2 card-3" alt="Vector"
                        src="https://c.animaapp.com/m8uerufgJVBeV6/img/vector.svg" />
                </div>
                <div class="text-wrapper-20"><?= htmlspecialchars($location) ?></div>
            </div>
            <div class="text-wrapper-21"><?= $price ?></div>
        </div>

        <div class="text-icons-3">
            <div class="size">
                <div class="icon-text">
                    <img class="img-3" alt="Size"
                        src="https://c.animaapp.com/m8uerufgJVBeV6/img/size-fullscreen-svgrepo-com-1.svg" />
                    <div class="text">
                        <div class="text-wrapper-22"><?= $area ?></div>
                    </div>
                </div>
                <div class="text-wrapper-23">Diện tích</div>
            </div>

            <div class="total-area">
                <div class="total-area-2">
                    <img class="img-3" alt="Time"
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