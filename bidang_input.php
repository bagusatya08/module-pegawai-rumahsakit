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
    require './dbConnection.php';

    if (isset($_POST['submit'])) {
        $nama_bidang = $_POST['nama_bidang'];
       
        try {
            $sql = "INSERT INTO tb_bidang(
                            nama_bidang
                        )VALUES(
                            :nama_bidang
                            );
                        ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nama_bidang', $nama_bidang);
    
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
    <title>Buat Bidang</title>
    
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
                <h2>Buat Bidang</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST">
                <div class="form-control">
                    <label for="nama_bidang">Nama Bidang</label>
                    <input type="text" name="nama_bidang" id="nama_bidang"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <input type="submit" name="submit" class="submit" value="Buat Bidang"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <!-- Validasi -->
    <script type="text/javascript" src="./js/validation_bidang_input.js"></script>
</body>
</html>

