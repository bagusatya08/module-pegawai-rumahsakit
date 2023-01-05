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
    $id_ruangan = $_GET['id_ruangan'];

    require './dbConnection.php';
    
    try {
        $sql = 'DELETE FROM tb_ruangan
                WHERE id_ruangan = :id_ruangan';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_ruangan', $id_ruangan, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }
    
    } catch (PDOException $e) {
        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

    header("location:ruangan.php");
    
}    

?>