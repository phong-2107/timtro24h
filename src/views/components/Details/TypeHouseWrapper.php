<link rel="stylesheet" href="/public/styles/detail/TypeHouseWrapper.css" />

<?php

function renderTypeHouseWrapper($props = []) {
    extract($props);
    $className = $className ?? '';
    $frameClassName = $frameClassName ?? '';
    $textIconsClassName = $textIconsClassName ?? '';
    $totalAreaClassName = $totalAreaClassName ?? '';
    $layer = $layer ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-9.png';
    $totalAreaClassNameOverride = $totalAreaClassNameOverride ?? '';
    $img = $img ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-10.png';
    $totalAreaWrapperClassName = $totalAreaWrapperClassName ?? '';
    $layer1 = $layer1 ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-11.png';
    $totalAreaWrapperClassNameOverride = $totalAreaWrapperClassNameOverride ?? '';
    $layer2 = $layer2 ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-12.png';
    $divClassName = $divClassName ?? '';
    $layer3 = $layer3 ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-13.png';
    $divClassNameOverride = $divClassNameOverride ?? '';
    $layer4 = $layer4 ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-14.png';
    $totalAreaClassName1 = $totalAreaClassName1 ?? '';
    $layer5 = $layer5 ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-15.png';
    $totalAreaClassName2 = $totalAreaClassName2 ?? '';
    $layer6 = $layer6 ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-16.png';
    $totalAreaClassName3 = $totalAreaClassName3 ?? '';
    $layer7 = $layer7 ?? 'https://c.animaapp.com/m8zrfufxKFUKIW/img/layer1-17.png';
    ?>

<!-- Bắt đầu in ra HTML -->
<div class="type-house-wrapper <?= htmlspecialchars($className) ?>">
    <div class="frame-wrapper">
        <div class="frame-18 <?= htmlspecialchars($frameClassName) ?>">
            <p class="lo-i-ph-ng-c-n-thu-2">Phòng Cho Thuê Ở Khu Vực</p>
        </div>
    </div>

    <div class="text-icons-2 <?= htmlspecialchars($textIconsClassName) ?>">
        <!-- 1. total-area-5 -->
        <div class="total-area-5 <?= htmlspecialchars($totalAreaClassName) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($layer) ?>" />
                </div>
                <div class="text-3">
                    <div class="text-wrapper-24">Tp. Hồ Chí Minh</div>
                </div>
            </div>
        </div>

        <!-- 2. total-area-7 -->
        <div class="total-area-7 <?= htmlspecialchars($totalAreaClassNameOverride) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($img) ?>" />
                </div>
                <div class="text-3">
                    <div class="text-wrapper-25">Hà Nội</div>
                </div>
            </div>
        </div>

        <!-- 3. total-area-8 -->
        <div class="total-area-8 <?= htmlspecialchars($totalAreaWrapperClassName) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($layer1) ?>" />
                </div>
                <div class="text-3">
                    <div class="text-wrapper-26">Bình Dương</div>
                </div>
            </div>
        </div>

        <!-- 4. total-area-9 -->
        <div class="total-area-9 <?= htmlspecialchars($totalAreaWrapperClassNameOverride) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($layer2) ?>" />
                </div>
                <div class="text-3">
                    <p class="text-wrapper-27">Bà Rịa - Vũng Tàu</p>
                </div>
            </div>
        </div>

        <!-- 5. total-area-10 -->
        <div class="total-area-10 <?= htmlspecialchars($divClassName) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($layer3) ?>" />
                </div>
                <div class="text-3">
                    <div class="text-wrapper-28">Đà Nẵng</div>
                </div>
            </div>
        </div>

        <!-- 6. total-area-11 -->
        <div class="total-area-11 <?= htmlspecialchars($divClassNameOverride) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($layer4) ?>" />
                </div>
                <div class="text-3">
                    <div class="text-wrapper-29">Đồng Nai</div>
                </div>
            </div>
        </div>

        <!-- 7. total-area-12 -->
        <div class="total-area-12 <?= htmlspecialchars($totalAreaClassName1) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($layer5) ?>" />
                </div>
                <div class="text-3">
                    <div class="text-wrapper-30">Lâm Đồng</div>
                </div>
            </div>
        </div>

        <!-- 8. total-area-13 -->
        <div class="total-area-13 <?= htmlspecialchars($totalAreaClassName2) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($layer6) ?>" />
                </div>
                <div class="text-3">
                    <div class="text-wrapper-30">Cần Thơ</div>
                </div>
            </div>
        </div>

        <!-- 9. total-area-14 -->
        <div class="total-area-14 <?= htmlspecialchars($totalAreaClassName3) ?>">
            <div class="total-area-6">
                <div class="svg">
                    <img class="layer" alt="Layer" src="<?= htmlspecialchars($layer7) ?>" />
                </div>
                <div class="text-3">
                    <div class="text-wrapper-30">Long An</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}