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
    $id_jadwal = $_GET['id_jadwal'];

    require './dbConnection.php';
    
    $sql = "SELECT *
            FROM tb_jadwal
            WHERE id_jadwal = :id_jadwal
    ;
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_jadwal', $id_jadwal, PDO::PARAM_STR);
    $stmt->execute();
    $jadwal = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($jadwal['status_jadwal'] == 'Y') {
        $st = 'Aktif';
    
    } else {
        $st = 'Tidak Aktif';
    
    }
    
    
    $sql = "SELECT *
            FROM tb_jadwal_detail
            WHERE id_jadwal = :id_jadwal
    ;
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_jadwal', $id_jadwal, PDO::PARAM_STR);
    $stmt->execute();
    $jadwal_detail = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    $sql = 'SELECT pg.id_pegawai, 
            pg.username, 
            pg.id_jabatan, 
            j.nama_jabatan
            FROM tb_pegawai AS pg
            INNER JOIN tb_jabatan AS j
            ON j.id_jabatan = pg.id_jabatan
            WHERE j.nama_jabatan = "Pegawai"
            ;
    ';
    $statement = $pdo->query($sql);
    
    if (isset($_POST['submit'])) {
        $shift = $_POST['shift'];
        $tgl = $_POST['tgl'];
        $targets = $_POST['target'];
        $status_jadwal = $_POST['status_jadwal'];
    
        if ($shift == 'Pagi') {
            $jam = '07:00-15:00';
    
        } else if ($shift == 'Siang') {
            $jam = '15:00-21:00';
    
        } else if ($shift == 'Malam') {
            $jam = '21:00-07:00';
    
        }
    
        try {
            // input tb_jadwal
            $sql = "UPDATE tb_jadwal
                    SET
                        shift = :shift,
                        jam = :jam,
                        tgl = :tgl,
                        status_jadwal = :status_jadwal
                    WHERE 
                        id_jadwal = :id_jadwal;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':shift', $shift);
            $stmt->bindParam(':jam', $jam);
            $stmt->bindParam(':tgl', $tgl);
            $stmt->bindParam(':status_jadwal', $status_jadwal);
            $stmt->bindParam(':id_jadwal', $id_jadwal, PDO::PARAM_STR);
    
            if ($stmt->execute() === FALSE) {
                echo 'Could not save information to the database';
    
            }
    
            // input tb_jadwal_detail
            $sql = "SELECT id_jadwal
                    FROM tb_jadwal
                    WHERE shift = :shift
                    AND jam = :jam
                    AND tgl = :tgl
                    AND status_jadwal = :status_jadwal
                    ;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':shift', $shift);
            $stmt->bindParam(':jam', $jam);
            $stmt->bindParam(':tgl', $tgl);
            $stmt->bindParam(':status_jadwal', $status_jadwal);
            $stmt->execute();
            $jadwal_input = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
            $sql = 'DELETE FROM tb_jadwal_detail
                    WHERE id_jadwal = :id_jadwal';
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_jadwal', $jadwal_input['id_jadwal'], PDO::PARAM_STR);
            $stmt->execute();
    
    
            foreach ($targets as $target){ 
                $sql = "REPLACE INTO tb_jadwal_detail(
                    id_jadwal,
                    id_pegawai
                )VALUES(
                    :id_jadwal,
                    :id_pegawai
                );
                ";
    
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id_jadwal', $jadwal_input['id_jadwal']);
                $stmt->bindParam(':id_pegawai', $target);
    
                if ($stmt->execute() === FALSE) {
    
                    echo 'Could not save information to the database';
    
                }
    
            }
    
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   

        header("location:jadwal_admin.php");
    
    }    

}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal</title>
    
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
                <h2>Edit Jadwal</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="shift">Shift</label>
                    <select name="shift">
                    <option value="<?= $jadwal['shift']; ?>" selected hidden><?= $jadwal['shift']; ?></option>
                        <option value="Pagi">Pagi</option>
                        <option value="Siang">Siang</option>     
                        <option value="Malam">Malam</option>    
                    </select>    
                </div>
                <div class="form-control">
                    <label for="tgl">Tanggal</label>
                    <input type="date" name="tgl" value="<?= $jadwal['tgl']; ?>"/>
                </div>
                <div class="form-control">
                    <label for="target">Target</label>
                    Toggle All<input type="checkbox" onClick="toggle_target(this)" />
                    <?php while ($data = $statement->fetch(PDO::FETCH_ASSOC)) : 
                        $sql = "SELECT *
                                FROM tb_jadwal_detail
                                WHERE id_jadwal = :id_jadwal
                                AND id_pegawai = :id_pegawai;
                        ";

                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id_jadwal', $id_jadwal, PDO::PARAM_STR);
                        $stmt->bindParam(':id_pegawai', $data['id_pegawai']);
                        $stmt->execute();
                        $data_target = $stmt->fetch(PDO::FETCH_ASSOC);

                    ?>
                        <?php if ($data_target) { ?>
                            <?php echo $data['username'] ?><input type="checkbox" class="target_jadwal" name="target[]" value="<?php echo $data['id_pegawai'] ?>" checked>

                        <?php } else { ?>
                            <?php echo $data['username'] ?><input type="checkbox" class="target_jadwal" name="target[]" value="<?php echo $data['id_pegawai'] ?>">
                        
                        <?php } ?>

                    <?php endwhile; ?>
                </div>
                <div class="form-control">
                    <label for="status_jadwal">Status</label>
                    <select name="status_jadwal">
                    <option value="<?= $jadwal['status_jadwal']; ?>" selected hidden><?= $st; ?></option>
                        <option value="Y">Aktif</option>
                        <option value="N">Tidak Aktif</option>     
                    </select>    
                </div>
                <input type="submit" name="submit" class="submit" value="Edit Jadwal"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <script src="./js/input_jadwal.js"></script>

    <!-- Validasi -->
    <!-- <script type="text/javascript" src="../js/validationAdd.js"></script> -->
</body>
</html>