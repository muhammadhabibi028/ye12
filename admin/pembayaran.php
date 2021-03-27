<?php
//koneksi ke database
include('../admin/koneksi.php');

//mendapatkan id_transaksi dari url
$id_transaksi = $_GET['id'];

//mengambil data pembayaran berdasarkan id_transaksi
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_transaksi = '$id_transaksi'");
$detail = $ambil->fetch_assoc();
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
                    <img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" width="30%"> <br>
                    <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Bank</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $detail['nama']; ?></td>
                                <td><?php echo $detail['bank']; ?></td>
                                <td>Rp. <?php echo number_format($detail['jumlah']); ?></td>
                                <td>
                                    <?php echo $detail['tanggal']; ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <form method="post">
                    <div class="form-group">
                        <label>No Resi Pengiriman</label>
                        <input type="text" name="resi">
                    </div>    
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="">Pilih Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="barang dikirim">Barang dikirim</option>
                            <option value="batal">Batal</option>
                        </select>
                    </div>
                    <button name="proses">Proses</button>
                    </form>
                    <?php
                    if(isset($_POST["proses"]))
                    {
                        $resi = $_POST["resi"];
                        $status = $_POST["status"];
                        $koneksi->query("UPDATE transaksi SET resi = '$resi', status_transaksi = '$status' WHERE id_transaksi = '$id_transaksi'");

                        echo "<script>alert(Data transaksi terupdate');</script>";
                        echo "<script>location='transaksi.php';</script>";

                    }
                    ?>
                                  
            </div>
            </div>
        </div>
        <!-- CONTENT END -->
    </div>
</div>
    <!-- ORDER ADMIN END -->

</body>
</html>