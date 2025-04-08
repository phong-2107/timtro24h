<?php
$className = $className ?? '';
$divClassName = $divClassName ?? '';
$tinhThanh = $tinhThanh ?? 'Đang tải...';
?>
<link rel="stylesheet" href="/public/styles/common/Button.css">

<button class="button <?= htmlspecialchars($className, ENT_QUOTES) ?>">
    <div class="text-wrapper-15 <?= htmlspecialchars($divClassName, ENT_QUOTES) ?>">
        <?= htmlspecialchars($tinhThanh, ENT_QUOTES, 'UTF-8') ?>
    </div>
</button>