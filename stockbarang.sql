-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 06:12 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `penerima` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `penerima`, `qty`) VALUES
(30, 50, '2023-08-06 08:32:49', 'ahmad (xii tab a)', 1),
(31, 52, '2023-08-06 08:33:06', 'hasan', 1),
(32, 53, '2023-08-06 08:33:24', 'arief', 1),
(33, 52, '2023-08-06 08:38:57', 'agung', 1),
(34, 51, '2023-08-06 08:40:43', 'hamda(x tab c)', 1),
(35, 50, '2023-08-06 08:43:08', 'ade (xi tab b)', 2),
(36, 53, '2023-08-06 08:47:16', 'ahmad', 4),
(37, 52, '2023-08-06 08:51:01', 'abeng', 1),
(38, 50, '2023-08-06 11:20:49', 'arief', 2),
(39, 52, '2023-08-06 11:21:17', 'hadi', 1),
(40, 44, '2023-08-18 00:44:08', 'ahmad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `idkondisi` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kondisi`
--

INSERT INTO `kondisi` (`idkondisi`, `idbarang`, `namabarang`, `qty`, `kondisi`, `tanggal`) VALUES
(42, 47, '', 1, 'rusak', '2023-08-06 11:43:31'),
(44, 44, '', 1, 'Dimusnahkan', '2023-08-21 01:48:18'),
(45, 46, '', 1, 'Tidak Layak', '2023-08-28 12:03:36'),
(46, 45, '', 1, 'Dimusnahkan', '2023-08-28 12:05:17'),
(48, 46, '', 1, 'Dimusnahkan', '2023-08-28 12:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', '12345', ''),
(2, 'dewi@gmail.com', '12345', ''),
(3, 'admin', 'admin1', 'admin'),
(4, 'siswa', 'siswa1', 'siswa'),
(5, 'kepsek', 'kepsek1', 'kepsek');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`) VALUES
(50, 48, '2023-08-06 08:30:37', 'suhandaris', 2),
(51, 45, '2023-08-06 08:31:43', 'suhandaris', 2),
(52, 44, '2023-08-06 08:36:44', 'arief', 5),
(53, 53, '2023-08-06 08:41:35', 'amin', 2),
(54, 43, '2023-08-06 08:49:21', 'suhandaris', 1),
(55, 53, '2023-08-06 08:52:18', 'amin', 2),
(56, 47, '2023-08-06 11:34:14', 'saleh', 1),
(57, 55, '2023-08-06 11:37:10', 'ade', 9),
(58, 52, '2023-08-06 11:37:30', 'agung', 5),
(59, 56, '2023-08-06 11:38:42', 'puji', 9),
(60, 44, '2023-08-18 00:44:52', 'muna', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` int(11) NOT NULL,
  `namapegawai` varchar(100) NOT NULL,
  `nip` varchar(30) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `ttl` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `image` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `namapegawai`, `nip`, `jabatan`, `pendidikan`, `ttl`, `tgl_lahir`, `alamat`, `image`) VALUES
