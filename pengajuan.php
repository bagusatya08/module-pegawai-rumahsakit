<?php 

session_start();

// jika waktu session habis (tak set 30m)
if (!isset($_SESSION['EXPIRES']) || time() >= $_SESSION['EXPIRES']) {
    session_destroy();
    $_SESSION = array();
}

if (!isset($_SESSION["id_pegawai"]) || $_SESSION['nama_jabatan'] != 'Pegawai') { 
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

    $sql = "SELECT p.*
            FROM tb_pengajuan AS p
            INNER JOIN tb_pegawai AS pg
            ON pg.id_pegawai = p.id_pegawai
            INNER JOIN tb_jabatan AS j
            ON j.id_jabatan = pg.id_jabatan
            WHERE pg.id_pegawai = :id_pegawai
            AND jenis_pengajuan = 'Pengajuan Cuti Tahunan'
            ;
    ";

    $stmt_pngj1 = $pdo->prepare($sql);
    $stmt_pngj1->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $stmt_pngj1->execute();
    

    $sql = "SELECT p.*
            FROM tb_pengajuan AS p
            INNER JOIN tb_pegawai AS pg
            ON pg.id_pegawai = p.id_pegawai
            INNER JOIN tb_jabatan AS j
            ON j.id_jabatan = pg.id_jabatan
            WHERE pg.id_pegawai = :id_pegawai
            AND jenis_pengajuan = 'Pengajuan Cuti Melahirkan'
            ;
    ";

    $stmt_pngj2 = $pdo->prepare($sql);
    $stmt_pngj2->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $stmt_pngj2->execute();


    $sql = "SELECT p.*
            FROM tb_pengajuan AS p
            INNER JOIN tb_pegawai AS pg
            ON pg.id_pegawai = p.id_pegawai
            INNER JOIN tb_jabatan AS j
            ON j.id_jabatan = pg.id_jabatan
            WHERE pg.id_pegawai = :id_pegawai
            AND jenis_pengajuan = 'Pengajuan Naik Tingkat'
            ;
    ";

    $stmt_pngj3 = $pdo->prepare($sql);
    $stmt_pngj3->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $stmt_pngj3->execute();
    
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beranda Pengajuan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/beranda-after.css">
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
                                    <a class="nav-link" aria-current="page" href="beranda-after.php">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="jadwal.php">Jadwal</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="pengajuan.php">Pengajuan</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="profile.php">Profile</a>
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
                        <th colspan="4">Pesyaratan</th>
                        </tr>
                        <tr>
                        <td colspan="4">Setiap pegawai memiliki hal sejumlah 2 kali cuti tahunan yang dapat diambil dengan durasi setiap cuti maksimal 3 hari dengan total jumlah hari cuti yang dapat diperoleh tiap tahun
adalah sebanyak 6 hari. Cuti dapat diajukan dengan mengisi formulir isian yang kemudian akan diverifikasi oleh kepala ruangan atau kepala bidang yang kemudian akan dihasilkan konfirmasi pemberian izin cuti tahunan.
                        </td>
                        </tr>
                        <tr>
                        <th colspan="4">
                            <a href="./pengajuan_input.php?jenis_pengajuan=<?= 'Pengajuan Cuti Tahunan' ?>" style="text-decoration:none; color: blue">Isian Formulir</a>
                        </th>
                        </tr>
                        <tr>
                        <tr>
                        <th colspan="4">Riwayat</th>
                        </tr>
                        <tr>
                        <td>Tanggal Masuk</td>
                        <td>Tanggal Konfirmasi</td>
                        <td>Status</td>
                        <td></td>
                        </tr>
                        <?php while ($pengajuan1 = $stmt_pngj1->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td>
                                    <?php echo $pengajuan1['tgl_masuk'] ?>
                                </td>
                                <td>
                                    <?php echo $pengajuan1['tgl_konfirmasi'] ?>
                                </td>
                                <td>
                                    <?php echo $pengajuan1['status_pengajuan'] ?>
                                </td>
                                <td>
                                    <a href="./pengajuan_edit.php?id_pengajuan=<?= $pengajuan1['id_pengajuan'] ?>" style="text-decoration:none; color: blue">Edit</a>
                                    |
                                    <a href="./pengajuan_hapus.php?id_pengajuan=<?= $pengajuan1['id_pengajuan'] ?>" style="text-decoration:none; color: blue">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
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
                        <th colspan="4">Pesyaratan</th>
                        </tr>
                        <tr>
                        <td colspan="4">Setiap pegawai memiliki hal sejumlah 2 kali cuti melahirkan yang dapat diambil dengan durasi setiap cuti maksimal 3 hari dengan total jumlah hari cuti yang dapat diperoleh tiap tahun
adalah sebanyak 6 hari. Cuti dapat diajukan dengan mengisi formulir isian yang kemudian akan diverifikasi oleh kepala ruangan atau kepala bidang yang kemudian akan dihasilkan konfirmasi pemberian izin cuti melahirkan.
                        </td>
                        </tr>
                        <tr>
                        <th colspan="4">
                            <a href="./pengajuan_input.php?jenis_pengajuan=<?= 'Pengajuan Cuti Melahirkan' ?>" style="text-decoration:none; color: blue">Isian Formulir</a>
                        </th>
                        </tr>
                        <tr>
                        <tr>
                        <th colspan="4">Riwayat</th>
                        </tr>
                        <tr>
                        <td>Tanggal Masuk</td>
                        <td>Tanggal Konfirmasi</td>
                        <td>Status</td>
                        <td></td>
                        </tr>
                        <?php while ($pengajuan2 = $stmt_pngj2->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td>
                                    <?php echo $pengajuan2['tgl_masuk'] ?>
                                </td>
                                <td>
                                    <?php echo $pengajuan2['tgl_konfirmasi'] ?>
                                </td>
                                <td>
                                    <?php echo $pengajuan2['status_pengajuan'] ?>
                                </td>
                                <td>
                                    <a href="./pengajuan_edit.php?id_pengajuan=<?= $pengajuan2['id_pengajuan'] ?>" style="text-decoration:none; color: blue">Edit</a>
                                    |
                                    <a href="./pengajuan_hapus.php?id_pengajuan=<?= $pengajuan2['id_pengajuan'] ?>" style="text-decoration:none; color: blue">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
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
                        <th colspan="4">Pesyaratan</th>
                        </tr>
                        <tr>
                        <td colspan="4">Setiap pegawai memiliki hal sejumlah 2 kali pengajuan penaikan tingkat yang dapat diambil dengan durasi setiap cuti maksimal 3 hari dengan total jumlah hari cuti yang dapat diperoleh tiap tahun
adalah sebanyak 6 hari. Pengajuan dapat diajukan dengan mengisi formulir isian yang kemudian akan diverifikasi oleh kepala ruangan atau kepala bidang yang kemudian akan dihasilkan konfirmasi pemberian izin pengajuan tingkat.
                        </td>
                        </tr>
                        <tr>
                        <th colspan="4">
                            <a href="./pengajuan_input.php?jenis_pengajuan=<?= 'Pengajuan Naik Tingkat' ?>" style="text-decoration:none; color: blue">Isian Formulir</a>
                        </th>
                        </tr>
                        <tr>
                        <tr>
                        <th colspan="4">Riwayat</th>
                        </tr>
                        <tr>
                        <td>Tanggal Masuk</td>
                        <td>Tanggal Konfirmasi</td>
                        <td>Status</td>
                        <td></td>
                        </tr>
                        <?php while ($pengajuan3 = $stmt_pngj3->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td>
                                    <?php echo $pengajuan3['tgl_masuk'] ?>
                                </td>
                                <td>
                                    <?php echo $pengajuan3['tgl_konfirmasi'] ?>
                                </td>
                                <td>
                                    <?php echo $pengajuan3['status_pengajuan'] ?>
                                </td>
                                <td>
                                    <a href="./pengajuan_edit.php?id_pengajuan=<?= $pengajuan3['id_pengajuan'] ?>" style="text-decoration:none; color: blue">Edit</a>
                                    |
                                    <a href="./pengajuan_hapus.php?id_pengajuan=<?= $pengajuan3['id_pengajuan'] ?>" style="text-decoration:none; color: blue">Hapus</a>
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