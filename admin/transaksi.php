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
                    <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Status Transaksi</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $nomor=1; ?>
                            <?php $ambil=$koneksi->query("SELECT * FROM transaksi JOIN pelanggan ON transaksi.id_pelanggan=pelanggan.id_pelanggan"); ?>
                            <?php while($pecah=$ambil->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['nama_pelanggan']; ?></td>
                                <td><?php echo $pecah['tanggal_transaksi']; ?></td>
                                <td><?php echo $pecah['status_transaksi']; ?></td>
                                <td><?php echo $pecah['total_transaksi']; ?></td>
                                <td>
                                    <a href="detailtransaksi.php?&id=<?php echo $pecah['id_transaksi']; ?>">Detail</a>

                                    <?php if($pecah['status_transaksi']!=="pending"): ?>
                                        <a href="pembayaran.php?&id=<?php echo $pecah['id_transaksi']; ?>">Pembayaran</a>
                                    <?php endif?>
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

    <!-- ORDER ADMIN END -->

</body>
</html>