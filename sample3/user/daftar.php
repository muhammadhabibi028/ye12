<?php
//koneksi ke database
include('../user/koneksi.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Brasco Indonesia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">
    <script src="../js/main.js"></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include("../user/navbar.php"); ?>
    <!-- NAVBAR END -->

    <!-- REGISTER --> 

    <div class="register-container">
        <div class="register-wrap">
            <img class="logo" src="../icon/logo.svg" width="186px" height="82px">
            <form id="register" method="post">
                <table>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" name="email" placeholder="Email" required style="border: none; border-bottom: 1px solid; width: 100%;"></td>
                    </tr>
                    <tr> 
                        <td>Nama</td>
                        <td>:</td>
                        <td><input type="text" name="nama" placeholder="Nama" required style="border: none; border-bottom: 1px solid; width: 100%;"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><input type="text" name="telepon" placeholder="Phone" required style="border: none; border-bottom: 1px solid; width: 100%;"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input type="password" name="password" placeholder="Password" required style="border: none; border-bottom: 1px solid; width: 100%;"></td>
                    </tr>
                </table>
                <input type="submit" name="daftar" value="DAFTAR">
            </form>
            <?php
            if(isset($_POST["daftar"]))
            {
                $email = $_POST["email"];
                $nama = $_POST["nama"];
                $telepon = $_POST["telepon"];
                $password = $_POST["password"];

                $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                $yangcocok = $ambil->num_rows;
                if($yangcocok==1)
                {
                    echo "<script>alert('Email sudah digunakan');</script>";
                    echo "<script>location='daftar.php';</script>";
                }
                else
                {
                    $koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan)
                        VALUES('$email','$password','$nama','$telepon')"); 
                    echo "<script>alert('Pendaftaran sukses');</script>";
                    echo "<script>location='login.php';</script>";   
                }


            }
            ?>
            <div class="belumakun">
            <p>Sudah punya akun?</p><a href="#">Login</a>
            </div>
        </div>
    </div>

    <!-- REGISTER END -->
</body>
</html>