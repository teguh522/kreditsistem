-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Mar 2021 pada 09.07
-- Versi server: 8.0.23-0ubuntu0.20.04.1
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kreditsistem`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `angsuran`
--

CREATE TABLE `angsuran` (
  `id_angsuran` int NOT NULL,
  `id_kredit` int NOT NULL,
  `jumlah_angsuran` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `angsuran`
--

INSERT INTO `angsuran` (`id_angsuran`, `id_kredit`, `jumlah_angsuran`, `created_at`) VALUES
(10, 9, '300000', '2021-03-10 01:35:44'),
(11, 9, '600000', '2021-03-10 01:52:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

CREATE TABLE `auth` (
  `id_auth` int NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 NOT NULL,
  `level` enum('admin','user') CHARACTER SET latin1 NOT NULL DEFAULT 'user',
  `status` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id_auth`, `email`, `password`, `level`, `status`, `created_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$8cx5a.QZLBdyKQgy.9nBkesth79qtHBhrQE.Ml8mL9zuV1Iy7WnCm', 'admin', 1, '2021-02-15 08:02:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kredit`
--

CREATE TABLE `kredit` (
  `id_kredit` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `id_barang` int NOT NULL,
  `harga_jual` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tenor` int NOT NULL,
  `jatuh_tempo` date NOT NULL,
  `tgl_tagihan` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `kredit`
--

INSERT INTO `kredit` (`id_kredit`, `id_pelanggan`, `id_barang`, `harga_jual`, `tenor`, `jatuh_tempo`, `tgl_tagihan`, `created_at`) VALUES
(8, 3, 7, '5500000', 12, '2021-03-08', '12', '2021-02-17 02:37:40'),
(9, 3, 6, '7000000', 12, '2021-03-13', '12', '2021-02-19 02:01:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mbarang`
--

CREATE TABLE `mbarang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `deskripsi` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hpp` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mbarang`
--

INSERT INTO `mbarang` (`id_barang`, `nama_barang`, `deskripsi`, `hpp`, `foto`, `created_at`) VALUES
(6, 'Samsung A51', 'RAM 6 GB', '5500000', '1613438878.jpeg', '2021-02-15 10:06:52'),
(7, 'Laptop HP', 'Core I3', '5000000', '1613443472.jpeg', '2021-02-16 02:44:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mpelanggan`
--

CREATE TABLE `mpelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama_pel` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_ktp` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_wa` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `no_saudara` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_saudara` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mpelanggan`
--

INSERT INTO `mpelanggan` (`id_pelanggan`, `nama_pel`, `no_ktp`, `tgl_lahir`, `no_wa`, `alamat`, `no_saudara`, `nama_saudara`, `created_at`) VALUES
(3, 'Pelanggan 1', '32109090123123', '1987-02-12', '083823234123', 'Bandung', '0843341231231', 'Sutisna', '2021-02-17 02:36:31');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `totalangsuran`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `totalangsuran` (
`id_kredit` int
,`total_angsuran` double
);

-- --------------------------------------------------------

--
-- Struktur untuk view `totalangsuran`
--
DROP TABLE IF EXISTS `totalangsuran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `totalangsuran`  AS  select `angsuran`.`id_kredit` AS `id_kredit`,sum(`angsuran`.`jumlah_angsuran`) AS `total_angsuran` from `angsuran` group by `angsuran`.`id_kredit` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id_angsuran`),
  ADD KEY `angsuran_ibfk_1` (`id_kredit`);

--
-- Indeks untuk tabel `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id_auth`);

--
-- Indeks untuk tabel `kredit`
--
ALTER TABLE `kredit`
  ADD PRIMARY KEY (`id_kredit`),
  ADD KEY `kredit_ibfk_1` (`id_barang`),
  ADD KEY `kredit_ibfk_2` (`id_pelanggan`);

--
-- Indeks untuk tabel `mbarang`
--
ALTER TABLE `mbarang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `mpelanggan`
--
ALTER TABLE `mpelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id_angsuran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `auth`
--
ALTER TABLE `auth`
  MODIFY `id_auth` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `kredit`
--
ALTER TABLE `kredit`
  MODIFY `id_kredit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `mbarang`
--
ALTER TABLE `mbarang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `mpelanggan`
--
ALTER TABLE `mpelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `angsuran`
--
ALTER TABLE `angsuran`
  ADD CONSTRAINT `angsuran_ibfk_1` FOREIGN KEY (`id_kredit`) REFERENCES `kredit` (`id_kredit`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kredit`
--
ALTER TABLE `kredit`
  ADD CONSTRAINT `kredit_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `mbarang` (`id_barang`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `kredit_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `mpelanggan` (`id_pelanggan`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
