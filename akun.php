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
    require "./dbConnection.php";

    $sql = 'SELECT pg.*, j.*, b.*, r.*
            FROM tb_pegawai AS pg
            LEFT JOIN tb_jabatan AS j
            ON j.id_jabatan = pg.id_jabatan
            LEFT JOIN tb_bidang AS b
            ON b.id_bidang = pg.id_bidang
            LEFT JOIN tb_ruangan AS r
            ON r.id_ruangan = pg.id_ruangan
            ORDER BY pg.id_pegawai
            ;'
    ;

    $statement = $pdo->query($sql);
    
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Akun Pegawai</title>
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
                                    <a class="nav-link" aria-current="page" href="beranda-after_admin.php">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="jadwal_admin.php">Jadwal</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="akun.php">Akun</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="jabatan.php">Jabatan</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="bidang.php">Bidang</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="ruangan.php">Ruangan</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="pengumuman_admin.php">Pengumuman</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="panduan_admin.php">Panduan</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="pengajuan_admin.php">Pengajuan</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link" href="profile_admin.php">Profile</a>
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
                <h2>Data Pegawai</h2>
                <table class="table table-bordered" style="margin-top: 2vh;">
                    <tbody>
                        <tr>
                        <th colspan="12">
                            <a href="./akun_input.php" style="text-decoration:none; color: blue">Buat Akun</a>
                        </th>
                        </tr>
                        <tr>
                        <th>Id</th>
                        <th>Jabatan</th>
                        <th>Bidang</th>
                        <th>Ruangan</th>
                        <th>Email</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>No.HP</th>
                        <th>Alamat</th>
                        <th>Tahun Masuk</th>
                        <th>Jenis Kontrak</th>
                        <th></th>
                        </tr>
                        <?php while ($user = $statement->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td>
                                    <?php echo $user['id_pegawai'] ?>
                                </td>
                                <td>
                                    <?php echo $user['nama_jabatan'] ?>
                                </td>
                                <td>
                                    <?php echo $user['nama_bidang'] ?>
                                </td>
                                <td>
                                    <?php echo $user['nama_ruangan'] ?>
                                </td>
                                <td>
                                    <?php echo $user['email'] ?>
                                </td>
                                <td>
                                    <?php echo $user['nip'] ?>
                                </td>
                                <td>
                                    <?php echo $user['nama'] ?>
                                </td>
                                <td>
                                    <?php echo $user['no_hp'] ?>
                                </td>
                                <td>
                                    <?php echo $user['alamat'] ?>
                                </td>
                                <td>
                                    <?php echo $user['tahun_masuk'] ?>
                                </td>
                                <td>
                                    <?php echo $user['jenis_kontrak'] ?>
                                </td>
                                <td>
                                    <a href="./akun_edit.php?id_pegawai=<?= $user['id_pegawai'] ?>" style="text-decoration:none; color: blue">Edit</a>
                                    |
                                    <a href="./akun_hapus.php?id_pegawai=<?= $user['id_pegawai'] ?>" style="text-decoration:none; color: red">Hapus</a>
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