<?php

$servername = "localhost";
$usernamedb = "root";
$passworddb = "";
$db = "db_kepegawaian_rumah_sakit";

try {

  $pdo = new PDO("mysql:host=$servername;dbname=db_kepegawaian_rumah_sakit", $usernamedb, $passworddb);

  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//   echo "Connected successfully";

} catch (PDOException $e) {

  echo "Connection failed: " . $e->getMessage();

}

?>