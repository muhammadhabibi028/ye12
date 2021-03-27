<?php
session_start();
//koneksi ke database
include('../user/koneksi.php');

if(!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"]))
{
    echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}
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

    <!-- POST --> 
    <div class="postprofil-atas">
        <div class="atas">
            <div class="info">
                <img src="../icon/profile.svg">
                <p class="nama"><?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></p>
                <a href="survey.php">Survey Kepuasan Pelanggan</a>
            </div>
        </div>
        <div class="bawah">
            <div class="emailnama">
                <div class="nama">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></td>
                    </tr>
                </table>
                <!-- <hr width="330.91px"> -->
                </div>
                <div class="email">
                <table>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $_SESSION["pelanggan"]["email_pelanggan"] ?></td>
                    </tr>
                </table>
                <!-- <hr width="330.91px"> -->
                </div>
            </div>
            <div class="phonepw">
                <div class="phone">
                <table>
                    <tr>
                        <td>Telepon</td>
                        <td>:</td>
                        <td><?php echo $_SESSION["pelanggan"]["telepon_pelanggan"] ?></td>
                    </tr>
                </table>
                </div>
                <div class="pw">
                    <table>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td><?php echo $_SESSION["pelanggan"]["password_pelanggan"] ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="postprofil-bawah">
        <h1>Riwayat Pembelian</h1>
            <div class="container">
                <div class="table">
                    <table class="prof">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor=1;
                            //mendapatkan id_pelanggan yang login dari session
                            $id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
                            $ambil = $koneksi->query("SELECT * FROM transaksi WHERE id_pelanggan='$id_pelanggan'");
                            while($pecah = $ambil->fetch_assoc()) { ?>
                            <tr>
                            <td><?php echo $nomor; ?> </td>
                            <td><?php echo $pecah["tanggal_transaksi"]; ?></td>
                           <td><?php echo $pecah["status_transaksi"]; ?><br>
                            <?php if(!empty($pecah['resi'])): ?>
                                Resi: <?php echo $pecah['resi']; ?>
                            <?php endif ?>
                           </td>
                            <td>Rp. <?php echo number_format($pecah["total_transaksi"]); ?></td>
                            <td>
                                <a href="nota.php?id=<?php echo $pecah["id_transaksi"] ?>"><button class="btn btn-yellow">Nota</button></a>

                                <?php if($pecah['status_transaksi']=="pending"): ?>
                                <a href="pembayaran.php?id=<?php echo $pecah["id_transaksi"]; ?>"><button class="btn btn-red">Pembayaran</button></a>
                                <?php else: ?>
                                    <a href="lihatpembayaran.php?id=<?php echo $pecah["id_transaksi"]; ?>"><button class="btn btn-black">Lihat Pembayaran</button></a>
                            <?php endif ?>
                            </td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--<div class="button">
                <button class="kiributton" type="button">TANYAKAN PRODUK</button>
                <button class="kananbutton" type="button">SUDAH DI TERIMA</button>
            </div>-->
    </div>
    <!-- POST END --> 
</body>
</html>