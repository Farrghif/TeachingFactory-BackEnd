<?php
header("Content-Type: application/json");
error_reporting(0);
include 'koneksi.php'; // koneksi ke database
// Include PHPMailer
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
$email = $_POST['email'];
$password = md5($_POST['password']);
$sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
$otp = rand(100000, 999999);
mysqli_query($con, "UPDATE user SET otp='$otp' WHERE email='$email'");

// Konfigurasi PHPMailer
$mail = new PHPMailer(true);
try {
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'ekomrpl99@gmail.com'; // GANTI
$mail->Password = 'ekbk khgt ciml oscw'; // GANTI
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->setFrom('emailkamu@gmail.com', 'Aplikasi BMTI');
$mail->addAddress($email);
$mail->Subject = 'Kode OTP Login Anda';
$mail->Body = "Kode OTP Anda adalah: $otp";
$mail->send();
echo json_encode([
"status" => "success",
"message" => "Login berhasil, OTP terkirim",
"otp" => $otp
]);
} catch (Exception $e) {
echo json_encode([
"status" => "error",
"message" => "Login berhasil, tapi gagal mengirim OTP",
"error" => $mail->ErrorInfo
]);
}
} else {
echo json_encode(["status" => "error", "message" => "Email atau password
salah"]);
}