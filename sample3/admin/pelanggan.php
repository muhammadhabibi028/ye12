<?php
//koneksi ke database
include('../admin/koneksi.php');
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
<body style="background: #EFF0F5;">
    <?php include('../admin/navbar.php'); ?>

    <!-- DASHBOARD -->

    <div class="admincontainer">
        <!-- SIDEBAR -->
        <?php include('../admin/sidebar.php'); ?>
        <!-- SIDEBAR END -->

        <!-- CONTENT -->
        <div class="dashboardadmin" style="margin-top: 0;">
            <div class="tabletable">
                <div class="heading">
                    <p class="headtext">User</p>
                </div>
                <div class="tablewrap">
                <div class="container">
                    <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $nomor=1; ?>
                                <?php $ambil=$koneksi->query("SELECT * FROM pelanggan"); ?>
                                <?php while($pecah=$ambil->fetch_assoc()){ ?>
                                <tr>
                                    <td><?php echo $nomor; ?></td>
                                    <td><?php echo $pecah['nama_pelanggan']; ?></td>
                                    <td><?php echo $pecah['email_pelanggan']; ?></td>
                                    <td><?php echo $pecah['telepon_pelanggan']; ?></td>
                                    <td>
                                    <a href="hapuspelanggan.php?&id=<?php echo $pecah['id_pelanggan']; ?>">Hapus</a>
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
        </div>
        <!-- CONTENT END -->
    </div>

    <!-- DASHBOARD END -->

</body>
</html>