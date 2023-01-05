<?php

session_start();

// jika waktu session habis (tak set 30m)
if (!isset($_SESSION['EXPIRES']) || time() >= $_SESSION['EXPIRES']) {

    session_destroy();
    $_SESSION = array();
    
}

if (isset($_SESSION["id_pegawai"])) { 

    header("location:beranda-after.php");

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
                                    <a class="nav-link" aria-current="page" href="beranda.php">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="jadwal.php">Jadwal</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="pengajuan.php">Pengajuan</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a class="nav-link" href="login.php">Login</a>
                                    </li>  
                                </ul>
                            </div>
                        </div>
                    </nav>
        </div>
        <div class="container" style="padding-top:20vh;">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="img/rs-1.png" class="d-block w-100" alt="Gambar Carousel 1">
                </div>
                <div class="carousel-item">
                <img src="img/rs-2.png" class="d-block w-100" alt="Gambar Carousel 2">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>
        <div class="container" style="background-color: #ffff; margin-top: 5vh; border-radius: 26px;">
            <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                <h2>Selamat Datang di Website Kepegawaian Rumah Sakit Teknologi Informasi</h2>
                <table class="table table-bordered" style="margin-top: 2vh;">
                    <tbody>
                        <tr>
                        <td><a href="./login.php" style="text-decoration:none; color: black">Silahkan login terlebih dahulu menggunakan username/email yang telah dibagikan oleh admin. <br></a>
                            Jika terdapat kendala saat login, silahkan hubungi admin melalui kontak pengaduan yang tertera.
                        </td>
                        </tr>
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