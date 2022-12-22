<?php
session_start();
if (!isset($_SESSION["id_pegawai"])) { 

    header("location:login.php");

} else { 

    $mysqli = require __DIR__ . "/dbConnection.php";

    $sql = "SELECT * FROM tb_pegawai
            WHERE id_pegawai = {$_SESSION["id_pegawai"]}";

    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_array($result);
}

// $user["foto_profile"];
// $nip["username_pegawai"];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="beranda.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
    <body class="d-flex flex-column min-vh-100" style="background-color: #F8F2DE;">
        <div class="d-flex flex-column justify-content-start header fixed-top">
                    <nav class="navbar navbar-expand-sm">
                        <div class="container-fluid">
                            <img src="img/char-logo.png" alt="logo-rumah-sakit" height="60" class="kiri" style="padding-right: 8vw; margin-left: 16vw;">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav text-center">
                                    <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="beranda.php">Beranda</a>
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
        <div class="container" style="padding-top:20vh;">
            <div class="d-lg-flex flex-row justify-content-center">
                <img class="foto-profile" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($user['foto_profile']); ?>" height="250px" style="margin-right: 9vw; margin-left: 1vw; margin-top: 5vh;"/>
                <div class="container" style="background-color: #ffff; border-radius: 26px; width: 70%;">
                    <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                        <h2>Informasi Umum Pegawai</h2>
                        <table class="table table-bordered" style="margin-top: 2vh; width:100%">
                            <tbody>
                                <tr>
                                <td colspan="2">NIP<br>2105551100</td>
                                </tr>
                                <tr>
                                <td>Bidang<br>Pegawai Kedokteran</td>
                                <td>Jenis Kontrak<br>PNS</td>
                                </tr>
                                <tr>
                                <td>Ruang Kerja<br>ICU 2</td>
                                <td>Tahun Masuk<br>2020</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
            <div class="container" style="background-color: #ffff; border-radius: 26px; padding-top:3vh; margin-top:5vh;">
                    <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                        <h2>Identitas Pribadi</h2>
                        <table class="table table-bordered" style="margin-top: 2vh; width:100%">
                            <tbody>
                                <tr>
                                <td colspan="2">Nama Lengkap<br>Bagus Satya</td>
                                </tr>
                                <tr>
                                <td>Tempat Lahir<br>Gianyar</td>
                                <td>Tanggal Lahir<br>04/07/2003</td>
                                </tr>
                                <tr>
                                <td>Jenis Kelamin<br>Laki-laki</td>
                                <td>Agama<br>Hindu</td>
                                </tr>
                                <tr>
                                <td>Status Perkawinan<br>Belum Kawin</td>
                                <td>Golongan Darah<br>O</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        </div>
        <div class="container" style="background-color: #ffff; border-radius: 26px; padding-top:3vh; margin-top:5vh;">
                    <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                        <h2>Informasi Pribadi</h2>
                        <table class="table table-bordered" style="margin-top: 2vh; width:100%">
                            <tbody>
                                <tr>
                                <td colspan="2">Negara<br>Indonesia</td>
                                </tr>
                                <tr>
                                <td>Kabupaten<br>Gianyar</td>
                                <td>Kecamatan<br>Blahbatuh</td>
                                </tr>
                                <tr>
                                <td colspan="2">Alamat<br>Jalan Pancoran Nagakunci, No.18</td>
                                </tr>
                                <tr>
                                <td>Nomor KTP<br>5129981298121</td>
                                <td>File KTP<br>(dalam format pdf)</td>
                                </tr>
                                <tr>
                                <td colspan="2">Nomor Telepon<br>081246915504</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
        </div>
        <div class="container d-lg-flex flex-row justify-content-between" style="margin-top: 5vh;">  
            <a href="logout.php">
                <button type="button" class="btn btn-primary btn-lg">Logout</button>
            </a>
            <button type="button" class="btn btn-primary btn-lg">Simpan</button>
        </div>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>