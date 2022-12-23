<?php 

require './dbConnection.php';

$sql = 'SELECT *
        FROM tb_jabatan';
$statement = $pdo->query($sql);


if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id_jabatan = $_POST['jabatan'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    // $foto_profile = $_FILES['foto_profile'];
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
    $bidang = $_POST['bidang'];
    $ruangan = $_POST['ruangan'];

    // $name = $_FILES['foto_profile']['name'];
    // $foto_profile = $_FILES['foto_profile']['tmp_name'];
    // $foto_profile = base64_encode(file_get_contents(addslashes($foto_profile)));
    $foto_profile= $_FILES['foto_profile']['tmp_name'];
    $img_blob = fopen($foto_profile, "rb");


    //attached pdf file information
    // $file_ktp_name = $_FILES['file_ktp']['name'];
    $file_ktp = $_FILES['file_ktp']['tmp_name'];
    $pdf_blob = fopen($file_ktp, "rb");

    try {
        $sql = "INSERT INTO tb_pegawai(
                        id_jabatan,
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
                        jenis_kontrak,
                        bidang,
                        ruangan
                    )VALUES(
                        :id_jabatan,
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
                        :jenis_kontrak,
                        :bidang,
                        :ruangan
                        );
                    ";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_jabatan', $id_jabatan);
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
        $stmt->bindParam(':bidang', $bidang);
        $stmt->bindParam(':ruangan', $ruangan);

        if ($stmt->execute() === FALSE) {

            echo 'Could not save information to the database';

        } else {

            echo 'Information saved';

        }

    } catch (PDOException $e) {

        echo 'Database Error '. $e->getMessage(). ' in '. $e->getFile().
        ': '. $e->getLine(); 

    }   

}

?>


<form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username"/>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email"/>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="text" name="password"/>
    </div>
    <div>
        <label for="jabatan">Jabatan</label>
        <select name="jabatan">
        <?php while ($jbt = $statement->fetch(PDO::FETCH_ASSOC)) : ?>
            <option value="<?php echo $jbt['id_jabatan'] ?>"><?php echo $jbt['nama_jabatan'] ?></option>
        <?php endwhile; ?>
        </select>    
    </div>
    <div>
        <label for="nip">NIP</label>
        <input type="text" name="nip"/>
    </div>
    <div>
        <label for="nama">Nama</label>
        <input type="text" name="nama"/>
    </div>
    <div>
        <label for="foto_profile">Foto Profile</label>
        <input type="file" name="foto_profile" accept="image/*">
    </div>
    <div>
        <label for="no_hp">Telepon</label>
        <input type="tel" name="no_hp"/>
    </div>
    <div>
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat"/>
    </div>
    <div>
        <label for="kecamatan">Kecamatan</label>
        <input type="text" name="kecamatan"/>
    </div>
    <div>
        <label for="kabupaten">Kabupaten</label>
        <input type="text" name="kabupaten"/>
    </div>
    <div>
        <label for="negara">Negara</label>
        <input type="text" name="negara"/>
    </div>
    <div>
        <label for="agama">Agama</label>
        <select name="agama">
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
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>     
        </select>    
    </div>
    <div>
        <label for="golongan_darah">Golongan Darah</label>
        <select name="golongan_darah">
            <option value="A">A</option>
            <option value="B">B</option> 
            <option value="AB">AB</option> 
            <option value="O">O</option> 
        </select>    
    </div>
    <div>
        <label for="tempat_lahir">Tempat Lahir</label>
        <input type="text" name="tempat_lahir"/>
    </div>
    <div>
        <label for="tgl_lahir">Tanggal Lahir</label>
        <input type="date" name="tgl_lahir"/>
    </div>
    <div>
        <label for="status_kawin">Status Kawin</label>
        <select name="status_kawin">
            <option value="Kawin">Kawin</option>
            <option value="Belum Kawin">Belum Kawin</option> 
        </select>    
    </div>
    <div>
        <label for="no_ktp">No.KTP</label>
        <input type="text" name="no_ktp"/>
    </div>
    <div>
        <label for="file_ktp">File KTP</label>
        <input type="file" name="file_ktp" accept=".pdf"/>
        <input type="hidden" name="MAX_FILE_SIZE" value="67108864"/>
    </div>
    <div>
        <label for="tahun_masuk">Tahun Masuk</label>
        <input type="number" name="tahun_masuk" min="1950" max="2023" step="1" value="2016"/>
    </div>
    <div>
        <label for="jenis_kontrak">Jenis Kontrak</label>
        <input type="text" name="jenis_kontrak"/>
    </div>
    <div>
        <label for="bidang">Bidang</label>
        <input type="text" name="bidang"/>
    </div>
    <div>
        <label for="ruangan">Ruangan</label>
        <input type="text" name="ruangan"/>
    </div>
    <div>
        <input type="submit" name="submit" value="Buat Akun"/>
    </div>
</form>
