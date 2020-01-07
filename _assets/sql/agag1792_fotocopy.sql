-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 17 Jul 2018 pada 11.27
-- Versi server: 10.1.31-MariaDB-cll-lve
-- Versi PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agag1792_fotocopy`
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
('10116005', 'penggaris', 500, 1000, 290, '11002', '0000-00-00 00:00:00', '2018-07-16 07:25:29'),
('103-0064a', 'Plastik Laminating', 21000, 27000, 2, '11001', '2018-07-17 11:18:24', '2018-07-17 11:18:24'),
('103-0797c', 'Gunting', 10500, 14000, 1, '11003', '2018-07-17 11:16:54', '2018-07-17 11:16:54'),
('103-1462c', 'Buku Nota', 6000, 7000, 0, '11003', '2018-07-17 11:02:12', '2018-07-17 11:02:12'),
('103-1d741', 'Buku Kwitansi  SIDU', 4000, 6000, 0, '11003', '2018-07-17 11:01:55', '2018-07-17 11:01:55'),
('103-1f244', 'Bussiness File', 4000, 6000, 0, '11003', '2018-07-17 11:02:37', '2018-07-17 11:02:37'),
('103-2da7c', 'Binder Clip (260)', 15000, 17000, 0, '11003', '2018-07-17 11:00:38', '2018-07-17 11:00:38'),
('103-2f7d9', 'Penggaris', 2000, 4000, 2, '11003', '2018-07-17 11:17:57', '2018-07-17 11:17:57'),
('103-6c702', 'Kertas Foto', 25000, 27000, 1, '11002', '2018-07-17 11:15:22', '2018-07-17 11:15:22'),
('103-8896a', 'isi Cutter', 5000, 7000, 2, '11003', '2018-07-17 11:14:14', '2018-07-17 11:14:14'),
('103-889e4', 'Komputer File Bantex', 30000, 35000, 1, '11003', '2018-07-17 11:03:36', '2018-07-17 11:03:36'),
('103-908fe', 'Damai Buku Hard Cover Folio 30', 32000, 35000, 0, '11001', '2018-07-17 00:01:51', '2018-07-17 00:01:51'),
('103-9129b', 'CD Binder BOX', 70000, 75000, 1, '11003', '2018-07-17 11:03:11', '2018-07-17 11:03:11'),
('103-94d02', 'pensil berwarna', 1000, 2000, 12, '11003', '2018-07-07 15:41:47', '2018-07-16 07:26:49'),
('103-aacb5', 'Bambi Clipboard', 15000, 17000, 2, '11003', '2018-07-17 11:13:40', '2018-07-17 11:13:40'),
('103-adacb', 'Baterai Energizer', 15000, 16000, 0, '11003', '2018-07-17 10:59:50', '2018-07-17 10:59:50'),
('103-b5917', 'Kiky amplop coklat tali', 12000, 14000, 0, '11002', '2018-07-17 10:55:13', '2018-07-17 10:55:13'),
('103-b9ef9', 'Lem Stick dan Cair', 10000, 12000, 9, '11003', '2018-07-17 11:16:03', '2018-07-17 11:16:03'),
('103-bbb58', 'Double tape foam', 16000, 20000, 1, '11003', '2018-07-17 11:04:45', '2018-07-17 11:04:45'),
('103-d006a', 'Kenko Pelubag Kertas', 40000, 45000, 2, '11003', '2018-07-17 11:13:07', '2018-07-17 11:13:07'),
('103-d6906', 'correction pen (Tip-x)', 8500, 10000, 1, '11001', '2018-07-17 11:04:11', '2018-07-17 11:04:11'),
('103-e8518', 'White Board Maker', 5500, 7500, 0, '11001', '2018-07-17 10:59:19', '2018-07-17 10:59:19'),
('103-fbadb', 'Buku Agenda Deluxe', 25000, 27000, 0, '11003', '2018-07-17 11:01:08', '2018-07-17 11:01:08'),
('103-fc337', 'Damai Buku Hard Cover Folio 10', 35000, 37000, 0, '11001', '2018-07-17 00:03:52', '2018-07-17 00:03:52'),
('103-fc410', 'Sticky Note', 8500, 9000, 1, '11003', '2018-07-17 11:14:50', '2018-07-17 11:14:50');

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
('104-8049b', 'Perlengkapan Komputer', '2018-07-16 23:56:08', '2018-07-16 23:56:08'),
('11001', 'Alat Tulis', '0000-00-00 00:00:00', '2018-07-16 23:54:14'),
('11002', 'Produk Kertas', '0000-00-00 00:00:00', '2018-07-16 23:54:28'),
('11003', 'Peralatan Kantor', '0000-00-00 00:00:00', '2018-07-16 23:54:57');

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
('101-d2916', 'Aini izza', '082210820104', '102-15465', 'aini', '8274b82aa057f3df1908084f14c55ec3', '2018-07-16 23:15:14', '2018-07-16 23:15:14'),
('101-ebff1', 'alga', '0892345345', '102-15465', 'alga', '202cb962ac59075b964b07152d234b70', '2018-07-14 22:21:29', '2018-07-14 22:21:29'),
('101-f941f', 'Aghniya Niamillah Nurhilman', '082214327471', '102-c1c0c', 'agni', 'c4ac485d9b7abe5d74641bb2f14b90ae', '2018-07-15 13:40:44', '2018-07-16 23:13:20');

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
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `barang_ibfk_1` (`id_kategori`);

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD KEY `detail_pembelian_ibfk_1` (`id_barang`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indeks untuk tabel `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD KEY `detail_penjualan_ibfk_1` (`id_barang`),
  ADD KEY `id_penjualan` (`id_penjualan`,`id_barang`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `rekapitulasi`
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
