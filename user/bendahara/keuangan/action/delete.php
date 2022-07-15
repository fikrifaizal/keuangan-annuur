<?php
require_once('../../../config.php');
require_once('../../akses.php');

if(isset($_GET['kid'])) {
  $kid = $_GET['kid'];

  $query = "DELETE FROM `keuangan_masjid` WHERE `id` LIKE '$kid'";
  $result = mysqli_query($conn, $query);

  header("Location: ../keuangan.php");
} else {
  header("Location: ../keuangan.php");
}
?>