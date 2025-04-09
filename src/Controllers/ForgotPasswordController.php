<?php
namespace QLPhongTro\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PDO;

class ForgotPasswordController {
    private $conn;
    
    // SMTP configuration - Admin email settings for sending out emails
    private $smtpHost = "smtp.gmail.com";
    private $smtpPort = 587;
    private $smtpUsername = "khanhchii741@gmail.com"; // Admin email (sender)
    private $smtpPassword = "cifg ikhy wwru mhwc";    // Admin email app password
    private $smtpFromName = "TimTro24h.com";

    public function __construct($conn) {
        $this->conn = $conn;
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showForgotPasswordForm() {
        // Display the form
        require_once __DIR__ . '/../views/user/forgotpassword.php';
    }
    
    public function processForgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // This is the user's email that they entered in the form
            $userEmail = $_POST['email'] ?? '';
            
            if (empty($userEmail)) {
                $_SESSION['error'] = 'Vui lòng nhập email.';
                header('Location: /public/index.php?action=forgot_password');
                exit;
            }
            
            // Validate email format
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Email không hợp lệ.';
                header('Location: /public/index.php?action=forgot_password');
                exit;
            }
            
            try {
                // Check if email exists in the database
                $stmt = $this->conn->prepare("SELECT * FROM User WHERE email = :email LIMIT 1");
                $stmt->bindParam(':email', $userEmail);
                $stmt->execute();
                
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$user) {
                    $_SESSION['error'] = 'Email không tồn tại trong hệ thống.';
                    header('Location: /public/index.php?action=forgot_password');
                    exit;
                }
                
                // Generate a new random password
                $newPassword = $this->generateRandomPassword();
                
                // Update user's password in the database
                // Check your password storage mechanism - if using password_hash:
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                
                // If your system uses a different hashing method:
                // $hashedPassword = md5($newPassword); // Example - use what matches your system
                
                $updateStmt = $this->conn->prepare("UPDATE User SET matKhau = :matKhau WHERE email = :email");
                $updateStmt->bindParam(':matKhau', $hashedPassword);
                $updateStmt->bindParam(':email', $userEmail);
                $updateSuccess = $updateStmt->execute();
                
                if (!$updateSuccess) {
                    $_SESSION['error'] = 'Không thể cập nhật mật khẩu. Vui lòng thử lại sau.';
                    header('Location: /public/index.php?action=forgot_password');
                    exit;
                }
                
                // Send the new password via email TO THE USER'S EMAIL (not admin)
                // Using the admin's email credentials to SEND FROM
                $emailSent = $this->sendPasswordResetEmail(
                    $user['hoTen'] ?? 'Người dùng', 
                    $userEmail,  // This is the important part - send TO the user's email
                    $newPassword
                );
                
                if ($emailSent) {
                    $_SESSION['message'] = 'Mật khẩu mới đã được gửi đến email của bạn.';
                } else {
                    $_SESSION['error'] = 'Không thể gửi email. Vui lòng thử lại sau.';
                }
                
                header('Location: /public/index.php?action=forgot_password');
                exit;
                
            } catch (Exception $e) {
                error_log("ForgotPassword Error: " . $e->getMessage());
                $_SESSION['error'] = 'Đã xảy ra lỗi, vui lòng thử lại.';
                header('Location: /public/index.php?action=forgot_password');
                exit;
            }
        }
    }
    
    // Generate a random password
    private function generateRandomPassword($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $password = '';
        $max = strlen($characters) - 1;
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, $max)];
        }
        
        return $password;
    }
    
    // Send password reset email
    private function sendPasswordResetEmail($name, $recipientEmail, $newPassword) {
        // Check if PHPMailer is installed
        $phpmailerPath = __DIR__ . '/../../vendor/autoload.php';
        if (!file_exists($phpmailerPath)) {
            throw new Exception("PHPMailer not installed. Please run: composer require phpmailer/phpmailer");
        }
        
        // Require PHPMailer
        require $phpmailerPath;
        
        // Initialize PHPMailer
        $mail = new PHPMailer(true);
        
        try {
            // Server configuration
            $mail->SMTPDebug = 0;                      // Set to 0 for production, 2 for debugging
            $mail->Debugoutput = 'error_log';          // Send debug to error_log
            $mail->isSMTP();                           // Send using SMTP
            $mail->Host       = $this->smtpHost;       // SMTP server
            $mail->SMTPAuth   = true;                  // Enable SMTP authentication
            $mail->Username   = $this->smtpUsername;   // SMTP username (admin email)
            $mail->Password   = $this->smtpPassword;   // SMTP password (admin email app password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port       = $this->smtpPort;       // TCP port to connect to
            $mail->CharSet    = 'UTF-8';               // Set character encoding
            
            // Set timeout to avoid hanging
            $mail->Timeout = 30; // Timeout after 30 seconds
            
            // Recipients
            $mail->setFrom($this->smtpUsername, $this->smtpFromName); // FROM admin email
            $mail->addAddress($recipientEmail, $name);                // TO user's email
            
            // Content
            $mail->isHTML(true);                      // Set email format to HTML
            $mail->Subject = "Mật khẩu mới cho tài khoản TimTro24h của bạn";
            
            // Create HTML email content
            $emailContent = "
                <html>
                <head>
                    <title>Mật khẩu mới cho tài khoản TimTro24h</title>
                    <style>
                        body { font-family: Arial, sans-serif; line-height: 1.6; }
                        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                        .header { background-color: #0061df; color: white; padding: 10px; text-align: center; }
                        .content { padding: 20px; border: 1px solid #ddd; }
                        .password { font-size: 18px; font-weight: bold; background-color: #f5f5f5; padding: 10px; text-align: center; margin: 15px 0; }
                        .footer { text-align: center; margin-top: 20px; font-size: 12px; color: #777; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h2>Mật khẩu mới - TimTro24h</h2>
                        </div>
                        <div class='content'>
                            <p>Xin chào " . htmlspecialchars($name) . ",</p>
                            <p>Chúng tôi đã tạo một mật khẩu mới cho tài khoản TimTro24h của bạn.</p>
                            <p>Dưới đây là mật khẩu mới của bạn:</p>
                            <div class='password'>" . htmlspecialchars($newPassword) . "</div>
                            <p>Vui lòng đăng nhập và thay đổi mật khẩu này ngay sau khi đăng nhập thành công.</p>
                            <p>Nếu bạn không yêu cầu đặt lại mật khẩu, vui lòng liên hệ với chúng tôi ngay lập tức.</p>
                            <p>Trân trọng,<br>Đội ngũ TimTro24h</p>
                        </div>
                        <div class='footer'>
                            <p>Email này được gửi tự động từ website TimTro24h.com</p>
                        </div>
                    </div>
                </body>
                </html>
            ";
            
            $mail->Body = $emailContent;
            $mail->AltBody = "Xin chào $name,\n\nChúng tôi đã tạo một mật khẩu mới cho tài khoản TimTro24h của bạn.\n\nMật khẩu mới của bạn: $newPassword\n\nVui lòng đăng nhập và thay đổi mật khẩu này ngay sau khi đăng nhập thành công.\n\nTrân trọng,\nĐội ngũ TimTro24h";
            
            // Send email
            $result = $mail->send();
            error_log("Email sent to: " . $recipientEmail . " - Result: " . ($result ? "Success" : "Failed"));
            return $result;
            
        } catch (Exception $e) {
            // Log error and throw exception to be handled outside
            error_log("Email sending error details: " . $mail->ErrorInfo);
            throw new Exception("Cannot send email: " . $mail->ErrorInfo);
        }
    }
}