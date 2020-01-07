-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Jul 2018 pada 05.09
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pencatatan_fotocopy`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(30) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_kategori` varchar(20) DEFAULT NULL,
  `time_create` datetime NOT NULL,
  `time_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_beli`, `harga_barang`, `stok`, `id_kategori`, `time_create`, `time_update`) VALUES
('10116003', 'Pensil', 1000, 2000, 999, '11001', '0000-00-00 00:00:00', '2018-07-16 07:26:18'),
('10116004', 'Penghapus pensil krayon', 100, 404, 493, '11003', '0000-00-00 00:00:00', '2018-07-16 07:25:42'),
('10116005', 'penggaris', 500, 1000, 290, '11002', '0000-00-00 00:00:00', '2018-07-16 07:25:29'),
('103-7047e', 'laptop', 100000, 10000000, 7, '11003', '2018-07-07 15:39:21', '2018-07-16 07:26:32'),
('103-94d02', 'pensil berwarna', 1000, 2000, 12, '11003', '2018-07-07 15:41:47', '2018-07-16 07:26:49'),
('103-c8f40', 'sepatu emas', 2000000, 2147483647, 234, '11002', '2018-07-08 22:48:35', '2018-07-16 07:27:01'),
('103-caeed', 'kursi', 120000, 150000, 100, '11002', '2018-07-16 05:40:13', '2018-07-16 05:40:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_pembelian` varchar(30) DEFAULT NULL,
  `id_barang` varchar(30) NOT NULL,
  `qty_pembelian` int(11) DEFAULT NULL,
  `total_harga_pembelian` int(11) DEFAULT NULL,
  `time_create` datetime DEFAULT NULL,
  `time_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_pembelian`, `id_barang`, `qty_pembelian`, `total_harga_pembelian`, `time_create`, `time_update`) VALUES
('105-27c76ad3', '10116005', 5, 2500, '2018-07-16 07:53:14', '2018-07-16 07:53:14'),
('105-27c76ad3', '103-7047e', 2, 200000, '2018-07-16 07:53:14', '2018-07-16 07:53:14'),
('105-27c76ad3', '103-94d02', 4, 4000, '2018-07-16 07:53:15', '2018-07-16 07:53:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_penjualan` varchar(30) NOT NULL,
  `id_barang` varchar(30) NOT NULL,
  `qty_penjualan` int(11) DEFAULT NULL,
  `total_harga_penjualan` int(11) DEFAULT NULL,
  `time_create` datetime NOT NULL,
  `time_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_penjualan`, `id_barang`, `qty_penjualan`, `total_harga_penjualan`, `time_create`, `time_update`) VALUES
