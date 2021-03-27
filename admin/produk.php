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
        <div class="dashboardadmin" style="margin-top: 30px;">
            <a href="tambahproduk.php" style="text-decoration: none; width: 247.83px;"><div class="button-md button-grey" style="box-shadow: none;">+ Tambah Produk</div></a>
            <div class="tabletable">
                <div class="heading">
                    <p class="headtext">Produk</p>
                </div>
                <div class="tablewrap">
                <div class="container">
                    <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Berat</th>
                                <th>Stok</th>
                                <th>Pic</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $nomor=1; ?>
                            <?php $ambil=$koneksi->query("SELECT * FROM produk"); ?>
                            <?php while($pecah=$ambil->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $nomor; ?></td>
                                <td><?php echo $pecah['nama_produk']; ?></td>
                                <td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
                                <td><?php echo $pecah['berat_produk']; ?> Gr</td>
                                <td><?php echo $pecah['stok_produk']; ?></td>
                                <td><img src="../pic_produk/<?php echo $pecah['pic_produk']; ?>" width="50"></td>
                            <td>
                                <a href="hapusproduk.php?&id=<?php echo $pecah['id_produk']; ?>">Hapus</a>
                                <a href="ubahproduk.php?&id=<?php echo $pecah['id_produk']; ?>">Ubah</a>
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