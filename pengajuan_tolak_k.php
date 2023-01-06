<?php 

session_start();

// jika waktu session habis (tak set 30m)
if (!isset($_SESSION['EXPIRES']) || time() >= $_SESSION['EXPIRES']) {
    session_destroy();
    $_SESSION = array();

}

if (!isset($_SESSION["id_pegawai"]) || $_SESSION['nama_jabatan'] != 'Kepala Bidang' && $_SESSION['nama_jabatan'] != 'Kepala Ruangan') { 
    header("location:login.php");

} else { 
    $id_pengajuan = $_GET['id_pengajuan'];

    require './dbConnection.php';
    
    try {
        $sql = 'UPDATE tb_pengajuan
                SET status_pengajuan = "Ditolak",
                tgl_konfirmasi = CURDATE()
                WHERE id_pengajuan = :id_pengajuan';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_pengajuan', $id_pengajuan, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }
    
    } catch (PDOException $e) {
        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

    header("location:pengajuan_kepala.php");
    
}    

?>