<?php
// Gán giá trị mặc định nếu chưa có
$className = $className ?? '';
$text = $text ?? 'Loại Phòng Cần Thuê';
$textIconsClassName = $textIconsClassName ?? '';
$divClassName = $divClassName ?? '';
$divClassNameOverride = $divClassNameOverride ?? '';
$divClassName1 = $divClassName1 ?? '';
$divClassName2 = $divClassName2 ?? '';
$text1 = $text1 ?? 'Phòng trọ';
$text2 = $text2 ?? 'Chung cư';
$text3 = $text3 ?? 'Nhà nguyên căn';
$text4 = $text4 ?? 'Kí túc xá';
?>

<link rel="stylesheet" href="/public/styles/list/TypeHouse.css">

<div class="type-house <?= htmlspecialchars($className) ?>">
    <div class="frame-wrapper">
        <div class="lo-i-ph-ng-c-n-thu-wrapper">
            <div class="lo-i-ph-ng-c-n-thu"><?= htmlspecialchars($text) ?></div>
        </div>
    </div>

    <div class="text-icons-3 <?= htmlspecialchars($textIconsClassName) ?>">
        <?php foreach ([
            ['text' => $text1, 'class' => $divClassName],
            ['text' => $text2, 'class' => $divClassNameOverride],
            ['text' => $text3, 'class' => $divClassName1],
            ['text' => $text4, 'class' => $divClassName2],
        ] as $item): ?>
        <div class="total-area-wrapper">
            <div class="total-area-4">
                <img class="frame-17" alt="Frame" src="https://c.animaapp.com/m8twrcooYWMm14/img/frame.svg" />
                <div class="text-4">
                    <div class="text-wrapper-23 <?= htmlspecialchars($item['class']) ?>">
                        <?= htmlspecialchars($item['text']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>