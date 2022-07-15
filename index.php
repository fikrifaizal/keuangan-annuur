<?php
if(isset($_COOKIE['id']) && isset($_COOKIE['role'])) {
  switch($_COOKIE["role"]) {
    case "ADMINISTRATOR":
      session_start();
      $_SESSION["id"] = $_COOKIE['id'];
      $_SESSION["nama"] = $_COOKIE['nama'];
      $_SESSION["role"] = $_COOKIE['role'];
      header("location: user/admin/dashboard.php");
      break;
    case "BENDAHARA MASJID":
      session_start();
      $_SESSION["id"] = $_COOKIE['id'];
      $_SESSION["nama"] = $_COOKIE['nama'];
      $_SESSION["role"] = $_COOKIE['role'];
      header("location: user/bendahara/dashboard.php");
      break;
    // default:
  }
} else {
  header("location: user/auth/login.php");
}

?>