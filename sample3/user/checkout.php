<?php
session_start();
//koneksi ke database
include('../user/koneksi.php');

//jika tidak session pelangggan, maka lari ke login
if (!isset($_SESSION["pelanggan"]))
{
    echo "<script>alert('Silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}

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
    <?php include_once("../user/navbar.php"); ?>
    <!-- NAVBAR END -->
        
    <!-- POST -->
    <div class="postcheckout-container">
    <h1>Checkout</h1>
        <div class="container">
            <div class="table">
                <table class="cout">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php $totalbelanja = 0; ?> 
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
                    </tr>
                        <?php $nomor++ ?>
                        <?php $totalbelanja+=$subharga; ?>
                        <?php endforeach ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                    </tr>
                    </tfoot>
                </table>
                <div class="row-cout">
                    <form method="post">
                        <div class="row">
                                    <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>">
                                    <input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>">
                                    <select name="id_ongkir">
                                        <option value="">Pilih Ongkos Kirim</option>
                                        <?php
                                        $ambil = $koneksi->query("SELECT * FROM ongkir");
                                        while($perongkir = $ambil->fetch_assoc()){ ?>
                                        <option value="<?php echo $perongkir['id_ongkir'] ?>">
                                        <?php echo $perongkir['jasa_pengirim'] ?> -
                                        Rp. <?php echo number_format($perongkir['tarif']) ?>
                                        </option>
                                        <?php }?>
                                    </select><br>
                                    <textarea name="alamat" placeholder="Masukkan Alamat"></textarea>
                        </div><br>
                            <button class="btn btn-black" name="checkout">Checkout</button>
                    </form>

                        <?php
                        if(isset($_POST["checkout"]))
                        {
                            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                            $id_ongkir = $_POST["id_ongkir"];
                            $tanggal_transaksi = date("Y-m-d");
                            $alamat = $_POST['alamat'];

                            $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
                            $arrayongkir = $ambil->fetch_assoc();
                            $jasa_pengirim = $arrayongkir['jasa_pengirim'];
                            $tarif = $arrayongkir['tarif'];

                            $total_transaksi = $totalbelanja + $tarif;

                            // Menyimpan data ke tabel transaksi
                            $koneksi->query("INSERT INTO transaksi (id_pelanggan,id_ongkir,tanggal_transaksi,total_transaksi,jasa_pengirim,tarif,alamat)
                            VALUES ('$id_pelanggan','$id_ongkir','$tanggal_transaksi','$total_transaksi','$jasa_pengirim','$tarif','$alamat')");

                            // Mendapat id_transaksi barusan terjadi
                            $id_transaksi_barusan = $koneksi->insert_id;
                            foreach ($_SESSION["keranjang"] as $id_produk=>$jumlah)
                            {

                                // Mendapatkan data produk berdasarkan id_produk
                                $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                $perproduk = $ambil->fetch_assoc();

                                $nama = $perproduk['nama_produk'];
                                $harga = $perproduk['harga_produk'];
                                $berat = $perproduk['berat_produk'];
                                $subberat = $perproduk['berat_produk']*$jumlah;
                                $subharga = $perproduk['harga_produk']*$jumlah;
                                $koneksi->query("INSERT INTO transaksi_produk (id_transaksi,id_produk,nama,harga,berat,subberat,subharga,jumlah) 
                                VALUES ('$id_transaksi_barusan','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah')");

                                // Update stok
                                $koneksi->query("UPDATE produk SET stok_produk=stok_produk -$jumlah WHERE id_produk='$id_produk'");
                            }

                            // Kosongkan keranjang belanja
                            unset($_SESSION["keranjang"]);

                            // Tampilan dialihkan ke halaman nota
                            echo "<script>alert('Pembelian sukses');</script>";
                            echo "<script>location='../user/nota.php?id=$id_transaksi_barusan';</script>";
                        }
                        ?>
                </div>

            </div>
            <!-- <pre><?php print_r($_SESSION['pelanggan']) ?></pre>
            <pre><?php print_r($_SESSION['keranjang']) ?></pre> -->
        </div>
    </div>
    <!-- POST END -->
</body>
</html>
