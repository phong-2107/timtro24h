<link rel="stylesheet" href="/public/styles/detail/Contentdetail.css" />

<?php
$room = $roomsData[0] ?? null;

if (!$room) {
    echo "<p>Không tìm thấy thông tin phòng trọ.</p>";
    return;
}
?>

<div class="content-detail">
    <div class="main">
        <div class="navbar-2">
            <div class="text-wrapper-8">Home</div>
            <div class="text-wrapper-8">/</div>
            <div class="text-wrapper-9">Phòng trọ</div>

            <div class="place-wrapper">
                <?php foreach ($locations as $location): ?>
                <?php $text = $location['tinhThanh']; $id = $location['id']; ?>
                <?php include __DIR__ . '/place.php'; ?>
                <?php endforeach; ?>
            </div>

            <div class="text-wrapper-8">/</div>
            <div class="text-wrapper-10">Phòng trọ #<?= htmlspecialchars($room['id']) ?></div>
        </div>

        <div class="content-left">

            <div class="image-view" id="gallery">
                <div class="main-image-wrapper">
                    <button class="nav prev" onclick="prevImage()">‹</button>

                    <div class="main-image" id="mainImage"
                        style="background-image: url('<?= $room['hinhAnh'][0] ?? '/images/default.jpg' ?>');">
                    </div>

                    <button class="nav next" onclick="nextImage()">›</button>
                </div>

                <div class="thumbnail-list" id="thumbnails">
                    <?php foreach ($room['hinhAnh'] as $index => $img): ?>
                    <div class="thumbnail" onclick="showImage(<?= $index ?>)"
                        style="background-image: url('<?= $img ?>');" data-index="<?= $index ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="div-wrapper-2">
                <p class="p"><?= htmlspecialchars($room['tieuDe']) ?></p>
            </div>

            <div class="address-room">
                <p class="text-wrapper-11">
                    <?= htmlspecialchars($room['diaChiCuThe']) ?>,
                    <?= $room['diaDiem']['quanHuyen'] ?? '' ?>,
                    <?= $room['diaDiem']['tinhThanh'] ?? '' ?>
                </p>
            </div>

            <div class="box-infor">
                <div class="div-2">
                    <div class="text-wrapper-12">Giá thuê</div>
                    <div class="text-wrapper-13"><?= number_format($room['gia'] / 1000000, 1) ?> triệu</div>
                </div>

                <div class="div-2">
                    <div class="text-wrapper-14">Diện tích</div>
                    <div class="text-wrapper-15"><?= $room['dienTich'] ?> m²</div>
                </div>
            </div>

            <div class="div-wrapper-2">
                <div class="text-wrapper-16">Thông tin mô tả</div>
            </div>

            <div class="div-wrapper-2">
                <p class="ph-ng-cho-thu-thi-t">
                    <?= nl2br(htmlspecialchars($room['moTa'])) ?>
                </p>
            </div>

            <div class="date-room">
                <div class="frame-16">
                    <div class="text-wrapper-17">Ngày đăng</div>
                    <div class="text-wrapper-18"><?= date('d/m/Y', strtotime($room['created_at'])) ?></div>
                    <div class="text-wrapper-19"><?= date('d/m/Y', strtotime($room['updated_at'])) ?></div>
                    <div class="text-wrapper-20">Ngày cập nhật</div>
                </div>
            </div>
        </div>

        <div class="content-right">
            <?php
            require_once __DIR__ . '/CategoriesTitle.php';
            renderCategoriesTitle([
                'className' => 'categories-title-instance',
                'img'       => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-23.png',
                'layer'     => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-25.png',
                'layer1'    => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-21.png',
                'layer2'    => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-24.png',
                'layer3'    => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-20.png',
                'layer4'    => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-26.png',
                'layer5'    => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-19.png',
                'layer6'    => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-18.png',
                'layer7'    => 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-22.png',
            ]);
            ?>
        </div>
    </div>

    <div class="div-wrapper-2">
        <div class="text-wrapper-21">Tin dành cho bạn</div>
    </div>

    <div class="box-card">
        <?php if (empty($roomsData)): ?>
        <p>Không có phòng gợi ý.</p>
        <?php else: ?>
        <?php foreach ($roomsData as $room): ?>
        <?php include __DIR__ . '/card.php'; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


<script>
const images = <?= json_encode($room['hinhAnh']) ?>;
let currentIndex = 0;

function showImage(index) {
    if (index < 0 || index >= images.length) return;
    currentIndex = index;
    document.getElementById('mainImage').style.backgroundImage = `url('${images[currentIndex]}')`;
    highlightThumbnail();
}

function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    showImage(currentIndex);
}

function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    showImage(currentIndex);
}

function highlightThumbnail() {
    const thumbs = document.querySelectorAll('.thumbnail');
    thumbs.forEach(t => t.classList.remove('active'));
    if (thumbs[currentIndex]) {
        thumbs[currentIndex].classList.add('active');
    }
}

document.addEventListener('DOMContentLoaded', highlightThumbnail);
</script>