<?php 

if (!isset($_SESSION["id_pegawai"])) { 

    header("location:login.php");

} 

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>beranda</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="beranda-after.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
    <body class="d-flex flex-column min-vh-100" style="background-color: #F8F2DE;">
        <div class="d-flex flex-column justify-content-start header fixed-top">
                    <nav class="navbar navbar-expand-sm">
                        <div class="container-fluid">
                                <img src="img/char-logo.png" alt="logo-rumah-sakit" height="60" style="padding-right: 8vw ;margin-left: 16vw;";>
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
                                    <li class="nav-item">
                                    <a class="nav-link" href="login.php">
                                        <!-- <img class="foto-profile" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($user['foto_profile']); ?>" height="30px"/>  -->
                                    Login
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container" style="background-color: #ffff; margin-top: 20vh; border-radius: 26px;">
            <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                <h2>Pengajuan Cuti Tahunan</h2>
                <table class="table table-bordered" style="margin-top: 2vh;">
                    <tbody>
                        <tr>
                        <td>Pesyaratan</td>
                        </tr>
                        <tr>
                        <td>Setiap pegawai memiliki hal sejumlah 2 kali cuti tahunan yang dapat diambil dengan durasi setiap cuti maksimal 3 hari dengan total jumlah hari cuti yang dapat diperoleh tiap tahun
adalah sebanyak 6 hari. Cuti dapat diajukan dengan mengisi formulir isian yang kemudian akan diverifikasi 2 tahap dimulai dari verifikasi kepala ruangan dan dilanjutkan kepada 
verifikasi kepala bidang yang kemudian akan dihasilkan konfirmasi pemberian izin cuti tahunan.
                        </td>
                        </tr>
                        <tr>
                        <td>Isian Formulir</td>
                        </tr>
                        <tr>
                        <td>Status Pengujian</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container" style="background-color: #ffff; margin-top: 5vh; border-radius: 26px;">
            <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                <h2>Pengajuan Cuti Melahirkan</h2>
                <table class="table table-bordered" style="margin-top: 2vh;">
                    <tbody>
                        <tr>
                        <td>Pesyaratan</td>
                        </tr>
                        <tr>
                        <td>Setiap pegawai memiliki hal sejumlah 2 kali cuti tahunan yang dapat diambil dengan durasi setiap cuti maksimal 3 hari dengan total jumlah hari cuti yang dapat diperoleh tiap tahun
adalah sebanyak 6 hari. Cuti dapat diajukan dengan mengisi formulir isian yang kemudian akan diverifikasi 2 tahap dimulai dari verifikasi kepala ruangan dan dilanjutkan kepada 
verifikasi kepala bidang yang kemudian akan dihasilkan konfirmasi pemberian izin cuti tahunan.
                        </td>
                        </tr>
                        <tr>
                        <td>Isian Formulir</td>
                        </tr>
                        <tr>
                        <td>Status Pengujian</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container" style="background-color: #ffff; margin-top: 5vh; border-radius: 26px;">
            <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                <h2>Pengajuan Naik Tingkat</h2>
                <table class="table table-bordered" style="margin-top: 2vh;">
                    <tbody>
                        <tr>
                        <td>Pesyaratan</td>
                        </tr>
                        <tr>
                        <td>Setiap pegawai memiliki hal sejumlah 2 kali cuti tahunan yang dapat diambil dengan durasi setiap cuti maksimal 3 hari dengan total jumlah hari cuti yang dapat diperoleh tiap tahun
adalah sebanyak 6 hari. Cuti dapat diajukan dengan mengisi formulir isian yang kemudian akan diverifikasi 2 tahap dimulai dari verifikasi kepala ruangan dan dilanjutkan kepada 
verifikasi kepala bidang yang kemudian akan dihasilkan konfirmasi pemberian izin cuti tahunan.
                        </td>
                        </tr>
                        <tr>
                        <td>Isian Formulir</td>
                        </tr>
                        <tr>
                        <td>Status Pengujian</td>
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