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
    require './dbConnection.php';

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
    
        $media = $_FILES['media']['tmp_name'];
        $pdf_blob = fopen($media, "rb");
    
        try {
            // input tb_pengumuman
            $sql = "INSERT INTO tb_pengumuman(
                            judul,
                            tgl,
                            konten,
                            media,
                            status_pengumuman
                        )VALUES(
                            :judul,
                            :tgl,
                            :konten,
                            :media,
                            'Y'
                        );
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':judul', $judul);
            $stmt->bindParam(':tgl', $tgl);
            $stmt->bindParam(':konten', $konten);
            $stmt->bindParam(':media', $pdf_blob, PDO::PARAM_LOB);
    
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
            $pengumuman = $stmt->fetch(PDO::FETCH_ASSOC);
    
            foreach ($targets as $target){ 
                $sql = "INSERT INTO tb_pengumuman_detail(
                    id_pengumuman,
                    id_pegawai
                )VALUES(
                    :id_pengumuman,
                    :id_pegawai
                );
                ";
    
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id_pengumuman', $pengumuman['id_pengumuman']);
                $stmt->bindParam(':id_pegawai', $target);
    
                if ($stmt->execute() === FALSE) {
    
                    echo 'Could not save information to the database';
    
                }
    
            }
    
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   

        header("location:pengumuman_admin.php");
    
    }    

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengumuman</title>
    
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
                <h2>Buat Pengumuman</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="tgl">Tanggal</label>
                    <input type="date" name="tgl" id="tgl"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="konten">Konten</label>
                    <input type="text" name="konten" id="konten"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="media">File</label>
                    <input type="file" name="media" id="media" accept=".pdf"/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="target">Target</label><br>
                    <input type="checkbox" onClick="toggle_target(this)" />Toggle All<br/>
                    <?php while ($data = $statement->fetch(PDO::FETCH_ASSOC)) : ?>
                    <input type="checkbox" class="target_pengumuman" name="target[]" value="<?php echo $data['id_pegawai'] ?>"><?php echo $data['username'] ?><br/>
                    <?php endwhile; ?>
                </div>
                <input type="submit" name="submit" class="submit" value="Buat Pengumuman"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <script src="./js/input_pengumuman.js"></script>

    <!-- Validasi -->
    <script type="text/javascript" src="./js/validation_pengumuman_input.js"></script>
</body>
</html>
