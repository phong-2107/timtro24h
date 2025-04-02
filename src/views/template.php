<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Import Dữ Liệu Excel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Import Dữ Liệu Excel</h1>

        <!-- Form upload file Excel -->
        <form method="post" enctype="multipart/form-data" class="mb-4">
            <div class="form-group">
                <label for="excel">Chọn file Excel</label>
                <input type="file" name="excel" id="excel" class="form-control-file" required>
            </div>
            <button type="submit" name="upload" class="btn btn-primary">Upload</button>
        </form>

        <!-- Thông báo kết quả -->
        <?php 
    if (isset($message)) {
        echo $message;
    }
  ?>

        <!-- Hiển thị dữ liệu từ file Excel nếu có -->
        <?php if (isset($sheetData) && !empty($sheetData)) { ?>
        <h2>Dữ liệu từ file Excel:</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Student Code</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Major</th>
                    <th>Date of Birth</th>
                    <th>Class Code</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sheetData as $row) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['A'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['B'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['C'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['D'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['E'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['F'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['G'] ?? '') ?></td>
                    <td><?= htmlspecialchars($row['H'] ?? '') ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>