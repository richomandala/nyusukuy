-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 04:07 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nyusukuy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id` int(11) NOT NULL,
  `kode_bahan` varchar(10) NOT NULL,
  `bahan` varchar(255) NOT NULL,
  `stok` double NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id`, `kode_bahan`, `bahan`, `stok`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 'BHN-0001', 'Susu Sapi Murni', 23400, 'ml', '2020-08-16 20:41:48', '2020-09-02 01:05:58'),
(2, 'BHN-0002', 'Gula', 39010, 'gram', '2020-08-16 20:41:54', '2020-09-02 01:05:58'),
(3, 'BHN-0003', 'Kitkat Matcha', 89, 'pcs', '2020-08-16 20:42:05', '2020-08-31 06:54:56'),
(4, 'BHN-0004', 'Kitkat Coklat', 94, 'pcs', '2020-08-16 20:42:15', '2020-09-02 01:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `inventaris`
--

CREATE TABLE `inventaris` (
  `id` int(11) NOT NULL,
  `kode_inventaris` varchar(10) NOT NULL,
  `barang` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` double NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventaris`
--

INSERT INTO `inventaris` (`id`, `kode_inventaris`, `barang`, `keterangan`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 'BRG-0001', 'Kulkas', 'Sharp', 1, '2020-08-17 21:29:20', '2020-08-19 05:54:55'),
(2, 'BRG-0002', 'Blender', 'Supreme', 3, '2020-08-17 21:34:48', '2020-08-20 05:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `kode_pembelian` varchar(10) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `kode_pembelian`, `supplier_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'PB-0001', 1, 'Notes', '2020-08-16 20:54:42', '2020-08-28 08:46:20'),
(2, 'PB-0002', 2, 'Notes', '2020-08-16 20:56:16', '2020-08-16 20:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id` int(11) NOT NULL,
  `pembelian_id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id`, `pembelian_id`, `bahan_id`, `jumlah`, `harga`) VALUES
(2, 2, 2, 10000, 120000),
(3, 2, 3, 100, 500000),
(4, 2, 4, 100, 500000),
(5, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_tmp`
--

CREATE TABLE `pembelian_tmp` (
  `bahan_id` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `harga` double NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_tmp`
--

INSERT INTO `pembelian_tmp` (`bahan_id`, `jumlah`, `harga`, `user_id`) VALUES
(1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `kode_penjualan` varchar(10) NOT NULL,
  `pembeli` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `bayar` double DEFAULT NULL,
  `kembali` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `kode_penjualan`, `pembeli`, `total`, `bayar`, `kembali`, `created_at`, `updated_at`) VALUES
(1, 'PJ-0001', 'Richo', 30000, 50000, 20000, '2020-08-16 20:56:49', '2020-08-16 20:56:49'),
(2, 'PJ-0002', 'Dani', 36000, 40000, 4000, '2020-08-16 20:57:34', '2020-08-16 20:57:34'),
(3, 'PJ-0003', 'Dani 2', 36000, 40000, 4000, '2020-08-16 20:59:34', '2020-08-16 20:59:34'),
(4, 'PJ-0004', 'test', 34000, 35000, 1000, '2020-08-16 21:12:04', '2020-08-16 21:12:04'),
(5, 'PJ-0005', 'test', 10000, 10000, 0, '2020-08-16 21:12:39', '2020-08-16 21:12:39'),
(6, 'PJ-0006', 'test', 34000, 35000, 1000, '2020-08-16 21:13:30', '2020-08-16 21:13:30'),
(7, 'PJ-0007', 'test', 34000, 35000, 1000, '2020-08-16 21:20:07', '2020-08-16 21:20:07'),
(8, 'PJ-0008', 'richo', 10000, 50000, 40000, '2020-08-26 03:31:22', '2020-08-26 03:31:22'),
(9, 'PJ-0009', 'richo', 10000, 50000, 40000, '2020-08-26 03:35:44', '2020-08-26 03:35:44'),
(10, 'PJ-0010', 'richo', 10000, 50000, 40000, '2020-08-26 03:36:03', '2020-08-26 03:36:03'),
(11, 'PJ-0011', 'a', 10000, 25000, 15000, '2020-08-26 04:53:31', '2020-08-26 04:53:31'),
(12, 'PJ-0012', 'test', 10000, 10000, 0, '2020-08-26 04:53:58', '2020-08-26 04:53:58'),
(13, 'PJ-0013', 'rsrsrychvhf', 10000, 10000, 0, '2020-08-26 05:50:05', '2020-08-26 05:50:05'),
(14, 'PJ-0014', 'bbhbhb', 20000, 20000, 0, '2020-08-26 05:50:49', '2020-08-26 05:50:49'),
(15, 'PJ-0015', 'a', 20000, 25000, 5000, '2020-08-26 06:12:36', '2020-08-26 06:12:36'),
(16, 'PJ-0016', 'a', 20000, 100000, 80000, '2020-08-26 22:06:25', '2020-08-26 22:06:25'),
(17, 'PJ-0017', 'a', 20000, 100000, 80000, '2020-08-26 22:07:32', '2020-08-26 22:07:32'),
(18, 'PJ-0018', 'Testing', 34000, 35000, 1000, '2020-08-26 22:17:21', '2020-08-26 22:17:21'),
(19, 'PJ-0019', 'test 2', 22000, 25000, 3000, '2020-08-27 00:17:43', '2020-08-27 00:17:43'),
(20, 'PJ-0020', 'gogo', 42000, 45000, 3000, '2020-08-31 06:54:55', '2020-08-31 06:54:55'),
(21, 'PJ-0021', 'haha', 10000, 10000, 0, '2020-08-31 06:55:45', '2020-08-31 06:55:45'),
(22, 'PJ-0022', 'pp', 22000, 25000, 3000, '2020-09-02 01:05:57', '2020-09-02 01:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `penjualan_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`penjualan_id`, `produk_id`, `jumlah`) VALUES
(1, 1, 3),
(2, 11, 1),
(2, 12, 2),
(3, 11, 1),
(3, 12, 2),
(4, 1, 1),
(4, 11, 2),
(5, 1, 1),
(6, 1, 1),
(6, 11, 2),
(7, 1, 1),
(7, 11, 2),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(13, 1, 1),
(14, 1, 2),
(15, 1, 2),
(16, 1, 2),
(17, 1, 2),
(18, 1, 1),
(18, 11, 1),
(18, 12, 1),
(19, 1, 1),
(19, 11, 1),
(20, 1, 3),
(20, 11, 1),
(21, 1, 1),
(22, 1, 1),
(22, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_tmp`
--

CREATE TABLE `penjualan_tmp` (
  `produk_id` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_tmp`
--

INSERT INTO `penjualan_tmp` (`produk_id`, `jumlah`, `user_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `produk` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kode_produk`, `produk`, `harga`, `created_at`, `updated_at`) VALUES
(1, 'NK-0001', 'Nyusukuy Original', 10000, '2020-08-16 20:42:43', '2020-08-16 20:42:43'),
(11, 'NK-0002', 'Nyusukuy Matcha', 12000, '2020-08-16 20:51:06', '2020-08-16 20:51:06'),
(12, 'NK-0003', 'Nyusukuy Coklat', 12000, '2020-08-16 20:51:47', '2020-08-16 20:51:47');

-- --------------------------------------------------------

--
-- Table structure for table `produk_detail`
--

CREATE TABLE `produk_detail` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `bahan_id` int(11) NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_detail`
--

INSERT INTO `produk_detail` (`id`, `produk_id`, `bahan_id`, `jumlah`) VALUES
(1, 1, 1, 100),
(2, 1, 2, 15),
(3, 11, 1, 100),
(4, 11, 2, 15),
(5, 11, 3, 1),
(6, 12, 1, 100),
(7, 12, 2, 15),
(8, 12, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk_tmp`
--

CREATE TABLE `produk_tmp` (
  `bahan_id` int(11) NOT NULL,
  `jumlah` double NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_tmp`
--

INSERT INTO `produk_tmp` (`bahan_id`, `jumlah`, `user_id`) VALUES
(1, 100, 0),
(2, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `kode_supplier` varchar(10) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `kode_supplier`, `supplier`, `email`, `telp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'SUP-0001', 'PT. Susu Sapi Idaman', 'admin@admin.com', '081234567890', 'Test', '2020-08-16 20:53:35', '2020-08-17 21:33:26'),
(2, 'SUP-0002', 'PT. ABC', 'admin@admin.com', '081234567890', 'test', '2020-08-16 20:53:50', '2020-08-16 20:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`id`, `token`, `user_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '7e0f3944c91a77b2e0a1dd4a07d65e3c812adae62e1160b41cdd11dff1f97a5f', 1, 0, '2020-08-31 14:48:20', '2020-08-31 14:48:44'),
(2, 'd6bb809e32ca405e902af75bd2be6066316f312e729afc2345f29cc8df906104', 2, 0, '2020-08-31 14:48:48', '2020-08-31 14:49:14'),
(3, '3e1afd03554607b22f48066a7f8dfd7ce68be99c304e40b2df8656674534b9d5', 1, 1, '2020-08-31 14:49:18', NULL),
(4, 'f572aeb27a6fa5031963911eb1f4132a53627fa0980d57727dcbd32fa6975b1a', 1, 1, '2020-08-31 20:27:56', NULL),
(5, 'f2117769fc42a7e0998e88fe85b6bcc1344810de078c61fe8b0eb3525d14ebbc', 1, 1, '2020-08-31 21:05:02', NULL),
(6, 'c4b55715ff9f777f88ca1d46300fea91ed9e274e89315139e8f5287024cbba4a', 1, 1, '2020-08-31 21:06:51', NULL),
(7, '9280278cfe83464d6e5841e415dbc30f8db8ba4ef7e40163889599b89e46c265', 1, 1, '2020-08-31 21:22:42', NULL),
(8, 'a4ae6d3ac1c9c6a6e3fb1ca54452a9c8e8bf1c69ecd747a70581b6c0ca3b6f64', 1, 1, '2020-08-31 22:47:21', NULL),
(9, '2ab3ff382d260e2d219ef3d150a6e76b6e9453b3c48efa7af7dbb8224808c393', 1, 1, '2020-08-31 22:47:36', NULL),
(10, '3e24a9fdbb4cdb34d4ce036cb316fe1ec302b3f4c1b679117ddb6c77963f6f0b', 1, 1, '2020-08-31 22:47:53', NULL),
(11, 'c916904d00383cef0a3241dbfa109cc7cc54ad65707697ac9b33c11b4825930e', 1, 1, '2020-08-31 22:48:36', NULL),
(12, 'b841002b2e6c60638c83d0696dae06bc58842ecdbc9ca4bdd1711d9ffa1dd154', 1, 1, '2020-08-31 22:49:29', NULL),
(13, '886f3a6025aa17d50f5cb1d35f82a7d3ba5ab7697efacd1bbfd78cdc6601951c', 1, 1, '2020-08-31 22:49:47', NULL),
(14, '0e3eeb8352d002934d4b3c5d6111c04ff77dba1f63e508ab2077703e20c55ebf', 1, 1, '2020-08-31 22:52:09', NULL),
(15, '56392b559050b0748c9ac54696c2c0c5ffb81de8421f5759d6205a74d7c264df', 1, 1, '2020-08-31 23:01:47', NULL),
(16, '046f8f7dfa316558fe85053070227a9090a3bd00b4a4d62131ac8612acf9778a', 1, 0, '2020-09-01 11:46:58', '2020-09-01 12:09:27'),
(17, 'c498e7ebba049b6c13980b62b0bc46ab98403b99fa6c98142b4f897398c5e212', 3, 0, '2020-09-01 12:09:33', '2020-09-01 12:44:06'),
(18, '0107873ccafb5a3845f72c689d8dbe592af5b05d50fe47bc742f56a33eb4ce4c', 1, 0, '2020-09-01 12:44:11', '2020-09-01 12:44:50'),
(19, '5115ace82c41a0913c921fb6f0faf2df6bf9e3a442ffd5f3e3b2d1cdf25041da', 3, 0, '2020-09-01 12:44:55', '2020-09-01 12:45:27'),
(20, '77bf190399af29f592f1587349580feb99141df3e2c534b9748c4ebf06d7ad9b', 1, 0, '2020-09-01 12:45:33', '2020-09-01 12:46:37'),
(21, '9ee0d5a3919a9503bc6147e37110e52105d20ec0cb06b6433adaaf65b83302e2', 3, 0, '2020-09-01 12:46:41', '2020-09-01 12:56:12'),
(22, 'b060c1a7f9af2ad1d2178a7410ea86163ac619adc5ae3a2a7a7fa142e831c7b7', 2, 0, '2020-09-01 12:56:17', '2020-09-01 12:58:53'),
(23, '04ed19631f968c50f6718d4499e686680fd49fcf7384cbcbbdf080c51a526e6f', 3, 1, '2020-09-01 12:58:58', NULL),
(24, 'bbdaf853d58b028de47dee461fecdf36102bb3b1959c1f8b098d534d6717ef4d', 1, 1, '2020-09-02 10:31:34', NULL),
(25, '2c4d294a16bf1e9ce9cfb9cd99a1ac6635be4948d8510dc08c1169fa54a46699', 1, 1, '2020-09-02 10:31:35', NULL),
(26, '79561f0ce76a472a643b9a7d8a64bbcb04b1e29d7bfad22e6ab9c45fb0ec4865', 1, 1, '2020-09-02 10:31:35', NULL),
(27, '84d46c93dea6fb3adfa5b4c7f38b6ef3255b70f7ac188a989da21b52703a5088', 1, 1, '2020-09-02 10:31:36', NULL),
(28, 'f96c498af1cfe4e1294d6bc123edfb58c754cebdebff77e9edbb66c12e2ef7cd', 3, 1, '2020-09-02 10:34:01', NULL),
(29, 'bda54c8fbf56560410bad5daeaf6ff554b4e48e7a8aecc7fc4230c97bd16f8d1', 3, 1, '2020-09-02 10:34:39', NULL),
(30, '2d25ddcb5fcaa3bc60d33ee0a5873641f0d4ec161109ce663041172a42517556', 3, 1, '2020-09-02 10:58:41', NULL),
(31, '74a6d3a2ba4e81bc3f64e1b37f2d8eb606bbd1f6d403e0c73d72d098f0829c3f', 2, 1, '2020-11-27 12:51:57', NULL),
(32, '9aad2774830718940b94bd47458a77c37e10d126135ceaad6c8fdf52101819a4', 1, 1, '2020-12-19 15:43:38', NULL),
(33, 'd9279c332c68837d974431df0b252d728eea4f99e5f5ff771bfc30e29d111fe4', 1, 0, '2020-12-19 15:43:40', '2020-12-19 15:44:32'),
(34, 'ffdfe7cda71424a5f66aa558eb69615db39e6b3e41302827fc979c084ed0f2c3', 1, 1, '2020-12-19 15:44:52', NULL),
(35, 'ddd9dbd3fb5999f6081b90f8b87e6425df479e310fba82f05bca6e740a718fb9', 1, 1, '2020-12-19 15:54:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Richo Mandala', 'richo', '$2y$10$qEouWw4G1F1HBPL2kihITOqBE1vK5wZTylQV7zHZjHq3oVGoHPsZ6'),
(2, 'Administrator', 'admin', '$2y$10$qEouWw4G1F1HBPL2kihITOqBE1vK5wZTylQV7zHZjHq3oVGoHPsZ6'),
(3, 'Kasir', 'kasir', '$2y$10$qEouWw4G1F1HBPL2kihITOqBE1vK5wZTylQV7zHZjHq3oVGoHPsZ6');

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_bahan` (`kode_bahan`);

--
-- Indexes for table `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pembelian` (`kode_pembelian`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian_tmp`
--
ALTER TABLE `pembelian_tmp`
  ADD PRIMARY KEY (`bahan_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_penjualan` (`kode_penjualan`);

--
-- Indexes for table `penjualan_tmp`
--
ALTER TABLE `penjualan_tmp`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `produk_detail`
--
ALTER TABLE `produk_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_tmp`
--
ALTER TABLE `produk_tmp`
  ADD PRIMARY KEY (`bahan_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_supplier` (`kode_supplier`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk_detail`
--
ALTER TABLE `produk_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
