<?php
session_start();
//koneksi ke database
include('../user/koneksi.php');

$id_transaksi = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran
    LEFT JOIN transaksi ON pembayaran.id_transaksi=transaksi.id_transaksi WHERE transaksi.id_transaksi='$id_transaksi'");
$detbay = $ambil->fetch_assoc();

//jika belum ada data pembayaran
if(empty($detbay))
{
    echo "<script>alert('Anda tidak berhak')</script>";
    echo "<script>location='profil.php';</script>";
    exit();
}

//jika data pelanggan yang bayar tidak sesuai dengan yg login
if($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"])
{
    echo "<script>alert('Anda tidak berhak')</script>";
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
    <script src="../js/main.js"></script>
</head>
<body>

	 <!-- NAVBAR -->
    <?php include_once("../user/navbar.php"); ?>
    <!-- NAVBAR END -->

    <div class="main-container">
    	        <!-- CONTENT -->  
        <div class="dashboardadmin" style="margin-top: 0;">
            <div class="tabletable">
                <div class="heading">
                    <p class="headtext">Order</p>
                    <a href="#"><p class="linktext">Go to Order</p></a>
                </div>
                <div class="tablewrap">
                <div class="container">
                   
                    <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Bank</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $detbay['nama']; ?></td>
                                <td><?php echo $detbay['bank']; ?></td>
                                <td><?php echo $detbay['tanggal']; ?></td>
                                <td>Rp. <?php echo number_format($detbay['jumlah']); ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                                  
            </div>
            </div>
        </div>
        <!-- CONTENT END -->
    </div>
    <div class="row">
    	<div class="col-md-7">
    		<div class="alert alert-info">
    			<img src="../bukti_pembayaran/<?php echo $detbay["bukti"] ?>" width="30%">
</div>
</div>
</div>



    </div>

</body>
</html>