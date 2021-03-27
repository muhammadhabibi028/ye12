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
                    <?php
                    $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$_GET[id]'");
                    $pecah=$ambil->fetch_assoc();
                    ?>

                    <form method="post" enctype="multipart/form-data" class="form-container-produk-add">
                        <div class="item-form">
                            <p>Nama</p>
                            <input class="input-text-md" type="text" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
                        </div>
                        <div class="item-form">
                            <p>Harga (Rp)</p>
                            <input class="input-text-md" type="number" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
                        </div>
                        <div class="item-form">
                            <p>Berat</p>
                            <input class="input-text-md" type="number" name="berat" value="<?php echo $pecah['berat_produk']; ?>">
                        </div>
                        <div class="item-form">
                            <p>Stok</p>
                            <input class="input-text-md" type="number" name="stok" value="<?php echo $pecah['stok_produk']; ?>">
                        </div>
                        <div class="item-form">
                            <p>Deskripsi</p>
                            <textarea class="input-text-md" style="height: 189px; padding: 20px; resize: none;" name="deskripsi">
                                 <?php echo $pecah['deskripsi_produk']; ?>
                            </textarea>
                        </div>
                        <div class="item-form">
                            <img src="../pic_produk/<?php echo $pecah['pic_produk'] ?>" width="200">
                        </div>
                        <div class="item-form">
                            <p>Ganti Pic</p>
                            <input class="input-text-md" type="file" name="pic">
                        </div>
                        <button class="button-md button-grey" name="ubah">Ubah</button>
                    </form>
                   <?php
                    if (isset($_POST['ubah']))
                    {
                        $namapic=$_FILES['pic']['name'];
                        $lokasipic=$_FILES['pic']['tmp_name'];
                        // jika foto dirubah
                        if (!empty($lokasipic))
                        {
                           move_uploaded_file($lokasipic, "../pic_produk/$namapic"); 

                           $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',
                           berat_produk='$_POST[berat]',stok_produk='$_POST[stok]',pic_produk='$namapic',deskripsi_produk='$_POST[deskripsi]'
                           WHERE id_produk='$_GET[id]'");
                        }
                        else
                        {
                           $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',
                           berat_produk='$_POST[berat]',stok_produk='$_POST[stok]',deskripsi_produk='$_POST[deskripsi]'
                           WHERE id_produk='$_GET[id]'");
                        }
                        echo "<script>alert('Data produk telah diubah');</script>";
                        echo "<script>location='produk.php';</script>";
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