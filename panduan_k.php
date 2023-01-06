<?php 

session_start();

// jika waktu session habis (tak set 30m)
if (!isset($_SESSION['EXPIRES']) || time() >= $_SESSION['EXPIRES']) {
    session_destroy();
    $_SESSION = array();

}

if (!isset($_SESSION["id_pegawai"]) || $_SESSION['nama_jabatan'] != 'Kepala Bidang' && $_SESSION['nama_jabatan'] != 'Kepala Ruangan') { 
    header("location:login.php");

} else { 
    $id_panduan = $_GET['id_panduan'];
    // echo $id_panduan;

    require "./dbConnection.php";

    $sql = "SELECT *
        FROM tb_panduan
        WHERE id_panduan = :id_panduan
        ;
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_panduan', $id_panduan, PDO::PARAM_STR);
    $stmt->execute();
    $panduan = $stmt->fetch(PDO::FETCH_ASSOC);

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda Panduan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/pengumuman.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body style="background-color: #F8F2DE;">
        <div class="d-flex flex-column justify-content-start header">
                    <nav class="navbar navbar-expand-sm">
                        <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="img/char-logo.png" alt="logo-rumah-sakit" height="60" class="kiri" style="padding-right: 8vw; margin-left: 16vw;">
                        </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav text-center">
                                    <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="beranda-after_kepala.php">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="jadwal_kepala.php">Jadwal</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="pengajuan_kepala.php">Pengajuan</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="profile_kepala.php">Profile</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
        </div>
        <div class="container">
            <div class="d-lg-flex flex-row justify-content-start">
                <div class="d-flex flex-column justify-content-start content">
                    <div class="d-flex flex-row justify-content-start">
                        <h4><?= $panduan['judul']; ?></h4>
                    </div>
                    <div class="d-flex flex-row justify-content-start">
                        <p style="padding-right:30px;">Panduan</p>
                        <p><?= $panduan['tgl']; ?></p>
                    </div>
                    <div class="d-flex flex-row justify-content-start main-content">
                        <p><?= $panduan['konten']; ?></p>
                    </div>
                </div>
                <div class="d-flex flex-column justify-content-center" style="margin-left: 16%;">
                    <iframe src="data:application/pdf;base64, <?php echo base64_encode($panduan['media']) ?>" frameborder="0" height="80%"></iframe>
                    <a title="Download PDF" download="<?= $panduan['tgl']; ?>_<?= $panduan['judul']; ?>.PDF" href="data:application/pdf;base64, <?php echo base64_encode($panduan['media']) ?>">Download</a>        
                </div>
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
</body>
</html>