<?php
/* mysqli_connect for database connection */

$dbHost = 'remotemysql.com';
$dbUser = 'ruqv5cbA2D';
$dbPassword = 'TT97lZJdWA';
$dbName = 'ruqv5cbA2D';

// connect to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

// check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// set time location
date_default_timezone_set('Asia/Jakarta');
?>