<div class="content">
    <div class="title-3">
        <div class="text-wrapper-11">TIN TỨC NỔI BẬT</div>
    </div>


    <div style="display: flex; flex-direction: row; gap: 20px; justify-content: center; align-items: center;">
        <?php
    $chunks = array_chunk($newsItems, 3);
    $index = 1;

    foreach ($chunks as $group):
        echo '<div class="list-news-2">';
        foreach ($group as $news):
            include __DIR__ . '/../News/NewsCard.php';
        endforeach;
        echo '</div>';
        $index++;
    endforeach;
    ?>


    </div>
    <div class="controls">
        <div class="text-wrapper-10">Xem thêm tin tức</div>
    </div>
</div>