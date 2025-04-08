<link rel="stylesheet" href="/public/styles/home/FindFilter.css" />

<div class="find">
    <form class="form" method="GET" action="/?action=phongtro_search">
        <div class="input">
            <!-- Loại phòng -->
            <div class="group-3">
                <div class="label">LOẠI PHÒNG</div>
                <div class="content-3">
                    <select name="roomType">
                        <option value="">Phòng Trọ</option>
                        <option value="nhatro">Nhà trọ</option>
                        <option value="chungcu">Chung cư mini</option>
                        <option value="nguyencan">Nhà nguyên căn</option>
                    </select>
                    <!-- <img src="/public/icons/arrow.svg" class="selectarrow" /> -->
                </div>
            </div>

            <!-- Khu vực -->
            <div class="group-4">
                <div class="label">KHU VỰC</div>
                <div class="content-3">
                    <select name="location">
                        <option value="">Chọn Địa Điểm</option>
                        <option value="hcm">TP. Hồ Chí Minh</option>
                        <option value="hn">Hà Nội</option>
                        <option value="dn">Đà Nẵng</option>
                    </select>
                    <!-- <img src="/public/icons/arrow.svg" class="selectarrow" /> -->
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
                    <!-- <img src="/public/icons/arrow.svg" class="selectarrow" /> -->
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