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
    $jenis_pengajuan = $_GET['jenis_pengajuan'];

    require './dbConnection.php';
    
    if (isset($_POST['submit'])) {
        $konten = $_POST['konten'];
    
        $media = $_FILES['media']['tmp_name'];
        $pdf_blob = fopen($media, "rb");
    
        try {
            // input tb_pengajuan
            $sql = "INSERT INTO tb_pengajuan(
                            id_pegawai,
                            jenis_pengajuan,
                            tgl_masuk,
                            konten,
                            media,
                            status_pengajuan
                        )VALUES(
                            :id_pegawai,
                            :jenis_pengajuan,
                            CURDATE(),
                            :konten,
                            :media,
                            'Pending'
                        );
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_pegawai', $_SESSION["id_pegawai"]);
            $stmt->bindParam(':jenis_pengajuan', $jenis_pengajuan);
            $stmt->bindParam(':konten', $konten);
            $stmt->bindParam(':media', $pdf_blob, PDO::PARAM_LOB);
    
            if ($stmt->execute() === FALSE) {
                echo 'Could not save information to the database';
    
            } else {
                header("Location: pengajuan.php");
    
            }
        
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   
    
    }    

}


?>


<form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
    <div>
        <label for="konten">Konten</label>
        <input type="text" name="konten"/>
    </div>
    <div>
        <label for="media">File</label>
        <input type="file" name="media" accept=".pdf"/>
        <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Buat pengajuan"/>
    </div>
</form>
