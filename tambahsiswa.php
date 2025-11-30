<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Mendapatkan Nilai dari POST
$nis = $_POST['nis'];
$namasiswa = $_POST['namasiswa'];
$jk = $_POST['jk'];
$alamat = $_POST['alamat'];
$tanggallahir = $_POST['tanggallahir'];
$fotoBase64 = $_POST['foto'];
// Dekode gambar dari base64 menjadi data biner
$imageData = base64_decode($fotoBase64);
// Buat nama unik untuk file gambar (berdasarkan NIS)
$namaFile = $nis . "_siswa.jpg";
// Tentukan path tempat menyimpan gambar
$filePath = "uploads/" . $namaFile;
// Simpan gambar di folder "uploads"
if (file_put_contents($filePath, $imageData)) {
// Import file koneksi database
require_once('koneksi.php');
// Query untuk menyimpan data siswa beserta nama file gambar
$sql = "INSERT INTO siswa (nis, namasiswa, jk, alamat, tanggallahir,
foto)
VALUES ('$nis', '$namasiswa', '$jk', '$alamat', '$tanggallahir',
'$filePath')";
// Eksekusi query dan cek keberhasilannya
if (mysqli_query($con, $sql)) {
echo 'Berhasil Menambahkan Siswa dan QR Code';
} else {
echo 'Gagal Menambahkan Siswa: ' . mysqli_error($con);
}
// Tutup koneksi
mysqli_close($con);
} else {
echo 'Gagal menyimpan gambar QR Code';
}
}
?>