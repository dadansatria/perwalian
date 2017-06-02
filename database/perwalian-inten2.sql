-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 02, 2017 at 06:05 
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perwalian-inten2`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nama`, `alamat`) VALUES
(1, 'Lorem Ipsum', 'jl lorem');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_matkul`
--

CREATE TABLE `dosen_matkul` (
  `id` int(11) NOT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`) VALUES
(1, 'Teknik Informatika'),
(2, 'Teknik Sipil'),
(3, 'Teknik Arsitektur'),
(4, 'Teknk Elektro');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `angkatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `alamat`, `hp`, `id_jurusan`, `angkatan`) VALUES
(1118, 'Nugraha', 'bandung', NULL, 3, '2018'),
(11178, 'Dadan', 'jl burung gerjea', NULL, 3, '2016'),
(1116005, 'Dadan Satria', 'sadang saip', NULL, 1, '2015'),
(1116006, 'Dadan Lorem', 'Bandung Gundul Pacul', NULL, 2, '2015');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `kode`, `id_jurusan`, `nama`, `sks`) VALUES
(1, 'MK001', 1, 'Dasar Dasar Kerekayasaan', 1),
(2, 'MK002', 1, 'Algoritma Pemrograman', 2),
(3, 'MK003', 1, 'Sistem Informasi', 1),
(4, 'MK004', 1, 'Pengenalan Hardware', 1);

-- --------------------------------------------------------

--
-- Table structure for table `perwalian`
--

CREATE TABLE `perwalian` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perwalian`
--

INSERT INTO `perwalian` (`id`, `nama`, `id_dosen`, `keterangan`) VALUES
(1, 'Dadan Satria', 1, 'Kerangan'),
(3, 'Perwalian semester 2', 1, 'l');

-- --------------------------------------------------------

--
-- Table structure for table `perwalian_matkul`
--

CREATE TABLE `perwalian_matkul` (
  `id` int(11) NOT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `id_perwalian` int(11) DEFAULT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perwalian_matkul`
--

INSERT INTO `perwalian_matkul` (`id`, `id_matkul`, `id_perwalian`, `nilai`, `status`) VALUES
(1, 0, 1, '0', 1),
(2, 0, 1, '0', 1),
(3, 0, 1, '0', 1),
(4, 0, 1, '0', 1),
(5, 0, 1, '0', 1),
(6, 0, 1, '0', 1),
(7, 0, 1, '0', 1),
(8, 0, 1, '0', 1),
(9, 0, 1, '0', 1),
(10, 0, 1, '0', 1),
(11, 0, 1, '0', 1),
(12, 0, 1, '0', 1),
(13, 0, 1, '0', 1),
(14, 0, 1, '0', 1),
(15, 0, 1, '0', 1),
(16, 0, 1, '0', 1),
(17, 0, 1, '0', 1),
(18, 0, 1, '0', 1),
(19, 0, 1, '0', 1),
(20, 0, 1, '0', 1),
(21, 0, 3, '0', 1),
(22, 0, 3, '0', 1),
(23, 0, 3, '0', 1),
(24, 0, 3, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `id_model` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `model`, `id_model`, `password`) VALUES
(1, 'admin', 'admin', 1, '$2y$10$eCOTgQ2YVKSJja7ZJQdjJOce5illM4W/vcQ1CSyEmbjxQvXXotmhG'),
(2, '01116005', 'mahasiswa', 1, '01116005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen_matkul`
--
ALTER TABLE `dosen_matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perwalian`
--
ALTER TABLE `perwalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perwalian_matkul`
--
ALTER TABLE `perwalian_matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dosen_matkul`
--
ALTER TABLE `dosen_matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `perwalian`
--
ALTER TABLE `perwalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `perwalian_matkul`
--
ALTER TABLE `perwalian_matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
