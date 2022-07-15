<?php
session_start();

if(!isset($_SESSION['id']) || $_SESSION['role'] != "BENDAHARA MASJID"){
	header("location: ../auth/login.php");
}
?>