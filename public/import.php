<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['upload'])) {
    // Lấy file Excel từ form upload
    $file = $_FILES['excel']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    // Chuyển đổi nội dung file Excel thành mảng
    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    
    echo "<h2>Dữ liệu từ file Excel:</h2>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr>
            <th>Student Code</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Major</th>
            <th>Date of Birth</th>
            <th>Class Code</th>
          </tr>";
    
    // Kết nối MySQLi tới database 'internship_management'
    $conn = new mysqli('localhost', 'root', '', 'internship_management');
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    
    foreach ($sheetData as $row) {
        // Dùng toán tử null coalescing để tránh lỗi undefined key
        $student_code = $row['A'] ?? '';
        $last_name    = $row['B'] ?? '';
        $first_name   = $row['C'] ?? '';
        $phone        = $row['D'] ?? '';
        $email        = $row['E'] ?? '';
        $major        = $row['F'] ?? '';
        $dob          = $row['G'] ?? '';
        $class_code   = $row['H'] ?? '';
        
        // Hiển thị dữ liệu vào bảng HTML
        echo "<tr>
                <td>$student_code</td>
                <td>$last_name</td>
                <td>$first_name</td>
                <td>$phone</td>
                <td>$email</td>
                <td>$major</td>
                <td>$dob</td>
                <td>$class_code</td>
              </tr>";
        
        // Tạo user mới trong bảng users
        // Sử dụng student_code làm username và mật khẩu mặc định là "123456" (đã hash)
        $usernameEscaped = $conn->real_escape_string($student_code);
        $passwordDefault = password_hash('123456', PASSWORD_DEFAULT);
        $passwordEscaped = $conn->real_escape_string($passwordDefault);
        $role = 'student';
        $roleEscaped = $conn->real_escape_string($role);
        
        $userInsertQuery = "INSERT INTO users (username, password, role)
                            VALUES ('$usernameEscaped', '$passwordEscaped', '$roleEscaped')";
        if (!$conn->query($userInsertQuery)) {
            echo "Lỗi tạo user: " . $conn->error;
            continue;
        }
        $user_id = $conn->insert_id; // Lấy user_id vừa được tạo
        echo "user_id: $user_id<br>";
        // Escape các giá trị cho bảng students
        $student_codeEscaped = $conn->real_escape_string($student_code);
        $last_nameEscaped = $conn->real_escape_string($last_name);
        $first_nameEscaped = $conn->real_escape_string($first_name);
        $phoneEscaped = $conn->real_escape_string($phone);
        $emailEscaped = $conn->real_escape_string($email);
        $majorEscaped = $conn->real_escape_string($major);
        
        // Xử lý giá trị ngày sinh: nếu rỗng thì dùng NULL (không đặt dấu nháy đơn)
        $dobValue = ($dob === '') ? "NULL" : "'" . $conn->real_escape_string($dob) . "'";
        // Xử lý class_code tương tự
        $classCodeValue = ($class_code === '') ? "NULL" : "'" . $conn->real_escape_string($class_code) . "'";
        
        $studentInsertQuery = "INSERT INTO students (user_id, student_code, last_name, first_name, phone, email, major, dob, class_code)
                              VALUES ($user_id, '$student_codeEscaped', '$last_nameEscaped', '$first_nameEscaped', '$phoneEscaped', '$emailEscaped', '$majorEscaped', $dobValue, $classCodeValue)";
        
        if (!$conn->query($studentInsertQuery)) {
            echo "Lỗi chèn sinh viên: " . $conn->error;
        }
    }
    
    echo "</table>";
    echo "<p>Import thành công!</p>";
}
?>
<!-- Form upload file Excel -->
<form method="post" enctype="multipart/form-data">
    <input type="file" name="excel" required>
    <button type="submit" name="upload">Upload</button>
</form>