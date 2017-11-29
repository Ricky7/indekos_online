-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Aug 19, 2017 at 10:30 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_masran`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `session` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `nama`, `username`, `password`, `session`) VALUES
(1, 'Admin', 'admin', '$2y$10$QQbbT2reHdxWRCVUqzo0hu7whqW2Av3tgDdnDY54Gii4928L3eFde', 'admin'),
(2, 'Admin B', 'admin', '$2y$10$IlTAGd/2vRMubKEWQlOdxu1R47aMcbuUcwydFxdIeU4gORu1AsSvO', 'admin'),
(3, 'Admin C', 'admin', '$2y$10$gixrEoG67ADI6jE57Xo/ZOUznQ..RY6xjERYldLF.vOOcoZWskyRO', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id_booking` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `id_indekos` int(11) NOT NULL,
  `biaya` int(20) NOT NULL,
  `total_biaya` int(20) NOT NULL,
  `durasi` int(10) NOT NULL,
  `tgl_booking` datetime NOT NULL,
  `kode_booking` varchar(200) NOT NULL,
  `status_booking` varchar(20) NOT NULL,
  `nama_bank` varchar(12) DEFAULT NULL,
  `nama_rek` varchar(25) DEFAULT NULL,
  `no_rek` varchar(20) DEFAULT NULL,
  `nilai` int(15) DEFAULT NULL,
  `note_transfer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id_booking`, `id_pembeli`, `id_penjual`, `id_indekos`, `biaya`, `total_biaya`, `durasi`, `tgl_booking`, `kode_booking`, `status_booking`, `nama_bank`, `nama_rek`, `no_rek`, `nilai`, `note_transfer`) VALUES
