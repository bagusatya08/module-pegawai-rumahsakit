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
    $id_bidang = $_GET['id_bidang'];

    require './dbConnection.php';
    
    $sql = "SELECT *
            FROM tb_bidang
            WHERE id_bidang = :id_bidang
    ;
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_bidang', $id_bidang, PDO::PARAM_STR);
    $stmt->execute();
    $bidang = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (isset($_POST['submit'])) {
        $nama_bidang = $_POST['nama_bidang'];
       
        try {
            $sql = "UPDATE tb_bidang
                    SET nama_bidang = :nama_bidang
                    WHERE id_bidang = :id_bidang;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nama_bidang', $nama_bidang);
            $stmt->bindParam(':id_bidang', $id_bidang, PDO::PARAM_STR);
    
            if ($stmt->execute() === FALSE) {
                echo 'Could not save information to the database';
    
            }
    
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   

        header("location:bidang.php");
    
    }    

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bidang</title>
    
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
                <h2>Edit Bidang</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST">
                <div class="form-control">
                    <label for="nama_bidang">Nama Bidang</label>
                    <input type="text" name="nama_bidang" id="nama_bidang" value="<?= $bidang['nama_bidang']; ?>"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <input type="submit" name="submit" class="submit" value="Edit Bidang"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <!-- Validasi -->
    <script type="text/javascript" src="./js/validation_bidang_edit.js"></script>
</body>
</html>
