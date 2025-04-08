<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?? 'Admin' ?></title>

  <!-- CSS Custom -->
  <link rel="stylesheet" href="/assets/css/ad_gb.css" />
  <link rel="stylesheet" href="/assets/css/ad_stl.css" />
  <link rel="stylesheet" href="/assets/css/ad_stl_gd.css" />

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Google Font: Roboto -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Tailwind + Alpine (nếu dùng tailwind component dropdown) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-50 font-['Roboto']">

  <!-- ✅ Bọc toàn bộ layout -->
  <div class="admin-panel">

    <div class="admin-layout flex">

      <!-- Sidebar -->
      <?php include __DIR__ . '/components/ad_sidebar.php'; ?>

      <div class="main-content flex-1">

        <!-- Header -->
        <?php include __DIR__ . '/components/ad_header.php'; ?>

        <!-- Breadcrumb -->
        <?php include __DIR__ . '/components/ad_breadcrumb.php'; ?>

        <!-- Nội dung chính -->
        <main class="page-content p-4">
          <?= $content ?? '' ?>
        </main>

      </div>
    </div>

  </div> <!-- /admin-panel -->

</body>
</html>
