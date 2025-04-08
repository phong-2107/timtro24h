<link rel="stylesheet" href="/public/styles/list/TypeHouseWrapper.css">

<div class="type-house-wrapper">
    <div class="text-5">
        <div class="frame-18">
            <p class="lo-i-ph-ng-c-n-thu-2">Phòng Cho Thuê Ở Khu Vực</p>
        </div>
    </div>

    <div class="text-icons-4">
        <?php
        $cities = [
            'Tp. Hồ Chí Minh',
            'Hà Nội',
            'Bình Dương',
            'Bà Rịa - Vũng Tàu',
            'Đà Nẵng',
            'Đồng Nai',
            'Lâm Đồng',
            'Cần Thơ',
            'Long An'
        ];

        // // Tạo class CSS theo thứ tự
        // $i = 8;
        foreach ($cities as $index => $city):
            // $wrapperClass = 'total-area-' . ($i + $index);
        ?>
        <div class="total-area-9"">
            <div class=" total-area-9">
            <div class="svg">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="text-6">
                <div class="text-wrapper-30"><?= htmlspecialchars($city) ?></div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>