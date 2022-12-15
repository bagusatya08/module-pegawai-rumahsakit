<?php 

require "dbConnection.php";

$password_hash = password_hash("admin", PASSWORD_DEFAULT);

$sql = "UPDATE tb_pegawai
        SET password_pegawai = '$password_hash'
        WHERE password_pegawai = 'admin'";

mysqli_query ($conn, $sql);

?>