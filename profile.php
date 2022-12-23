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

    require "./dbConnection.php";

    // $sql = "SELECT * FROM tb_pegawai
    //         WHERE id_pegawai = {$_SESSION["id_pegawai"]}";

    // $result = mysqli_query($conn, $sql);

    // $user = mysqli_fetch_array($result);

    $sql = 'SELECT *
            FROM tb_pegawai
            WHERE id_pegawai = :id_pegawai';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/beranda.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: #F8F2DE;">
    <!-- Nav bar div -->
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
    <!-- END Nav bar div -->
    
    <!-- Informasi Umum Pegawai Div -->
    <div class="container" style="padding-top:20vh;">
        <div class="d-lg-flex flex-row justify-content-center">
            <img class="foto-profile" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($user['foto_profile']); ?>" height="250px" style="margin-right: 9vw; margin-left: 1vw; margin-top: 5vh; border-radius:30px;"/>
            <div class="container" style="background-color: #ffff; border-radius: 26px; width: 70%;">
                <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                    <h2>Informasi Umum Pegawai</h2>
                    <table class="table table-bordered" style="margin-top: 2vh; width:100%">
                        <tbody>
                            <tr>
                            <td colspan="2">NIP<br><?= $user['nip']; ?></td>
                            </tr>
                            <tr>
                            <td>Bidang<br><?= $user['bidang']; ?></td>
                            <td>Jenis Kontrak<br><?= $user['jenis_kontrak']; ?></td>
                            </tr>
                            <tr>
                            <td>Ruang Kerja<br><?= $user['ruangan']; ?></td>
                            <td>Tahun Masuk<br><?= $user['tahun_masuk']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- END Informasi Umum Pegawai Div -->
    
    <!-- Identitas Pribadi Div -->
    <div class="container" style="background-color: #ffff; border-radius: 26px; padding-top:3vh; margin-top:5vh;">
        <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
            <h2>Identitas Pribadi</h2>
            <table class="table table-bordered" style="margin-top: 2vh; width:100%">
                <tbody>
                    <tr>
                    <td colspan="2">Nama Lengkap<br><?= $user['nama']; ?></td>
                    </tr>
                    <tr>
                    <td>Tempat Lahir<br><?= $user['tempat_lahir']; ?></td>
                    <td>Tanggal Lahir<br><?= $user['tgl_lahir']; ?></td>
                    </tr>
                    <tr>
                    <td>Jenis Kelamin<br><?= $user['jenis_kelamin']; ?></td>
                    <td>Agama<br><?= $user['agama']; ?></td>
                    </tr>
                    <tr>
                    <td>Status Perkawinan<br><?= $user['status_kawin']; ?></td>
                    <td>Golongan Darah<br><?= $user['golongan_darah']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Identitas Pribadi Div -->
    
    <!-- Informasi Pribadi Div -->
    <div class="container" style="background-color: #ffff; border-radius: 26px; padding-top:3vh; margin-top:5vh;">
        <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
            <h2>Informasi Pribadi</h2>
            <table class="table table-bordered" style="margin-top: 2vh; width:100%">
                <tbody>
                    <tr>
                    <td colspan="2">Negara<br><?= $user['negara']; ?></td>
                    </tr>
                    <tr>
                    <td>Kabupaten<br><?= $user['kabupaten']; ?></td>
                    <td>Kecamatan<br><?= $user['kecamatan']; ?></td>
                    </tr>
                    <tr>
                    <td colspan="2">Alamat<br><?= $user['alamat']; ?></td>
                    </tr>
                    <tr>
                    <td>Nomor KTP<br><?= $user['no_ktp']; ?></td>
                    <td>File KTP<br><a download="file_ktp.PDF" href="data:application/pdf;base64, <?php echo base64_encode($user['file_ktp']) ?>">Download</a></td>
                    </tr>
                    <tr>
                    <td colspan="2">Nomor Telepon<br><?= $user['no_hp']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Informasi Pribadi Div -->
    
    <!-- Button Div -->
    <div class="container d-lg-flex flex-row justify-content-between" style="margin-top: 5vh;">  
        <a href="logout.php">
            <button type="button" class="btn btn-primary btn-lg">Logout</button>
        </a>
        <a href="profile_edit.php">
            <button type="button" class="btn btn-primary btn-lg">Edit</button>
        </a>
    </div>
    <!-- END Button Div -->
    
    <!-- Footer Div -->
    <div class="d-flex flex-row-lg justify-content-evenly footer">
        <div class="d-lg-flex flex-row justify-content-between">
            <img src="img/title-logo-black-2.png" alt="logo pegawai" height="70px" style="padding-right: 80px">
            <p class="desc">Website ini adalah Sistem Informasi Kepegawaian Rumah Sakit Teknologi Informasi yang digunakan sebagai platform kepegawaian dalam bentuk digital.</p>
        </div>
        <div class="d-flex flex-column justify-content-start informasi">
            <p class="kontak">Kontak Pengaduan</p>
            <p class="nomor">0812-345-67897</p>
        </div>
    </div>
    <!-- END Footer Div -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>