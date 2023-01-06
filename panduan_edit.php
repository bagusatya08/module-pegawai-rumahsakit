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
    $id_panduan = $_GET['id_panduan'];

    require './dbConnection.php';
    
    $sql = "SELECT *
            FROM tb_panduan
            WHERE id_panduan = :id_panduan
    ;
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_panduan', $id_panduan, PDO::PARAM_STR);
    $stmt->execute();
    $panduan = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($panduan['status_panduan'] == 'Y') {
        $st = 'Aktif';
    
    } else {
        $st = 'Tidak Aktif';
    
    }
    
    
    $sql = "SELECT *
            FROM tb_panduan_detail
            WHERE id_panduan = :id_panduan
    ;
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_panduan', $id_panduan, PDO::PARAM_STR);
    $stmt->execute();
    $panduan_detail = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
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
        $status_panduan = $_POST['status_panduan'];
    
        if ($_FILES['media']['size'] != 0) {
            $media = $_FILES['media']['tmp_name'];
            $pdf_blob = fopen($media, "rb");
        
        } else {
            $pdf_blob = $panduan['media'];
    
        }
    
        try {
            // input tb_panduan
            $sql = "UPDATE tb_panduan
                    SET
                        judul = :judul,
                        tgl = :tgl,
                        konten = :konten,
                        media = :media,
                        status_panduan = :status_panduan
                    WHERE 
                        id_panduan = :id_panduan;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':judul', $judul);
            $stmt->bindParam(':tgl', $tgl);
            $stmt->bindParam(':konten', $konten);
            $stmt->bindParam(':media', $pdf_blob, PDO::PARAM_LOB);
            $stmt->bindParam(':status_panduan', $status_panduan);
            $stmt->bindParam(':id_panduan', $id_panduan, PDO::PARAM_STR);
    
            if ($stmt->execute() === FALSE) {
                echo 'Could not save information to the database';
    
            }
    
    
            // input tb_panduan_detail
            $sql = "SELECT id_panduan
                    FROM tb_panduan
                    WHERE judul = :judul
                    AND tgl = :tgl
                    AND konten = :konten
                    AND status_panduan = :status_panduan
                    ;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':judul', $judul);
            $stmt->bindParam(':tgl', $tgl);
            $stmt->bindParam(':konten', $konten);
            $stmt->bindParam(':status_panduan', $status_panduan);
            $stmt->execute();
            $panduan_input = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
            $sql = 'DELETE FROM tb_panduan_detail
                    WHERE id_panduan = :id_panduan';
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_panduan', $panduan_input['id_panduan'], PDO::PARAM_STR);
            $stmt->execute();
    
    
            foreach ($targets as $target){ 
                $sql = "REPLACE INTO tb_panduan_detail(
                    id_panduan,
                    id_pegawai
                )VALUES(
                    :id_panduan,
                    :id_pegawai
                );
                ";
    
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id_panduan', $panduan_input['id_panduan']);
                $stmt->bindParam(':id_pegawai', $target);
    
                if ($stmt->execute() === FALSE) {
    
                    echo 'Could not save information to the database';
    
                }
    
            }
    
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   

        header("location:panduan_admin.php");
    
    }    

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Panduan</title>
    
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
                <h2>Edit Panduan</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" value="<?= $panduan['judul']; ?>"/>
                </div>
                <div class="form-control">
                    <label for="tgl">Tanggal</label>
                    <input type="date" name="tgl" value="<?= $panduan['tgl']; ?>"/>
                </div>
                <div class="form-control">
                    <label for="konten">Konten</label>
                    <input type="text" name="konten" value="<?= $panduan['konten']; ?>"/>
                </div>
                <div class="form-control">
                    <label for="media">File</label>
                    <input type="file" name="media" accept=".pdf"/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
                </div>
                <div class="form-control">
                    <label for="target">Target</label><br>
                    <input type="checkbox" onClick="toggle_target(this)" />Toggle All<br/>
                    <?php while ($data = $statement->fetch(PDO::FETCH_ASSOC)) : 
                        $sql = "SELECT *
                                FROM tb_panduan_detail
                                WHERE id_panduan = :id_panduan
                                AND id_pegawai = :id_pegawai;
                        ";

                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id_panduan', $id_panduan, PDO::PARAM_STR);
                        $stmt->bindParam(':id_pegawai', $data['id_pegawai']);
                        $stmt->execute();
                        $data_target = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    ?>
                        <?php if ($data_target) { ?>
                            <input type="checkbox" class="target_panduan" name="target[]" value="<?php echo $data['id_pegawai'] ?>" checked><?php echo $data['username'] ?><br/>

                        <?php } else { ?>
                            <input type="checkbox" class="target_panduan" name="target[]" value="<?php echo $data['id_pegawai'] ?>"><?php echo $data['username'] ?><br/>
                        
                        <?php } ?>
                    
                    <?php endwhile; ?>
                </div>
                <div class="form-control">
                    <label for="status_panduan">Status</label>
                    <select name="status_panduan">
                    <option value="<?= $panduan['status_panduan']; ?>" selected hidden><?= $st; ?></option>
                        <option value="Y">Aktif</option>
                        <option value="N">Tidak Aktif</option>     
                    </select>    
                </div>
                <input type="submit" name="submit" class="submit" value="Edit Panduan"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <script src="./js/input_panduan.js"></script>

    <!-- Validasi -->
    <!-- <script type="text/javascript" src="../js/validationAdd.js"></script> -->
</body>
</html>
