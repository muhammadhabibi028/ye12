<?php
//koneksi ke database
include('../admin/koneksi.php');

if (!isset($_SESSION['admin']))
{
    echo "<script>alert('Anda harus login');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
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
<body style="background: #EFF0F5; height: 100%;">
    <?php include('../admin/navbar.php'); ?>

    <!-- DASHBOARD -->

    <div class="admincontainer">
        <!-- SIDEBAR -->
        <?php include('../admin/sidebar.php'); ?>
        <!-- SIDEBAR END -->

        <!-- CONTENT -->
        <div class="dashboardadmin">
            <div class="tiga">
            <div class="users">
                <img src="../icon/usersbig.svg">
                <div class="data">
                    <p class="number">23977</p>
                    <p class="name">Users</p>
                </div>
            </div>
            <div class="order">
                <img src="../icon/orderbig.svg">
                <div class="data">
                    <p class="number">6679</p>
                    <p class="name">Order</p>
                </div>
            </div>
            <div class="product">
                <img src="../icon/productbig.svg">
                <div class="data">
                    <p class="number">1220</p>
                    <p class="name">Product</p>
                </div>
            </div>
            </div>
            <div class="tabletable">
                <div class="heading">
                    <p class="headtext">User</p>
                    <a href="#"><p class="linktext">Go to User</p></a>
                </div>
                <div class="tablewrap">
                <div class="container">
                    <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ryan Pandu</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Gogon Imanuel</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Cancut Rangers</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
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
                                <th>Nomor Order</th>
                                <th>Nama</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>#3321</td>
                                <td>Ryan Pandu</td>
                                <td><div class="status pending-status">Pending</div></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>#3324</td>
                                <td>Gogon Imanuel</td>
                                <td><div class="status proses-status">Proses</div></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>#3325</td>
                                <td>Cancut Rangers</td>
                                <td><div class="status selesai-status">Selesai</div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
            <div class="tabletable">
                <div class="heading">
                    <p class="headtext">Product</p>
                    <a href="#"><p class="linktext">Go to Product</p></a>
                </div>
                <div class="tablewrap">
                    <div class="container">
                        <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Produk ID</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sepatu Nike Merah</td>
                                <td>FFGH45</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Jaket Bomber Biru</td>
                                <td>HHKK21</td>
                                </tr>
                            <tr>
                                <td>3</td>
                                <td>Sepatu White Shoes</td>
                                <td>JKL234</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabletable">
                <div class="heading">
                    <p class="headtext">Retur</p>
                    <a href="#"><p class="linktext">Go to Retur</p></a>
                </div>
                <div class="tablewrap">
                    <div class="container">
                        <div class="table">
                        <table cellpadding="10">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Order</th>
                                <th>Nama</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>#33421</td>
                                <td>Ryan Pandu</td>
                                <td style="width: 300px;">
                                    <a href="#"><div class="status tolak-status inline" style="margin-right: 10px;">Tolak</div></a>
                                    <a href="#"><div class="status proses-status inline">Proses</div></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>#33421</td>
                                <td>Gogon Imanuel</td>
                                <td style="width: 300px;">
                                    <a href="#"><div class="status tolak-status inline" style="margin-right: 10px;">Tolak</div></a>
                                    <a href="#"><div class="status proses-status inline">Proses</div></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>#33421</td>
                                <td> Cancut Rangers</td>
                                <td style="width: 300px;">
                                    <a href="#"><div class="status tolak-status inline" style="margin-right: 10px;">Tolak</div></a>
                                    <a href="#"><div class="status proses-status inline">Proses</div></a>
                                </td>
                            </tr>
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