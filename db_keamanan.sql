-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jul 2024 pada 00.31
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keamanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dekripsi`
--

CREATE TABLE `dekripsi` (
  `id_de` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_file` varchar(100) NOT NULL,
  `ukuran_file` varchar(20) NOT NULL,
  `filepath` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `dekripsi`
--

INSERT INTO `dekripsi` (`id_de`, `id_user`, `nama_file`, `ukuran_file`, `filepath`, `tanggal`) VALUES
(63, 1, 'Implementasi Kriptografi Vigenere Cipher Dengan PHP.pdf.enc', '969144', 'uploads/Implementasi Kriptografi Vigenere Cipher Dengan PHP.pdf', '2024-07-01'),
(64, 1, '423-Article Text-711-1-10-20210222.pdf.enc', '795296', 'uploads/423-Article Text-711-1-10-20210222.pdf', '2024-07-02'),
(65, 1, 'Pengamanan Citra Digital Berbasis Kriptografi Menggunakan Algoritma Vigenere Cipher.pdf.enc', '872296', 'uploads/Pengamanan Citra Digital Berbasis Kriptografi Menggunakan Algoritma Vigenere Cipher.pdf', '2024-07-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dekripsi_av`
--

CREATE TABLE `dekripsi_av` (
  `id_de` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `ukuran_file` varchar(20) NOT NULL,
  `filepath` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `dekripsi_av`
--

INSERT INTO `dekripsi_av` (`id_de`, `id_user`, `nama_file`, `ukuran_file`, `filepath`, `tanggal`) VALUES
(6, 1, 'Y2meta.app - DOLA - ANGGA DERMAWAN  (Official Music Video) (128 kbps) (1).mp3.enc', '411720', 'uploads/Y2meta.app - DOLA - ANGGA DERMAWAN  (Official Music Video) (128 kbps) (1).mp3', '2024-07-02'),
(7, 1, 'Y2meta.app - DOLA - ANGGA DERMAWAN  (Official Music Video) (128 kbps) (1).mp3.enc', '411720', 'uploads/Y2meta.app - DOLA - ANGGA DERMAWAN  (Official Music Video) (128 kbps) (1).mp3', '2024-07-02'),
(8, 1, 'videoplayback.mp4.enc', '6689900', 'uploads/videoplayback.mp4', '2024-07-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `enkripsi`
--

CREATE TABLE `enkripsi` (
  `id_en` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `ukuran_file` varchar(20) NOT NULL,
  `filepath` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `enkripsi`
--

INSERT INTO `enkripsi` (`id_en`, `id_user`, `nama_file`, `ukuran_file`, `filepath`, `tanggal`) VALUES
(60, 1, 'Implementasi Kriptografi Vigenere Cipher Dengan PHP.pdf', '726857', 'uploads/Implementasi Kriptografi Vigenere Cipher Dengan PHP.pdf.enc', '2024-07-01'),
(61, 1, '423-Article Text-711-1-10-20210222.pdf', '596471', 'uploads/423-Article Text-711-1-10-20210222.pdf.enc', '2024-07-02'),
(62, 1, 'Pengamanan Citra Digital Berbasis Kriptografi Menggunakan Algoritma Vigenere Cipher.pdf', '654220', 'uploads/Pengamanan Citra Digital Berbasis Kriptografi Menggunakan Algoritma Vigenere Cipher.pdf.enc', '2024-07-02'),
(63, 1, 'PENGAMAN DATA.docx', '16327', 'uploads/PENGAMAN DATA.docx.enc', '2024-07-12'),
(64, 1, 'TES.txt', '13', 'uploads/TES.txt.enc', '2024-07-12'),
(65, 1, 'TEST.txt', '5', 'uploads/TEST.txt.enc', '2024-07-12'),
(66, 1, 'COBA.txt', '13', 'uploads/COBA.txt.enc', '2024-07-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `enkripsi_av`
--

CREATE TABLE `enkripsi_av` (
  `id_en` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `ukuran_file` varchar(20) NOT NULL,
  `filepath` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `enkripsi_av`
--

INSERT INTO `enkripsi_av` (`id_en`, `id_user`, `nama_file`, `ukuran_file`, `filepath`, `tanggal`) VALUES
(12, 1, 'Y2meta.app - DOLA - ANGGA DERMAWAN  (Official Music Video) (128 kbps) (1).mp3', '308788', 'uploads/Y2meta.app - DOLA - ANGGA DERMAWAN  (Official Music Video) (128 kbps) (1).mp3.enc', '2024-07-01'),
(13, 1, 'Y2meta.app - DOLA - ANGGA DERMAWAN  (Official Music Video) (128 kbps) (1).mp3', '308788', 'uploads/Y2meta.app - DOLA - ANGGA DERMAWAN  (Official Music Video) (128 kbps) (1).mp3.enc', '2024-07-02'),
(14, 1, 'videoplayback.mp4', '5017424', 'uploads/videoplayback.mp4.enc', '2024-07-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ijin`
--

CREATE TABLE `ijin` (
  `id_ijin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Setuju','Tolak') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ijin`
--

INSERT INTO `ijin` (`id_ijin`, `id_user`, `nama_file`, `tanggal`, `status`) VALUES
(15, 19, 'Implementasi Kriptografi Vigenere Cipher Dengan PHP.pdf', '2024-07-02', 'Setuju'),
(16, 19, 'Pengamanan Citra Digital Berbasis Kriptografi Menggunakan Algoritma Vigenere Cipher.pdf', '2024-07-02', 'Setuju');

-- --------------------------------------------------------

--
-- Struktur dari tabel `koordinasi`
--

CREATE TABLE `koordinasi` (
  `id_ko` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_file` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `koordinasi`
--

INSERT INTO `koordinasi` (`id_ko`, `id_user`, `nama_file`, `keterangan`, `tanggal`) VALUES
(2, 19, 'coba2.docx', 'pergantian penerima bantuan', '2024-07-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(45) NOT NULL,
  `username_user` varchar(20) NOT NULL,
  `password_user` varchar(32) NOT NULL,
  `status_user` enum('Admin','Pimpinan','Kades') NOT NULL,
  `tempat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username_user`, `password_user`, `status_user`, `tempat`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'BAPPERIDA'),
(15, 'kaban', 'kaban', '790d0d51b5a79665aa7c471193021177', 'Pimpinan', 'BAPPERIDA'),
(16, 'YAKOP', 'yakop', 'yakop', 'Kades', 'Sikun'),
(17, 'SIMON', 'simon', 'b30bd351371c686298d32281b337e8e9', 'Kades', ''),
(18, 'LIUS', 'lius', 'b1d7b10dedb80591bebc03f616546895', 'Kades', 'Umalor'),
(19, 'Yanto', 'kades', '0cfa66469d25bd0d9e55d7ba583f9f2f', 'Kades', 'Oan Mane');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dekripsi`
--
ALTER TABLE `dekripsi`
  ADD PRIMARY KEY (`id_de`),
  ADD KEY `fk_user` (`id_user`);

--
-- Indeks untuk tabel `dekripsi_av`
--
ALTER TABLE `dekripsi_av`
  ADD PRIMARY KEY (`id_de`),
  ADD KEY `dekripsi_av_user` (`id_user`);

--
-- Indeks untuk tabel `enkripsi`
--
ALTER TABLE `enkripsi`
  ADD PRIMARY KEY (`id_en`),
  ADD KEY `en_user` (`id_user`);

--
-- Indeks untuk tabel `enkripsi_av`
--
ALTER TABLE `enkripsi_av`
  ADD PRIMARY KEY (`id_en`),
  ADD KEY `enkripsi_av_user` (`id_user`);

--
-- Indeks untuk tabel `ijin`
--
ALTER TABLE `ijin`
  ADD PRIMARY KEY (`id_ijin`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `koordinasi`
--
ALTER TABLE `koordinasi`
  ADD PRIMARY KEY (`id_ko`),
  ADD KEY `k_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dekripsi`
--
ALTER TABLE `dekripsi`
  MODIFY `id_de` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT untuk tabel `dekripsi_av`
--
ALTER TABLE `dekripsi_av`
  MODIFY `id_de` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `enkripsi`
--
ALTER TABLE `enkripsi`
  MODIFY `id_en` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `enkripsi_av`
--
ALTER TABLE `enkripsi_av`
  MODIFY `id_en` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `ijin`
--
ALTER TABLE `ijin`
  MODIFY `id_ijin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `koordinasi`
--
ALTER TABLE `koordinasi`
  MODIFY `id_ko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dekripsi`
--
ALTER TABLE `dekripsi`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dekripsi_av`
--
ALTER TABLE `dekripsi_av`
  ADD CONSTRAINT `dekripsi_av_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `enkripsi`
--
ALTER TABLE `enkripsi`
  ADD CONSTRAINT `en_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `enkripsi_av`
--
ALTER TABLE `enkripsi_av`
  ADD CONSTRAINT `enkripsi_av_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ijin`
--
ALTER TABLE `ijin`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `koordinasi`
--
ALTER TABLE `koordinasi`
  ADD CONSTRAINT `k_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
