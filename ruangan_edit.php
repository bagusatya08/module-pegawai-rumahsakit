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


<form method="POST">
    <div>
        <label for="nama_ruangan">Nama Ruangan</label>
        <input type="text" name="nama_ruangan" value="<?= $ruangan['nama_ruangan']; ?>"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Edit ruangan"/>
    </div>
</form>
