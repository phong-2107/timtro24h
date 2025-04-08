<div class="card-row">
    <img class="img-3" alt="<?= $room['name'] ?>" src="<?= $room['imageUrl'] ?>" />

    <div class="text-icons">
        <div class="text">
            <div class="title">
                <div class="frame-15">
                    <div class="text-wrapper-16"><?= $room['tieuDe'] ?></div>
                    <img class="frame-16" alt="Heart" src="/public/icons/heart.svg" />
                </div>
                <div class="text-wrapper-17"><?= $room['location'] ?></div>
            </div>
            <div class="text-wrapper-18"><?= $room['price'] ?> / Tháng</div>
        </div>

        <div class="text-icons-2">
            <div class="bedrooms">
                <div class="icon-text">
                    <img class="img-4" alt="Size" src="/public/icons/size.svg" />
                    <div class="text-2">
                        <div class="text-wrapper-19"><?= $room['area'] ?>m²</div>
                    </div>
                </div>
                <div class="text-wrapper-20">Diện tích</div>
            </div>

            <div class="total-area-2">
                <div class="total-area-3">
                    <img class="img-4" alt="Time" src="/public/icons/time.svg" />
                    <div class="text-3">
                        <div class="text-wrapper-21"><?= $room['updatedTime'] ?></div>
                    </div>
                </div>
                <div class="text-wrapper-22">Thời gian</div>
            </div>
        </div>
    </div>
</div>