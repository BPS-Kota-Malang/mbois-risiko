-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Agu 2024 pada 04.17
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
-- Database: `sadmin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `area_dampak`
--

CREATE TABLE `area_dampak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_dampak` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `area_dampak`
--

INSERT INTO `area_dampak` (`id`, `area_dampak`, `created_at`, `updated_at`) VALUES
(2, 'Malang Kota Hahahah', '2024-08-11 08:34:47', '2024-08-11 08:53:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_resiko`
--

CREATE TABLE `jenis_resiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `jenis_resiko` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_resiko`
--

INSERT INTO `jenis_resiko` (`id`, `kode`, `jenis_resiko`, `created_at`, `updated_at`) VALUES
(1, '002', 'Bukan', NULL, NULL),
(2, '003', 'Bukan', NULL, NULL),
(3, '003', 'resiko 3', '2024-08-11 05:31:08', '2024-08-11 05:31:08'),
(4, '010', 'apalahteshalo', '2024-08-11 05:34:36', '2024-08-11 06:00:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_resiko`
--

CREATE TABLE `kategori_resiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `definisi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori_resiko`
--

INSERT INTO `kategori_resiko` (`id`, `deskripsi`, `definisi`, `created_at`, `updated_at`) VALUES
(2, 'pa', 'hahaha', '2024-08-11 07:46:05', '2024-08-11 07:46:05'),
(3, 'resiko banyak', 'buanyak', '2024-08-12 10:40:30', '2024-08-12 10:40:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_dampak`
--

CREATE TABLE `kriteria_dampak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_area_dampak` bigint(20) UNSIGNED NOT NULL,
  `id_level_dampak` bigint(20) UNSIGNED NOT NULL,
  `deskripsi_negatif` varchar(255) NOT NULL,
  `deskripsi_positif` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_kemungkinan`
--

CREATE TABLE `kriteria_kemungkinan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kategori_resiko` bigint(20) UNSIGNED NOT NULL,
  `id_level_kemungkinan` bigint(20) UNSIGNED NOT NULL,
  `presentase_kemungkinan` varchar(255) NOT NULL,
  `jumlah_frekuensi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriteria_kemungkinan`
--

INSERT INTO `kriteria_kemungkinan` (`id`, `id_kategori_resiko`, `id_level_kemungkinan`, `presentase_kemungkinan`, `jumlah_frekuensi`, `created_at`, `updated_at`) VALUES
(2, 2, 2, '100', '21', '2024-08-13 09:50:21', '2024-08-13 09:51:08'),
(4, 3, 2, '100', '1', '2024-08-13 10:22:46', '2024-08-13 10:22:46'),
(5, 3, 3, '100', '2', '2024-08-13 10:22:54', '2024-08-13 10:22:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_dampak`
--

CREATE TABLE `level_dampak` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_dampak` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `level_dampak`
--

INSERT INTO `level_dampak` (`id`, `level_dampak`, `deskripsi`, `created_at`, `updated_at`) VALUES
(2, '1', 'Rendah', '2024-08-11 19:12:33', '2024-08-11 19:12:33'),
(3, '2', 'pedas', '2024-08-13 10:50:18', '2024-08-13 10:50:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_kemungkinan`
--

CREATE TABLE `level_kemungkinan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_kemungkinan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `level_kemungkinan`
--

INSERT INTO `level_kemungkinan` (`id`, `level_kemungkinan`, `created_at`, `updated_at`) VALUES
(2, 'ppphaha', '2024-08-11 09:41:03', '2024-08-11 09:41:03'),
(3, 'sedang', '2024-08-12 10:40:09', '2024-08-12 10:40:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_resiko`
--

CREATE TABLE `level_resiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_resiko` varchar(255) NOT NULL,
  `rentang_besar_resiko` varchar(255) NOT NULL,
  `tindakan` varchar(255) NOT NULL,
  `ket_warna` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `matriks_analisis_resiko`
--

CREATE TABLE `matriks_analisis_resiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_level_kemungkinan` bigint(20) UNSIGNED NOT NULL,
  `id_level_dampak` bigint(20) UNSIGNED NOT NULL,
  `besaran_resiko` int(3) NOT NULL,
  `id_level_Resiko` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_07_22_060106_create_permission_tables', 2),
(5, '2024_08_08_142116_create_pemangku_kepentingan_table', 2),
(6, '2024_08_08_142124_create_peraturan_perundang_undangan_table', 2),
(7, '2024_08_08_142133_create_jenis_resiko_table', 2),
(8, '2024_08_08_142133_create_sumber_resiko_table', 2),
(9, '2024_08_08_142133_create_tim_project_table', 2),
(10, '2024_08_08_142134_create_area_dampak_table', 2),
(11, '2024_08_08_142134_create_kategori_resiko_table', 2),
(12, '2024_08_08_142135_create_kriteria_kemungkinan_table', 2),
(13, '2024_08_08_142135_create_level_dampak_table', 2),
(14, '2024_08_08_142135_create_level_kemungkinan', 2),
(15, '2024_08_08_142136_create_kriteria_dampak_table', 2),
(16, '2024_08_08_142136_create_level_resiko_table', 2),
(17, '2024_08_08_142137_create_opsi_penanganan_table', 2),
(18, '2024_08_08_142137_create_selera_resiko_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `opsi_penanganan`
--

CREATE TABLE `opsi_penanganan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opsi_penanganan` varchar(255) NOT NULL,
  `deskisi` varchar(255) NOT NULL,
  `id_jenis_resiko` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemangku_kepentingan`
--

CREATE TABLE `pemangku_kepentingan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pemangku_kepentingan` varchar(255) NOT NULL,
  `kelompok_pemangku_kepentingan` varchar(255) NOT NULL,
  `hubungan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemangku_kepentingan`
--

INSERT INTO `pemangku_kepentingan` (`id`, `pemangku_kepentingan`, `kelompok_pemangku_kepentingan`, `hubungan`, `created_at`, `updated_at`) VALUES
(12, 'Kementerian Perhutanan', 'Eksternal', 'HutanRimba', '2024-08-10 00:12:41', '2024-08-10 09:20:57'),
(15, 'kementerian perwibuan', 'Internal', 'Kecambah', '2024-08-10 04:22:52', '2024-08-10 04:22:52'),
(17, 'Kementerian Pertanian Kubis', 'Internal', 'Kecambah', '2024-08-10 09:21:10', '2024-08-10 09:21:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peraturan_perundang_undangan`
--

CREATE TABLE `peraturan_perundang_undangan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peraturan_perundang_undangan` varchar(255) NOT NULL,
  `amanat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `peraturan_perundang_undangan`
--

INSERT INTO `peraturan_perundang_undangan` (`id`, `peraturan_perundang_undangan`, `amanat`, `created_at`, `updated_at`) VALUES
(1, 'Hai', 'Nilla', '2024-08-10 02:55:33', '2024-08-10 02:55:33'),
(2, 'Halo', 'Nilla', '2024-08-10 02:55:44', '2024-08-10 02:55:44'),
(3, 'PP', 'takde', '2024-08-10 03:01:02', '2024-08-10 03:01:02'),
(5, 'PP', 'Nilla', '2024-08-10 03:03:40', '2024-08-10 03:03:40'),
(6, 'TI', 'PC', '2024-08-10 03:11:28', '2024-08-10 03:11:28'),
(7, 'Halo', 'NillaPutrir', '2024-08-10 09:44:13', '2024-08-10 09:44:13'),
(8, 'TID', 'RE', '2024-08-10 09:46:46', '2024-08-10 09:46:46'),
(9, 'TID', 'titpo', '2024-08-11 08:37:24', '2024-08-11 08:37:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard_access', 'web', '2024-08-07 08:11:21', '2024-08-07 08:11:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-08-07 08:11:21', '2024-08-07 08:11:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `selera_resiko`
--

CREATE TABLE `selera_resiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kategori_resiko` bigint(20) NOT NULL,
  `resiko_minimum_negatif` int(11) NOT NULL,
  `resiko_miimum_positif` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pyjdfvE6vX1FsUkkJoNw4WvT5Lppmpzkt5LdyZaq', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN2JFWTVuMFgwOHNsT1gwa0FXVG4wckhROFI0VDVNZFNSM1BDVzJQWiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyOToiaHR0cDovLzEyNy4wLjAuMTo4MDgwL2NvbnRleHQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDgwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7fQ==', 1723572898);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sumber_resiko`
--

CREATE TABLE `sumber_resiko` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `sumber_resiko` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sumber_resiko`
--

INSERT INTO `sumber_resiko` (`id`, `kode`, `sumber_resiko`, `created_at`, `updated_at`) VALUES
(1, '001', 'Internal', '2024-08-11 06:13:10', '2024-08-11 06:13:10'),
(2, 'a3', 'Eksternal', '2024-08-11 06:13:20', '2024-08-11 06:22:32'),
(3, 'a4', 'Internal', '2024-08-11 06:28:55', '2024-08-11 06:29:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim_project`
--

CREATE TABLE `tim_project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_team` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tim_project`
--

INSERT INTO `tim_project` (`id`, `nama_team`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'bro', 'ngerjakan simari', NULL, NULL),
(2, 'Tim Kuda', 'Hahaha tim kuda', '2024-08-11 04:42:19', '2024-08-11 04:42:19'),
(3, 'Tim bBi', 'Babi apa', '2024-08-11 04:45:26', '2024-08-11 04:45:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Carmine Howe', 'bonita.kirlin@example.org', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'iSDaNjHjdZ', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(2, 'Rosendo Miller V', 'lhoeger@example.com', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'bdT9pDj5B1', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(3, 'Dr. Dominique Stroman IV', 'harris.lavonne@example.com', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'W845XsXO7y', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(4, 'Mervin Bradtke', 'gutkowski.kali@example.net', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'pp1EZqRZOz', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(5, 'Bettie Kuphal', 'ddach@example.net', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'mmATlFHys3', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(6, 'Prof. Cyril Stoltenberg', 'hilton04@example.com', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'lfNDarz8DA', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(7, 'Octavia Hessel', 'xwiegand@example.org', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'KgYFurdX5T', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(8, 'Miss Claudia Heller Jr.', 'pdibbert@example.com', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'nXh7CifS2T', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(9, 'Emery McGlynn', 'ejacobson@example.com', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'pCN9GT74lV', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(10, 'Leilani Rempel', 'hassan.marvin@example.net', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'KaNfGzX2ZG', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(11, 'Test User', 'test@example.com', '2024-08-07 08:11:20', '$2y$12$XONwBWcElUBuDJkPLm9c9uFXia6XuqDEMIPPQWq2Owgr.VDqjH8/G', 'tcTOm4JtZh', '2024-08-07 08:11:20', '2024-08-07 08:11:20'),
(12, 'Admin User', 'admin@example.com', '2024-08-09 15:44:49', '$2y$12$BQ7mCfq9uK7Nv0udz5sv0eXmlH7tJGrLof1n8j2jRNeg8bQoopu6q', NULL, '2024-08-07 08:11:21', '2024-08-07 08:11:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `area_dampak`
--
ALTER TABLE `area_dampak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jenis_resiko`
--
ALTER TABLE `jenis_resiko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_resiko`
--
ALTER TABLE `kategori_resiko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria_dampak`
--
ALTER TABLE `kriteria_dampak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_area_dampak` (`id_area_dampak`),
  ADD KEY `id_level_dampak` (`id_level_dampak`);

--
-- Indeks untuk tabel `kriteria_kemungkinan`
--
ALTER TABLE `kriteria_kemungkinan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_resiko` (`id_kategori_resiko`),
  ADD KEY `id_level_kemungkinan` (`id_level_kemungkinan`);

--
-- Indeks untuk tabel `level_dampak`
--
ALTER TABLE `level_dampak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level_kemungkinan`
--
ALTER TABLE `level_kemungkinan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level_resiko`
--
ALTER TABLE `level_resiko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `matriks_analisis_resiko`
--
ALTER TABLE `matriks_analisis_resiko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level_kemungkinan` (`id_level_kemungkinan`),
  ADD KEY `id_level_dampak` (`id_level_dampak`),
  ADD KEY `id_level_Resiko` (`id_level_Resiko`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `opsi_penanganan`
--
ALTER TABLE `opsi_penanganan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pemangku_kepentingan`
--
ALTER TABLE `pemangku_kepentingan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peraturan_perundang_undangan`
--
ALTER TABLE `peraturan_perundang_undangan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `selera_resiko`
--
ALTER TABLE `selera_resiko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `sumber_resiko`
--
ALTER TABLE `sumber_resiko`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tim_project`
--
ALTER TABLE `tim_project`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `area_dampak`
--
ALTER TABLE `area_dampak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_resiko`
--
ALTER TABLE `jenis_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_resiko`
--
ALTER TABLE `kategori_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kriteria_dampak`
--
ALTER TABLE `kriteria_dampak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kriteria_kemungkinan`
--
ALTER TABLE `kriteria_kemungkinan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `level_dampak`
--
ALTER TABLE `level_dampak`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `level_kemungkinan`
--
ALTER TABLE `level_kemungkinan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `level_resiko`
--
ALTER TABLE `level_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `opsi_penanganan`
--
ALTER TABLE `opsi_penanganan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemangku_kepentingan`
--
ALTER TABLE `pemangku_kepentingan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `peraturan_perundang_undangan`
--
ALTER TABLE `peraturan_perundang_undangan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `selera_resiko`
--
ALTER TABLE `selera_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sumber_resiko`
--
ALTER TABLE `sumber_resiko`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tim_project`
--
ALTER TABLE `tim_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kriteria_dampak`
--
ALTER TABLE `kriteria_dampak`
  ADD CONSTRAINT `kriteria_dampak_ibfk_1` FOREIGN KEY (`id_level_dampak`) REFERENCES `level_dampak` (`id`),
  ADD CONSTRAINT `kriteria_dampak_ibfk_2` FOREIGN KEY (`id_area_dampak`) REFERENCES `area_dampak` (`id`);

--
-- Ketidakleluasaan untuk tabel `kriteria_kemungkinan`
--
ALTER TABLE `kriteria_kemungkinan`
  ADD CONSTRAINT `kriteria_kemungkinan_ibfk_1` FOREIGN KEY (`id_kategori_resiko`) REFERENCES `kategori_resiko` (`id`),
  ADD CONSTRAINT `kriteria_kemungkinan_ibfk_2` FOREIGN KEY (`id_level_kemungkinan`) REFERENCES `level_kemungkinan` (`id`);

--
-- Ketidakleluasaan untuk tabel `matriks_analisis_resiko`
--
ALTER TABLE `matriks_analisis_resiko`
  ADD CONSTRAINT `matriks_analisis_resiko_ibfk_1` FOREIGN KEY (`id_level_kemungkinan`) REFERENCES `level_kemungkinan` (`id`),
  ADD CONSTRAINT `matriks_analisis_resiko_ibfk_2` FOREIGN KEY (`id_level_dampak`) REFERENCES `level_dampak` (`id`),
  ADD CONSTRAINT `matriks_analisis_resiko_ibfk_3` FOREIGN KEY (`id_level_Resiko`) REFERENCES `level_resiko` (`id`);

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
