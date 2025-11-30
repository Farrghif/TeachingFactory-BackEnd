<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
// Optional: Cek apakah email sudah terdaftar
$check = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
echo "Email sudah terdaftar";
} else {
$sql = "INSERT INTO user (username, email, password) VALUES ('$username',
'$email', '$password')";
if (mysqli_query($con, $sql)) {
echo "Berhasil daftar!";
} else {
echo "Gagal daftar!";
}
}
} else {
    echo "Invalid request";
}
