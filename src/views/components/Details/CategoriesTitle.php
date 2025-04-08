<?php
function renderCategoriesTitle($props = []) {
    $className = $props['className'] ?? '';
    ?>

<link rel="stylesheet" href="/public/styles/detail/CategoriesTitle.css" />

<div class="categories-title <?= $className ?>">
    <?php
        require_once __DIR__ . '/TypeHouse.php';
        require_once __DIR__ . '/TypeHouseWrapper.php';

        // ==== 1) Loại phòng cần thuê ====
        renderTypeHouse([
            'className'            => 'type-house-instance',
            'text'                 => 'Loại Phòng Cần Thuê',
            'text1'                => 'Phòng trọ',
            'text2'                => 'Chung cư',
            'text3'                => 'Nhà nguyên căn',
            'text4'                => 'Kí túc xá',
            'textIconsClassName'   => 'type-house-2',
            'totalAreaClassName'   => 'type-house-2',
        ]);
        ?>

    <div class="total-area-15"></div>

    <?php
        // ==== 2) Phòng cho thuê ở khu vực ====
        renderTypeHouseWrapper([
            'className'            => 'type-house-instance',
            'img'                  => $props['img'] ?? '',
            'layer'                => $props['layer'] ?? '',
            'layer1'               => $props['layer1'] ?? '',
            'layer2'               => $props['layer2'] ?? '',
            'layer3'               => $props['layer3'] ?? '',
            'layer4'               => $props['layer4'] ?? '',
            'layer5'               => $props['layer5'] ?? '',
            'layer6'               => $props['layer6'] ?? '',
            'layer7'               => $props['layer7'] ?? '',
            'textIconsClassName'   => 'type-house-2',
        ]);
        ?>

    <?php
        // ==== 3) Mức giá mong muốn ====
        renderTypeHouse([
            'className'            => 'type-house-4',
            'text'                 => 'Mức Giá Mong Muốn',
            'text1'                => '4 Triệu',
            'text2'                => '6 Triệu',
            'text3'                => '10 Triệu',
            'text4'                => '15 Triệu',
            'textIconsClassName'   => 'type-house-5',
            'totalAreaClassName'   => 'type-house-2',
        ]);
        ?>
</div>

<?php
}
?>