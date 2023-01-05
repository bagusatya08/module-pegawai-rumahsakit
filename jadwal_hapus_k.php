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
    $id_jadwal = $_GET['id_jadwal'];

    require './dbConnection.php';
    
    try {
        $sql = 'DELETE FROM tb_jadwal_detail
                WHERE id_jadwal = :id_jadwal';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_jadwal', $id_jadwal, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }

        $sql = 'DELETE FROM tb_jadwal
                WHERE id_jadwal = :id_jadwal';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_jadwal', $id_jadwal, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }
    
    } catch (PDOException $e) {
        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

    header("location:jadwal_kepala.php");
    
}    

?>