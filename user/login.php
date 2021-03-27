<?php
session_start();
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
    <?php include_once("../user/navbar.php"); ?>
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
                        <td><input type="text" name="user" placeholder="Email" style="border: none; border-bottom: 1px solid; width: 100%;"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input type="password" name="pass" placeholder="Password" style="border: none; border-bottom: 1px solid; width: 100%;"></td>
                    </tr>
                </table>
                <input type="submit" name="login" value="LOGIN">
            </form>
            <?php
                    // jika ada tombol login(tombol login ditekan)
                    if (isset($_POST['login']))
                        {
                            // lakukan query cek akun ditabel pelanggan DB
                            $ambil=$koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$_POST[user]'
                            AND password_pelanggan='$_POST[pass]'");
                            // Mengitung akun yang terambil
                            $yangcocok=$ambil->num_rows;
                            // jika 1 akun yang cocok, maka diloginkan 
                            if ($yangcocok==1)
                                {
                                    $_SESSION["pelanggan"]=$ambil->fetch_assoc();
                                    echo "<div class='alert alert-info'>Login Sukses</div>";

                                    if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
                                    {
                                        echo "<meta http-equiv='refresh' content='1;url=../user/checkout.php'>";    
                                    }
                                    else
                                    {
                                        echo "<meta http-equiv='refresh' content='1;url=../user/profil.php'>";   
                                    }
                                    
                                }
                            else
                                {
                                    echo "<div class='alert alert-danger'>Login Gagal</div>";
                                    echo "<meta http-equiv='refresh' content='1;url=../user/login.php'>";
                                }
                        }
            ?>
            <div class="belumakun">
            <p>Belum punya akun?</p><a href="daftar.php">Daftar</a>
            </div>
        </div>
    </div>

    <!-- REGISTER END -->
</body>
</html>