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
    <?php include("../user/navbar.php"); ?>
    <!-- NAVBAR END -->

    <!-- CAROUSEL -->
    <div class="container">
        <div class="content">
            <img src="../img/img1.jpg">
            <div class="caption">
                <h1>BRASCO FASHION</h1>
            </div>
        </div>
    </div>
    <!-- CAROUSEL END -->

    <!-- POST -->
    <div class="post-container">

        <?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
        <?php while($perproduk = $ambil->fetch_assoc()) { ?>
        <div class="post">
            <div class="img">
                <img src="../pic_produk/<?php echo $perproduk['pic_produk']; ?>" alt="">
            </div>
            <div class="text">
                <p class="title"><?php echo $perproduk['nama_produk']; ?></p>
                <p class="price">Rp. <?php echo number_format($perproduk['harga_produk']); ?></p>
            </div>
            <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>"> <button type="button" class="beli">Beli</button> </a>
            <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>"> <button type="button" class="detail">Detail</button> </a>
        </div>
        <?php } ?>
    </div>
    <!-- POST END -->
</body>
</html>