(5, 'hadi rusadi, S.Pd', '0998766 8896666 2 200', 'Guru Teknik Alat Berat', 'S1 Pendidikan Guru Otomotif', 'Binuang', '2023-07-20', 'Binuang', '455a2a1f1a0f83540f13aebf79fe39a3.jpg'),
(10, 'agung pramujio, S.T', '0998766 8896666 4 120', 'Guru Teknik Alat Berat', 'S1 Teknik Mesin', 'Binuang', '2023-07-05', 'Binuang', '05d38668db7d61610be61e763a536369.jpg'),
(11, 'mansyah, S.Pd', '0998766 8896666 2 101', 'Guru Teknik Alat Berat', 'S1 Pendidikan Guru Otomotif', 'Banyumas', '1992-01-07', 'Jl. PLN binuang', 'c54fc7893903168e4a9cfcc4423cf642.jpg'),
(12, 'Suhandaris, S.Pd', '0998766 8896666 2 301', 'Guru Teknik Alat Berat', 'S1 Pendidikan Guru Otomotif', 'Surabaya', '1988-02-09', 'Jl. rantau baru', '7852c249144705527c401bff0f5508c2.jpg'),
(13, 'muhammad amin, S.T', '0998766 8896666 4 302', 'Guru Teknik Alat Berat', 'S1 Teknik Mesin', 'Simpang 4', '1996-06-11', 'Jl. simpang 4 kec. simpang 4', 'd7cea16f5acb33d541144e420ed9241c.jpg'),
(14, 'munawwarah, S.T', '-', 'Guru Teknik Alat Berat', 'S1 Teknik Mesin', 'Binuang', '1995-02-13', 'Jl. seberang SMA binuang sariwangi', 'c1fc608d8d2adbf18180d9c5b182c3b7.jpg'),
(15, 'Pradewi, S.T', '0998766 8896666 5 202', 'Guru Teknik Alat Berat', 'S1 Teknik Mesin', 'Binuang', '1993-06-08', 'Jl. sidorejo Pulau pinang', '536d05a30d5a86a619234495531c4989.jpg'),
(16, 'siti mariam, S.Pd', '0998766 8896666 2 003', 'Guru Teknik Alat Berat', 'S1 Pendidikan Guru Otomotif', 'Binuang', '1992-02-12', 'Jl. sarang burung', '5ee8e3021ec03fa5b9c331b3cd4604d5.jpg'),
(17, 'puji rahayu, S.Pd', '-', 'Guru Teknik Alat Berat', 'S1 Pendidikan Guru Otomotif', 'Binuang', '1989-10-06', 'Jl. nes 12 blok P', '84a129b56da0e0878bef12af520f6d41.jpg'),
(18, 'Mawar Anggraini, S.T', '-', 'Guru Teknik Alat Berat', 'S1 Teknik Mesin', 'Binuang', '1994-10-18', 'Jl. transad blok j ', 'a9f3b0b2658b8e241c28e2a8767525b9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `idpeminjaman` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggalpinjam` date NOT NULL,
  `qty` int(11) NOT NULL,
  `peminjam` varchar(100) NOT NULL,
  `status_pinjam` varchar(50) NOT NULL,
  `tanggalkembali` datetime NOT NULL,
  `tanggaldisetujui` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`idpeminjaman`, `idbarang`, `tanggalpinjam`, `qty`, `peminjam`, `status_pinjam`, `tanggalkembali`, `tanggaldisetujui`) VALUES
(62, 49, '2023-08-23', 1, 'ahmad', 'Kosong', '0000-00-00 00:00:00', '2023-08-23 20:29:00'),
(63, 46, '2023-08-23', 1, 'coba dulu', 'Dikembalikan', '2023-08-23 20:33:00', '2023-08-23 20:29:00'),
(64, 43, '2023-08-23', 1, 'ahmad', 'Dikembalikan', '2023-08-25 12:51:00', '0000-00-00 00:00:00'),
(65, 55, '2023-08-22', 1, 'qwerty', 'Dikembalikan', '2023-08-23 20:27:00', '2023-08-23 20:10:00'),
(66, 52, '2023-08-23', 3, 'alex', 'Dikembalikan', '2023-08-23 20:43:00', '2023-08-23 20:43:00'),
(67, 46, '2023-08-25', 1, 'akang', 'Dikembalikan', '2023-08-25 14:53:00', '2023-08-25 13:52:00'),
(68, 46, '2023-08-28', 1, 'ari', 'Dikembalikan', '2023-08-28 16:00:00', '2023-08-28 10:25:00'),
(69, 48, '2023-08-28', 1, 'jhon', 'Disetujui', '0000-00-00 00:00:00', '2023-08-28 10:31:00');

-- --------------------------------------------------------

--
-- Table structure for table `pemusnahan`
--

