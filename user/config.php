<?php
/* mysqli_connect for database connection */

$dbHost = 'sql6.freemysqlhosting.net';
$dbUser = 'sql6505252';
$dbPassword = 'qfagAwgEw3';
$dbName = 'sql6505252';

// connect to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

// check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// set time location
date_default_timezone_set('Asia/Jakarta');
?>