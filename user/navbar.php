<nav class="navbar">
        <div class="kiri">
            <!-- LOGO -->
                <a class="logo" href="index.php"><img src="../icon/logo.svg"></a>
            <!-- LOGO END -->
            <!-- MENU -->
                <ul class="nav-nav">
                    <div class="item">
                    <li>
                        <a href="index.php">Beranda</a>
                    </li>
                    <li>
                        <a href="keranjang.php">Keranjang</a>
                    </li>
                    <!--jika sudah login(ada session pelanggan)-->
                    <?php if (isset($_SESSION["pelanggan"])): ?>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li>
                        <a href="login.php">Login</a>
                    </li>   
                    <?php endif ?>
                    <li>
                        <a href="checkout.php">Checkout</a>
                    </li> 
                    <li>
                        <a href="profil.php">Profile</a>
                    </li>
                    <li>
                        <a href="retur.php">Retur</a>
                    </li>
                    <li>
                        <a href="about.php">About Us</a>
                    </li>
                    </div>
                </ul>
            <!-- MENU END -->
        </div>
        <div class="kanan">
            <form action="search.php" method="get" class="searchbox">
                <input type="search" placeholder="Cari..." name="keyword">
                <input type="submit" value="Cari">
            </form>
        </div>
    </nav>