-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2023 pada 15.01
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkir`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_mem` char(8) NOT NULL,
  `no_pol` char(9) DEFAULT NULL,
  `jenis` enum('Motor','Mobil') DEFAULT NULL,
  `merek_ken` varchar(50) DEFAULT NULL,
  `pemilik` varchar(50) DEFAULT NULL,
  `status` enum('aktif','nonaktif') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_mem`, `no_pol`, `jenis`, `merek_ken`, `pemilik`, `status`) VALUES
('M2019001', 'BF438SL', 'Motor', 'Suzuki', 'Li Ming Chep', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `parkirin`
--

CREATE TABLE `parkirin` (
  `id_par` char(10) NOT NULL,
  `no_pol` char(9) DEFAULT NULL,
  `status` enum('member','nonmember') DEFAULT NULL,
  `waktu_mas` time DEFAULT NULL,
  `waktu_kel` time DEFAULT NULL,
  `aksi` enum('masuk','keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `parkirin`
--

INSERT INTO `parkirin` (`id_par`, `no_pol`, `status`, `waktu_mas`, `waktu_kel`, `aksi`) VALUES
('6', 'E 4567 YU', 'nonmember', '07:29:40', '07:29:49', 'keluar'),
('7', 'Y 678 OP', 'nonmember', '07:31:53', '07:34:38', 'keluar'),
('78', 'E 7869 OP', 'nonmember', '11:15:14', '11:15:21', 'keluar'),
('TKT06336', 'L 9876 TY', 'nonmember', '05:52:54', '05:53:04', 'keluar'),
('TKT46909', 'M 6789 kk', 'nonmember', '06:19:23', '08:57:34', 'keluar'),
('TKT51b40', 'E 2345 YU', 'nonmember', '05:43:16', '05:46:21', 'keluar'),
('TKT85598', 'E 4567 YT', 'nonmember', '05:50:51', '05:50:58', 'keluar'),
('TKTbaa07', 'E 6789 LO', 'nonmember', '05:48:04', '05:48:16', 'keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `username` char(25) NOT NULL,
  `password` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `password`) VALUES
('admin', '123'),
('iman', '123'),
('perdi', '123');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_mem`),
  ADD UNIQUE KEY `no_pol` (`no_pol`);

--
-- Indeks untuk tabel `parkirin`
--
ALTER TABLE `parkirin`
  ADD PRIMARY KEY (`id_par`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
