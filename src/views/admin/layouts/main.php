<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// session_start();

if (!isset($_SESSION['user'])) {
    header('Location: /public/index.php?action=login');
    exit();
}

// Kết nối DB và Model
require_once __DIR__ . '/../../../Config/Database.php';
require_once __DIR__ . '/../../../Models/PhongTro.php';
require_once __DIR__ . '/../../../models/DiaDiem.php';
use QLPhongTro\Models\PhongTro;
use QLPhongTro\Config\Database;
use QLPhongTro\Models\DiaDiem;

// Khởi tạo DB và model
$db = Database::getInstance()->getConnection();
$phongTroModel = new PhongTro($db);
$diaDiemModel = new DiaDiem($db);
// Xác định trang hiện tại từ URL
$page = $_GET['page'] ?? 'dashboard';

$userRole = $_SESSION['user_role'] ?? null;

// echo '<pre>Role: ' . ($_SESSION['user_role'] ?? 'Chưa login') . '</pre>';

$allowedPages = [
    'Admin' => ['dashboard', 'room', 'create-room', 'user', 'tin-tuc', 'setting', 'quyen'],
    'NhanVien' => ['room', 'create-room', 'tin-tuc', 'setting']
];

$permissionError = false;
if (!in_array($page, $allowedPages[$userRole] ?? [])) {
    $permissionError = true;
}

$diaDiems = $diaDiemModel->all();
// Lấy dữ liệu tùy theo trang
switch ($page) {
    case 'dashboard':
        $featuredRooms = $phongTroModel->paginate(5, 0); // 5 phòng mới nhất
        break;
    case 'room':
        $limit = 10;
        $currentPage = isset($_GET['page_num']) ? max(1, (int)$_GET['page_num']) : 1;
        $offset = ($currentPage - 1) * $limit;
        $rooms = $phongTroModel->paginate($limit, $offset);
        $totalPages = ceil($phongTroModel->countAll() / $limit);
        break;
}

// Mapping các trang đến view tương ứng
$viewMapping = [
    'dashboard' => __DIR__ . '/../dashboard/index.php',
    'room' => __DIR__ . '/../room/index.php',
    'create-room' => __DIR__ . '/../room/create-room.php',
    'user' => __DIR__ . '/../user/index.php',
    'setting' => __DIR__ . '/../setting/index.php',
    'tin-tuc' => __DIR__ . '/../tin-tuc/index.php',
];

// View sẽ được include trong layout
$contentView = $viewMapping[$page] ?? $viewMapping['dashboard'];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimTro24H - Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/public/styles/admin/admin.css">
    <link rel="stylesheet" href="/public/styles/admin/variables.css">
</head>

<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Nội dung chính -->
        <div class="admin-content">
            <!-- Header -->
            <?php include 'header.php'; ?>

            <!-- Main Content (Dynamic) -->
            <div class="admin-main">
                <?php if ($permissionError): ?>
                <div
                    style="padding: 1rem; background: #fff3cd; color: #856404; border: 1px solid #ffeeba; border-radius: 6px; margin-bottom: 1rem;">
                    ⚠️ Bạn chưa được cấp quyền truy cập trang <strong><?= htmlspecialchars($page) ?></strong>.
                </div>
                <?php else: ?>
                <?php include $contentView; ?>
                <?php endif; ?>
            </div>
            <!-- <?php if ($permissionError): ?> -->
            <!-- <div
                style="padding: 1rem; background: #fff3cd; color: #856404; border: 1px solid #ffeeba; border-radius: 6px; margin-bottom: 1rem;">
                ⚠️ Bạn chưa được cấp quyền truy cập trang <strong><?= htmlspecialchars($page) ?></strong>.
            </div>
            <?php endif; ?> -->
        </div>
    </div>

    <script src="/assets/js/admin.js"></script>
</body>

</html>