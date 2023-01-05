<?php 

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

}

?>


<form method="POST">
    <div>
        <label for="nama_ruangan">Nama Ruangan</label>
        <input type="text" name="nama_ruangan"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Buat Ruangan"/>
    </div>
</form>