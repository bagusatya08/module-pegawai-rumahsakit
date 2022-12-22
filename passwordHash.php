<?php 

require 'app/database/connect.php';

$password_hash = password_hash("admin", PASSWORD_DEFAULT);

$sql = "UPDATE tb_pegawai
        SET password_pg = '$password_hash'
        WHERE password_pg = 'admin'";

mysqli_query($conn, $sql);

?>