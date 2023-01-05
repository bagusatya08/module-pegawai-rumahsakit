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
    $id_pengajuan = $_GET['id_pengajuan'];

    require './dbConnection.php';

    $sql = "SELECT *
        FROM tb_pengajuan
        WHERE id_pengajuan = :id_pengajuan
        ;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_pengajuan', $id_pengajuan, PDO::PARAM_STR);
    $stmt->execute();
    $pengajuan = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if (isset($_POST['submit'])) {
        $konten = $_POST['konten'];
    
        if ($_FILES['media']['size'] != 0) {
            $media = $_FILES['media']['tmp_name'];
            $pdf_blob = fopen($media, "rb");
        
        } else {
            $pdf_blob = $pengajuan['media'];
    
        }
    
        try {
            // input tb_pengajuan
            $sql = "UPDATE tb_pengajuan
                    SET
                        tgl_masuk = CURDATE(),
                        konten = :konten,
                        media = :media
                    WHERE 
                        id_pengajuan = :id_pengajuan;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':konten', $konten);
            $stmt->bindParam(':media', $pdf_blob, PDO::PARAM_LOB);
            $stmt->bindParam(':id_pengajuan', $id_pengajuan, PDO::PARAM_STR);
    
            if ($stmt->execute() === FALSE) {
                echo 'Could not save information to the database';
    
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
        <input type="text" name="konten" value="<?= $pengajuan['konten']; ?>"/>
    </div>
    <div>
        <label for="media">File</label>
        <input type="file" name="media" accept=".pdf"/>
        <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Edit pengajuan"/>
    </div>
</form>
