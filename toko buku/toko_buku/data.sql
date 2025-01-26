-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2022 at 11:15 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rio_unibookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` varchar(5) NOT NULL,
  `penerbit_id` varchar(5) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `penerbit_id`, `kategori`, `nama`, `harga`, `stok`) VALUES
('B1001', 'SP01', 'Bisnis', 'Bisnis Online', 75000, 9),
('B1002', 'SP01', 'Bisnis', 'Etika Bisnis dan Tanggung Jawab Sosial', 67500, 20),
('B1003', 'SP01', 'Bisnis', 'Belajar membangun bisnis', 50000, 62),
('K1001', 'SP01', 'Keilmuan', 'Analisis & Perancangan Sistem Informasi', 50000, 60),
('K1002', 'SP01', 'Keilmuan', 'Artifical Intelligence', 45000, 60),
('K2003', 'SP01', 'Keilmuan', 'Autocad 3 Dimensi', 40000, 25),
('K3004', 'SP01', 'Keilmuan', 'Cloud Computing Technology', 85000, 15),
('N1001', 'SP02', 'Novel', 'Cahaya Di Penjuru Hati', 68000, 10),
('N1002', 'SP03', 'Novel', 'Aku Ingin Cerita', 48000, 12);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `telepon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id`, `nama`, `alamat`, `kota`, `telepon`) VALUES
('SP01', 'Penerbit Informatika', 'Jl. Buah Batu No. 121', 'Bandung', '0813-2220-1946'),
('SP02', 'Andi Offset', 'Jl. Suryalaya IX No.3', 'Bandung', '0878-3903-0688'),
('SP03', 'Danendra', 'Jl Moch. Toha 44', 'Bandung', '022-5201215'),
('SP04', 'Andis', 'test2', 'test2', '021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
