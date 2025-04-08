<?php
// Mô phỏng biến $loading nếu muốn (PHP là đồng bộ, nên thường không có loading):
$loading = false; 
// $rooms, $tinhThanh, $diaDiemId được lấy từ Controller (listByDiaDiem)
?>

<div class="categories">
    <div class="menu-categories">
        <div class="breadcrumbs">
            <div class="text-wrapper">Home</div>
            <div class="text-wrapper">/</div>
            <div class="div">Phòng trọ</div>
            <div class="text-wrapper">/</div>
            <div class="group">
                <?php
                    $className = 'button-instance';
                    $divClassName = 'design-component-instance-node';
                    $tinhThanh = $tinhThanh ?? 'Đang tải...';
                    include __DIR__ . '/../components/buttons/location_button.php';
                ?>
            </div>
        </div>

        <div class="infor">
            <div class="cards">
                <?php if ($loading): ?>
                <p>Đang tải danh sách phòng...</p>
                <?php elseif (empty($rooms)): ?>
                <p>Không tìm thấy phòng trọ nào trong khu vực này.</p>
                <?php else: ?>
                <?php foreach ($rooms as $room): ?>
                <?php
                            // Convert dữ liệu sang format như Categories.jsx
                            // Giả sử cột trong DB là: $room['id'], $room['tieuDe'], $room['diaChiCuThe']...
                            // Tính giá hiển thị
                            $price = number_format($room['gia'] / 1000000, 1) . ' Triệu';
                            // Lấy quanHuyen, tinhThanh từ cột JOIN, hoặc mảng con 'diaDiem'
                            $quanHuyen = $room['diaDiem']['quanHuyen'] ?? '';
                            $tinhThanhRoom = $room['diaDiem']['tinhThanh'] ?? '';
                            $location = $room['diaChiCuThe'] . ', ' . $quanHuyen . ', ' . $tinhThanhRoom;

                            // Lấy hình ảnh, ví dụ cột 'hinhAnh' (nếu có array) hoặc default
                            // Hoặc dùng phương thức getHinhAnhByPhongTroId($id)
                            // Ở đây ta giả sử $room['hinhAnh'] là mảng, 
                            //    $room['hinhAnh'][0] là ảnh đầu tiên
                            $imageUrl = !empty($room['hinhAnh']) ? $room['hinhAnh'][0] : '/public/images/default.jpg';

                            // Gói lại data cho "CardRow"
                            $cardData = [
                                'id' => $room['id'],
                                'name' => $room['tieuDe'],
                                'location' => $location,
                                'price' => $price,
                                'area' => $room['dienTich'] ?? 0,
                                'imageUrl' => $imageUrl,
                                'updatedTime' => 'Vừa đăng',
                            ];
                        ?>

                <?php include __DIR__ . '/CardRow.php'; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="categories-title">
                <?php
                $className = ''; // hoặc "type-house-instance"
                $textIconsClassName = 'type-house-2';
                $divClassName = 'type-house-1';
                $divClassNameOverride = 'type-house-4';
                $divClassName1 = 'type-house-5';
                $divClassName2 = 'type-house-5';

                $text = 'Mức Giá Mong Muốn';
                $text1 = '4 Triệu';
                $text2 = '6 Triệu';
                $text3 = '10 Triệu';
                $text4 = '15 Triệu';

                include __DIR__ . '/../list/type_house.php';
                ?>

                <?php include __DIR__ . '/../list/type_house_wrapper.php'; ?>

                <?php
                $className = ''; 
                $textIconsClassName = 'type-house-2';
                $divClassName = 'type-house-1';
                $divClassNameOverride = 'type-house-4';
                $divClassName1 = 'type-house-5';
                $divClassName2 = 'type-house-5';

                $text = 'Loại Phòng Cần Thuê';
                $text1 = 'Phòng trọ';
                $text1 = 'Chung cư';
                $text2 = 'Nhà nguyên căn';
                $text3 = 'Kí túc xá';

                include __DIR__ . '/../list/type_house.php';
                ?>
            </div>
        </div>
    </div>
</div>