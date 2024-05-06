-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2023 pada 08.24
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
(16, '2023_12_14_021221_tb_data_anggota_lama', 3);

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
(1, 3, 1, 1, 'photos/1702018590_IMG_20220406_134027.jpg', 'Rizky Firmansyah', '1000', '14720110321312', '2023-12-08', 'Laki-laki', 'Mahasiswa', 'Pangkalan Durian', '2023-12-08', 'R 001', '2023-12-07 23:56:30', '2023-12-07 23:56:30'),
(2, 3, 1, 2, 'photos/1702020802_tr-removebg-preview.png', 'Rizky Saja', '1000', '14720110321312', '2023-12-08', 'Laki-laki', 'Mahasiswa', 'Pangkalan Durian', '2023-12-08', 'R 002', '2023-12-07 23:57:29', '2023-12-08 19:06:03'),
(3, 7, 8, 8, 'photos/1702087391_IMG_20220406_134027.jpg', 'Bangkinang', '1000', '21321123312', '2023-12-09', 'Laki-laki', 'Mahasiswa', 'Bangkinang', '2023-12-09', 'Y 001', '2023-12-08 19:03:11', '2023-12-08 19:03:11'),
(4, 3, 7, 1, 'photos/1702527575_images (4).jpeg', 'Sandi', '1000', '12345678', '2023-12-01', 'Laki-laki', 'Editing', 'Pangkalan Durian', '2023-12-14', 'S 01', '2023-12-09 05:37:13', '2023-12-13 21:30:02'),
(5, 3, 3, 6, 'photos/1702567671_Gambar WhatsApp 2023-12-14 pukul 21.12.31_44912749.jpg', 'Sri Ayu Indriyani', '1000', '369258147', '2002-01-14', 'Perempuan', 'Mahasiswa', 'Bangkinang', '2023-12-14', 'S 03', '2023-12-12 09:48:16', '2023-12-14 08:36:51');

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
(1, 3, '1', '2023-12-07 20:22:53', '2023-12-07 20:22:53'),
(2, 3, '2', '2023-12-07 20:22:58', '2023-12-07 20:36:45'),
(3, 3, '3', '2023-12-07 20:23:02', '2023-12-07 20:23:02'),
(4, 3, '4', '2023-12-07 20:23:09', '2023-12-07 20:23:09'),
(6, 3, '5', '2023-12-07 20:38:01', '2023-12-07 20:38:01'),
(7, 3, '6', '2023-12-07 20:38:06', '2023-12-07 20:38:11'),
(8, 7, '1', '2023-12-08 19:00:56', '2023-12-08 19:00:56'),
(9, 7, '2', '2023-12-08 19:01:01', '2023-12-08 19:01:01'),
(10, 7, '3', '2023-12-08 19:01:07', '2023-12-08 19:01:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_daftar_anggota_baru`
--

CREATE TABLE `tb_daftar_anggota_baru` (
  `id_daftar_anggota_baru` bigint(20) UNSIGNED NOT NULL,
  `id_superadmin` int(11) NOT NULL,
  `id_anggota_tervalidasi` int(11) NOT NULL,
  `id_kelompok` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
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

--
-- Dumping data untuk tabel `tb_daftar_anggota_baru`
--

INSERT INTO `tb_daftar_anggota_baru` (`id_daftar_anggota_baru`, `id_superadmin`, `id_anggota_tervalidasi`, `id_kelompok`, `photo`, `KkPdf`, `SertifPdf`, `JBPdf`, `nama_anggota_baru`, `nik`, `alamat`, `pekerjaan`, `jenis_kelamin`, `status`, `tanggal_lahir`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 7, 'photos/1702527575_images (4).jpeg', 'daftaranggotaterbaru/1702527575_kk_LaporanAkhir_ERP_202113029_Rizky Firmansyah.pdf', 'daftaranggotaterbaru/1702527575_sertif_29-31.pdf', 'daftaranggotaterbaru/1702527575_jb_Bab 1 -3.pdf', 'Sandi', '12345678', 'BL Pelosok', 'Editing', 'Laki-laki', 'Selesai Verifikasi', '2023-12-01', '2023-12-13 21:19:35', '2023-12-13 21:30:02'),
(3, 3, 5, 3, 'photos/1702567671_Gambar WhatsApp 2023-12-14 pukul 21.12.31_44912749.jpg', 'daftaranggotaterbaru/1702567671_kk_Kartu Tanda Penduduk.pdf', 'daftaranggotaterbaru/1702567671_sertif_Kartu BPJS.pdf', 'daftaranggotaterbaru/1702567671_jb_Transkrip Nilai.pdf', 'Sri Ayu Indriyani', '369258147', 'Rohil', 'Mahasiswa', 'Perempuan', 'Selesai Verifikasi', '2002-01-14', '2023-12-14 08:27:51', '2023-12-14 08:36:51');

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

--
-- Dumping data untuk tabel `tb_data_anggota_lama`
--

INSERT INTO `tb_data_anggota_lama` (`id_data_anggota_lama`, `id_superadmin`, `id_anggota_lama`, `id_kelompok`, `photo`, `nama_anggota_lama`, `nik`, `alamat`, `pekerjaan`, `no_anggota`, `tanggal_lahir`, `tanggal_keluar`, `jenis_kelamin`, `created_at`, `updated_at`, `id_blok`) VALUES
(1, 3, 4, 7, 'photos/1702125433_IMG_20220406_134027.jpg', 'Sariono', '14720110321312', 'Pangkalan Durian', 'Petani', 'S 02', '2023-12-13', '2023-12-14', 'Laki-laki', '2023-12-13 21:30:02', '2023-12-13 21:30:02', 1),
(2, 3, 5, 3, 'photos/1702399696_man-7750139_1280.png', 'Surya', '14720110321312', 'Bangkinang', 'Petani', 'A 001', '2023-12-12', '2023-12-14', 'Laki-laki', '2023-12-14 08:35:00', '2023-12-14 08:35:00', 6),
(3, 3, 5, 3, 'photos/1702567671_Gambar WhatsApp 2023-12-14 pukul 21.12.31_44912749.jpg', 'Sariono', '369258147', 'Bangkinang', 'Mahasiswa', 'S 02', '2002-01-14', '2023-12-14', 'Perempuan', '2023-12-14 08:36:51', '2023-12-14 08:36:51', 6);

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
(1, 1, 3, 1, 1, 4000.00, '2023-12-12 05:46:49', '2023-12-12 05:46:49'),
(2, 1, 3, 1, 2, 4000.00, '2023-12-12 05:46:56', '2023-12-12 05:46:56'),
(3, 7, 3, 2, 4, 4000.00, '2023-12-12 05:47:21', '2023-12-12 05:47:21'),
(4, 3, 3, 3, 5, 4500.00, '2023-12-12 09:49:12', '2023-12-12 09:49:12'),
(5, 1, 3, 4, 1, 1000.00, '2023-12-12 10:24:19', '2023-12-12 10:24:19'),
(6, 1, 3, 4, 2, 1000.00, '2023-12-12 10:24:28', '2023-12-12 10:24:28'),
(7, 1, 3, 4, 1, 10000.00, '2023-12-12 19:31:42', '2023-12-12 19:31:42'),
(8, 3, 3, 5, 5, 10000.00, '2023-12-12 22:44:25', '2023-12-12 22:44:25'),
(9, 7, 3, 6, 4, 10000.00, '2023-12-12 22:44:34', '2023-12-12 22:44:34'),
(10, 1, 3, 7, 1, 400.00, '2023-12-12 22:45:35', '2023-12-14 06:59:52'),
(11, 1, 3, 7, 2, 10000.00, '2023-12-12 22:45:41', '2023-12-12 22:45:41');

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
(1, 7, 2, 3, 1, 1, 1, 100, 'Peputra Masterindo', '09879-0721', '2023-12-12 05:48:25', '2023-12-12 05:48:25'),
(2, 1, 1, 3, 1, 1, 1, 100, 'Peputra Masterindo', '09880-0721', '2023-12-12 05:49:04', '2023-12-12 05:49:04'),
(3, 1, 1, 3, 2, 2, 2, 100, 'Peputra Masterindo', '09881-0721', '2023-12-12 05:49:35', '2023-12-12 05:49:35'),
(4, 3, 3, 3, 2, 1, 3, 100, 'Peputra Masterindo', '95579-0721', '2023-12-14 09:09:33', '2023-12-14 09:10:55');

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
(1, 3, 'Maju Jaya', '2023-12-07 20:43:14', '2023-12-07 20:43:14'),
(2, 3, 'Rukun Jaya', '2023-12-07 20:44:03', '2023-12-07 20:44:03'),
(3, 3, 'Tunas Mulya', '2023-12-07 20:45:01', '2023-12-07 20:53:44'),
(5, 3, 'Subur Makmur', '2023-12-07 20:53:50', '2023-12-07 20:53:50'),
(7, 3, 'Sri Rahayu', '2023-12-07 20:54:09', '2023-12-07 20:54:09'),
(8, 7, 'Bangkinang', '2023-12-08 19:01:18', '2023-12-08 19:01:18');

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
(1, 'Super Admin', '2023-12-07 08:08:57', '2023-12-07 08:08:57'),
(3, 'Unit Usaha Otonom', '2023-12-07 09:14:44', '2023-12-07 09:14:44');

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
(1, 3, 1, '2023-12-12', '2023-12-12 05:46:35', '2023-12-12 05:46:35'),
(2, 3, 7, '2023-12-01', '2023-12-12 05:47:10', '2023-12-12 05:47:10'),
(3, 3, 3, '2023-12-07', '2023-12-12 09:48:56', '2023-12-12 09:48:56'),
(4, 3, 1, '2023-11-02', NULL, NULL),
(5, 3, 3, '2023-11-15', NULL, NULL),
(6, 3, 7, '2023-11-12', NULL, NULL),
(7, 3, 1, '2024-01-10', NULL, NULL);

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
(1, 1, 'Super Admin', 'Super Admin', '$2y$10$8Q8v.JxNhjSH9ocMNTLSXuetDygBkg9zYiypeaf3tUKz.8Cf8Kkc.', '2023-12-07 08:33:52', '2023-12-07 08:33:52'),
(3, 3, 'UUO Bukit Payung', 'UUO Bukit Payung', '$2y$10$u7SyQReD.y8ziC90rmslkO.INouK5CJkbwzugc620iwGS.4OH3ahS', '2023-12-07 09:15:47', '2023-12-07 09:15:47'),
(7, 3, 'UUO Bangkinang', 'UUO Bangkinang', '$2y$10$XL7tPcjXi3UWcu39o1SVseO6JZkFvVfMqgxYXIu05srFDkNcUX3lC', '2023-12-08 18:59:40', '2023-12-08 18:59:40');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_anggota_tervalidasi`
--
ALTER TABLE `tb_anggota_tervalidasi`
  MODIFY `id_anggota_tervalidasi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_blok`
--
ALTER TABLE `tb_blok`
  MODIFY `id_blok` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_daftar_anggota_baru`
--
ALTER TABLE `tb_daftar_anggota_baru`
  MODIFY `id_daftar_anggota_baru` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_data_anggota_lama`
--
ALTER TABLE `tb_data_anggota_lama`
  MODIFY `id_data_anggota_lama` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_data_panen_kelompok`
--
ALTER TABLE `tb_data_panen_kelompok`
  MODIFY `id_data_panen_kelompok` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_data_spb`
--
ALTER TABLE `tb_data_spb`
  MODIFY `id_data_spb` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_input_hasil_pks`
--
ALTER TABLE `tb_input_hasil_pks`
  MODIFY `id_input_hasil_pks` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kelompok`
--
ALTER TABLE `tb_kelompok`
  MODIFY `id_kelompok` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id_kendaraan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_tanggal_panen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_user_admin`
--
ALTER TABLE `tb_user_admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_user_superadmin`
--
ALTER TABLE `tb_user_superadmin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
