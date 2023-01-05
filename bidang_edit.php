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
    
    }    

}

?>


<form method="POST">
    <div>
        <label for="nama_bidang">Nama Bidang</label>
        <input type="text" name="nama_bidang" value="<?= $bidang['nama_bidang']; ?>"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Edit Bidang"/>
    </div>
</form>
