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

    $sql = 'SELECT *
            FROM tb_jabatan
            INNER JOIN tb_pegawai
                ON tb_pegawai.id_jabatan = tb_jabatan.id_jabatan
            WHERE id_pegawai = :id_pegawai';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $statement->execute();
    $user_jabatan = $statement->fetch(PDO::FETCH_ASSOC);


    $sql = 'SELECT *
            FROM tb_bidang
            INNER JOIN tb_pegawai
                ON tb_pegawai.id_bidang = tb_bidang.id_bidang
            WHERE id_pegawai = :id_pegawai';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $statement->execute();
    $user_bidang = $statement->fetch(PDO::FETCH_ASSOC);


    $sql = 'SELECT *
            FROM tb_ruangan
            INNER JOIN tb_pegawai
                ON tb_pegawai.id_ruangan = tb_ruangan.id_ruangan
            WHERE id_pegawai = :id_pegawai';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $statement->execute();
    $user_ruangan = $statement->fetch(PDO::FETCH_ASSOC);


    $sql = 'SELECT *
            FROM tb_pegawai
            WHERE id_pegawai = :id_pegawai';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user['jenis_kelamin'] == 'L') {
        $jk = 'Laki-laki';

    } else {
        $jk = 'Perempuan';

    }

    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $kecamatan = $_POST['kecamatan'];
        $kabupaten = $_POST['kabupaten'];
        $negara = $_POST['negara'];
        $agama = $_POST['agama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $golongan_darah = $_POST['golongan_darah'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $status_kawin = $_POST['status_kawin'];
        $no_ktp = $_POST['no_ktp'];
    
        if ($_FILES['foto_profile']['size'] != 0) {
            $foto_profile= $_FILES['foto_profile']['tmp_name'];
            $img_blob = fopen($foto_profile, "rb");  

        } else {
            $img_blob = $user['foto_profile'];

        }

        if ($_FILES['file_ktp']['size'] != 0) {
            $file_ktp = $_FILES['file_ktp']['tmp_name'];
            $pdf_blob = fopen($file_ktp, "rb");

        } else {
            $pdf_blob = $user['file_ktp'];

        }
       
    
        try {
            $sql = "UPDATE tb_pegawai
                    SET 
                        email = :email,
                        nama = :nama,
                        no_hp = :no_hp,
                        alamat = :alamat,
                        kecamatan = :kecamatan,
                        kabupaten = :kabupaten,
                        negara = :negara,
                        agama = :agama,
                        jenis_kelamin = :jenis_kelamin,
                        golongan_darah = :golongan_darah,
                        tempat_lahir = :tempat_lahir,
                        tgl_lahir = :tgl_lahir,
                        status_kawin = :status_kawin,
                        no_ktp = :no_ktp,
                        foto_profile = :foto_profile,
                        file_ktp = :file_ktp
                    WHERE 
                        id_pegawai = :id_pegawai;
            ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':no_hp', $no_hp);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':kecamatan', $kecamatan);
            $stmt->bindParam(':kabupaten', $kabupaten);
            $stmt->bindParam(':negara', $negara);
            $stmt->bindParam(':agama', $agama);
            $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
            $stmt->bindParam(':golongan_darah', $golongan_darah);
            $stmt->bindParam(':tempat_lahir', $tempat_lahir);
            $stmt->bindParam(':tgl_lahir', $tgl_lahir);
            $stmt->bindParam(':status_kawin', $status_kawin);
            $stmt->bindParam(':no_ktp', $no_ktp);
            $stmt->bindParam(':foto_profile', $img_blob, PDO::PARAM_LOB);
            $stmt->bindParam(':file_ktp', $pdf_blob, PDO::PARAM_LOB);
            $stmt->bindParam(':id_pegawai', $_SESSION["id_pegawai"], PDO::PARAM_STR);
            
            if ($stmt->execute() === FALSE) {
                echo 'Could not save information to the database';
    
            } else {
                header("Location: profile_admin.php");
    
            }
    
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   
    
    }    

}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Edit</title>
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
    <!-- END Nav bar div -->

    <form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
        <!-- Informasi Umum Pegawai Div -->
        <div class="container" style="padding-top:20vh;">
            <div class="d-lg-flex flex-row justify-content-center">
                <div>
                    <img class="foto-profile" src="data:image/png;charset=utf8;base64,<?php echo base64_encode($user['foto_profile']); ?>" height="250px" style="margin-right: 9vw; margin-left: 1vw; margin-top: 5vh; border-radius:30px;"/>
                    <input type="file" name="foto_profile" accept="image/*">
                </div>
                <div class="container" style="background-color: #ffff; border-radius: 26px; width: 70%;">
                    <div class="d-flex flex-column justify-content-evenly" style="margin-top: 3vh; margin-left: 3vw; margin-right: 3vw; margin-bottom: 5vh;">
                        <h2>Informasi Umum Pegawai</h2>
                        <table class="table table-bordered" style="margin-top: 2vh; width:100%">
                            <tbody>
                                <tr>
                                <td>NIP<br><?= $user['nip']; ?></td>
                                <td>Jabatan<br><?= $user_jabatan['nama_jabatan']; ?></td>
                                </tr>
                                <tr>
                                <td>Bidang<br><?= $user_bidang['nama_bidang']; ?></td>
                                <td>Jenis Kontrak<br><?= $user['jenis_kontrak']; ?></td>
                                </tr>
                                <tr>
                                <td>Ruang Kerja<br><?= $user_ruangan['nama_ruangan']; ?></td>
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
                        <td colspan="2">Nama Lengkap<br>
                        <input type="text" name="nama" value="<?= $user['nama']; ?>"/>
                        </td>
                        </tr>
                        <tr>
                        <td>Tempat Lahir<br>
                        <input type="text" name="tempat_lahir" value="<?= $user['tempat_lahir']; ?>"/>
                        </td>
                        <td>Tanggal Lahir<br>
                        <input type="date" name="tgl_lahir" value="<?= $user['tgl_lahir']; ?>"/>
                        </td>
                        </tr>
                        <tr>
                        <td>Jenis Kelamin<br>
                        <select name="jenis_kelamin">
                            <option value="<?= $user['jenis_kelamin']; ?>" selected hidden><?= $jk; ?></option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>     
                        </select>    
                        </td>
                        <td>Agama<br>
                        <select name="agama">
                            <option value="<?= $user['agama']; ?>" selected hidden><?= $user['agama']; ?></option>
                            <option value="Hindu">Hindu</option>
                            <option value="Islam">Islam</option>     
                            <option value="Kristen Katolik">Kristen Katolik</option>    
                            <option value="Kristen Protestan">Kristen Protestan</option>    
                            <option value="Buddha">Buddha</option>
                            <option value="Kong Hu Chu">Kong Hu Chu</option> 
                        </select> 
                        </td>
                        </tr>
                        <tr>
                        <td>Status Perkawinan<br>
                        <select name="status_kawin">
                            <option value="<?= $user['status_kawin']; ?>" selected hidden><?= $user['status_kawin']; ?></option>
                            <option value="Kawin">Kawin</option>
                            <option value="Belum Kawin">Belum Kawin</option> 
                        </select>    
                        </td>
                        <td>Golongan Darah<br>
                        <select name="golongan_darah">
                            <option value="<?= $user['golongan_darah']; ?>" selected hidden><?= $user['golongan_darah']; ?></option>
                            <option value="A">A</option>
                            <option value="B">B</option> 
                            <option value="AB">AB</option> 
                            <option value="O">O</option> 
                        </select>    
                        </td>
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
                        <td colspan="2">Negara<br>
                        <input type="text" name="negara" value="<?= $user['negara']; ?>"/>
                        </td>
                        </tr>
                        <tr>
                        <td>Kabupaten<br>
                        <input type="text" name="kabupaten" value="<?= $user['kabupaten']; ?>"/>
                        </td>
                        <td>Kecamatan<br>
                        <input type="text" name="kecamatan" value="<?= $user['kecamatan']; ?>"/>
                        </td>
                        </tr>
                        <tr>
                        <td colspan="2">Alamat<br>
                        <input type="text" name="alamat" value="<?= $user['alamat']; ?>"/>
                        </td>
                        </tr>
                        <tr>
                        <td>Nomor KTP<br>
                        <input type="text" name="no_ktp" value="<?= $user['no_ktp']; ?>"/>
                        </td>
                        <td>File KTP<br>
                        <input type="file" name="file_ktp" accept=".pdf"/>
                        <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
                        </td>
                        </tr>
                        <tr>
                        <td>Nomor Telepon<br>
                        <input type="tel" name="no_hp" value="<?= $user['no_hp']; ?>"/>
                        </td>
                        <td>Email<br>
                        <input type="email" name="email" value="<?= $user['email']; ?>"/>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Informasi Pribadi Div -->
        
        <!-- Button Div -->
        <div class="container d-lg-flex flex-row justify-content-between" style="margin-top: 5vh;">  
            <a href="profile_admin.php">
                <button type="button" class="btn btn-danger btn-lg">Cancel</button>
            </a>
            <input type="submit" name="submit" class="btn btn-success btn-lg"></input>
        </div>
        <!-- END Button Div -->
    </form>

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