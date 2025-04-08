<link rel="stylesheet" href="/public/styles/list/FindFilter.css" />

<div class="find">
    <form class="form" method="GET" action="index.php">
        <input type="hidden" name="action" value="phongtro_find" />

        <div class="input">
            <!-- Diện Tích -->
            <div class="group-3">
                <div class="label">DIỆN TÍCH</div>
                <div class="content-3">
                    <select name="area">
                        <option value="">Tất cả diện tích</option>
                        <option value="duoi15">Dưới 15m²</option>
                        <option value="15-25">15 - 25m²</option>
                        <option value="25-35">25 - 35m²</option>
                        <option value="tren35">Trên 35m²</option>
                    </select>
                </div>
            </div>

            <!-- Khu vực -->
            <div class="group-4">
                <div class="label">KHU VỰC</div>
                <div class="content-3">
                    <select name="location_id">
                        <option value="">Chọn Địa Điểm</option>
                        <?php foreach ($diaDiems as $diaDiem): ?>
                        <option value="<?= htmlspecialchars($diaDiem['id']) ?>">
                            <?= htmlspecialchars($diaDiem['tinhThanh'] . ' - ' . $diaDiem['quanHuyen']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Mức giá -->
            <div class="group-5">
                <div class="label">Mức Giá</div>
                <div class="content-3">
                    <select name="price">
                        <option value="">Tất cả mức giá</option>
                        <option value="duoi1tr">Dưới 1 triệu</option>
                        <option value="1-3tr">1 - 3 triệu</option>
                        <option value="3-5tr">3 - 5 triệu</option>
                        <option value="tren5tr">Trên 5 triệu</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Icon lọc -->
        <img class="img" alt="Filter" src="https://c.animaapp.com/m8twrcooYWMm14/img/filter-1.svg" />

        <!-- Nút tìm kiếm -->
        <button type="submit" class="button-2">
            <img class="img" alt="Icon" src="https://c.animaapp.com/m8twrcooYWMm14/img/icon.svg" />
            <div class="text-wrapper-2">TÌM KIẾM</div>
        </button>
    </form>
</div>