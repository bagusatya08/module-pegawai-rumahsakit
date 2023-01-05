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
        $nama_jabatan = $_POST['nama_jabatan'];
       
        try {
            $sql = "INSERT INTO tb_jabatan(
                            nama_jabatan
                        )VALUES(
                            :nama_jabatan
                            );
                        ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nama_jabatan', $nama_jabatan);
    
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


<form method="POST">
    <div>
        <label for="nama_jabatan">Nama Jabatan</label>
        <input type="text" name="nama_jabatan"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Buat Jabatan"/>
    </div>
</form>
