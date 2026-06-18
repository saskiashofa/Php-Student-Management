-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2025 at 12:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siak_upi`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `email`, `jurusan`, `gambar`) VALUES
(1, '240101', 'Andi Pratama', 'andi.pratama@example.com', 'PSTI', 'andi.jpg'),
(2, '240102', 'Budi Santoso', 'budi.santoso@example.com', 'PSTI', 'budi.jpg'),
(3, '240103', 'Citra Lestari', 'citra.lestari@example.com', 'MKB', 'citra.jpg'),
(4, '240104', 'Dewi Anjani', 'dewi.anjani@example.com', 'SISTEL', 'dewi.jpg'),
(5, '240105', 'Eko Nugroho', 'eko.nugroho@example.com', 'SISTEL', 'eko.jpg'),
(6, '240106', 'Fitri Handayani', 'fitri.handayani@example.com', 'PGPAUD', 'fitri.jpg'),
(7, '240107', 'Gilang Saputra', 'gilang.saputra@example.com', 'MKB', 'gilang.jpg'),
(8, '240108', 'Hana Puspita', 'hana.puspita@example.com', 'PGSD', 'hana.jpg'),
(9, '240109', 'Irwan Setiawan', 'irwan.setiawan@example.com', 'PGSD', 'irwan.jpg'),
(10, '240110', 'Joko Susanto', 'joko.susanto@example.com', 'PGPAUD', 'joko.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
