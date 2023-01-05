<?php 



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

}

?>


<form method="POST">
    <div>
        <label for="nama_jabatan">Nama Jabatan</label>
        <input type="text" name="nama_jabatan" value="<?= $jabatan['nama_jabatan']; ?>"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Edit Jabatan"/>
    </div>
</form>
