<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Mendapatkan Nilai dari POST
$idproduk = $_POST['idproduk'];
$namaproduk = $_POST['namaproduk'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$barcodeBase64 = $_POST['barcode'];
$tanggal = $_POST['tanggal'];
// Dekode gambar dari base64 menjadi data biner
$imageData = base64_decode($barcodeBase64);
// Buat nama unik untuk file barcode (berdasarkan ID Produk)
$namaFile = $idproduk . "_produk.jpg";
// Tentukan path tempat menyimpan gambar
$filePath = "uploads/" . $namaFile;
// Simpan gambar di folder "uploads"
if (file_put_contents($filePath, $imageData)) {
// Import file koneksi database
require_once('koneksi.php');
// Query untuk menyimpan data produk beserta nama file barcode
$sql = "INSERT INTO produk (idproduk, namaproduk, jumlah, harga, barcode,
tanggal) 
$tanggal')";
// Eksekusi query dan cek keberhasilannya
if (mysqli_query($con, $sql)) {
echo 'Berhasil Menambahkan Produk dan Barcode';
} else {
echo 'Gagal Menambahkan Produk: ' . mysqli_error($con);
}
// Tutup koneksi
mysqli_close($con);
} else {
echo 'Gagal menyimpan gambar Barcode';
}
}
?>