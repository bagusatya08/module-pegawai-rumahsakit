<?php 

session_start();

// jika waktu session habis (tak set 30m)
if (!isset($_SESSION['EXPIRES']) || time() >= $_SESSION['EXPIRES']) {
    session_destroy();
    $_SESSION = array();

}

if (!isset($_SESSION["id_pegawai"])) { 
    header("location:login.php");

} else {
    $id_pegawai = $_GET['id_pegawai'];

    require './dbConnection.php';
    
    try {
        $sql = 'DELETE FROM tb_pegawai
                WHERE id_pegawai = :id_pegawai';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_pegawai', $id_pegawai, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }
    
    } catch (PDOException $e) {
        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

    header("location:akun.php");
    
}    

?>