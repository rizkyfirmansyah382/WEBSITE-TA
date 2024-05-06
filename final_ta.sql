-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jan 2024 pada 11.59
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siketas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2023_11_29_133122_tb_user_superadmin', 1),
(3, '2023_11_29_133132_tb_role', 1),
(4, '2023_12_01_112949_tb_user_admin', 1),
(5, '2023_12_01_113000_tb_role_admin', 1),
(6, '2023_12_02_023035_tb_kendaraan', 1),
(7, '2023_12_02_023045_tb_sopir', 1),
(8, '2023_12_02_034406_tb_blok', 1),
(9, '2023_12_02_034415_tb_kelompok', 1),
(10, '2023_12_02_040947_tb_anggota_tervalidasi', 1),
(11, '2023_12_02_104009_tb_tanggal_panen', 1),
(12, '2023_12_02_144637_tb_data_panen_kelompok', 1),
(13, '2023_12_03_032134_tb_data_spb', 1),
(14, '2023_12_04_073825_tb_input_hasil_pks', 1),
(15, '2023_12_13_143138_tb_daftar_anggota_baru', 2),
(16, '2023_12_14_021221_tb_data_anggota_lama', 3),
(17, '2023_12_21_114850_tb_pemetaan', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota_tervalidasi`
--

CREATE TABLE `tb_anggota_tervalidasi` (
  `id_anggota_tervalidasi` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_blok` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `luas_lahan` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `alamat_tinggal` varchar(255) NOT NULL,
  `tgl_masuk_anggota` date NOT NULL,
  `no_anggota` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_anggota_tervalidasi`
--

INSERT INTO `tb_anggota_tervalidasi` (`id_anggota_tervalidasi`, `id_superadmin`, `id_kelompok`, `id_blok`, `photo`, `nama_anggota`, `luas_lahan`, `nik`, `tgl_lahir`, `jenis_kelamin`, `pekerjaan`, `alamat_tinggal`, `tgl_masuk_anggota`, `no_anggota`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, 'photos/1703123737_logo.png', 'Sandi', '19,73', '14720110321312', '2023-12-21', 'Laki-laki', 'Petani', 'Bangkinang', '2023-12-21', 'S 01', '2023-12-20 18:55:37', '2023-12-20 18:55:37'),
(2, 3, 1, 1, 'photos/1703123847_logo.png', 'Sandi2', '1,970', '14720110321312', '2023-12-21', 'Laki-laki', 'Petani', 'Bangkinang', '2023-12-21', 'S 02', '2023-12-20 18:57:27', '2023-12-20 18:57:27'),
(3, 3, 1, 1, 'photos/1703123887_logo.png', 'Sandi3', '2,97', '14720110321312', '2023-12-21', 'Laki-laki', 'Petani', 'Bangkinang', '2023-12-21', 'S 03', '2023-12-20 18:58:07', '2023-12-20 18:58:07'),
(4, 3, 2, 2, 'photos/1703123955_1.jpg', 'Rizky Firmansyah', '100,97', '14720110321312', '2023-12-21', 'Laki-laki', 'Petani', 'Bangkinang', '2023-12-21', 'R 001', '2023-12-20 18:59:15', '2023-12-20 18:59:15'),
(5, 3, 2, 2, 'photos/1703123999_1.jpg', 'Rizky Firmansyah2', '19,73', '14720110321312', '2023-12-21', 'Laki-laki', 'Petani', 'Bangkinang', '2023-12-21', 'R 002', '2023-12-20 18:59:59', '2023-12-20 18:59:59'),
(6, 3, 2, 2, 'photos/1703124185_1.jpg', 'Rizky Firmansyah3', '19,73', '14720110321312', '2023-12-21', 'Laki-laki', 'Petani', 'Bangkinang', '2023-12-21', 'R 003', '2023-12-20 19:03:05', '2023-12-20 19:06:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_blok`
--

CREATE TABLE `tb_blok` (
  `id_blok` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `blok` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_blok`
--

INSERT INTO `tb_blok` (`id_blok`, `id_superadmin`, `blok`, `created_at`, `updated_at`) VALUES
(1, 3, '1', '2023-12-20 18:00:40', '2023-12-20 18:00:40'),
(2, 3, '2', '2023-12-20 18:00:45', '2023-12-20 18:00:45'),
(3, 3, '3', '2023-12-20 18:00:50', '2023-12-20 18:00:50'),
(4, 3, '4', '2023-12-20 18:00:55', '2023-12-20 18:00:55'),
(5, 3, '5', '2023-12-20 18:00:59', '2023-12-20 18:00:59'),
(6, 3, '6', '2023-12-20 18:01:04', '2023-12-20 18:01:04'),
(7, 3, '7', '2023-12-20 18:01:10', '2023-12-20 18:01:10'),
(8, 3, '8', '2023-12-20 18:01:15', '2023-12-20 18:01:15'),
(9, 3, '9', '2023-12-20 18:01:20', '2023-12-20 18:01:20'),
(10, 3, '10', '2023-12-20 18:01:27', '2023-12-20 18:01:27'),
(11, 3, '11', '2023-12-20 18:01:31', '2023-12-20 18:01:31'),
(12, 3, '12', '2023-12-20 18:01:37', '2023-12-20 18:01:37'),
(13, 3, '13', '2023-12-20 18:01:41', '2023-12-20 18:01:41'),
(14, 3, '14', '2023-12-20 18:01:45', '2023-12-20 18:01:45'),
(15, 3, '19', '2023-12-20 18:01:54', '2023-12-20 18:01:54'),
(16, 3, '20', '2023-12-20 18:02:05', '2023-12-20 18:02:05'),
(17, 3, '21', '2023-12-20 18:02:08', '2023-12-20 18:02:08'),
(18, 3, '22', '2023-12-20 18:02:12', '2023-12-20 18:02:12'),
(19, 3, '23', '2023-12-20 18:02:15', '2023-12-20 18:02:15'),
(20, 3, '24', '2023-12-20 18:02:19', '2023-12-20 18:02:19'),
(21, 3, '25', '2023-12-20 18:02:23', '2023-12-20 18:02:23'),
(22, 3, '26', '2023-12-20 18:02:27', '2023-12-20 18:02:27'),
(23, 3, '27', '2023-12-20 18:02:37', '2023-12-20 18:02:37'),
(24, 3, '28', '2023-12-20 18:02:41', '2023-12-20 18:02:41'),
(25, 3, '29', '2023-12-20 18:02:51', '2023-12-20 18:02:51'),
(26, 3, '30', '2023-12-20 18:02:56', '2023-12-20 18:02:56'),
(27, 3, '31', '2023-12-20 18:03:14', '2023-12-20 18:03:14'),
(28, 3, '32', '2023-12-20 18:03:21', '2023-12-20 18:03:21'),
(29, 3, '33', '2023-12-20 18:03:24', '2023-12-20 18:03:24'),
(30, 3, '34', '2023-12-20 18:03:28', '2023-12-20 18:03:28'),
(31, 3, '35', '2023-12-20 18:03:35', '2023-12-20 18:03:35'),
(32, 3, '36', '2023-12-20 18:03:40', '2023-12-20 18:03:40'),
(33, 3, '37', '2023-12-20 18:03:44', '2023-12-20 18:03:44'),
(34, 3, '38', '2023-12-20 18:03:49', '2023-12-20 18:03:49'),
(35, 3, '39', '2023-12-20 18:03:58', '2023-12-20 18:03:58'),
(36, 3, '40', '2023-12-20 18:04:04', '2023-12-20 18:04:04'),
(37, 3, '41', '2023-12-20 18:04:08', '2023-12-20 18:04:08'),
(38, 3, '42', '2023-12-20 18:04:12', '2023-12-20 18:04:12'),
(39, 3, '43', '2023-12-20 18:04:16', '2023-12-20 18:04:16'),
(40, 3, '44', '2023-12-20 18:04:21', '2023-12-20 18:05:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_daftar_anggota_baru`
--

CREATE TABLE `tb_daftar_anggota_baru` (
  `id_daftar_anggota_baru` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_anggota_tervalidasi` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `KkPdf` varchar(255) NOT NULL,
  `SertifPdf` varchar(255) NOT NULL,
  `JBPdf` varchar(255) NOT NULL,
  `nama_anggota_baru` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `status` enum('Proses Verifikasi','Selesai Verifikasi') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_anggota_lama`
--

CREATE TABLE `tb_data_anggota_lama` (
  `id_data_anggota_lama` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_anggota_lama` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `nama_anggota_lama` varchar(255) NOT NULL,
  `nik` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `no_anggota` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_blok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_panen_kelompok`
--

CREATE TABLE `tb_data_panen_kelompok` (
  `id_data_panen_kelompok` bigint(20) UNSIGNED NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_tanggal_panen` int(11) NOT NULL,
  `id_anggota_tervalidasi` int(11) NOT NULL,
  `tonase_anggota` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_data_panen_kelompok`
--

INSERT INTO `tb_data_panen_kelompok` (`id_data_panen_kelompok`, `id_kelompok`, `id_superadmin`, `id_tanggal_panen`, `id_anggota_tervalidasi`, `tonase_anggota`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 7, 4, 1000.00, '2024-01-26 16:57:21', '2024-01-26 16:57:21'),
(2, 1, 3, 5, 1, 1000.00, '2024-01-26 16:57:41', '2024-01-26 16:57:41'),
(3, 1, 3, 4, 1, 1200.00, '2024-01-26 16:59:05', '2024-01-27 03:23:22'),
(4, 2, 3, 8, 4, 1000.00, '2024-01-26 16:59:24', '2024-01-26 16:59:24'),
(5, 1, 3, 6, 1, 1000.00, '2024-01-26 17:38:35', '2024-01-26 17:38:35'),
(6, 1, 3, 6, 2, 1218.00, '2024-01-26 17:49:29', '2024-01-27 03:22:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_data_spb`
--

CREATE TABLE `tb_data_spb` (
  `id_data_spb` bigint(20) UNSIGNED NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `id_tanggal_panen` int(11) NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_sopir` int(11) NOT NULL,
  `id_blok` int(11) NOT NULL,
  `id_kendaraan` int(11) NOT NULL,
  `total_janjang` int(11) NOT NULL,
  `tujuan_pks` varchar(255) NOT NULL,
  `no_spb` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_data_spb`
--

INSERT INTO `tb_data_spb` (`id_data_spb`, `id_kelompok`, `id_tanggal_panen`, `id_superadmin`, `id_sopir`, `id_blok`, `id_kendaraan`, `total_janjang`, `tujuan_pks`, `no_spb`, `created_at`, `updated_at`) VALUES
(1, 2, 7, 3, 1, 2, 1, 100, 'Peputra Masterindo', '95579-0721', '2023-12-20 20:29:29', '2023-12-20 20:29:29'),
(2, 2, 7, 3, 2, 2, 2, 100, 'Peputra Masterindo', '95580-0721', '2023-12-20 20:29:47', '2023-12-20 20:29:47'),
(3, 2, 7, 3, 4, 2, 3, 100, 'Peputra Masterindo', '95581-0721', '2023-12-20 20:30:03', '2023-12-20 20:30:03'),
(4, 1, 4, 3, 1, 1, 1, 100, 'Peputra Masterindo', '95582-0721', '2023-12-20 20:31:21', '2023-12-20 20:31:21'),
(5, 1, 4, 3, 2, 1, 2, 100, 'Peputra Masterindo', '95583-0721', '2023-12-20 20:31:41', '2023-12-20 20:31:41'),
(6, 1, 4, 3, 4, 1, 3, 100, 'Peputra Masterindo', '95584-0721', '2023-12-20 20:32:05', '2023-12-20 20:32:18'),
(7, 1, 5, 3, 1, 1, 1, 100, 'Peputra Masterindo', '95585-0721', '2023-12-20 20:33:24', '2023-12-20 20:33:24'),
(8, 1, 5, 3, 2, 1, 2, 100, 'Peputra Masterindo', '95586-0721', '2023-12-20 20:33:50', '2023-12-20 20:33:50'),
(9, 1, 5, 3, 4, 1, 3, 100, 'Peputra Masterindo', '95587-0721', '2023-12-20 20:34:09', '2023-12-20 20:34:09'),
(10, 2, 8, 3, 1, 2, 1, 100, 'Peputra Masterindo', '95588-0721', '2023-12-20 20:34:45', '2023-12-20 20:34:45'),
(11, 2, 8, 3, 2, 2, 2, 100, 'Peputra Masterindo', '95589-0721', '2023-12-20 20:35:06', '2023-12-20 20:35:06'),
(12, 2, 8, 3, 4, 2, 3, 100, 'Peputra Masterindo', '95590-0721', '2023-12-20 20:35:27', '2023-12-20 20:35:27'),
(13, 1, 1, 3, 1, 1, 1, 100, 'Peputra Masterindo', '95591-0721', '2023-12-20 20:36:16', '2023-12-20 20:36:16'),
(14, 1, 1, 3, 2, 1, 2, 100, 'Peputra Masterindo', '95592-0721', '2023-12-20 20:36:52', '2023-12-20 20:36:52'),
(15, 1, 1, 3, 4, 1, 3, 100, 'Peputra Masterindo', '95593-0721', '2023-12-20 20:37:18', '2023-12-20 20:37:18'),
(16, 2, 11, 3, 1, 2, 2, 100, 'Peputra Masterindo', '95594-0721', '2023-12-20 20:38:40', '2023-12-20 20:38:40'),
(17, 2, 11, 3, 2, 2, 2, 100, 'Peputra Masterindo', '95596-0721', '2023-12-20 20:38:58', '2023-12-20 20:38:58'),
(18, 2, 11, 3, 4, 2, 3, 100, 'Peputra Masterindo', '95597-0721', '2023-12-20 20:39:27', '2023-12-20 20:39:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_input_hasil_pks`
--

CREATE TABLE `tb_input_hasil_pks` (
  `id_input_hasil_pks` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_data_spb` int(11) NOT NULL,
  `bruto` int(11) NOT NULL,
  `tarra` int(11) NOT NULL,
  `netto_terima` int(11) NOT NULL,
  `sortasi` int(11) NOT NULL,
  `netto_bersih` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_input_hasil_pks`
--

INSERT INTO `tb_input_hasil_pks` (`id_input_hasil_pks`, `id_superadmin`, `id_data_spb`, `bruto`, `tarra`, `netto_terima`, `sortasi`, `netto_bersih`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:40:27', '2023-12-20 20:40:27'),
(2, 3, 2, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:40:40', '2023-12-20 20:40:40'),
(3, 3, 3, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:40:58', '2023-12-20 20:40:58'),
(4, 3, 4, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:41:20', '2023-12-20 20:41:20'),
(5, 3, 5, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:41:33', '2023-12-20 20:41:33'),
(6, 3, 6, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:41:44', '2023-12-20 20:41:44'),
(7, 3, 7, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:42:11', '2023-12-20 20:42:11'),
(8, 3, 8, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:42:27', '2023-12-20 20:42:27'),
(9, 3, 9, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:42:39', '2023-12-20 20:42:39'),
(10, 3, 10, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:43:09', '2023-12-20 20:43:09'),
(11, 3, 11, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:43:24', '2023-12-20 20:43:24'),
(12, 3, 12, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:43:48', '2023-12-20 20:43:48'),
(13, 3, 13, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:44:12', '2023-12-20 20:44:12'),
(14, 3, 14, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:44:23', '2023-12-20 20:44:23'),
(15, 3, 15, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:44:36', '2023-12-20 20:44:36'),
(16, 3, 16, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:45:03', '2023-12-20 20:45:03'),
(17, 3, 17, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:45:25', '2023-12-20 20:45:25'),
(18, 3, 18, 2500, 1440, 1060, 40, 1020, '2023-12-20 20:45:41', '2023-12-20 20:45:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelompok`
--

CREATE TABLE `tb_kelompok` (
  `id_kelompok` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `nama_kelompok` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_kelompok`
--

INSERT INTO `tb_kelompok` (`id_kelompok`, `id_superadmin`, `nama_kelompok`, `created_at`, `updated_at`) VALUES
(1, 3, 'Maju Jaya', '2023-12-20 18:05:32', '2023-12-20 18:05:32'),
(2, 3, 'Sri Rahayu', '2023-12-20 18:05:39', '2023-12-20 18:05:39'),
(3, 3, 'Rukun Jaya', '2023-12-20 18:05:47', '2023-12-20 18:05:47'),
(4, 3, 'Tunas Mulya', '2023-12-20 18:05:57', '2023-12-20 18:05:57'),
(5, 3, 'Subur Makmur', '2023-12-20 18:06:04', '2023-12-20 18:06:04'),
(6, 3, 'Mekar Jaya', '2023-12-20 18:06:11', '2023-12-20 18:06:11'),
(7, 3, 'Setia Kawan', '2023-12-20 18:06:18', '2023-12-20 18:06:18'),
(8, 3, 'Karisma', '2023-12-20 18:06:30', '2023-12-20 18:06:30'),
(9, 3, 'Pantang Mundur', '2023-12-20 18:06:37', '2023-12-20 18:06:37'),
(10, 3, 'Mitra Usaha', '2023-12-20 18:06:46', '2023-12-20 18:06:46'),
(11, 3, 'Ngudi Makmur', '2023-12-20 18:08:13', '2023-12-20 18:08:13'),
(12, 3, 'BinaTani', '2023-12-20 18:08:28', '2023-12-20 18:08:28'),
(13, 3, 'Tani Jaya', '2023-12-20 18:08:35', '2023-12-20 18:08:35'),
(14, 3, 'Kencana Jaya', '2023-12-20 18:08:43', '2023-12-20 18:08:43'),
(15, 3, 'Karya Nyata', '2023-12-20 18:08:53', '2023-12-20 18:08:53'),
(16, 3, 'Jago Rawit', '2023-12-20 18:09:05', '2023-12-20 18:09:12'),
(17, 3, 'Sumber Makmur', '2023-12-20 18:10:01', '2023-12-20 18:10:01'),
(18, 3, 'Karya Baru', '2023-12-20 18:10:23', '2023-12-20 18:10:23'),
(19, 3, 'Sumber Rejeki', '2023-12-20 18:10:33', '2023-12-20 18:10:33'),
(20, 3, 'Jasa Tani', '2023-12-20 18:10:40', '2023-12-20 18:10:40'),
(21, 3, 'Rukun Tani', '2023-12-20 18:10:49', '2023-12-20 18:10:49'),
(22, 3, 'Suka Makmur', '2023-12-20 18:10:59', '2023-12-20 18:10:59'),
(23, 3, 'Sido Makmur', '2023-12-20 18:11:08', '2023-12-20 18:11:08'),
(24, 3, 'Sawit Luhur', '2023-12-20 18:11:40', '2023-12-20 18:11:40'),
(25, 3, 'Rizky', '2023-12-20 18:11:56', '2023-12-20 18:11:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id_kendaraan` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `no_polisi` varchar(255) NOT NULL,
  `jenis_kendaraan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id_kendaraan`, `id_superadmin`, `no_polisi`, `jenis_kendaraan`, `created_at`, `updated_at`) VALUES
(1, 3, 'BM 1234 XY', 'Truck', '2023-12-07 19:53:29', '2023-12-07 20:05:52'),
(2, 3, 'BM 3421 CV', 'Truck', '2023-12-07 20:06:00', '2023-12-07 20:06:00'),
(3, 3, 'BM 0987 HG', 'Truck', '2023-12-07 20:07:00', '2023-12-07 20:07:00'),
(5, 7, 'Bangkinang', 'Truck', '2023-12-08 19:00:49', '2023-12-08 19:00:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemetaan`
--

CREATE TABLE `tb_pemetaan` (
  `id_pemetaan` bigint(20) UNSIGNED NOT NULL,
  `id_anggota_tervalidasi` int(11) NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `coordinates` varchar(1000) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_pemetaan`
--

INSERT INTO `tb_pemetaan` (`id_pemetaan`, `id_anggota_tervalidasi`, `id_superadmin`, `coordinates`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '[[[0.3367032699759218,101.02283261016332],[0.3381623663759573,101.02592000490974],[0.33588789248073003,101.02677761456152],[0.33475065533440806,101.02347581740214]]]', '2023-12-21 05:02:53', '2023-12-21 05:02:53'),
(2, 2, 3, '[[[0.340151457667077,101.02142398653926],[0.34168565406456985,101.02454354164767],[0.34018364360798986,101.02510098792132],[0.338864019942463,101.02193855233037]]]', '2023-12-21 05:03:44', '2023-12-21 05:03:44'),
(3, 3, 3, '[[[0.3379048787918501,101.01971645422934],[0.33880608530629636,101.02192479908267],[0.3367247272775055,101.02278240873444],[0.33580206326676193,101.02048830291592]]]', '2023-12-21 05:04:09', '2023-12-21 05:04:09'),
(4, 4, 3, '[[[0.3139327637690444,101.21002393728541],[0.2933336878974587,101.29098228841397],[0.227416403437125,101.32391449904252],[0.1848446584394048,101.28823793752827],[0.19308435971360446,101.2388396215854],[0.23840264077344087,101.19767435829971],[0.20544390408431767,101.17023084944256],[0.2754811247102761,101.12769341071402]]]', '2024-01-04 00:14:53', '2024-01-04 00:14:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2024-01-21 17:44:12', '2024-01-21 17:44:12'),
(2, 'Unit Usaha Otonom', '2023-12-07 09:14:44', '2023-12-07 09:14:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_role_admin`
--

CREATE TABLE `tb_role_admin` (
  `id_role_admin` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_role_admin`
--

INSERT INTO `tb_role_admin` (`id_role_admin`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Kelompok Tani', '2023-12-07 10:14:06', '2023-12-07 10:14:06'),
(2, 'Mandor', '2023-12-07 10:14:12', '2023-12-07 10:14:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sopir`
--

CREATE TABLE `tb_sopir` (
  `id_sopir` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `nama_sopir` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_sopir`
--

INSERT INTO `tb_sopir` (`id_sopir`, `id_superadmin`, `nama_sopir`, `created_at`, `updated_at`) VALUES
(1, 3, 'Sandi', '2023-12-07 19:04:13', '2023-12-07 19:04:13'),
(2, 3, 'Doddy', '2023-12-07 19:04:20', '2023-12-07 19:04:20'),
(4, 3, 'Romi Irawan', '2023-12-07 19:48:13', '2023-12-07 19:48:35'),
(5, 7, 'Bangkinang', '2023-12-08 19:00:33', '2023-12-08 19:00:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tanggal_panen`
--

CREATE TABLE `tb_tanggal_panen` (
  `id_tanggal_panen` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `tgl_panen` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_tanggal_panen`
--

INSERT INTO `tb_tanggal_panen` (`id_tanggal_panen`, `id_superadmin`, `id_kelompok`, `tgl_panen`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2023-12-01', '2023-12-20 19:23:11', '2023-12-20 19:23:11'),
(2, 3, 1, '2023-12-10', '2023-12-20 19:23:22', '2023-12-20 19:23:22'),
(3, 3, 1, '2023-12-20', '2023-12-20 19:23:33', '2023-12-20 19:23:33'),
(4, 3, 1, '2023-11-01', '2023-12-20 19:23:46', '2023-12-20 19:23:46'),
(5, 3, 1, '2023-11-10', '2023-12-20 19:24:02', '2023-12-20 19:24:02'),
(6, 3, 1, '2023-11-20', '2023-12-20 19:24:10', '2023-12-20 19:24:10'),
(7, 3, 2, '2023-11-01', '2023-12-20 19:24:25', '2023-12-20 19:24:25'),
(8, 3, 2, '2023-11-10', '2023-12-20 19:24:33', '2023-12-20 19:24:33'),
(9, 3, 2, '2023-12-20', '2023-12-20 19:24:43', '2023-12-20 19:24:43'),
(10, 3, 2, '2023-11-20', '2023-12-20 19:25:40', '2023-12-20 19:25:40'),
(11, 3, 2, '2023-12-01', '2023-12-20 19:25:55', '2023-12-20 19:25:55'),
(12, 3, 2, '2023-12-10', '2023-12-20 19:26:10', '2023-12-20 19:26:10'),
(13, 3, 1, '2024-01-10', '2024-01-10 10:41:10', '2024-01-10 10:41:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_admin`
--

CREATE TABLE `tb_user_admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_role_admin` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_user_admin`
--

INSERT INTO `tb_user_admin` (`id`, `id_superadmin`, `id_role_admin`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Kelompok Tani Bukit Payung', 'Kelompok Tani Bukit Payung', '$2y$10$sXikFIYObDgSnAiklvj.e.pBJNnqBV98rvFQ1cqcX00scdngUcqRa', '2023-12-07 10:39:20', '2023-12-07 10:39:20'),
(2, 3, 2, 'Mandor Bukit Payung', 'Mandor Bukit Payung', '$2y$10$hDmnykPQufeEi667gB8bnO71PciDETWji//kA3Fwi3s.yUMBaMo5O', '2023-12-07 10:42:25', '2023-12-07 11:02:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_superadmin`
--

CREATE TABLE `tb_user_superadmin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_role` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tb_user_superadmin`
--

INSERT INTO `tb_user_superadmin` (`id`, `id_role`, `name`, `username`, `password`, `created_at`, `updated_at`) VALUES
(3, 2, 'UUO Bukit Payung', 'UUO Bukit Payung', '$2y$10$u7SyQReD.y8ziC90rmslkO.INouK5CJkbwzugc620iwGS.4OH3ahS', '2023-12-07 09:15:47', '2023-12-07 09:15:47'),
(7, 2, 'UUO Bangkinang', 'UUO Bangkinang', '$2y$10$XL7tPcjXi3UWcu39o1SVseO6JZkFvVfMqgxYXIu05srFDkNcUX3lC', '2023-12-08 18:59:40', '2023-12-08 18:59:40'),
(8, 2, 'Rizky Firmansyah', 'Rizky Firmansyah', '$2y$10$ERhQ/I5QR1f7ZUtUR0Vtv.24ORk7K7O2ISWm/rhYgoxQupHbWTqMu', '2024-01-14 19:17:25', '2024-01-14 19:17:25'),
(10, 1, 'Super Admin', 'Super Admin', '$2y$10$ypJwF3IpVVyRjZuKiOkVKezk1hYaFGitjm3mReME6g7amoHfy5H8W', '2024-01-21 17:44:41', '2024-01-21 17:44:41'),
(11, 1, 'Admin', 'Admin', '$2y$10$AWJWPmwMHfBQyJEhbMAh8O1LDYsvJctfeQe7kSTxYRONCwdGCW3TS', '2024-01-24 20:22:19', '2024-01-24 20:35:55'),
(12, 1, 'Admin Oke', 'Admin Oke', '$2y$10$PKd070OkA7SIfaCfaOg6muZ61d.zTwXleU8xx4SPcLnOgD0V2Bjeq', '2024-01-24 20:23:55', '2024-01-24 20:35:46');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `tb_anggota_tervalidasi`
--
ALTER TABLE `tb_anggota_tervalidasi`
  ADD PRIMARY KEY (`id_anggota_tervalidasi`);

--
-- Indeks untuk tabel `tb_blok`
--
ALTER TABLE `tb_blok`
  ADD PRIMARY KEY (`id_blok`);

--
-- Indeks untuk tabel `tb_daftar_anggota_baru`
--
ALTER TABLE `tb_daftar_anggota_baru`
  ADD PRIMARY KEY (`id_daftar_anggota_baru`);

--
-- Indeks untuk tabel `tb_data_anggota_lama`
--
ALTER TABLE `tb_data_anggota_lama`
  ADD PRIMARY KEY (`id_data_anggota_lama`);

--
-- Indeks untuk tabel `tb_data_panen_kelompok`
--
ALTER TABLE `tb_data_panen_kelompok`
  ADD PRIMARY KEY (`id_data_panen_kelompok`);

--
-- Indeks untuk tabel `tb_data_spb`
--
ALTER TABLE `tb_data_spb`
  ADD PRIMARY KEY (`id_data_spb`);

--
-- Indeks untuk tabel `tb_input_hasil_pks`
--
ALTER TABLE `tb_input_hasil_pks`
  ADD PRIMARY KEY (`id_input_hasil_pks`);

--
-- Indeks untuk tabel `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indeks untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indeks untuk tabel `tb_pemetaan`
--
ALTER TABLE `tb_pemetaan`
  ADD PRIMARY KEY (`id_pemetaan`);

--
-- Indeks untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tb_role_admin`
--
ALTER TABLE `tb_role_admin`
  ADD PRIMARY KEY (`id_role_admin`);

--
-- Indeks untuk tabel `tb_sopir`
--
ALTER TABLE `tb_sopir`
  ADD PRIMARY KEY (`id_sopir`);

--
-- Indeks untuk tabel `tb_tanggal_panen`
--
ALTER TABLE `tb_tanggal_panen`
  ADD PRIMARY KEY (`id_tanggal_panen`);

--
-- Indeks untuk tabel `tb_user_admin`
--
ALTER TABLE `tb_user_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user_superadmin`
--
ALTER TABLE `tb_user_superadmin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_anggota_tervalidasi`
--
ALTER TABLE `tb_anggota_tervalidasi`
  MODIFY `id_anggota_tervalidasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_blok`
--
ALTER TABLE `tb_blok`
  MODIFY `id_blok` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_daftar_anggota_baru`
--
ALTER TABLE `tb_daftar_anggota_baru`
  MODIFY `id_daftar_anggota_baru` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_data_anggota_lama`
--
ALTER TABLE `tb_data_anggota_lama`
  MODIFY `id_data_anggota_lama` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_data_panen_kelompok`
--
ALTER TABLE `tb_data_panen_kelompok`
  MODIFY `id_data_panen_kelompok` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_data_spb`
--
ALTER TABLE `tb_data_spb`
  MODIFY `id_data_spb` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_input_hasil_pks`
--
ALTER TABLE `tb_input_hasil_pks`
  MODIFY `id_input_hasil_pks` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
  MODIFY `id_kelompok` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_pemetaan`
--
ALTER TABLE `tb_pemetaan`
  MODIFY `id_pemetaan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_role_admin`
--
ALTER TABLE `tb_role_admin`
  MODIFY `id_role_admin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_sopir`
--
ALTER TABLE `tb_sopir`
  MODIFY `id_sopir` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_tanggal_panen`
--
ALTER TABLE `tb_tanggal_panen`
  MODIFY `id_tanggal_panen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_user_admin`
--
ALTER TABLE `tb_user_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_user_superadmin`
--
ALTER TABLE `tb_user_superadmin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