(3, 1, 2, 3, 150000, 500000, 2, '2017-08-12 00:01:48', '15024709085676', 'COMPLETED', 'BNI', 'Hartono Harianja', '4564545445745', 150000, 'gk ada'),
(5, 1, 2, 3, 150000, 500000, 3, '2017-08-15 00:19:58', '15027311988020', 'CONFIRMED', 'BNI', 'Hartono Harianja', '3463734534534', 150000, 'Gagal'),
(6, 1, 2, 3, 900000, 3000000, 6, '2017-08-15 00:23:33', '15027314137096', 'PAID', 'BNI', 'Hartono Harianja', '5473534564356345', 900000, 'Sukses'),
(7, 1, 2, 3, 600000, 2000000, 4, '2017-08-15 02:17:46', '15027382664237', 'UNPAID', NULL, NULL, NULL, NULL, NULL),
(8, 1, 2, 4, 540000, 1800000, 6, '2017-08-15 14:32:54', '15027823743901', 'COMPLETED', 'BCA', 'Hartono Harianja', '723462364264', 540000, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id_cart` int(11) NOT NULL,
  `id_indekos` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `harga` int(20) NOT NULL,
  `durasi` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_indekos`
--

CREATE TABLE `tbl_indekos` (
  `id_indekos` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` mediumtext NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `harga` int(20) NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `gambar_1` varchar(30) NOT NULL,
  `gambar_2` varchar(30) NOT NULL,
  `gambar_3` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_indekos`
--

INSERT INTO `tbl_indekos` (`id_indekos`, `id_seller`, `kelas`, `judul`, `deskripsi`, `alamat`, `harga`, `gambar`, `gambar_1`, `gambar_2`, `gambar_3`, `status`) VALUES
(1, 2, 'VIP', 'Kos - kosan campur laki perempuan', '<p>Feel Like A Home - kost khusus mahasiswi/karyawati&nbsp;<br />Lokasi kost sangat strategis di area Tomang Jakarta Barat, dekat dengan kampus Universitas Trisakti, Universitas Tarumanegara dan Ukrida<br /><br />- Fasilitas lengkap<br />- Ruangan yang besar dan nyaman&nbsp;<br />- tempat parkir yang luas<br />- lokasi yang sangat strategis di pusat kota dekat dengan ITC Roxy Mas<br /><br />Alamat kost:<br />Jl Tomang Utara 26A, Jakarta Barat<br /><br />Hubungi 0816910937<br />Email : m4rthac@gmail.com</p>', 'Jl.Pancing Ujung No. 77 Medan', 1000000, '668671.jpg', '51947.jpg', '266828.jpg', '708716.jpg', '1'),
(3, 2, 'Eksekutif', 'Indekos Lengkap Harga terjangkau', '<p>Feel Like A Home - kost khusus mahasiswi/karyawati&nbsp;<br />Lokasi kost sangat strategis di area Tomang Jakarta Barat, dekat dengan kampus Universitas Trisakti, Universitas Tarumanegara dan Ukrida<br /><br />- Fasilitas lengkap<br />- Ruangan yang besar dan nyaman&nbsp;<br />- tempat parkir yang luas<br />- lokasi yang sangat strategis di pusat kota dekat dengan ITC Roxy Mas<br /><br />Alamat kost:<br />Jl Tomang Utara 26A, Jakarta Barat<br /><br />Hubungi 0816910937<br />Email : m4rthac@gmail.com</p>', 'Jl. Sekar Sari No 76 Medan Helvetia', 500000, '312512.jpg', '644618.jpg', '646581.jpg', '966867.jpg', '1'),
(4, 2, 'Ekonomi', 'Kos Murah Meriah Muntaber', '<p>Feel Like A Home - kost khusus mahasiswi/karyawati&nbsp;<br />Lokasi kost sangat strategis di area Tomang Jakarta Barat, dekat dengan kampus Universitas Trisakti, Universitas Tarumanegara dan Ukrida<br /><br />- Fasilitas lengkap<br />- Ruangan yang besar dan nyaman&nbsp;<br />- tempat parkir yang luas<br />- lokasi yang sangat strategis di pusat kota dekat dengan ITC Roxy Mas<br /><br />Alamat kost:<br />Jl Tomang Utara 26A, Jakarta Barat<br /><br />Hubungi 0816910937<br />Email : m4rthac@gmail.com</p>', 'Jl. Patumbak no 0 Medan patumbak', 300000, '731076.jpg', '323731.jpg', '227378.jpg', '212974.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

CREATE TABLE `tbl_seller` (
  `id_seller` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `koor_lat` varchar(30) DEFAULT NULL,
  `koor_long` varchar(30) DEFAULT NULL,
  `no_rek` varchar(20) NOT NULL,
  `nama_rek` varchar(25) NOT NULL,
  `bank_rek` varchar(15) NOT NULL,
  `tgl_registrasi` datetime NOT NULL,
  `session` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`id_seller`, `nama`, `username`, `password`, `no_hp`, `alamat`, `koor_lat`, `koor_long`, `no_rek`, `nama_rek`, `bank_rek`, `tgl_registrasi`, `session`) VALUES
(1, 'Kartolo', 'kartolo123', '$2y$10$de28YYe4itIUuXikPubvXOtPKU0xROQxvtvI3SK15g2no8fbZEafi', '085647385864', '', NULL, NULL, '', '', '', '2017-08-08 23:29:24', 'seller'),
(2, 'Sagala', 'sagala123', '$2y$10$ddq4vu78RTBYIEEms/D1iue2m55TolGIiA5mDYDAgzdqQFcvIfT.e', '085745653342', 'Medan Sunggal, Medan City, North Sumatra, Indonesia', '3.5759525', '98.6215649', '4675645347', 'Sagala LN', 'BCA', '2017-08-08 23:31:17', 'seller');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tgl_registrasi` datetime NOT NULL,
  `session` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama`, `username`, `password`, `no_hp`, `tgl_registrasi`, `session`) VALUES
(1, 'Hartono', 'hartono123', '$2y$10$rg/uqE3foTZy.pbox63NOuyCMAX9yIxFSgvcdZYXzsRrQJBureacW', '08465747584', '2017-08-11 01:34:48', 'user'),
(6, 'Desman', 'desman123', '$2y$10$oP0BD02WOjue.MzgWn8SY.JFf69m8RHi6XTALYGXq4ucY1/oIdgqq', '085745653342', '2017-08-11 01:53:11', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_penjual` (`id_penjual`),
  ADD KEY `id_indekos` (`id_indekos`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_indekos` (`id_indekos`),
  ADD KEY `id_penjual` (`id_penjual`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Indexes for table `tbl_indekos`
--
ALTER TABLE `tbl_indekos`
  ADD PRIMARY KEY (`id_indekos`),
  ADD KEY `id_seller` (`id_seller`);

--
-- Indexes for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  ADD PRIMARY KEY (`id_seller`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id_booking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_indekos`
--
ALTER TABLE `tbl_indekos`
  MODIFY `id_indekos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_seller`
--
ALTER TABLE `tbl_seller`
  MODIFY `id_seller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
