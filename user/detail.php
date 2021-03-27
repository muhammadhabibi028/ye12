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
    <script src="js/main.js"></script>
</head>
<body>
    <!-- NAVBAR -->
    <?php include_once("../user/navbar.php"); ?>
    <!-- NAVBAR END -->

    <!-- PRODUCT DETAILS -->
    <div class="product-details-container">
        <?php
            $id_produk = $_GET["id"];
            $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $detail=$ambil->fetch_assoc();
        ?>
        <div class="container">
        <div class="product-img">
            <img src="../pic_produk/<?php echo $detail['pic_produk']; ?>" width="100%">
            
        </div>
        <div class="desc-product">
            <p class="title"><?php echo $detail['nama_produk']; ?></p>
            <p class="price" style="color: #656565;">Rp. <?php echo number_format($detail['harga_produk']); ?></p>
            <h5>Stok : <?php echo $detail['stok_produk'] ?></h5>
            <!-- <div class="size">
                <p class="sizetext">Size</p>
                <p class="space">:</p>
                <span class="input">
                <input type="radio">S</input>
                <input type="radio">M</input>
                <input type="radio">L</input>
                <input type="radio">XL</input>
                <input type="radio">XXL</input>
                </span>
            </div> --> 
            <form method="post">
            <div class="quantity">
                <p class="qty">Quantity :</p>
                <input type="number" min="1" name="jumlah" max="<?php echo $detail['stok_produk'] ?>">
                <button class="beli" name="beli">BELI</button>
            </div>
            </form>
            <?php
                if(isset($_POST["beli"]))
                {
                    $jumlah = $_POST["jumlah"];

                    $_SESSION["keranjang"]["$id_produk"] = $jumlah;

                    echo "<script>alert('Produk telah masuk ke keranjang');</script>";
                    echo "<script>location='keranjang.php';</script>";
                }
            ?>
            <div class="description">
                <p>Deskripsi Produk :</p>
                <p class="longdesc"><?php echo $detail['deskripsi_produk']; ?></p>
            </div>
        </div>
        </div>
    </div>
    <!-- PRODUCT DETAILS END -->
</body>
</html>