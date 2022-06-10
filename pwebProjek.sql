-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2022 pada 18.32
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


DROP SCHEMA IF EXISTS project_web;
CREATE SCHEMA project_web;
USE project_web;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pweb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asal`
--

CREATE TABLE `asal` (
  `asal_id` int(10) NOT NULL,
  `country` varchar(255) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `asal`
--

INSERT INTO `asal` (`asal_id`, `country`, `last_update`) VALUES
(1, 'Germany', '2022-06-09 15:22:31'),
(2, 'Japan', '2022-06-09 15:22:37'),
(3, 'Russia\r\n', '2022-06-09 15:22:45'),
(4, 'France', '2022-06-09 15:22:52'),
(5, 'Spain', '2022-06-09 15:23:01'),
(6, 'England', '2022-06-09 15:23:08'),
(7, 'United States', '2022-06-09 15:23:32'),
(8, 'Qatar', '2022-06-09 15:23:44'),
(9, 'Australia', '2022-06-09 15:24:18'),
(10, 'Brazil', '2022-06-09 15:24:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` int(8) NOT NULL,
  `stok_barang` int(8) NOT NULL,
  `kondisi` int(10) NOT NULL,
  `asal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID`, `nama_barang`, `harga_barang`, `stok_barang`, `kondisi`, `asal`) VALUES
(1, 'Laptop', 10000, 30, 2, 3),
(2, 'Monitor', 20000, 35, 3, 6),
(3, 'Mobil', 500000, 15, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi`
--

CREATE TABLE `kondisi` (
  `id_kondisi` int(10) NOT NULL,
  `kondisi` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kondisi`
--

INSERT INTO `kondisi` (`id_kondisi`, `kondisi`, `deskripsi`, `last_update`) VALUES
(1, 'BNIB', 'lorem lorem ipsum', '2022-06-09 15:31:02'),
(2, 'BNOB', 'lorem lorem ipsum', '2022-06-09 15:31:07'),
(3, 'BEKAS', 'lorem lorem ipsum', '2022-06-09 15:31:12'),
(4, 'SECOND HAND', 'lorem lorem ipsum', '2022-06-09 15:31:17');

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asal`
--
ALTER TABLE `asal`
  ADD PRIMARY KEY (`asal_id`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `asal`
--
ALTER TABLE `asal`
  MODIFY `asal_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id_kondisi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
