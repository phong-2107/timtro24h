<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TimTro24H</title>
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
    @import url("https://fonts.googleapis.com/css?family=Inter:400,500,700,600|Gantari:500,600");
    </style>
    <style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css");

    * {
        -webkit-font-smoothing: antialiased;
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0px;
        height: 100%;
    }

    /* a blue color as a generic focus style */
    button:focus-visible {
        outline: 2px solid #4a90e2 !important;
        outline: -webkit-focus-ring-color auto 5px !important;
    }

    a {
        text-decoration: none;
    }
    </style>

    <!-- CSS riêng -->
    <link rel="stylesheet" href="/public/styles/common/styleguide.css">
    <link rel="stylesheet" href="/public/styles/common/Header.css">
</head>

<body>
    <?php include __DIR__ . '/header.php'; ?>

    <main style="max-width: 1440px; margin: 0 auto; position: relative;">
        <?= isset($content) ? $content : "" ?>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>