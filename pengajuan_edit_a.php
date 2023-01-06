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
    
            } else {
                header("Location: pengajuan_admin.php");
    
            }
        
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   
    
    }    

}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengajuan</title>
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./style/styleForm.css">

    <!-- Font -->
    <script src="https://use.fontawesome.com/2e95bf0c1a.js"></script>
</head>
<body>
    <!-- Box -->
    <div class="box">
        <!-- Container -->
        <div class="container">
            <header>
                <h2>Edit Pengajuan</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="konten">Konten</label>
                    <input type="text" name="konten" id="konten" value="<?= $pengajuan['konten']; ?>"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="media">File</label>
                    <input type="file" name="media" accept=".pdf"/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
                </div>
                <input type="submit" name="submit" class="submit" value="Edit Pengajuan"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <!-- Validasi -->
    <script type="text/javascript" src="./js/validation_pengajuan_edit.js"></script>
</body>
</html>