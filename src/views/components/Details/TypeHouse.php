<link rel="stylesheet" href="/public/styles/detail/TypeHouse.css" />
<?php
function renderTypeHouse($props = []) {
  extract($props);

  // Gán giá trị mặc định (trong JSX code)
  $className = $className ?? '';
  $textIconsClassName = $textIconsClassName ?? '';
  $totalAreaClassName = $totalAreaClassName ?? '';
  $totalAreaClassNameOverride = $totalAreaClassNameOverride ?? '';
  $totalAreaWrapperClassName = $totalAreaWrapperClassName ?? '';
  $totalAreaWrapperClassNameOverride = $totalAreaWrapperClassNameOverride ?? '';
  $text = $text ?? 'Loại Phòng Cần Thuê';
  $divClassName = $divClassName ?? '';
  $text1 = $text1 ?? 'Phòng trọ';
  $divClassNameOverride = $divClassNameOverride ?? '';
  $text2 = $text2 ?? 'Chung cư';
  $divClassName1 = $divClassName1 ?? '';
  $text3 = $text3 ?? 'Nhà nguyên căn';
  $divClassName2 = $divClassName2 ?? '';
  $text4 = $text4 ?? 'Kí túc xá';

  ?>
<!-- Bắt đầu in ra HTML -->
<div class="type-house <?= htmlspecialchars($className) ?>">
    <div class="text">
        <div class="lo-i-ph-ng-c-n-thu-wrapper">
            <div class="lo-i-ph-ng-c-n-thu"><?= htmlspecialchars($text) ?></div>
        </div>
    </div>

    <div class="text-icons <?= htmlspecialchars($textIconsClassName) ?>">
        <!-- total-area -->
        <div class="total-area <?= htmlspecialchars($totalAreaClassName) ?>">
            <div class="total-area-2">
                <img class="frame-17" alt="Frame" src="https://c.animaapp.com/m8zrfufxKFUKIW/img/frame.svg" />
                <div class="text-2">
                    <div class="text-wrapper-23 <?= htmlspecialchars($divClassName) ?>">
                        <?= htmlspecialchars($text1) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- total-area-wrapper -->
        <div class="total-area-wrapper <?= htmlspecialchars($totalAreaClassNameOverride) ?>">
            <div class="total-area-2">
                <img class="frame-17" alt="Frame" src="https://c.animaapp.com/m8zrfufxKFUKIW/img/frame.svg" />
                <div class="text-2">
                    <div class="text-wrapper-23 <?= htmlspecialchars($divClassNameOverride) ?>">
                        <?= htmlspecialchars($text2) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- total-area-3 -->
        <div class="total-area-3 <?= htmlspecialchars($totalAreaWrapperClassName) ?>">
            <div class="total-area-2">
                <img class="frame-17" alt="Frame" src="https://c.animaapp.com/m8zrfufxKFUKIW/img/frame.svg" />
                <div class="text-2">
                    <div class="nh-nguy-n-c-n <?= htmlspecialchars($divClassName1) ?>">
                        <?= htmlspecialchars($text3) ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- total-area-4 -->
        <div class="total-area-4 <?= htmlspecialchars($totalAreaWrapperClassNameOverride) ?>">
            <div class="total-area-2">
                <img class="frame-17" alt="Frame" src="https://c.animaapp.com/m8zrfufxKFUKIW/img/frame.svg" />
                <div class="text-2">
                    <div class="k-t-c-x <?= htmlspecialchars($divClassName2) ?>">
                        <?= htmlspecialchars($text4) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}