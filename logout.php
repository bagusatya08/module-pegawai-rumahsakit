<?php

session_start();

if (!isset($_SESSION["id_pegawai"])) { 

    header("location:login.php");

} 

session_destroy();

header("Location: beranda.php");
exit;