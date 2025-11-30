<?php require_once('koneksi.php');
if (isset($_GET['idtransaksi'])) {
$idtransaksi = $_GET['idtransaksi'];
}
$result = array();
$query = mysqli_query($con, "SELECT * FROM transaksi ORDER BY idtransaksi DESC");
while ($row = mysqli_fetch_assoc($query)) {
$result[] = $row;
}
echo json_encode(array('result' => $result));