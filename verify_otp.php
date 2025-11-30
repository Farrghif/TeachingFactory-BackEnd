<?php
header("Content-Type: application/json");
include 'koneksi.php';
$email = $_POST['email'];
$otp = $_POST['otp'];
$query = "SELECT * FROM user WHERE email='$email' AND otp='$otp'";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
// Hapus OTP setelah diverifikasi agar tidak bisa dipakai lagi
mysqli_query($con, "UPDATE user SET otp=NULL WHERE email='$email'");
echo json_encode(["status" => "success", "message" => "OTP valid"]);
} else {
echo json_encode(["status" => "error", "message" => "OTP salah atau sudah
kadaluarsa"]);
}