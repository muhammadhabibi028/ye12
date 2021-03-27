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
            <div class="tabletable">
                <div class="heading">
                    <p class="headtext">Tambah Produk</p>
                </div>
                <div class="tablewrap">
                <div class="container" style="padding-top: 30px; border: none; display: flex; flex-direction: row;">
                    <form method="post" enctype="multipart/form-data" class="form-container-produk-add">
                        <div class="item-form">
                            <p>Nama</p>
                            <input class="input-text-md" type="text" name="nama">
                        </div>
                        <div class="item-form">
                            <p>Harga (Rp)</p>
                            <input class="input-text-md" type="number" name="harga">
                        </div>
                        <div class="item-form">
                            <p>Berat</p>
                            <input class="input-text-md" type="number" name="berat">
                        </div>
                        <div class="item-form">
                            <p>Stok</p>
                            <input class="input-text-md" type="number" name="stok">
                        </div>
                        <div class="item-form">
                            <p>Deskripsi</p>
                            <textarea class="input-text-md" style="height: 189px; padding: 20px; resize: none;" name="deskripsi"></textarea>
                        </div>
                        <div class="item-form">
                            <p>Pic</p>
                            <input class="input-text-md" type="file" name="pic">
                        </div>
                        <button class="button-md button-grey" name="save">Tambah Produk</button>
                    </form>
                    <?php
                    if (isset($_POST['save']))
                        {
                            $namafoto = $_FILES['pic']['name'];
                            $lokasifoto = $_FILES['pic']['tmp_name'];
                            move_uploaded_file($lokasifoto, "../pic_produk/".$namafoto);
                            $koneksi->query("INSERT INTO produk
                            (nama_produk,harga_produk,berat_produk,stok_produk,pic_produk,deskripsi_produk)
                            VALUES('$_POST[nama]','$_POST[harga]','$_POST[berat]','$_POST[stok]','$namafoto','$_POST[deskripsi]')");

                            echo "<div class='alert-info'>Data Tersimpan</div>";
                            echo "<meta http-equiv='refresh' content='1;url=produk.php'>";
                        }
                    ?>         
                </div>
                </div>
        </div>
        <!-- CONTENT END -->
    </div>

    <!-- ORDER ADMIN END -->

</body>
</html>