CREATE TABLE `pemusnahan` (
  `idpemusnahan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemusnahan`
--

INSERT INTO `pemusnahan` (`idpemusnahan`, `tanggal`, `namabarang`, `keterangan`, `idbarang`, `qty`) VALUES
(15, '2023-08-22', '', 'dimusnahkan', 51, 1),
(16, '2023-08-28', '', 'dimusnahkan', 46, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `idpengajuan` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'menunggu persetujuan',
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`idpengajuan`, `idbarang`, `namabarang`, `qty`, `merek`, `status`, `tanggal`) VALUES
(52, 0, 'elektroda', '10', 'nikko', 'setuju', '2023-08-03'),
(53, 0, 'Air Compresor', '1', 'KRISBOW', 'setuju', '2023-08-03'),
(54, 0, 'bore gage', '1', 'krisbow', 'menunggu persetujuan', '2023-07-26'),
(55, 0, 'dial indicator', '1', 'dial indicator', 'setuju', '2023-07-27'),
(56, 0, 'mata gerinda', '2', 'RYU', 'setuju', '2023-08-01'),
(57, 0, 'tespen', '5', 'tekiro', 'setuju', '2023-07-24'),
(58, 0, 'pompa air', '2', 'shimizu', 'setuju', '2023-07-24'),
(59, 0, 'oli', '5', 'mesran', 'setuju', '2023-07-17'),
(60, 0, 'wd', '5', 'wd', 'setuju', '2023-07-24'),
(61, 0, 'lemari', '5', 'olimpic', 'tidaksetuju', '2023-07-18'),
(62, 0, 'KUNCI MOMENT ', '1', 'krisbow', 'menunggu persetujuan', '2023-07-31'),
(63, 0, 'helm las', '10', 'KRISBOW', 'tidaksetuju', '2023-07-25');

-- --------------------------------------------------------

--
-- Table structure for table `rab`
--

CREATE TABLE `rab` (
  `idrab` int(11) NOT NULL,
  `namabarang` varchar(100) NOT NULL,
  `tglbelanja` timestamp NOT NULL DEFAULT current_timestamp(),
  `merek` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `hargasatuan` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `image` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab`
--

INSERT INTO `rab` (`idrab`, `namabarang`, `tglbelanja`, `merek`, `qty`, `hargasatuan`, `jumlah`, `deskripsi`, `image`) VALUES
(35, 'kompresor', '2023-08-07 02:57:27', 'krisbow', 1, '1500000', '1500000', 'aset', '6e6029f57200719f571a630a4b424054.jpg'),
(36, 'tespen', '2023-08-07 03:00:03', 'tekiro', 5, '40000', '200000', 'aset', '16c9949ae45d1b203f403653600643ad.jpg'),
(44, 'spidol', '2023-08-04 16:00:00', '1', 1, '12000', '12000', 'pembelajaran', '84a26238739d9da581b8ab4cea5afeb4.jpg'),
(45, 'spidol', '2023-08-04 16:00:00', '1', 1, '12000', '12000', 'pembelajaran', 'b3d0138a70268958d9f3ae3615283ac7.jpg'),
(46, 'spidol', '2023-08-04 16:00:00', '1', 1, '12000', '12000', 'pembelajaran', 'faccbe41d7e5d7bcdb594017daf93abf.jpg'),
(47, 'spidol', '2023-08-04 16:00:00', '1', 1, '12000', '12000', 'pembelajaran', '90f4f5246948bf310ab9e0b79dd13a75.jpg'),
(48, 'spidol', '2023-08-04 16:00:00', '1', 1, '12000', '12000', 'pembelajaran', 'ca9e1efe906864cb8c44a297494d2675.jpg'),
(49, 'spidol', '2023-08-04 16:00:00', '1', 1, '12000', '12000', 'pembelajaran', 'c72a6845bcd74f4f00e2124bd5bc148a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rab1`
--

CREATE TABLE `rab1` (
  `idrab` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `tglbelanja` date NOT NULL DEFAULT current_timestamp(),
  `merek` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `hargasatuan` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `image` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab1`
--

INSERT INTO `rab1` (`idrab`, `namabarang`, `tglbelanja`, `merek`, `qty`, `hargasatuan`, `jumlah`, `deskripsi`, `image`) VALUES
(18, 'oli', '2023-08-01', 'mesran', 5, '', '500000', 'barang habis pakai', 'a6acb485ff751eb194582dc923757bb3.jpg'),
(19, 'tespe', '2023-08-01', 'tekiro', 5, '', '350000', 'aset', 'ba84d183b26e399ea7af8834149246ce.jpg'),
(20, 'wd', '2023-08-01', 'wd', 5, '', '60000', 'barang habis pakai', '968cf643f33bf51cea399e2a433afc70.jpg'),
(21, 'elektroda', '2023-08-01', 'nikko', 10, '', '150000', 'barang habis pakai', '984b6e913920f0a13a6fe24846fd570f.jpg'),
(22, 'kompresor', '2023-08-01', 'krisbow', 1, '', '1300000', 'aset', '08ea70f604892441f77f8d752a9188fd.jpg'),
(24, 'KUNCI MOMENT', '2023-08-01', 'krisbow', 1, '', '1100000', 'aset', 'f643d7f40598ecebc2d5668a55a010b9.jpg'),
(26, 'gerinda', '2023-08-01', 'bitec', 2, '', '200000', 'aset', '7f103c1d4f5f8b4acc2d77723b17d480.jpg'),
(27, 'mesin bor', '2023-08-01', 'krisbow', 2, '', '500000', 'aset', '782389652e616fd235ce8b1019c1f7b6.jpg'),
(28, 'mesin las', '2023-08-01', 'krisbow', 1, '', '1800000', 'aset', 'd860742e97bac6d38f5dbfe951406659.jpg'),
(29, 'TOOLBOX SET', '2023-08-01', 'krisbow', 1, '', '100000', 'aset', '5a0c9c7008b4d1a92eb7587c82b5d34f.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(50) NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `merek` varchar(50) NOT NULL,
  `thnpembelian` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(99) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `merek`, `thnpembelian`, `stock`, `image`) VALUES
(43, 'Kompresor', 'aset', 'KRISBOW', '2019', -11, 'a6e6a97d37ec291700405c03ea4502e8.jpg'),
(44, 'battery tester', 'aset', 'lancol', '2020', 2, '2466d760739fe3d9092c4d0792b3e267.jpg'),
(45, 'bor listrik', 'aset', 'krisbow', '2020', -5, '0a5b46705d90671aee8b0fbeb7ecdf9f.jpg'),
(46, 'helm las digital', 'aset', 'KRISBOW', '2021', 3, 'e0b7b40013531b14f035f2b94e8f221b.jpg'),
(47, 'mesin las', 'aset', 'lakoni', '2021', -1, '233d08346a4845310a38d0bf6ace8a05.jpg'),
(48, 'TOOLBOX SET', 'aset', 'toolbox', '2019', 11, '144304e45ea6e4454e6696a5e10de774.jpg'),
(49, 'solder', 'aset', 'tora', '2021', 1, '32cec1ffc7ff1adc490ad7d8ae4d5786.jpg'),
(50, 'amplas', 'barang habis pakai', 'amplas', '2022', 16, 'afdf7b1cb9f2cad1cac723bea1d5d913.jpg'),
(51, 'contact cleaner', 'barang habis pakai', 'rexco', '2022', 13, 'fbc10d81b3009d36eb41709d985424dc.jpg'),
(52, 'elektroda', 'barang habis pakai', 'nikko', '2021', 8, '5676ced34e3bd457a615394d5cc04866.jpg'),
(53, 'mata gerinda', 'barang habis pakai', 'RYU', '2021', 2, '49662506294cb2e18e97512e958997ea.jpg'),
(54, 'gerinda', 'aset', 'bitec', '2021', 1, '5b624b2e33b615d6448571fa9f29a18d.jpg'),
(55, 'oli', 'barang habis pakai', 'mesran', '2022', 13, 'ea1a375093d59dd5a00045a92829b69e.jpg'),
(56, 'wd', 'barang habis pakai', 'wd', '2023', 10, 'd01b97eeb8b328d55fe8d48adf25ea31.jpg'),
(57, 'FIXED TABLE VISE ', 'aset', 'krisbow', '2022', -1, 'c9e7063d821237a03aae4d125e4045b5.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`idkondisi`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`idpeminjaman`);

--
-- Indexes for table `pemusnahan`
--
ALTER TABLE `pemusnahan`
  ADD PRIMARY KEY (`idpemusnahan`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`idpengajuan`);

--
-- Indexes for table `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`idrab`);

--
-- Indexes for table `rab1`
--
ALTER TABLE `rab1`
  ADD PRIMARY KEY (`idrab`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `idkondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idpegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `idpeminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `pemusnahan`
--
ALTER TABLE `pemusnahan`
  MODIFY `idpemusnahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `idpengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `rab`
--
ALTER TABLE `rab`
  MODIFY `idrab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `rab1`
--
ALTER TABLE `rab1`
  MODIFY `idrab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
