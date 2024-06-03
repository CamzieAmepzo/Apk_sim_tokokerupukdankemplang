-- phpMyAdmin SQL Dump
-- Laravel version 8.83.27
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2024 pada 12:34
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sim_tokokerupukdankemplang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_lain`
--

CREATE TABLE `biaya_lain` (
  `id_biaya_lain` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `draf_pendaftaran`
--

CREATE TABLE `draf_pendaftaran` (
  `id_draf` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` bigint(20) NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_barang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tidak Aktif',
  `jenisbarang` bigint(20) DEFAULT NULL,
  `bayar` bigint(20) DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `nama_pegawai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` bigint(20) NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`, `nohp`, `alamat`, `status`) VALUES
(1, 'Franss', 10102938384, 812345678, 'laki-laki', 'Palembang', 'Aktif')
(2, 'Pegawai2', 103829134, 814627284, 'laki-laki', 'Palembang', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Bagus', NULL, NULL),
(2, 'Jelek', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `Jenisbarang`
--

CREATE TABLE `jenisbarang` (
  `id_jenisbarang` bigint(20) UNSIGNED NOT NULL,
  `jenisbarang` int(11) NOT NULL,
  `nama_jenisbarang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenisbarang`
--

INSERT INTO `jenisbarang` (`id_jenisbarang`, `jenisbarang`, `nama_jenisbarang`) VALUES
(1, 10, 'Kerupuk (A)', 'aca'),
(2, 11, 'Kemplang(A)', 'mangkok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `tanggal_pendapatan` date DEFAULT NULL,
  `jumlah_pendapatan` bigint(20) DEFAULT NULL,
  `sumber` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pengeluaran` date DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `satuan` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banyak` int(11) DEFAULT NULL,
  `jumlah_pengeluaran` bigint(20) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `tanggal_pendapatan`, `jumlah_pendapatan`, `sumber`, `tanggal_pengeluaran`, `keterangan`, `satuan`, `banyak`, `jumlah_pengeluaran`, `status`) VALUES
(1, '2024-03-15', 300000, 'harga kerupuk', '2024-03-15', NULL, NULL, NULL, NULL, 'pendapatan'),
(2, '2024-03-15', 300000, 'harga kerupuk', '2024-03-15', NULL, NULL, NULL, NULL, 'pendapatan'),
(3, '2024-04-13', 100000, 'harga kemplang', '2024-04-13', NULL, NULL, NULL, NULL, 'pendapatan'),
(4, '2024-04-20', 100000, 'harga kemplang', '2024-04-20', NULL, NULL, NULL, NULL, 'pendapatan'),
(5, '2024-04-28', 100000, 'harga kemplang', '2024-04-28', NULL, NULL, NULL, NULL, 'pendapatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_3_12_000000_create_users_table', 1),
(2, '2024_3_11_144215_create__table', 1),
(3, '2024_3_11_145137_create_jenisbarang_table', 1),
(4, '2024_3_12_032552_create_pegawai_table', 1),
(5, '2024_3_12_035410_create_kategori_table', 1),
(6, '2024_3_14_064327_create_pendaftaran_table', 1),
(7, '2024_3_14_072006_create_pembayaran_table', 1),
(8, '2024_3_16_070818_create_hargakerupuk_table', 1),
(9, '2024_4_17_093258_create_hargakelemplang_table', 1),
(10, '2024_4_17_132644_create_data_transaksi_table', 1),
(11, '2024_4_17_132920_create_profit_table', 1),
(12 '2024_5_19_063044_create_biaya_lain_table', 1),
(13, '2024_5_21_142807_create_draf_pendaftaran_table', 1),
(14, '2024_5_18_145701_create_laporan_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` bigint(20) UNSIGNED NOT NULL,
  `jenis_pembayaran` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `jenis_pembayaran`, `nominal`, `kode`) VALUES
(1, 'Cash', 125000, 'KM-0001'),
(2, 'Transfer', 300000, 'KM-0002'),
(3, 'DataTransaksi', 1000000, 'KM-0003'),


-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` bigint(20) UNSIGNED NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` time NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id_pendaftaran`, `nominal`, `nama_barang`, `waktu`, `tanggal`) VALUES
(1, 125000, 'Kemplang', '01:42:25', '2021-12-21'),
(2, 125000, 'kerupuk', '01:42:33', '2021-12-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `id_jenisbarang` bigint(20) NOT NULL,
  `id_kategori` bigint(20) NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `id_jenisbarang`, `id_kategori`, `nama_barang`,`status`) VALUES
(1, 1, 1, 'kerupuk', 1222022, 'bagus', '2021-12-18',  'Pengiriman'),
(2, 2, 2, 'kemplang', 1558411, 'bagus', '2021-12-19',  'pengiriman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `DataTransaksi`
--

CREATE TABLE `DataTransaksi` (
  `id_data_transaksi` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) NOT NULL,
  `nominal` bigint(20) NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------



-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nohp` bigint(20) NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `nohp`, `status`) VALUES
(1, 'Admin', 'admin', '$2y$10$GkdK3jLAJ/ATJcwF9tRJD.mogJJRGDa2ARmayB9ktVB8WKs1zn7I2', 8123456789, 'admin'),
(2, 'pegawai1', 'pegawai1', '$2y$10$vYoFMrUKjVdnGbhVWQzdr.0/qkndCgfzXShWSU1q3Iv/M3lECsHcu', 8123456789, 'pegawai1'),
(3, 'pegawai2', 'pegawai2', '$2y$10$TTXe6ZHRUrc0Z0i8WtwaBOWNkS8pWCieTfHWm3Udeq1fefIszCzB.', 8123456789, 'pegawai2'),

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `biaya_lain`
--
ALTER TABLE `biaya_lain`
  ADD PRIMARY KEY (`id_biaya_lain`);

--
-- Indeks untuk tabel `draf_pendaftaran`
--
ALTER TABLE `draf_pendaftaran`
  ADD PRIMARY KEY (`id_draf`);

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `jenisbarang`
--
ALTER TABLE `jenisbarang`
  ADD PRIMARY KEY (`id_jenisbarang`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `Data Transaksi`
--
ALTER TABLE `datatransaksi`
  ADD PRIMARY KEY (`id_data_transaksi`);

--
--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `biaya_lain`
--
ALTER TABLE `biaya_lain`
  MODIFY `id_biaya_lain` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `draf_pendaftaran`
--
ALTER TABLE `draf_pendaftaran`
  MODIFY `id_draf` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jenisbarang`
--
ALTER TABLE `jenisbarang`
  MODIFY `id_jenisbarang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_transaksi`
--
ALTER TABLE `datatransaksi`
  MODIFY `id_data_transaksi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--

-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
