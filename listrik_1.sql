-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Jul 2023 pada 12.17
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `listrik`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPelangganByDaya` ()   BEGIN
  SELECT pelanggan.*
  FROM pelanggan
  JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
  WHERE tarif.daya = '900VA';
END$$

--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `HitungTotalPenggunaanListrikPerBulan` (`bulan` VARCHAR(13), `tahun` VARCHAR(6)) RETURNS DECIMAL(10,2) DETERMINISTIC BEGIN
  DECLARE total DECIMAL(10, 2);
  
  SELECT SUM(meter_akhir - meter_awal)
  INTO total
  FROM penggunaan
  WHERE `bulan` = bulan AND `tahun` = tahun;
  
  RETURN total;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Administrator'),
(2, 'Pelanggan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nomor_kwh` varchar(20) DEFAULT NULL,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `id_tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `username`, `password`, `nomor_kwh`, `nama_pelanggan`, `alamat`, `id_tarif`) VALUES
(1, 'tes', '$2y$10$J07.iuEOhR4xPgb5zv7kL.a7EO.bczGf4qH1LCnZkQ3hKYK5s986u', '1234567890', 'Billy', 'Jl. ABC No. 123', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `bulan_bayar` varchar(13) DEFAULT NULL,
  `biaya_admin` varchar(150) DEFAULT NULL,
  `total_bayar` varchar(255) DEFAULT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` varchar(13) DEFAULT NULL,
  `tahun` varchar(6) DEFAULT NULL,
  `meter_awal` varchar(255) DEFAULT NULL,
  `meter_akhir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
(1, 1, 'Juli', '2023', '100', '200');

--
-- Trigger `penggunaan`
--
DELIMITER $$
CREATE TRIGGER `simpan_tagihan` AFTER INSERT ON `penggunaan` FOR EACH ROW BEGIN
  INSERT INTO tagihan (id_penggunaan, id_pelanggan, bulan, tahun, jumlah_meter, status)
  VALUES (NEW.id_penggunaan, NEW.id_pelanggan, NEW.bulan, NEW.tahun, NEW.meter_akhir - NEW.meter_awal, 'Belum Dibayar');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_penggunaan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `bulan` varchar(13) DEFAULT NULL,
  `tahun` varchar(6) DEFAULT NULL,
  `jumlah_meter` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `id_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `status`) VALUES
(2, 1, 1, 'Juli', '2023', '100', 'Belum Dibayar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `daya` varchar(255) DEFAULT NULL,
  `tarifperkwh` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarifperkwh`) VALUES
(0, '900VA', '1.400'),
(1, '1300VA', '1.500'),
(2, '2200VA', '1.600'),
(3, '3500VA', '1.700'),
(4, '5500VA', '2.000'),
(5, '6600VA', '2.500');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `id_level` int(11) NOT NULL DEFAULT 2,
  `id_pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_pelanggan`, `id_level`, `id_pelanggan`) VALUES
(2, 'asda', '$2y$10$M.4iVlYhxPsy/geoklf9SeMPZ7PO/5nKXfhsHIHcgZGq6GO5KKegm', '', 2, NULL),
(3, 'baru', '$2y$10$7dMFbMSfrFmxLC2dJNTYHebGHTqsXpBFV2P9bn5p/4OOIwuKXrxjG', '', 2, NULL),
(4, 'bil', '$2y$10$LEp0uGZDZzgSmK1gRJtMHudA2yrMfpjugIkOwPMY.GTxTgBvWBwB.', '', 1, NULL),
(5, 'bgs', '$2y$10$dpdd6gHyfwfJR9YFzNVbd.Vzr86adB7GjvZCI7X3K.d03n5RWU03K', '', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_tarif` (`id_tarif`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_tagihan` (`id_tagihan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `fk_id_penggunaan` (`id_penggunaan`),
  ADD KEY `fk_id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `fk_user_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`),
  ADD CONSTRAINT `tagihan_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
