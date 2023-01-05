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
    require './dbConnection.php';

    if (isset($_POST['submit'])) {
        $nama_ruangan = $_POST['nama_ruangan'];
       
        try {
            $sql = "INSERT INTO tb_ruangan(
                            nama_ruangan
                        )VALUES(
                            :nama_ruangan
                            );
                        ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nama_ruangan', $nama_ruangan);
    
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
    <title>Buat Ruangan</title>
    
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
                <h2>Buat Ruangan</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST">
                <div class="form-control">
                    <label for="nama_ruangan">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan"/>
                </div>
                <input type="submit" name="submit" class="submit" value="Buat Ruangan"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <script src="./js/input_pengumuman.js"></script>

    <!-- Validasi -->
    <!-- <script type="text/javascript" src="../js/validationAdd.js"></script> -->
</body>
</html>