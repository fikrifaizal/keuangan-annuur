<?php
require_once('../../../config.php');
require_once('../../akses.php');

$id = $_SESSION["id"];

$keterangan = $_POST['keterangan'];
$jumlah = $_POST['jumlah'];
$tanggal = $_POST['tanggal'];

$query = "INSERT INTO `keuangan_masjid`(`keterangan`,`keluar`,`masuk`,`tanggal`,`user_id`) VALUES ('$keterangan','$jumlah','0','$tanggal','$id')";
$result = mysqli_query($conn, $query);

header("Location: ../keuangan.php");
?>