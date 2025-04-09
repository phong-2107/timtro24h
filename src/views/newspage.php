<?php
ob_start();

$newsItems = [
    [
        'title' => 'Hướng dẫn xem và tính tiền điện nước phòng trọ chuẩn',
        'content' => 'Cách tính tiền điện nước tại phòng trọ... Chủ trọ nói sao biết vậy.'
    ],
    [
        'title' => 'Bí quyết thuê phòng trọ giá rẻ',
        'content' => 'Muốn thuê phòng trọ giá tốt thì bạn cần lưu ý những điều sau...'
    ],
    [
        'title' => 'Kinh nghiệm ở ghép phòng trọ',
        'content' => 'Việc ở ghép giúc tiết kiệm chi phí nhưng cũng có nhiều bất tiện...'
    ],
    [
        'title' => 'Hướng dẫn xem và tính tiền điện nước phòng trọ chuẩn',
        'content' => 'Cách tính tiền điện nước tại phòng trọ... Chủ trọ nói sao biết vậy.'
    ],
    [
        'title' => 'Bí quyết thuê phòng trọ giá rẻ',
        'content' => 'Muốn thuê phòng trọ giá tốt thì bạn cần lưu ý những điều sau...'
    ],
    [
        'title' => 'Kinh nghiệm ở ghép phòng trọ',
        'content' => 'Việc ở ghép giúc tiết kiệm chi phí nhưng cũng có nhiều bất tiện...'
    ],
    [
        'title' => 'Hướng dẫn xem và tính tiền điện nước phòng trọ chuẩn',
        'content' => 'Cách tính tiền điện nước tại phòng trọ... Chủ trọ nói sao biết vậy.'
    ],
    [
        'title' => 'Bí quyết thuê phòng trọ giá rẻ',
        'content' => 'Muốn thuê phòng trọ giá tốt thì bạn cần lưu ý những điều sau...'
    ],
    [
        'title' => 'Kinh nghiệm ở ghép phòng trọ',
        'content' => 'Việc ở ghép giúc tiết kiệm chi phí nhưng cũng có nhiều bất tiện...'
    ]
];
?>

<link rel="stylesheet" href="/public/styles/News/News.css">
<link rel="stylesheet" href="/public/styles/News/NewsCard.css">
<link rel="stylesheet" href="/public/styles/News/ControlPage.css">
<link rel="stylesheet" href="/public/styles/News/NewsCard.css">
<link rel="stylesheet" href="/public/styles/News/Content.css">

<div class="news-screen">
    <div class="news-3">
        <!-- <?php include __DIR__ . '/components/News/control_page.php'; ?> -->

        <?php include __DIR__ . '/components/News/content.php'; ?>

        <div class="btn-viewmore" style="display: flex; justify-content: center; align-items: center; margin-top: 50px;">
            <a href="#">Xem thêm</a>
        </div>

        <?php include __DIR__ . '/components/Home/map.php'; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/main.php';