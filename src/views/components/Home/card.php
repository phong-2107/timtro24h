<?php
if (!isset($room) || !is_array($room)) {
    echo '<div style="color: red;">Lỗi: Không có dữ liệu phòng trọ!</div>';
    return;
}

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

// Escape dữ liệu
$displayTitle = htmlspecialchars($displayTitle, ENT_QUOTES, 'UTF-8');
$location = htmlspecialchars($location, ENT_QUOTES, 'UTF-8');

// Xác định trang hiện tại có phải follow_mine hay không
$currentPage = $_GET['action'] ?? '';
$isFollowPage = ($currentPage === 'follow_mine');
?>

<div class="card card-instance" style="position: relative;">
    <?php if ($isFollowPage && isset($_SESSION['username'])): ?>
        <!-- Nút Bỏ theo dõi -->
        <form method="post" action="?action=yeuthich_remove" style="position: absolute; top: 10px; right: 10px; z-index: 10;">
            <input type="hidden" name="phong" value="<?= $id ?>">
            <button type="submit" class="btn-unfollow" style="
                background-color: #dc3545;
                color: white;
                border: none;
                padding: 4px 8px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 12px;">
                Bỏ theo dõi
            </button>
        </form>
    <?php endif; ?>

    <a href="<?= $detailUrl ?>" style="text-decoration: none; color: inherit;">
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
    </a>
</div>
