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
    $id_ruangan = $_GET['id_ruangan'];

    require './dbConnection.php';
    
    $sql = "SELECT *
            FROM tb_ruangan
            WHERE id_ruangan = :id_ruangan
    ;
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_ruangan', $id_ruangan, PDO::PARAM_STR);
    $stmt->execute();
    $ruangan = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (isset($_POST['submit'])) {
        $nama_ruangan = $_POST['nama_ruangan'];
       
        try {
            $sql = "UPDATE tb_ruangan
                    SET nama_ruangan = :nama_ruangan
                    WHERE id_ruangan = :id_ruangan;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nama_ruangan', $nama_ruangan);
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

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan</title>
    
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
                <h2>Edit Ruangan</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST">
                <div class="form-control">
                    <label for="nama_ruangan">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="nama_ruangan" value="<?= $ruangan['nama_ruangan']; ?>"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <input type="submit" name="submit" class="submit" value="Edit Ruangan"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <script src="./js/input_pengumuman.js"></script>

    <!-- Validasi -->
    <script type="text/javascript" src="./js/validation_ruangan_edit.js"></script>
</body>
</html>