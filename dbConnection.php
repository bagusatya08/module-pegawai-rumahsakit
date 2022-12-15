<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "db_kepegawaian_rumah_sakit";

// Create connection
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>