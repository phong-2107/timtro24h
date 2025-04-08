<link rel="stylesheet" href="/public/styles/list/Card.css">
<?php
// $cardData chứa các thông tin: id, name, location, price, area, imageUrl, updatedTime
if (!$cardData) {
    echo '<div>Không có dữ liệu</div>';
    return;
}

    $shortName = (mb_strlen($cardData['name']) > 20)
    ? mb_substr($cardData['name'], 0, 20) . '...'
    : $cardData['name'];

    $detailUrl = "?action=phongtro_detail&id=" . urlencode($cardData['id']);

?>
<a href="<?= $detailUrl ?>" class="card-row">
    <img class="img-3" alt="<?= htmlspecialchars($cardData['name'], ENT_QUOTES) ?>"
        src="<?= htmlspecialchars($cardData['imageUrl'], ENT_QUOTES) ?>" />

    <div class="text-icons">
        <div class="text">
            <div class="title">
                <div class="frame-15">
                    <div class="text-wrapper-16">
                        <?= htmlspecialchars($shortName, ENT_QUOTES) ?>
                    </div>
                    <img class="frame-16" alt="Heart" src="https://c.animaapp.com/m8twrcooYWMm14/img/frame-4.svg" />
                </div>
                <div class="text-wrapper-17">
                    <?= htmlspecialchars($cardData['location'], ENT_QUOTES) ?>
                </div>
            </div>

            <div class="text-wrapper-18">
                <?= htmlspecialchars($cardData['price'], ENT_QUOTES) ?> / Tháng
            </div>
        </div>

        <div class="text-icons-2">
            <div class="bedrooms">
                <div class="icon-text">
                    <img class="img-4" alt="Size"
                        src="https://c.animaapp.com/m8twrcooYWMm14/img/size-fullscreen-svgrepo-com-1.svg" />
                    <div class="text-2">
                        <div class="text-wrapper-19"><?= (int)$cardData['area'] ?>m²</div>
                    </div>
                </div>
                <div class="text-wrapper-20">Diện tích</div>
            </div>

            <div class="total-area-2">
                <div class="total-area-3">
                    <img class="img-4" alt="Time"
                        src="https://c.animaapp.com/m8twrcooYWMm14/img/time-svgrepo-com-1.svg" />
                    <div class="text-3">
                        <div class="text-wrapper-21">
                            <?= htmlspecialchars($cardData['updatedTime'], ENT_QUOTES) ?>
                        </div>
                    </div>
                </div>
                <div class="text-wrapper-22">Thời gian</div>
            </div>
        </div>
    </div>
</a>