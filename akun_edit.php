<?php 

$id_pegawai = $_GET['id_pegawai'];

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


$sql = 'SELECT *
FROM tb_pegawai
WHERE id_pegawai = :id_pegawai';

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_pegawai', $id_pegawai, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if ($user['jenis_kelamin'] == 'L') {
    $jk = 'Laki-laki';

} else {
    $jk = 'Perempuan';

}


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
    $id_jabatan = $_POST['jabatan'];
    $id_bidang = $_POST['bidang'];
    $id_ruangan = $_POST['ruangan'];
    $nip = $_POST['nip'];
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
    $tahun_masuk = $_POST['tahun_masuk'];
    $jenis_kontrak = $_POST['jenis_kontrak'];
    

    if ($_POST['password'] == $user['password']) {
        $password = $user['password'];

    } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    }


    if ($_FILES['foto_profile']['size'] != 0) {
        // $name = $_FILES['foto_profile']['name'];
        // $foto_profile = $_FILES['foto_profile']['tmp_name'];
        // $foto_profile = base64_encode(file_get_contents(addslashes($foto_profile)));
        
        $foto_profile= $_FILES['foto_profile']['tmp_name'];
        $img_blob = fopen($foto_profile, "rb"); 

    } else {
        $img_blob = $user['foto_profile'];

    }


    if ($_FILES['file_ktp']['size'] != 0) {
        //attached pdf file information
        // $file_ktp_name = $_FILES['file_ktp']['name'];
        
        $file_ktp = $_FILES['file_ktp']['tmp_name'];
        $pdf_blob = fopen($file_ktp, "rb");

    } else {
        $pdf_blob = $user['file_ktp'];

    }
    
   
    try {
        $sql = "UPDATE tb_pegawai
                SET
                    id_jabatan = :id_jabatan,
                    id_bidang = :id_bidang,
                    id_ruangan = :id_ruangan,
                    username = :username,
                    email = :email,
                    password_pg = :password_pg,
                    nip = :nip,
                    nama = :nama,
                    foto_profile = :foto_profile,
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
                    file_ktp = :file_ktp,
                    tahun_masuk = :tahun_masuk,
                    jenis_kontrak = :jenis_kontrak
                WHERE 
                    id_pegawai = :id_pegawai;
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

}

?>


<form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
    <div>
        <label for="username">Username*</label>
        <input type="text" name="username" value="<?= $user['username']; ?>"/>
    </div>
    <div>
        <label for="email">Email*</label>
        <input type="email" name="email" value="<?= $user['email']; ?>"/>
    </div>
    <div>
        <label for="password">Password*</label>
        <input type="password" name="password" value="<?= $user['password']; ?>"/>
    </div>
    <div>
        <label for="jabatan">Jabatan*</label>
        <select name="jabatan">
        <option value="<?= $user['id_jabatan']; ?>" selected hidden><?= $user['jabatan']; ?></option>
        <?php while ($jbt = $statement_jabatan->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?php echo $jbt['id_jabatan'] ?>"><?php echo $jbt['nama_jabatan'] ?></option>
        <?php endwhile; ?>
        </select>    
    </div>
    <div>
        <label for="nip">NIP*</label>
        <input type="text" name="nip" value="<?= $user['nip']; ?>"/>
    </div>
    <div>
        <label for="nama">Nama*</label>
        <input type="text" name="nama" value="<?= $user['nama']; ?>"/>
    </div>
    <div>
        <label for="tahun_masuk">Tahun Masuk*</label>
        <input type="number" name="tahun_masuk" min="1950" max="2023" step="1" value="<?= $user['tahun_masuk']; ?>"/>
    </div>
    <div>
        <label for="jenis_kontrak">Jenis Kontrak*</label>
        <input type="text" name="jenis_kontrak" value="<?= $user['jenis_kontrak']; ?>"/>
    </div>
    <div>
        <label for="no_ktp">No.KTP*</label>
        <input type="text" name="no_ktp" value="<?= $user['no_ktp']; ?>"/>
    </div>
    <div>
        <label for="file_ktp">File KTP</label>
        <input type="file" name="file_ktp" accept=".pdf"/>
        <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
    </div>
    <div>
        <label for="bidang">Bidang</label>
        <select name="bidang">
            <option value="<?= $user['id_bidang']; ?>" selected hidden><?= $user['nama_bidang']; ?></option>
        <?php while ($bdg = $statement_bidang->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?php echo $bdg['id_bidang'] ?>"><?php echo $bdg['nama_bidang'] ?></option>
        <?php endwhile; ?>
        </select>    
    </div>
    <div>
        <label for="ruangan">Ruangan</label>
        <select name="ruangan">
            <option value="<?= $user['id_ruangan']; ?>" selected hidden><?= $user['nama_ruangan']; ?></option>
        <?php while ($rgn = $statement_ruangan->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?php echo $rgn['id_ruangan'] ?>"><?php echo $rgn['nama_ruangan'] ?></option>
        <?php endwhile; ?>
        </select>    
    </div>
    <div>
        <label for="foto_profile">Foto Profile</label>
        <input type="file" name="foto_profile" accept="image/*">
    </div>
    <div>
        <label for="no_hp">Telepon</label>
        <input type="tel" name="no_hp" value="<?= $user['no_hp']; ?>"/>
    </div>
    <div>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?= $user['alamat']; ?>"/>
    </div>
    <div>
        <label for="kecamatan">Kecamatan</label>
        <input type="text" name="kecamatan" value="<?= $user['kecamatan']; ?>"/>
    </div>
    <div>
        <label for="kabupaten">Kabupaten</label>
        <input type="text" name="kabupaten" value="<?= $user['kabupaten']; ?>"/>
    </div>
    <div>
        <label for="negara">Negara</label>
        <input type="text" name="negara" value="<?= $user['negara']; ?>"/>
    </div>
    <div>
        <label for="agama">Agama</label>
        <select name="agama">
            <option value="<?= $user['agama']; ?>" selected hidden><?= $user['agama']; ?></option>
            <option value="Hindu">Hindu</option>
            <option value="Islam">Islam</option>     
            <option value="Kristen Katolik">Kristen Katolik</option>    
            <option value="Kristen Protestan">Kristen Protestan</option>    
            <option value="Buddha">Buddha</option>
            <option value="Kong Hu Chu">Kong Hu Chu</option> 
        </select>    
    </div>
    <div>
        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin">
            <option value="<?= $user['jenis_kelamin']; ?>" selected hidden><?= $jk; ?></option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>     
        </select>    
    </div>
    <div>
        <label for="golongan_darah">Golongan Darah</label>
        <select name="golongan_darah">
            <option value="<?= $user['golongan_darah']; ?>" selected hidden><?= $user['golongan_darah']; ?></option>
            <option value="A">A</option>
            <option value="B">B</option> 
            <option value="AB">AB</option> 
            <option value="O">O</option> 
        </select>    
    </div>
    <div>
        <label for="tempat_lahir">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" value="<?= $user['tempat_lahir']; ?>"/>
    </div>
    <div>
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" value="<?= $user['tgl_lahir']; ?>"/>
    </div>
    <div>
        <label for="status_kawin">Status Kawin</label>
        <select name="status_kawin">
            <option value="<?= $user['status_kawin']; ?>" selected hidden><?= $user['status_kawin']; ?></option>
            <option value="Kawin">Kawin</option>
            <option value="Belum Kawin">Belum Kawin</option> 
        </select>    
    </div>
    <div>
        <input type="submit" name="submit" value="Edit Akun"/>
    </div>
</form>
