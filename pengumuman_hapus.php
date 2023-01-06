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
    $id_pengumuman = $_GET['id_pengumuman'];

    require './dbConnection.php';
    
    try {
        $sql = 'DELETE FROM tb_pengumuman_detail
                WHERE id_pengumuman = :id_pengumuman';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_pengumuman', $id_pengumuman, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }

        $sql = 'DELETE FROM tb_pengumuman
                WHERE id_pengumuman = :id_pengumuman';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_pengumuman', $id_pengumuman, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }
    
    } catch (PDOException $e) {
        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

    header("location:pengumuman_admin.php");
    
}    

?>