('105-33d262f1', '103-94d02', 2, 2000, '2018-07-16 06:08:05', '2018-07-16 06:20:39'),
('105-53f48dc0', '10116005', 1, 1000, '2018-07-16 06:08:22', '2018-07-16 06:08:22'),
('105-53f48dc0', '103-94d02', 1, 2000, '2018-07-16 06:08:22', '2018-07-16 06:08:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(30) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `time_create` datetime NOT NULL,
  `time_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `time_create`, `time_update`) VALUES
('102-15465', 'data entry', '2018-07-14 22:20:32', '2018-07-14 22:20:32'),
('102-c1c0c', 'Pemilik', '2018-07-15 13:40:18', '2018-07-15 13:40:18'),
('102-c6848', 'admin', '2018-07-14 22:20:05', '2018-07-14 22:20:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` varchar(20) NOT NULL,
  `nama_kategori` varchar(30) DEFAULT NULL,
  `time_create` datetime NOT NULL,
  `time_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `time_create`, `time_update`) VALUES
('11001', 'peralatan sekolah', '0000-00-00 00:00:00', '2018-07-04 14:37:23'),
('11002', 'Peralatan Kantor', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('11003', 'Property', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(50) NOT NULL,
  `nama_p` varchar(30) NOT NULL,
  `no_telp` varchar(13) DEFAULT NULL,
  `id_jabatan` varchar(30) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `time_create` datetime NOT NULL,
  `time_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_p`, `no_telp`, `id_jabatan`, `username`, `pass`, `time_create`, `time_update`) VALUES
('101-752e3', 'akbar', '0892345345', '102-15465', 'akbar', '202cb962ac59075b964b07152d234b70', '2018-07-14 22:21:47', '2018-07-14 22:21:47'),
('101-790cd', 'kurnia', '0892345345', '102-15465', 'kurnia', '202cb962ac59075b964b07152d234b70', '2018-07-14 22:23:49', '2018-07-14 22:23:49'),
('101-a583e', 'herdita permana', '089668354665', '102-c6848', 'admin', '202cb962ac59075b964b07152d234b70', '2018-07-14 22:21:08', '2018-07-14 22:21:08'),
('101-bdcb0', 'adit', '0892345345', '102-15465', 'adit', '202cb962ac59075b964b07152d234b70', '2018-07-14 22:23:30', '2018-07-14 22:23:30'),
('101-ebff1', 'alga', '0892345345', '102-15465', 'alga', '202cb962ac59075b964b07152d234b70', '2018-07-14 22:21:29', '2018-07-14 22:21:29'),
('101-f941f', 'agni', '089668354665', '102-c1c0c', 'agni', 'c4ac485d9b7abe5d74641bb2f14b90ae', '2018-07-15 13:40:44', '2018-07-15 13:40:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` varchar(30) NOT NULL,
  `tgl_pembelian` date DEFAULT NULL,
  `tharga_pembelian` int(11) DEFAULT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `keterangan` text,
  `time_create` datetime DEFAULT NULL,
  `time_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tgl_pembelian`, `tharga_pembelian`, `id_pegawai`, `keterangan`, `time_create`, `time_update`) VALUES
('105-27c76ad3', '2018-07-16', 206500, '101-ebff1', '', '2018-07-16 07:53:14', '2018-07-16 07:53:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(30) NOT NULL,
  `tharga_penjualan` int(11) DEFAULT NULL,
  `id_pegawai` varchar(50) NOT NULL,
  `keterangan` text,
  `time_create` datetime NOT NULL,
  `time_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `tharga_penjualan`, `id_pegawai`, `keterangan`, `time_create`, `time_update`) VALUES
('105-04739a35', 2404, '101-ebff1', '', '2018-07-16 06:04:04', '2018-07-16 06:04:04'),
('105-06a15396', 3000, '101-ebff1', '', '2018-07-16 06:05:24', '2018-07-16 06:05:24'),
('105-29773f5b', 110000000, '101-f941f', '', '2018-07-16 06:24:07', '2018-07-16 06:24:07'),
('105-33d262f1', 2000, '101-ebff1', '', '2018-07-16 06:08:05', '2018-07-16 06:08:05'),
('105-53f48dc0', 3000, '101-ebff1', '', '2018-07-16 06:08:22', '2018-07-16 06:08:22'),
('105-55c46c45', 10004000, '101-ebff1', '', '2018-07-16 06:03:07', '2018-07-16 06:03:07'),
('105-60df4562', 1404, '101-ebff1', '', '2018-07-16 06:07:34', '2018-07-16 06:07:34'),
('105-709f2492', 16000, '101-a583e', '', '2018-07-16 00:13:50', '2018-07-16 00:13:50'),
('106-128d3a93', 110000000, '101-bdcb0', '', '2018-07-16 06:26:58', '2018-07-16 06:26:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekapitulasi`
--

CREATE TABLE `rekapitulasi` (
  `no_rekapitulasi` int(11) NOT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `bulan` varchar(10) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `pemasukan` int(11) DEFAULT NULL,
  `total_pendapatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `barang_ibfk_1` (`id_kategori`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD KEY `detail_pembelian_ibfk_1` (`id_barang`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD KEY `detail_penjualan_ibfk_1` (`id_barang`),
  ADD KEY `id_penjualan` (`id_penjualan`,`id_barang`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `rekapitulasi`
--
ALTER TABLE `rekapitulasi`
  ADD PRIMARY KEY (`no_rekapitulasi`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`);

--
-- Ketidakleluasaan untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD CONSTRAINT `detail_penjualan_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
