<?php
//koneksi ke database
include('../admin/koneksi.php');
$semuadata=array();
$tglm="-";
$tgls="-";
if(isset($_POST["kirim"]))
{
    $tglm = $_POST["tglm"];
    $tgls = $_POST["tgls"];
    $ambil = $koneksi->query("SELECT * FROM transaksi ts LEFT JOIN pelanggan pl ON ts.id_pelanggan=pl.id_pelanggan WHERE tanggal_transaksi BETWEEN '$tglm' AND '$tgls'");
    while($pecah = $ambil->fetch_assoc())
    {
        $semuadata[] = $pecah;
    }
    //echo "<pre>";
    //print_r($semuadata);
    //echo "</pre>";
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
                    <p class="headtext">Laporan Transaksi dari <?php echo $tglm ?> hingga <?php echo $tgls ?></p>
                    <a href="#"><p class="linktext">Go to Order</p></a>
                </div>
                <div class="tablewrap">
                <div class="container">
                    <form method="post">
                        <div class="row">
                            <div>
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tglm" value="<?php echo $tglm ?>">
                            </div>
                            <div>
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tgls" value="<?php echo $tgls ?>">
                            </div>
                            <div>
                                <button name="kirim">Lihat</button>
                            </div>
                        </div>
                    </form>
                    <div class="table">
                        <table cellpadding="10">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Status Transaksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $total=0; ?>
                                <?php foreach ($semuadata as $key => $value): ?>
                                    <?php $total+=$value['total_transaksi'] ?>
            
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $value['nama_pelanggan']; ?></td>
                                <td><?php echo $value['tanggal_transaksi']; ?></td>
                                <td><?php echo $value['status_transaksi']; ?></td>
                                <td>Rp. <?php echo number_format($value['total_transaksi']); ?></td>
                            </tr>
                
                        <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">Total</th>
                                    <th>Rp. <?php echo number_format($total) ?></th>
                                </tr>
                            </tfoot>
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