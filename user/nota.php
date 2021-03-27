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

    <!-- POST -->  
    <div class="postnota-container">
        <h1>Nota Pembelian</h1>
            <div class="table">
                <div class="container">
                    <?php
                    $ambil=$koneksi->query("SELECT * FROM transaksi JOIN pelanggan
                        ON transaksi.id_pelanggan=pelanggan.id_pelanggan
                        WHERE transaksi.id_transaksi='$_GET[id]'");
                    $detailtransaksi=$ambil->fetch_assoc();
                    ?>
                    <!-- tidak bisa melihat nota orang lain-->
                    <?php
                    $idpelangganyangbeli = $detailtransaksi["id_pelanggan"];
                    $idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];
                    if($idpelangganyangbeli!==$idpelangganyanglogin)
                    {
                    	echo "<script>alert('Jangan nakal');</script>";
                    	echo "<script>location='profil.php';</script>";
                    	exit();
                    }
                    ?>
                   
                    <div class="row-not">
                        <table class="nota">
                            <thead>
                                <tr>
                                    <th>Pembelian</th>
                                    <th>Pelanggan</th>
                                    <th>Pengiriman</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>No. Pembelian : <?php echo $detailtransaksi['id_transaksi']; ?></strong><br>
                                        <p>
                                            Tanggal : <?php echo $detailtransaksi['tanggal_transaksi']; ?><br>
                                            Total : Rp. <?php echo number_format($detailtransaksi['total_transaksi']); ?>
                                        </p>
                                    </td>
                                    <td>
                                        <strong><?php echo $detailtransaksi['nama_pelanggan']; ?></strong> <br>
                                        <p>
                                            <?php echo $detailtransaksi['telepon_pelanggan']; ?> <br>
                                            <?php echo $detailtransaksi['email_pelanggan']; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <strong><?php echo $detailtransaksi['jasa_pengirim']; ?></strong> <br>
                                        <p>
                                            Ongkos Kirim : Rp. <?php echo number_format($detailtransaksi['tarif']); ?> <br>
                                            Alamat : <?php echo $detailtransaksi['alamat']; ?>
                                        </p>            
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><br>

                        <table class="nota">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Berat</th>
                                <th>Jumlah</th>
                                <th>Subberat</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $nomor=1; ?>
                            <?php $ambil=$koneksi->query("SELECT * FROM transaksi_produk WHERE id_transaksi='$_GET[id]'"); ?>
                            <?php while($pecah=$ambil->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['nama']; ?></td>
                                <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
                                <td><?php echo $pecah['berat']; ?> Gr</td>
                                <td><?php echo $pecah['jumlah']; ?></td>
                                <td><?php echo $pecah['subberat']; ?> Gr</td>
                                <td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
                            </tr>
                            <?php $nomor++; ?>
                            <?php } ?>
                            </tbody>
                        </table>  
            </div>
        </div>
    </div>
    <!-- POST END -->
    <!--<div class="row">
    	<div class="col-md-7">
    		<div class="alert alert-info">
    			<p>Silahkan melakukan pembayaran Rp. <?php echo number_format($detailtransaksi['total_transaksi']); ?> ke <br>
    			<strong>BANK MANDIRI 137-001088-3276 AN. Brasco Indonesia</strong>
    			</p>
            </div>
        </div>
    </div>-->

</body>
</html>