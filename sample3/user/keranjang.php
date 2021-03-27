<?php
session_start();
//koneksi ke database
include('../user/koneksi.php');

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    echo "<script>alert('Keranjang kosong, silahkan belanja dulu');</script>";
    echo "<script>location='index.php';</script>";
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
    <div class="postkeranjang-container">
        <h1>Keranjang Belanja</h1>
        <div class="container">
            <div class="table">
                <table class="krjg">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subharga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>

                        <!--Menampilkan produk yang sedang diperulangkan berdasarkan id_produk-->
                        <?php
                        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                        $pecah = $ambil->fetch_assoc();
                        $subharga = $pecah["harga_produk"]*$jumlah;
                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['nama_produk']; ?></td>
                                <td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
                                <td><?php echo $jumlah; ?></td>
                                <td>Rp. <?php echo number_format($subharga); ?></td>
                                <td>
                                    <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>"><button class="btn btn-red">Hapus</button></a>
                                </td>
                        </tr>
                        <?php $nomor++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
                <br>
                <a href="index.php"><button class="btn btn-black">Lanjutkan belanja</button></a>
                <a href="checkout.php"><button class="btn btn-black">Checkout</button></a>
        </div>        
    </div>
    <!-- POST END -->
</body>
</html>
