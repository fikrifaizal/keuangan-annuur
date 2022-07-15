<?php
require_once('../../../config.php');
require_once('../../akses.php');

$id = $_SESSION["id"];

$keterangan = $_POST['keterangan'];
$kategori = $_POST['newkategori'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];

if($kategori == "masuk") {
  $query = "INSERT INTO `keuangan_masjid`(`keterangan`,`keluar`,`masuk`,`tanggal`,`user_id`) VALUES ('$keterangan','0','$jumlah','$tanggal','$id')";
}
elseif($kategori == "keluar") {
  $query = "INSERT INTO `keuangan_masjid`(`keterangan`,`keluar`,`masuk`,`tanggal`,`user_id`) VALUES ('$keterangan','$jumlah','0','$tanggal','$id')";
}

$result = mysqli_query($conn, $query);

header("Location: ../keuangan.php");
?>