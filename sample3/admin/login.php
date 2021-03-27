<?php
//koneksi ke database
include('../admin/koneksi.php');
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
    <script src="js/main.js"></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include_once("../admin/navbar.php"); ?>
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
                    if (isset($_POST['login']))
                        {
                            $ambil=$koneksi->query("SELECT * FROM admin WHERE username='$_POST[user]'
                            AND password='$_POST[pass]'");
                            $yangcocok=$ambil->num_rows;
                            if ($yangcocok==1)
                                {
                                    $_SESSION['admin']=$ambil->fetch_assoc();
                                    echo "<div class='alert alert-info'>Login Sukses</div>";
                                    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                                }
                            else
                                {
                                    echo "<div class='alert alert-danger'>Login Gagal</div>";
                                    echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                }
                        }
            ?>
        </div>
    </div>

    <!-- REGISTER END -->
</body>
</html>