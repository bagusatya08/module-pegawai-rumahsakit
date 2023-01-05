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

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // $mysqli = require __DIR__ . "/dbConnection.php";

    // // connect to the database and select the publisher
    require './dbConnection.php';

    // Pindahkan data dari form ke variabel
    $username_email = $_POST["username_email"];
    $password = $_POST["password"];
    
    // $sql = "SELECT * FROM tb_pegawai 
    //         WHERE username = '$username'";
    
    // $result = mysqli_query($conn, $sql);
    
    // $user = mysqli_fetch_array($result);


    $sql = 'SELECT pg.*, j.*
            FROM tb_pegawai AS pg
            INNER JOIN tb_jabatan AS j
            ON j.id_jabatan = pg.id_jabatan
            WHERE username = :username
            OR email = :email
            ;
    ';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':username', $username_email, PDO::PARAM_STR);
    $statement->bindParam(':email', $username_email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // echo $username;
    // echo $password;
    // echo password_verify($password, $user["password_pg"]);
    
    if ($user) {
        if (password_verify($password, $user["password_pg"])) {
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["id_pegawai"] = $user["id_pegawai"];

            // session expired
            $_SESSION['EXPIRES'] = time() + 1800; //second

            if ($user["nama_jabatan"] == 'Admin') {
                header("Location: beranda-after_admin.php");
                exit;

            } else if ($user["nama_jabatan"] == 'Kepala Bidang' || $user["nama_jabatan"] == 'Kepala Ruangan') {
                header("Location: beranda-after_kepala.php");
                exit;    

            } else if ($user["nama_jabatan"] == 'Pegawai') {
                header("Location: beranda-after.php");
                exit;    

            }
            
        }
    }

    $is_invalid = true;    
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
                        <p>username/email</p>
                        <input type="text" name="username_email" id="username" placeholder="Masukan Username" value="<?= htmlspecialchars($_POST["username_email"] ?? "") ?>">
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