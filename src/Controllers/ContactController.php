<?php

namespace QLPhongTro\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactController {
    private $conn;
    private $adminEmail = "khanhchii741@gmail.com"; // Email nhận thông tin liên hệ
    
    // SMTP configuration - Sửa lại thông tin này
    private $smtpHost = "smtp.gmail.com";
    private $smtpPort = 587;
    private $smtpUsername = "khanhchii741@gmail.com"; // Thay bằng email của bạn
    private $smtpPassword = "cifg ikhy wwru mhwc"; // Mật khẩu ứng dụng từ Google
    private $smtpFromName = "TimTro24h.com";

    public function __construct($conn) {
        $this->conn = $conn;
        // Bắt đầu session nếu chưa được bắt đầu
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Hiển thị trang liên hệ
    public function index() {
        // Log để debug
        error_log("Contact index called. Session ID: " . session_id());
        
        // Kiểm tra xem có thông báo thành công hay thất bại từ session
        $success_message = isset($_SESSION['contact_success']) ? $_SESSION['contact_success'] : '';
        $error_message = isset($_SESSION['contact_error']) ? $_SESSION['contact_error'] : '';
        
        // Debug
        error_log("Success message: " . $success_message);
        error_log("Error message: " . $error_message);
        

        
        include_once __DIR__ . '/../views/contactpage.php';
                // Xóa thông báo sau khi đã lấy ra
                unset($_SESSION['contact_success']);
                unset($_SESSION['contact_error']);
    }

    // Xử lý gửi form liên hệ
    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $message = $_POST['message'] ?? '';
    
            // Validate dữ liệu
            if (empty($name) || empty($email) || empty($phone) || empty($message)) {
                $_SESSION['contact_error'] = 'Vui lòng nhập đầy đủ thông tin!';
                // Debug
                error_log("Set error message for empty fields: " . $_SESSION['contact_error']);
                session_write_close(); // Đảm bảo session được ghi
                header('Location: ?action=contact');
                exit();
            }
    
            // Validate email
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['contact_error'] = 'Email không hợp lệ!';
                // Debug
                error_log("Set error message for invalid email: " . $_SESSION['contact_error']);
                session_write_close(); // Đảm bảo session được ghi
                header('Location: ?action=contact');
                exit();
            }
    
            // Gửi email
            try {
                $emailResult = $this->sendEmailSMTP($name, $email, $phone, $message);
                
                if ($emailResult) {
                    $_SESSION['contact_success'] = 'Gửi thông tin liên hệ thành công! Chúng tôi sẽ phản hồi sớm nhất có thể.';
                    // Debug
                    error_log("Set success message: " . $_SESSION['contact_success']);
                } else {
                    $_SESSION['contact_error'] = 'Không gửi được email. Vui lòng thử lại sau.';
                    // Debug
                    error_log("Set error message for failed email: " . $_SESSION['contact_error']);
                }
            } catch (Exception $e) {
                $_SESSION['contact_error'] = 'Có lỗi xảy ra khi gửi email: ' . $e->getMessage();
                // Debug
                error_log("Set error message for exception: " . $_SESSION['contact_error']);
            }
            
            // Đảm bảo session được ghi
            session_write_close();
            
            header('Location: ?action=contact');
            exit();
        }
    
        // Nếu không phải POST request, chuyển hướng về trang liên hệ
        header('Location: ?action=contact');
        exit();
    }
    
    // Phương thức gửi email qua SMTP
    private function sendEmailSMTP($name, $email, $phone, $message) {
        // Kiểm tra xem thư viện PHPMailer đã được cài đặt chưa
        $phpmailerPath = __DIR__ . '/../../vendor/autoload.php';
        if (!file_exists($phpmailerPath)) {
            throw new Exception("Chưa cài đặt PHPMailer. Vui lòng chạy: composer require phpmailer/phpmailer");
        }
        
        // Yêu cầu thư viện PHPMailer
        require $phpmailerPath;
        
        // Khởi tạo PHPMailer
        $mail = new PHPMailer(true);
        
        try {
            // Cấu hình server
            $mail->SMTPDebug = 3;                      // Enable debug output (0: no output, 3: detailed)
            $mail->Debugoutput = 'error_log';           // Gửi debug vào error_log
            $mail->isSMTP();                           // Send using SMTP
            $mail->Host       = $this->smtpHost;       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                  // Enable SMTP authentication
            $mail->Username   = $this->smtpUsername;   // SMTP username
            $mail->Password   = $this->smtpPassword;   // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port       = $this->smtpPort;       // TCP port to connect to
            $mail->CharSet    = 'UTF-8';               // Set character encoding
            
            // Thiết lập timeout để tránh treo
            $mail->Timeout = 30; // Timeout sau 30 giây
            
            // Người gửi và người nhận
            $mail->setFrom($this->smtpUsername, $this->smtpFromName);
            $mail->addAddress($this->adminEmail);      // Địa chỉ người nhận
            $mail->addReplyTo($email, $name);          // Địa chỉ trả lời
            
            // Nội dung
            $mail->isHTML(true);                       // Set email format to HTML
            $mail->Subject = "Liên hệ mới từ " . htmlspecialchars($name);
            
            // Tạo nội dung email HTML
            $emailContent = "
                <html>
                <head>
                    <title>Thông tin liên hệ mới</title>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                        .header { background-color: #0061df; color: white; padding: 10px; text-align: center; }
                        .content { padding: 20px; border: 1px solid #ddd; }
                        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2>Thông tin liên hệ mới</h2>
                        </div>
                        <div class='content'>
                            <p><strong>Họ tên:</strong> " . htmlspecialchars($name) . "</p>
                            <p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>
                            <p><strong>Số điện thoại:</strong> " . htmlspecialchars($phone) . "</p>
                            <p><strong>Nội dung:</strong></p>
                            <p>" . nl2br(htmlspecialchars($message)) . "</p>
                        </div>
                        <div class='footer'>
                            <p>Email này được gửi tự động từ website TimTro24h.com</p>
                        </div>
                    </div>
                </body>
                </html>
            ";
            
            $mail->Body = $emailContent;
            $mail->AltBody = "Họ tên: $name\nEmail: $email\nSố điện thoại: $phone\nNội dung: $message";
            
            // Gửi email
            $result = $mail->send();
            error_log("Kết quả gửi email: " . ($result ? "Thành công" : "Thất bại"));
            return $result;
            
        } catch (Exception $e) {
            // Ghi lỗi và ném ngoại lệ để xử lý bên ngoài
            error_log("Chi tiết lỗi gửi mail: " . $mail->ErrorInfo);
            throw new Exception("Không thể gửi email: " . $mail->ErrorInfo);
        }

}