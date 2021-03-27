<?php
//koneksi ke database
include('../admin/koneksi.php');
?>

<?php

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotoproduk = $pecah['pic_produk'];
if (file_exists("../pic_produk/$fotoproduk"))
{
    unlink("../pic_produk/$fotoproduk");
}
$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id]'");

echo "<script>alert('Produk Terhapus');</script>";
echo "<script>location='produk.php';</script>";

?>