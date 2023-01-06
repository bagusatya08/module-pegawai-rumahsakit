<?php 

session_start();

// jika waktu session habis (tak set 30m)
if (!isset($_SESSION['EXPIRES']) || time() >= $_SESSION['EXPIRES']) {
    session_destroy();
    $_SESSION = array();
}

if (!isset($_SESSION["id_pegawai"]) || $_SESSION['nama_jabatan'] == 'Kepala Bidang' || $_SESSION['nama_jabatan'] == 'Kepala Ruangan' || $_SESSION['nama_jabatan'] == 'Admin') { 
    header("location:login.php");

} else { 
    require "./dbConnection.php";

    $sql = 'SELECT *
            FROM tb_pegawai
            WHERE id_pegawai = :id_pegawai';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT j.*
            FROM tb_jadwal AS j
            INNER JOIN tb_jadwal_detail AS jd
            ON jd.id_jadwal = j.id_jadwal
            INNER JOIN tb_pegawai AS pg
            ON pg.id_pegawai = jd.id_pegawai
            WHERE pg.id_pegawai = :id_pegawai
            AND j.status_jadwal = 'Y'
            ;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $stmt->execute();
    
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/jadwal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
    <body class="d-flex flex-column min-vh-100" style="background-color: #F8F2DE;">
        <div class="d-flex flex-column justify-content-start header fixed-top">
                    <nav class="navbar navbar-expand-sm">
                        <div class="container-fluid">
                            <img src="img/char-logo.png" alt="logo-rumah-sakit" height="60" class="kiri" style="padding-right: 8vw;">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav text-center">
                                    <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="beranda-after.php">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="jadwal.php">Jadwal</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="pengajuan.php">Pengajuan</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="profile.php">Profile</a>
                                    </li>  
                                </ul>
                            </div>
                        </div>
                    </nav>
        </div>
        <div class="container" style="background-color: #ffff; margin-top: 20vh; border-radius: 26px;">
            <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                <h2>Jadwal</h2>
                <table class="table table-bordered" style="margin-top: 2vh;">
                    <tbody>
                        <tr>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Shift</th>
                        </tr>
                        <?php while ($jadwal = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td>
                                    <?php echo $jadwal['tgl'] ?>
                                </td>
                                <td>
                                    <?php echo $jadwal['jam'] ?>
                                </td>
                                <td>
                                    <?php echo $jadwal['shift'] ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex flex-row-lg justify-content-evenly footer">
            <div class="d-lg-flex flex-row justify-content-between">
                <img src="img/title-logo-black-2.png" alt="logo pegawai" height="70" style="padding-right: 80px">
                <p class="desc">Website ini adalah Sistem Informasi Kepegawaian Rumah Sakit Teknologi Informasi yang digunakan sebagai platform kepegawaian dalam bentuk digital.</p>
            </div>
            <div class="d-flex flex-column justify-content-start informasi">
                <p class="kontak">Kontak Pengaduan</p>
                <p class="nomor">0812-345-67897</p>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>