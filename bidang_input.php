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
    
    }    

}

?>


<form method="POST">
    <div>
        <label for="nama_bidang">Nama Bidang</label>
        <input type="text" name="nama_bidang"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Buat Bidang"/>
    </div>
</form>
