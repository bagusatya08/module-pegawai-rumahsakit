<?php 

session_start();

// jika waktu session habis (tak set 30m)
if (!isset($_SESSION['EXPIRES']) || time() >= $_SESSION['EXPIRES']) {
    session_destroy();
    $_SESSION = array();
}

if (!isset($_SESSION["id_pegawai"]) || $_SESSION['nama_jabatan'] != 'Pegawai') { 
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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengajuan</title>
    
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
                <h2>Buat Pengajuan</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="konten">Konten</label>
                    <input type="text" name="konten"/>
                </div>
                <div class="form-control">
                    <label for="media">File</label>
                    <input type="file" name="media" accept=".pdf"/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
                </div>
                <input type="submit" name="submit" class="submit" value="Buat Pengajuan"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <!-- Validasi -->
    <!-- <script type="text/javascript" src="../js/validationAdd.js"></script> -->
</body>
</html>