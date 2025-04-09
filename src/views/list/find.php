<link rel="stylesheet" href="/public/styles/list/FindFilter.css" />

<div class="frame">
    <form class="form" method="GET" action="index.php">
        <input type="hidden" name="action" value="phongtro_find" />

        <div class="input">
            <!-- Tìm kiếm tên phòng -->
            <div class="group-2">
                <div class="label">TÌM KIẾM</div>
                <div class="content-2">
                    <img
                        class="img-2"
                        alt="Frame"
                        src="https://c.animaapp.com/m8twrcooYWMm14/img/frame.svg"
                    />
                    <input
                        type="text"
                        name="search_text"
                        placeholder="Tìm kiếm tên phòng trọ"
                    />
                </div>
            </div>

            <!-- Loại phòng -->
            <div class="group-3">
                <div class="label">LOẠI PHÒNG</div>
                <div class="content-3">
                    <select name="room_type">
                        <option value="">Phòng Trọ</option>
                        <option value="nhatro">Nhà trọ</option>
                        <option value="chungcu">Chung cư mini</option>
                        <option value="nguyencan">Nhà nguyên căn</option>
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
                <div class="label">MỨC GIÁ</div>
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