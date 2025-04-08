<?php
ob_start(); 

$linkBase = '?action=phongtro_search';
?>

<link rel="stylesheet" href="/public/styles/rooms/style.css">
<link rel="stylesheet" href="/public/styles/home/Categories.css">
<link rel="stylesheet" href="/public/styles/list/Card.css">

<div class="home">
    <div class="div-2">
        <?php 
                include __DIR__ . '/list/find.php'; 
            ?>
        <div class="categories-Home">

            <div class="title-3">
                <div class="text-wrapper-11">Danh Sách Phòng</div>
            </div>

            <div class="list-card">
                <div class="frame-10">
                    <?php if (empty($roomsData)): ?>
                    <div style="
                        padding: 60px 20px;
                        text-align: center;
                        background-color: #f9f9f9;
                        border-radius: 12px;
                        border: 1px solid #eee;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                        margin: 40px auto;
                        max-width: 600px;
                    ">
                        <img src="https://cdn-icons-png.flaticon.com/512/6134/6134065.png" alt="Không tìm thấy"
                            style="max-width: 120px; margin-bottom: 25px; opacity: 0.85;" />
                        <h2 style="font-size: 24px; color: #333; font-weight: bold; margin-bottom: 10px;">
                            Không tìm thấy phòng trọ phù hợp
                        </h2>
                        <p style="font-size: 16px; color: #666;">
                            Vui lòng thử lại với các bộ lọc khác hoặc kiểm tra lại khu vực, diện tích, mức giá...
                        </p>
                    </div>
                    <?php else: ?>
                    <?php foreach ($roomsData as $room): ?>
                    <?php include __DIR__ . '/components/Home/card.php'; ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>



                <?php if (!empty($totalPages) && $totalPages > 1): ?>
                <div class="pagination" style="margin-top: 30px; text-align: center;">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="<?= $linkBase ?>&page=<?= $i ?>"
                        class="pagination-button <?= $i === $page ? 'active' : '' ?>" style="
                                margin: 0 5px;
                                padding: 6px 12px;
                                border-radius: 6px;
                                background-color: <?= $i === $page ? '#007bff' : '#f0f0f0' ?>;
                                color: <?= $i === $page ? '#fff' : '#333' ?>;
                                text-decoration: none;
                                display: inline-block;
                            ">
                        <?= $i ?>
                    </a>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php include __DIR__ . '/components/Home/map.php'; ?>
    </div>
</div>

<?php 
$content = ob_get_clean(); 
include __DIR__ . '/layouts/main.php'; 
?>