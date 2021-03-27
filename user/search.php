<?php
session_start();
//koneksi ke database
include('../user/koneksi.php');
?>
<?php 
$keyword = $_GET["keyword"];

$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
    $semuadata[]=$pecah;
}
//echo "<pre>";
//print_r ($semuadata);
//echo "</pre>";

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
    <h3>Hasil Pencarian : <?php echo $keyword ?></h3>
    <?php
    if(empty($semuadata)): ?>
        <div>
            Produk <strong><?php echo $keyword ?></strong> tidak ditemukan
        </div>
    <?php endif ?>
    <!-- POST -->
    <div class="post-container">


       <?php foreach ($semuadata as $key => $value): ?>
        <div class="post">
            <div class="img">
                <img src="../pic_produk/<?php echo $value['pic_produk']; ?>" alt="">
            </div>
            <div class="text">
            <p class="title"><?php echo $value['nama_produk']; ?></p>
            <p class="price">Rp. <?php echo number_format($value['harga_produk']); ?></p>
            </div>
            <a href="beli.php?id=<?php echo $value['id_produk']; ?>"> <button type="button" class="beli">Beli</button> </a>
            <a href="detail.php?id=<?php echo $value['id_produk']; ?>"> <button type="button" class="detail">Detail</button> </a>
        </div>
    <?php endforeach ?>
    </div>
    <!-- POST END -->
</body>
</html>
