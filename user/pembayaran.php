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

// mendapatkan id_transaksi dari url
$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM transaksi WHERE id_transaksi='$idpem'");
$detpem = $ambil->fetch_assoc();

// mendapatkan id_pelanggan yang beli
$id_pelanggan_beli = $detpem["id_pelanggan"];
//mendapatkan id peangglan yang login
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if($id_pelanggan_login!==$id_pelanggan_beli)
{
    echo "<script>alert('Jangan nakal');</script>";
    echo "<script>location='profil.php';</script>";
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
    <script src="js/main.js"></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include_once("../user/navbar.php"); ?>
    <!-- NAVBAR END -->

    <!-- KONFIRMASI PEMBAYARAN --> 
    <div class="konfirmasi-container">
        <div class="konfirmasi-wrap">
            <img src="../img/konfirmasi.png">
            <div class="form-wrap">
                <p class="text">Silahkan lakukan konfirmasi pembayaran dibawah ini, agar pesanan anda kami proses ke pengiriman</p><br>
                <strong>Total tagihan anda Rp. <?php echo number_format($detpem["total_transaksi"]) ?></strong>
                <form id="konfirmasi" method="post" enctype="multipart/form-data">
                    <div class="nama">
                        <p class="nama-bank">Nama Bank :</p>
                        <input class="form" name="bank" type="text">
                    </div>
                    <div class="nama-account-bank">
                            <p class="title">Nama Penyetor :</p>
                            <input class="form" name="nama" type="text">
                    </div>
                    <div class="nomor-order">
                            <p class="title">Jumlah :</p>
                            <input class="form" name="jumlah" type="number" min="1">
                    </div>
                    <p class="bukti-transfer">Bukti Trasfer :</p>
                    <div class="bukti-container">
                            <img src="../icon/bukti-upload.svg">
                            <input class="bukti-form" name="bukti" type="file">
                    </div>
                    <input type="submit" class="konfirmasi-button" name="konfirmasi" value="KONFIRMASI">
                </form> 

            </div>
            <?php
                // jika ada tombol konfirmasi
                if(isset($_POST["konfirmasi"]))
                {
                    //upload foto bukti
                    $namabukti = $_FILES["bukti"]["name"];
                    $lokasibukti = $_FILES["bukti"]["tmp_name"];
                    $namafiks = date("YmdHis").$namabukti;
                    move_uploaded_file($lokasibukti, "../bukti_pembayaran/$namafiks");

                    $nama = $_POST["nama"];
                    $bank = $_POST["bank"];
                    $jumlah = $_POST["jumlah"];
                    $tanggal = date("Y-m-d");
                    
                    // simpan pembayaran
                    $koneksi->query("INSERT INTO pembayaran(id_transaksi,nama,bank,jumlah,tanggal,bukti) VALUES('$idpem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

                    // update dari pending ke terbayar
                    $koneksi->query("UPDATE transaksi SET status_transaksi='Terbayar' WHERE id_transaksi='$idpem'");

                        echo "<script>alert('Terima kasih sudah melakukan konfirmasi');</script>";
                        echo "<script>location='profil.php';</script>";
                }
                ?>
        </div>
    </div>
    <!-- KONFIRMASI PEMBAYARAN END --> 
</body>
</html>