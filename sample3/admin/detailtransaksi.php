<?php
//koneksi ke database
include('../admin/koneksi.php');
?>

<!DOCTYPE html>
<html style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Brasco Indonesia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/main.css">
    <script src="../js/main.js"></script>
</head>
<body style="background: #EFF0F5;">
    <?php include('../admin/navbar.php'); ?>

    <!-- ORDER ADMIN -->

    <div class="admincontainer">
        <!-- SIDEBAR -->
        <?php include('../admin/sidebar.php'); ?>
        <!-- SIDEBAR END -->

        <!-- CONTENT -->
        <div class="dashboardadmin" style="margin-top: 0;">
            <div class="tabletable">
                <div class="heading">
                    <p class="headtext">Order</p>
                    <a href="#"><p class="linktext">Go to Order</p></a>
                </div>
                <div class="tablewrap">
                <div class="container">
                    <?php
                    $ambil=$koneksi->query("SELECT * FROM transaksi JOIN pelanggan
                        ON transaksi.id_pelanggan=pelanggan.id_pelanggan
                        WHERE transaksi.id_transaksi='$_GET[id]'");
                    $detailtransaksi=$ambil->fetch_assoc();
                    ?>
                    <strong><?php echo $detailtransaksi['nama_pelanggan']; ?></strong> <br>
                    <p>
                         <?php echo $detailtransaksi['telepon_pelanggan']; ?> <br>
                         <?php echo $detailtransaksi['email_pelanggan']; ?>
                    </p>
                    <p>
                        Tanggal:<?php echo $detailtransaksi['tanggal_transaksi']; ?> <br>
                        Total : Rp. <?php echo number_format($detailtransaksi['total_transaksi']); ?> <br>
                        Status: <?php echo $detailtransaksi["status_transaksi"];  ?>
                    </p>
                    <strong><?php echo $detailtransaksi['jasa_pengirim']; ?></strong> <br>
                    <p>
                         Tarif: <?php echo $detailtransaksi["tarif"]; ?> <br>
                         Alamat: <?php echo $detailtransaksi["alamat"]; ?>
                    </p>
                    <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $nomor=1; ?>
                            <?php $ambil=$koneksi->query("SELECT * FROM transaksi_produk JOIN produk 
                            ON transaksi_produk.id_produk=produk.id_produk 
                            WHERE transaksi_produk.id_transaksi='$_GET[id]'"); ?>
                            <?php while($pecah=$ambil->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['nama_produk']; ?></td>
                                <td><?php echo $pecah['harga_produk']; ?></td>
                                <td><?php echo $pecah['jumlah']; ?></td>
                                <td>
                                    <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
                                </td>
                            </tr>
                            <?php $nomor++; ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                                  
            </div>
            </div>
        </div>
        <!-- CONTENT END -->
    </div>
</div>
    <!-- ORDER ADMIN END -->

</body>
</html>