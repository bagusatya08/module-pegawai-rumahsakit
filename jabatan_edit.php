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
    $id_jabatan = $_GET['id_jabatan'];

    require './dbConnection.php';
    
    $sql = "SELECT *
            FROM tb_jabatan
            WHERE id_jabatan = :id_jabatan
    ;
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_jabatan', $id_jabatan, PDO::PARAM_STR);
    $stmt->execute();
    $jabatan = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (isset($_POST['submit'])) {
        $nama_jabatan = $_POST['nama_jabatan'];
       
        try {
            $sql = "UPDATE tb_jabatan
                    SET nama_jabatan = :nama_jabatan
                    WHERE id_jabatan = :id_jabatan;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nama_jabatan', $nama_jabatan);
            $stmt->bindParam(':id_jabatan', $id_jabatan, PDO::PARAM_STR);
    
            if ($stmt->execute() === FALSE) {
                echo 'Could not save information to the database';
    
            }
    
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   

        header("location:jabatan.php");
    
    }    

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jabatan</title>
    
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
                <h2>Edit Jabatan</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST">
                <div class="form-control">
                    <label for="nama_jabatan">Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" value="<?= $jabatan['nama_jabatan']; ?>"/>
                </div>
                <input type="submit" name="submit" class="submit" value="Edit Jabatan"/>
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