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
    require './dbConnection.php';

    $sql = 'SELECT *
            FROM tb_jabatan';
    $statement_jabatan = $pdo->query($sql);
    
    $sql = 'SELECT *
            FROM tb_ruangan';
    $statement_ruangan = $pdo->query($sql);
    
    $sql = 'SELECT *
            FROM tb_bidang';
    $statement_bidang = $pdo->query($sql);
    
    
    if (isset($_POST['submit']) 
            && $_POST['username'] != '' 
            && $_POST['email'] != '' 
            && $_POST['password'] != ''
            && $_POST['jabatan'] != 'null'
            && $nip = $_POST['nip'] != ''
            && $_POST['nama'] != ''
            && $_POST['tahun_masuk'] != ''
            && $_POST['jenis_kontrak'] != ''
            && $_POST['no_ktp'] != ''
        ) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $id_jabatan = $_POST['jabatan'];
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $no_hp = $_POST['no_hp'];
        $alamat = $_POST['alamat'];
        $kecamatan = $_POST['kecamatan'];
        $kabupaten = $_POST['kabupaten'];
        $negara = $_POST['negara'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $no_ktp = $_POST['no_ktp'];
        $tahun_masuk = $_POST['tahun_masuk'];
        $jenis_kontrak = $_POST['jenis_kontrak'];
    
        if ($_POST['bidang'] != 'null') {
            $id_bidang = $_POST['bidang'];
    
        } else {
            $id_bidang = null;
    
        }
    
        if ($_POST['ruangan'] != 'null') {
            $id_ruangan = $_POST['ruangan'];
    
        } else {
            $id_ruangan = null;
    
        }
    
        if ($_POST['agama'] != 'null') {
            $agama = $_POST['agama'];
    
        } else {
            $agama = null;
    
        }
    
        if ($_POST['jenis_kelamin'] != 'null') {
            $jenis_kelamin = $_POST['jenis_kelamin'];
    
        } else {
            $jenis_kelamin = null;
    
        }
    
        if ($_POST['golongan_darah'] != 'null') {
            $golongan_darah = $_POST['golongan_darah'];
    
        } else {
            $golongan_darah = null;
    
        }
    
        if ($_POST['status_kawin'] != 'null') {
            $status_kawin = $_POST['status_kawin'];
    
        } else {
            $status_kawin = null;
    
        }
    
        if ($_FILES['foto_profile']['size'] != 0) {
            // $name = $_FILES['foto_profile']['name'];
            // $foto_profile = $_FILES['foto_profile']['tmp_name'];
            // $foto_profile = base64_encode(file_get_contents(addslashes($foto_profile)));
            $foto_profile= $_FILES['foto_profile']['tmp_name'];
            $img_blob = fopen($foto_profile, "rb"); 
    
        } else {
            $img_blob = null;
    
        }
    
        if ($_FILES['file_ktp']['size'] != 0) {
            //attached pdf file information
            // $file_ktp_name = $_FILES['file_ktp']['name'];
            $file_ktp = $_FILES['file_ktp']['tmp_name'];
            $pdf_blob = fopen($file_ktp, "rb");
    
        } else {
            $pdf_blob = null;
    
        }
       
        try {
            $sql = "INSERT INTO tb_pegawai(
                            id_jabatan,
                            id_bidang,
                            id_ruangan,
                            username,
                            email,
                            password_pg,
                            nip,
                            nama,
                            foto_profile,
                            no_hp,
                            alamat,
                            kecamatan,
                            kabupaten,
                            negara,
                            agama,
                            jenis_kelamin,
                            golongan_darah,
                            tempat_lahir,
                            tgl_lahir,
                            status_kawin,
                            no_ktp,
                            file_ktp,
                            tahun_masuk,
                            jenis_kontrak
                        )VALUES(
                            :id_jabatan,
                            :id_bidang,
                            :id_ruangan,
                            :username,
                            :email,
                            :password_pg,
                            :nip,
                            :nama,
                            :foto_profile,
                            :no_hp,
                            :alamat,
                            :kecamatan,
                            :kabupaten,
                            :negara,
                            :agama,
                            :jenis_kelamin,
                            :golongan_darah,
                            :tempat_lahir,
                            :tgl_lahir,
                            :status_kawin,
                            :no_ktp,
                            :file_ktp,
                            :tahun_masuk,
                            :jenis_kontrak
                            );
                        ";
    
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_jabatan', $id_jabatan);
            $stmt->bindParam(':id_bidang', $id_bidang);
            $stmt->bindParam(':id_ruangan', $id_ruangan);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_pg', $password);
            $stmt->bindParam(':nip', $nip);
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':foto_profile', $img_blob, PDO::PARAM_LOB);
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
            $stmt->bindParam(':file_ktp', $pdf_blob, PDO::PARAM_LOB);
            $stmt->bindParam(':tahun_masuk', $tahun_masuk);
            $stmt->bindParam(':jenis_kontrak', $jenis_kontrak);
    
            if ($stmt->execute() === FALSE) {
                echo 'Could not save information to the database';
    
            }
    
        } catch (PDOException $e) {
            echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
            ': '. $e->getLine(); 
    
        }   

        header("location:akun.php");
    
    }    

}


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun</title>
    
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
                <h2>Buat Akun</h2>
            </header>

            <!-- Form -->
            <form class="form" id="form" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                <div class="form-control">
                    <label for="username">Username*</label>
                    <input type="text" name="username" id="username"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="email">Email*</label>
                    <input type="email" name="email" id="email"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="password">Password*</label>
                    <input type="password" name="password" id="password"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="jabatan">Jabatan*</label><br>
                    <select name="jabatan" id="jabatan">
                        <option value='null' selected hidden>Pilih</option>
                    <?php while ($jbt = $statement_jabatan->fetch(PDO::FETCH_ASSOC)) : ?>
                        <option value="<?php echo $jbt['id_jabatan'] ?>"><?php echo $jbt['nama_jabatan'] ?></option>
                    <?php endwhile; ?>
                    </select>    
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="nip">NIP*</label>
                    <input type="text" name="nip" id="nip"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="nama">Nama*</label>
                    <input type="text" name="nama" id="nama"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="tahun_masuk">Tahun Masuk*</label>
                    <input type="number" name="tahun_masuk" id="tahun_masuk" min="1950" max="2023" step="1" value="2016"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="jenis_kontrak">Jenis Kontrak*</label>
                    <input type="text" name="jenis_kontrak" id="jenis_kontrak"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="no_ktp">No.KTP*</label>
                    <input type="text" name="no_ktp" id="no_ktp"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="file_ktp">File KTP</label>
                    <input type="file" name="file_ktp" id="file_ktp" accept=".pdf"/>
                    <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="bidang">Bidang</label><br>
                    <select name="bidang" id="bidang">
                        <option value='null' selected hidden>Pilih</option>
                    <?php while ($bdg = $statement_bidang->fetch(PDO::FETCH_ASSOC)) : ?>
                        <option value="<?php echo $bdg['id_bidang'] ?>"><?php echo $bdg['nama_bidang'] ?></option>
                    <?php endwhile; ?>
                    </select>    
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="ruangan">Ruangan</label><br>
                    <select name="ruangan" id="ruangan">
                        <option value='null' selected hidden>Pilih</option>
                    <?php while ($rgn = $statement_ruangan->fetch(PDO::FETCH_ASSOC)) : ?>
                        <option value="<?php echo $rgn['id_ruangan'] ?>"><?php echo $rgn['nama_ruangan'] ?></option>
                    <?php endwhile; ?>
                    </select>    
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="foto_profile">Foto Profile</label>
                    <input type="file" name="foto_profile" id="foto_profile" accept="image/*">
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="no_hp">Telepon</label>
                    <input type="tel" name="no_hp" id="no_hp"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="kecamatan">Kecamatan</label>
                    <input type="text" name="kecamatan" id="kecamatan"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="kabupaten">Kabupaten</label>
                    <input type="text" name="kabupaten" id="kabupaten"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="negara">Negara</label>
                    <input type="text" name="negara" id="negara"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="agama">Agama</label><br>
                    <select name="agama" id="agama">
                        <option value='null' selected hidden>Pilih</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Islam">Islam</option>     
                        <option value="Kristen Katolik">Kristen Katolik</option>    
                        <option value="Kristen Protestan">Kristen Protestan</option>    
                        <option value="Buddha">Buddha</option>
                        <option value="Kong Hu Chu">Kong Hu Chu</option> 
                    </select>    
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="jenis_kelamin">Jenis Kelamin</label><br>
                    <select name="jenis_kelamin" id="jenis_kelamin">
                        <option value='null' selected hidden>Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>     
                    </select>    
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="golongan_darah">Golongan Darah</label><br>
                    <select name="golongan_darah" id="golongan_darah">
                        <option value='null' selected hidden>Pilih</option>
                        <option value="A">A</option>
                        <option value="B">B</option> 
                        <option value="AB">AB</option> 
                        <option value="O">O</option> 
                    </select>    
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="tgl_lahir">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir"/>
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                <div class="form-control">
                    <label for="status_kawin">Status Kawin</label><br>
                    <select name="status_kawin" id="status_kawin">
                        <option value='null' selected hidden>Pilih</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Belum Kawin">Belum Kawin</option> 
                    </select>    
                    <i class="fa fa-check-circle"></i>
                    <i class="fa fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <input type="submit" name="submit" class="submit" value="Buat Akun"/>
            </form>
            <!-- Close Form -->
        </div>
        <!-- Close Container -->
    </div>
    <!-- Close Box -->

    <!-- Validasi -->
    <script type="text/javascript" src="./js/validation_akun_input.js"></script>
</body>
</html>


