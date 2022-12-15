<?php
require "dbConnection.php";

// Press Login
if(isset($_POST["submit"])) {
    // Pindahkan data dari form ke variabel
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query update data
    $sqlSelect = "SELECT * FROM tb_pegawai WHERE username_pegawai = '$username' and password_pegawai = '$password'";
    $data = mysqli_query($conn, $sqlSelect);
    
    // menghitung jumlah data yang ditemukan
    $cek = mysqli_num_rows($data);
    
    if($cek > 0){
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("location:beranda.php");
    }else{
        header("location:login.php?pesan=gagal");
    }

    // Cek keberhasilan proses
    if($cek > 0) {
        echo "
            <script>
                alert ('Berhasil Login');
            </script>
        ";
    } else {
        echo "
            <script>
                alert ('Gagal Login');
            </script>
        ";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
  <body class="d-flex flex-column min-vh-100" style="background-color: #F8F2DE;">

    <div class="container">
        <div class="d-flex flex-column justify-content-start halaman">
            <div class="d-flex flex-row justify-content-center judul">
                <img src="img/char-logo.png" alt="logo-rumah-sakit" height="70" style="padding-right: 18px;">
                <img src="img/title-logo-black.png" alt="logo-rumah-sakit" height="70" style="padding-right: 7px">
            </div>
            <div class="d-flex flex-row justify-content-center">
            <form class="form" id="form" method="POST">
                    <div class="d-flex flex-column justify-content-center input">    
                        <p>username</p>
                        <input type="text" name="username" id="username" placeholder="Masukan Username">
                    </div>
                    <div class="d-flex flex-column justify-content-center input">    
                        <p>password</p>
                        <input type="password" name="password" id="password" placeholder="Masukan Password">
                    </div>
                    <div class="d-flex flex-column justify-content-center input">    
                    <button type="submit" name="submit" value="Login" class="btn btn-primary">login</button>
                    </div>
            </form>
            </div>
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