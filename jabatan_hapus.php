<?php 

session_start();

// jika waktu session habis (tak set 30m)
if (!isset($_SESSION['EXPIRES']) || time() >= $_SESSION['EXPIRES']) {
    session_destroy();
    $_SESSION = array();

}

if (!isset($_SESSION["id_pegawai"]) || $_SESSION['nama_jabatan'] != 'Admin') { 
    header("location:login.php");

} else { 
    $id_jabatan = $_GET['id_jabatan'];

    require './dbConnection.php';
    
    try {
        $sql = 'DELETE FROM tb_jabatan
                WHERE id_jabatan = :id_jabatan';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_jabatan', $id_jabatan, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }
    
    } catch (PDOException $e) {
        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

    header("location:jabatan.php");
    
}    

?>