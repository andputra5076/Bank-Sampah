-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 20, 2024 at 12:17 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank_sampah_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id_image` int NOT NULL,
  `id_produk` int NOT NULL,
  `url_thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id_image`, `id_produk`, `url_thumbnail`) VALUES
(1, 1, 'https://blog.sribu.com/wp-content/uploads/2023/05/contoh-desain-produk-makanan.webp'),
(2, 2, 'https://blog.sribu.com/wp-content/uploads/2023/05/contoh-desain-produk-makanan.webp'),
(3, 3, 'https://blog.sribu.com/wp-content/uploads/2023/05/contoh-desain-produk-makanan.webp'),
(4, 1, 'https://blog.sribu.com/wp-content/uploads/2023/05/contoh-desain-produk-makanan.webp');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `nama`) VALUES
(1, 'Plastik (Gram)'),
(2, 'Kertas (Gram)'),
(3, 'Jelanta (Ml)'),
(4, 'Logam (Gram)'),
(5, 'Kaca (Gram)');

-- --------------------------------------------------------

--
-- Table structure for table `kritik_saran`
--

CREATE TABLE `kritik_saran` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `balasan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at_balasan` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kritik_saran`
--

INSERT INTO `kritik_saran` (`id`, `id_user`, `nama`, `email`, `pesan`, `balasan`, `created_at`, `created_at_balasan`) VALUES
(7, 6, 'Administrator', 'admin@gmail.com', 'okey', 'oke', '2024-10-14 08:38:39', '2024-10-15 15:49:24'),
(8, 6, 'Administratorsdd', 'admin@gmail.com', 'sd', 'tes', '2024-10-14 08:38:47', '2024-10-15 15:51:45'),
(9, 6, 'Administrator', 'admin@gmail.com', 'sd', '', '2024-10-14 08:42:57', NULL),
(11, 6, 'Administrator', 'admin@gmail.com', 'Okey', '', '2024-10-15 08:37:34', NULL);

--
-- Triggers `kritik_saran`
--
DELIMITER $$
CREATE TRIGGER `before_insert_balasan` BEFORE UPDATE ON `kritik_saran` FOR EACH ROW BEGIN
    IF NEW.balasan IS NOT NULL THEN
        SET NEW.created_at_balasan = NOW();
    ELSE
        SET NEW.created_at_balasan = NULL; -- Menetapkan nilai NULL jika tidak ada balasan
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `stok` int NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori`, `harga`, `stok`, `deskripsi`) VALUES
(1, 'Laptop XYZ', 'Elektronik', 15000000.00, 25, 'Laptop dengan prosesor Intel i7 generasi 12.'),
(2, 'Sneakers Comfort', 'Fashion', 1200000.00, 50, 'Sepatu sneakers dengan desain modern dan nyaman.'),
(3, 'Meja Belajar Minimalis', 'Furniture', 700000.00, 30, 'Meja kayu dengan desain minimalis.');

-- --------------------------------------------------------

--
-- Table structure for table `setoran_sampah`
--

CREATE TABLE `setoran_sampah` (
  `id` int NOT NULL,
  `kode_transaksi` text NOT NULL,
  `id_user` int NOT NULL,
  `id_jenis` int NOT NULL,
  `jumlah` int NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `setoran_sampah`
--

INSERT INTO `setoran_sampah` (`id`, `kode_transaksi`, `id_user`, `id_jenis`, `jumlah`, `keterangan`, `created_at`) VALUES
(30, 'TRX-20241015081306-560', 6, 2, 1, 'Oke\r\n', '2024-10-15 08:13:06'),
(31, '', 7, 2, 12, 'asd', '2024-11-19 17:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `level` enum('0','1') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '1',
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text,
  `foto_profil` varchar(255) DEFAULT NULL,
  `point` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `nama_lengkap`, `level`, `telepon`, `alamat`, `foto_profil`, `point`, `status`, `created_at`, `updated_at`) VALUES
(6, 'admin', '0795151defba7a4b5dfa89170de46277', 'admin@gmail.com', 'Administrator', '1', '089508264556', 'Jalan Bukit Tinggi, No 87 A, Sukorejo, Bangsalsari, Jember, Jawa Timur, 62657.', 'assets/images/Indonesia-Flag-250x250-1.png', 19500, 1, '2024-10-10 08:13:20', '2024-11-19 17:54:08'),
(7, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@user.com', 'user', '1', '089508264556', 'Andra,   asdas123//172, 17', 'assets/images/Indonesia-Flag-250x250-1.png', 18000, 1, '2024-11-19 17:50:25', '2024-11-19 19:49:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `setoran_sampah`
--
ALTER TABLE `setoran_sampah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kritik_saran`
--
ALTER TABLE `kritik_saran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setoran_sampah`
--
ALTER TABLE `setoran_sampah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
