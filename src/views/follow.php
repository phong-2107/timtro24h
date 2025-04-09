<?php
ob_start();

$linkBase = '?action=follow_mine'; 
?>

<link rel="stylesheet" href="/public/styles/rooms/style.css">
<link rel="stylesheet" href="/public/styles/home/Categories.css">
<link rel="stylesheet" href="/public/styles/list/Card.css">

<div class="home">
    <div class="div-2">
        <div class="categories-Home">
            <div class="title-3">
                <div class="text-wrapper-11">PHÒNG TRỌ BẠN ĐÃĐÃ FOLLOW</div>
            </div>

            <div class="list-card">
                <div class="frame-10">
                    <?php if (empty($roomsData)): ?>
                        <p>Bạn chưa yêu thích phòng trọ nào.</p>
                    <?php else: ?>
                        <?php foreach ($roomsData as $room): ?>
                            <?php include __DIR__ . '/../components/Home/card.php'; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- PHÂN TRANG nếu cần (sẽ cần logic phân trang ở controller) -->
                <?php if (isset($totalPages) && $totalPages > 1): ?>
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

        <?php include __DIR__ . '/../components/Home/map.php'; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
