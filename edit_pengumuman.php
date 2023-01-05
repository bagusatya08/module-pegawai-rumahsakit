<?php 



$id_pengumuman = 1;

require './dbConnection.php';

$sql = "SELECT *
        FROM tb_pengumuman
        WHERE id_pengumuman = :id_pengumuman
;
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_pengumuman', $id_pengumuman, PDO::PARAM_STR);
$stmt->execute();
$pengumuman = $stmt->fetch(PDO::FETCH_ASSOC);


$sql = "SELECT *
        FROM tb_pengumuman_detail
        WHERE id_pengumuman = :id_pengumuman
;
";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_pengumuman', $id_pengumuman, PDO::PARAM_STR);
$stmt->execute();
$pengumuman_detail = $stmt->fetch(PDO::FETCH_ASSOC);


$sql = 'SELECT pg.id_pegawai, 
        pg.username, 
        pg.id_jabatan, 
        j.nama_jabatan
        FROM tb_pegawai AS pg
        INNER JOIN tb_jabatan AS j
        ON j.id_jabatan = pg.id_jabatan;
';
$statement = $pdo->query($sql);

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $tgl = $_POST['tgl'];
    $konten = $_POST['konten'];
    $targets = $_POST['target'];

    if ($_FILES['media']['size'] != 0) {
        $media = $_FILES['media']['tmp_name'];
        $pdf_blob = fopen($media, "rb");
    
    } else {
        $pdf_blob = $pengumuman['media'];

    }

    try {
        // input tb_pengumuman
        $sql = "UPDATE tb_pengumuman
                SET
                    judul = :judul,
                    tgl = :tgl,
                    konten = :konten,
                    media = :media
                WHERE 
                    id_pengumuman = :id_pengumuman;
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':tgl', $tgl);
        $stmt->bindParam(':konten', $konten);
        $stmt->bindParam(':media', $pdf_blob, PDO::PARAM_LOB);
        $stmt->bindParam(':id_pengumuman', $id_pengumuman, PDO::PARAM_STR);

        if ($stmt->execute() === FALSE) {
            echo 'Could not save information to the database';

        }


        // input tb_pengumuman_detail
        $sql = "SELECT id_pengumuman
                FROM tb_pengumuman
                WHERE judul = :judul
                AND tgl = :tgl
                AND konten = :konten
                AND status_pengumuman = 'Y'
                ;
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':judul', $judul);
        $stmt->bindParam(':tgl', $tgl);
        $stmt->bindParam(':konten', $konten);
        $stmt->execute();
        $pengumuman_input = $stmt->fetch(PDO::FETCH_ASSOC);


        $sql = 'DELETE FROM tb_pengumuman_detail
                WHERE id_pengumuman = :id_pengumuman';

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_pengumuman', $pengumuman_input['id_pengumuman'], PDO::PARAM_STR);
        $stmt->execute();


        foreach ($targets as $target){ 
            $sql = "REPLACE INTO tb_pengumuman_detail(
                id_pengumuman,
                id_pegawai
            )VALUES(
                :id_pengumuman,
                :id_pegawai
            );
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_pengumuman', $pengumuman_input['id_pengumuman']);
            $stmt->bindParam(':id_pegawai', $target);

            if ($stmt->execute() === FALSE) {

                echo 'Could not save information to the database';

            }

        }

    } catch (PDOException $e) {
        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

}

?>


<form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
    <div>
        <label for="judul">Judul</label>
        <input type="text" name="judul" value="<?= $pengumuman['judul']; ?>"/>
    </div>
    <div>
        <label for="tgl">Tanggal</label>
        <input type="date" name="tgl" value="<?= $pengumuman['tgl']; ?>"/>
    </div>
    <div>
        <label for="konten">Konten</label>
        <input type="text" name="konten" value="<?= $pengumuman['konten']; ?>"/>
    </div>
    <div>
        <label for="media">File</label>
        <input type="file" name="media" accept=".pdf"/>
        <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
    </div>
    <div>
        <label for="target">Target</label><br>
        <input type="checkbox" onClick="toggle_target(this)" />Toggle All<br/>
        <?php while ($data = $statement->fetch(PDO::FETCH_ASSOC)) : 
            $sql = "SELECT *
                    FROM tb_pengumuman_detail
                    WHERE id_pengumuman = :id_pengumuman
                    AND id_pegawai = :id_pegawai;
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_pengumuman', $id_pengumuman, PDO::PARAM_STR);
            $stmt->bindParam(':id_pegawai', $data['id_pegawai']);
            $stmt->execute();
            $data_target = $stmt->fetch(PDO::FETCH_ASSOC);
        
        ?>
            <?php if ($data_target) { ?>
                <input type="checkbox" class="target_pengumuman" name="target[]" value="<?php echo $data['id_pegawai'] ?>" checked><?php echo $data['username'] ?><br/>

            <?php } else { ?>
                <input type="checkbox" class="target_pengumuman" name="target[]" value="<?php echo $data['id_pegawai'] ?>"><?php echo $data['username'] ?><br/>
            
            <?php } ?>
        
        <?php endwhile; ?>
    </div>
    <div>
        <input type="submit" name="submit" value="Edit Pengumuman"/>
    </div>
</form>
<script src="./js/input_pengumuman.js"></script>