<!-- views/listpage.php -->
<link rel="stylesheet" href="/public/styles/Categories.css">
<link rel="stylesheet" href="/public/styles/CardRow.css">

<div class="list" style="margin-top: 100px;">
    <div class="div-2">
        <?php include_once __DIR__ . '../views/components/Home/find.php'; ?>

        <div class="categories">
            <div class="menu-categories">
                <div class="content">
                    <div class="text-wrapper">Home</div>
                    <div class="text-wrapper">/</div>
                    <div class="div">Phòng trọ</div>
                    <!-- <div class="group">
                        <?php include_once __DIR__ . '/../components/buttons/location-filter.php'; ?>
                    </div> -->

                </div>

                <div class="infor">
                    <div class="cards">
                        <?php foreach ($rooms as $room): ?>
                        <?php include __DIR__ . '/list/card.php'; ?>
                        <?php endforeach; ?>
                    </div>

                    <!-- <div class="categories-title">
                        <?php include __DIR__ . '/../components/TypeHouse.php'; ?>
                        <div class="total-area"></div>
                        <?php include __DIR__ . '/../components/TypeHouseWrapper.php'; ?>

                        <?php include __DIR__ . '/../components/TypeHouse.php'; ?>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>