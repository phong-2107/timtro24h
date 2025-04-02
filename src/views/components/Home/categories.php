<link rel="stylesheet" href="/public/styles/home/Categories.css">

<div class="categories-Home">
    <div class="title-3">
        <div class="text-wrapper-11">PHÒNG TRỌ NỔI BẬT</div>
    </div>

    <div class="list-card">
        <div class="list-place">
            <div class="text-wrapper-12">Cho Thuê Phòng Trọ</div>
            <div class="places">
                <?php foreach ($locations as $location): ?>
                <?php $text = $location['tinhThanh']; $id = $location['id']; ?>
                <?php include __DIR__ . '/place.php'; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="frame-10">
            <?php if (empty($roomsData)): ?>
            <p>Đang tải phòng trọ...</p>
            <?php else: ?>
            <?php foreach ($roomsData as $room): ?>
            <?php include __DIR__ . '/card.php'; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>