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
    $id_panduan = $_GET['id_panduan'];

    require './dbConnection.php';
    
    try {
        $sql = 'DELETE FROM tb_panduan_detail
                WHERE id_panduan = :id_panduan';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_panduan', $id_panduan, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }

        $sql = 'DELETE FROM tb_panduan
                WHERE id_panduan = :id_panduan';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_panduan', $id_panduan, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }
    
    } catch (PDOException $e) {
        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

    header("location:panduan_admin.php");
    
}    

?>