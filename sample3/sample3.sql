-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2019 at 03:41 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sample3`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'andrejan@gmail.com', '12345678', 'Andre Jan'),
(2, 'indran@gmail.com', '12345678', 'Indran');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `jasa_pengirim` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `jasa_pengirim`, `tarif`) VALUES
(1, 'JNE', 20000),
(2, 'JNT', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `telepon_pelanggan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `email_pelanggan`, `password_pelanggan`, `nama_pelanggan`, `telepon_pelanggan`) VALUES
(1, 'andrejan@gmail.com', '12345678', 'Andre Jan', '081295851849'),
(3, 'indran@gmail.com', '12345678', 'Indran', '086523456543'),
(4, 'ryan@gmail.com', '12345678', 'Ryan', '087654321234');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(3, 13, 'Andre Jan', 'Mandiri', 200000, '2019-05-05', '20190505102527Topi.jpg'),
(4, 18, 'Andre Jan', 'Mandiri', 350000, '2019-05-06', '20190506143509Topi.jpg'),
(5, 19, 'Andre Jan', 'BNI', 100000, '2019-05-07', '20190507150032Topi.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `stok_produk` int(5) NOT NULL,
  `pic_produk` varchar(100) NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `stok_produk`, `pic_produk`, `deskripsi_produk`) VALUES
(2, 'Kaos', 80000, 50, 0, 'Kaos.jpg', 'Ini kaos keren.'),
(3, 'Celana', 100000, 50, 3, 'Celana.jpg', 'Ini celana keren.'),
(4, 'Jaket', 150000, 50, 3, 'Jaket.jpg', 'Ini jaket keren.'),
(5, 'Topi', 50000, 100, 4, 'Topi.jpg', 'Ini topi keren.'),
(6, 'Jam', 100000, 100, 1, 'Jam.jpg', 'Ini jam keren.');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_transaksi` int(11) NOT NULL,
  `jasa_pengirim` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `status_transaksi` varchar(100) NOT NULL DEFAULT 'pending',
  `resi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `id_ongkir`, `tanggal_transaksi`, `total_transaksi`, `jasa_pengirim`, `tarif`, `alamat`, `status_transaksi`, `resi`) VALUES
(1, 2, 1, '2019-04-30', 120000, '', 0, '', 'pending', ''),
(3, 2, 1, '2019-05-02', 190000, '', 0, '', 'pending', ''),
(4, 2, 1, '2019-05-02', 190000, '', 0, '', 'pending', ''),
(5, 2, 2, '2019-05-02', 185000, '', 0, '', 'pending', ''),
(6, 2, 1, '2019-05-02', 190000, '', 0, '', 'pending', ''),
(7, 2, 1, '2019-05-02', 190000, '', 0, '', 'pending', ''),
(8, 2, 1, '2019-05-02', 90000, '', 0, '', 'pending', ''),
(9, 2, 1, '2019-05-03', 190000, '', 0, '', 'pending', ''),
(10, 2, 2, '2019-05-03', 235000, '', 0, '', 'pending', ''),
(11, 2, 1, '2019-05-03', 190000, '', 0, '', 'pending', ''),
(12, 2, 1, '2019-05-03', 190000, '', 0, '', 'pending', ''),
(13, 1, 1, '2019-05-03', 200000, 'JNE', 20000, '', 'barang dikirim', 'ABC12'),
(14, 1, 1, '2019-05-03', 200000, 'JNE', 20000, 'Jln. Sirnagalih 2', 'pending', ''),
(15, 3, 2, '2019-05-05', 195000, 'JNT', 15000, 'Jln. Cikiding', 'pending', ''),
(16, 3, 1, '2019-05-05', 380000, 'JNE', 20000, 'Cikidang', 'pending', ''),
(17, 1, 1, '2019-05-06', 600000, 'JNE', 20000, 'Kp. Cilember Abuya.', 'pending', ''),
(18, 1, 1, '2019-05-06', 350000, 'JNE', 20000, 'Kp. Cilember Rt/Rw 004/003 Desa Cilember Kec. Cisarua - Bogor 16770', 'barang dikirim', '567890'),
(19, 1, 1, '2019-05-07', 100000, 'JNE', 20000, 'Cikiding', 'barang dikirim', 'hfjhjkhg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id_transaksi_produk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_produk`
--

INSERT INTO `transaksi_produk` (`id_transaksi_produk`, `id_transaksi`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(1, 1, 1, 1, '', 0, 0, 0, 0),
(2, 5, 2, 1, '', 0, 0, 0, 0),
(3, 5, 3, 1, '', 0, 0, 0, 0),
(4, 6, 2, 1, '', 0, 0, 0, 0),
(5, 6, 3, 1, '', 0, 0, 0, 0),
(6, 7, 2, 1, '', 0, 0, 0, 0),
(7, 7, 3, 1, '', 0, 0, 0, 0),
(8, 8, 2, 1, '', 0, 0, 0, 0),
(9, 9, 2, 1, '', 0, 0, 0, 0),
(10, 9, 3, 1, '', 0, 0, 0, 0),
(11, 12, 2, 1, 'Kaos', 70000, 2, 2, 70000),
(12, 12, 3, 1, 'Celana', 100000, 3, 3, 100000),
(13, 13, 2, 1, 'Kaos', 80000, 2, 2, 80000),
(14, 13, 3, 1, 'Celana', 100000, 3, 3, 100000),
(15, 14, 2, 1, 'Kaos', 80000, 2, 2, 80000),
(16, 14, 3, 1, 'Celana', 100000, 3, 3, 100000),
(17, 15, 2, 1, 'Kaos', 80000, 50, 50, 80000),
(18, 15, 3, 1, 'Celana', 100000, 50, 50, 100000),
(19, 16, 2, 2, 'Kaos', 80000, 50, 100, 160000),
(20, 16, 6, 2, 'Jam', 100000, 100, 200, 200000),
(21, 17, 6, 2, 'Jam', 100000, 100, 200, 200000),
(22, 17, 3, 1, 'Celana', 100000, 50, 50, 100000),
(23, 17, 2, 1, 'Kaos', 80000, 50, 50, 80000),
(24, 17, 5, 1, 'Topi', 50000, 100, 100, 50000),
(25, 17, 4, 1, 'Jaket', 150000, 50, 50, 150000),
(26, 18, 2, 1, 'Kaos', 80000, 50, 50, 80000),
(27, 18, 3, 1, 'Celana', 100000, 50, 50, 100000),
(28, 18, 4, 1, 'Jaket', 150000, 50, 50, 150000),
(29, 19, 2, 1, 'Kaos', 80000, 50, 50, 80000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id_transaksi_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id_transaksi_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
