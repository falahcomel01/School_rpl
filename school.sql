-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.0.30 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- membuang struktur untuk table school_rpl.aturan_kelulusans
CREATE TABLE IF NOT EXISTS `aturan_kelulusans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nilai_minimal` int NOT NULL,
  `tahun` year NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.aturan_kelulusans: ~0 rows (lebih kurang)
INSERT INTO `aturan_kelulusans` (`id`, `nilai_minimal`, `tahun`, `created_at`, `updated_at`) VALUES
	(1, 20, '2024', '2025-12-21 05:27:47', '2025-12-21 05:27:47');

-- membuang struktur untuk table school_rpl.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.cache: ~3 rows (lebih kurang)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('laravel-cache-spatie.permission.cache', 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:67:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:10:"view users";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:1;a:4:{s:1:"a";i:2;s:1:"b";s:10:"view roles";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:2;a:4:{s:1:"a";i:3;s:1:"b";s:16:"view permissions";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:3;a:4:{s:1:"a";i:4;s:1:"b";s:12:"create users";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:4;a:4:{s:1:"a";i:5;s:1:"b";s:10:"show users";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:5;a:4:{s:1:"a";i:6;s:1:"b";s:10:"edit users";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:6;a:4:{s:1:"a";i:7;s:1:"b";s:12:"delete users";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:7;a:4:{s:1:"a";i:8;s:1:"b";s:12:"create roles";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:8;a:4:{s:1:"a";i:9;s:1:"b";s:10:"show roles";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:9;a:4:{s:1:"a";i:10;s:1:"b";s:10:"edit roles";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:10;a:4:{s:1:"a";i:11;s:1:"b";s:12:"delete roles";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:11;a:4:{s:1:"a";i:12;s:1:"b";s:18:"create permissions";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:12;a:4:{s:1:"a";i:13;s:1:"b";s:16:"show permissions";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:13;a:4:{s:1:"a";i:14;s:1:"b";s:16:"edit permissions";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:14;a:4:{s:1:"a";i:15;s:1:"b";s:18:"delete permissions";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:15;a:4:{s:1:"a";i:16;s:1:"b";s:10:"view total";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:6;}}i:16;a:4:{s:1:"a";i:17;s:1:"b";s:10:"view siswa";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:4;i:2;i:6;i:3;i:7;}}i:17;a:4:{s:1:"a";i:18;s:1:"b";s:10:"edit siswa";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:7;}}i:18;a:4:{s:1:"a";i:19;s:1:"b";s:9:"view guru";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:6;}}i:19;a:4:{s:1:"a";i:20;s:1:"b";s:11:"view jadwal";s:1:"c";s:3:"web";s:1:"r";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:20;a:4:{s:1:"a";i:21;s:1:"b";s:13:"create jadwal";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:21;a:4:{s:1:"a";i:22;s:1:"b";s:11:"edit jadwal";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:22;a:4:{s:1:"a";i:23;s:1:"b";s:18:"edit presensisiswa";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:23;a:4:{s:1:"a";i:24;s:1:"b";s:20:"create presensisiswa";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:8;}}i:24;a:4:{s:1:"a";i:25;s:1:"b";s:20:"delete presensisiswa";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:25;a:4:{s:1:"a";i:26;s:1:"b";s:18:"view presensisiswa";s:1:"c";s:3:"web";s:1:"r";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:26;a:4:{s:1:"a";i:27;s:1:"b";s:18:"show presensisiswa";s:1:"c";s:3:"web";s:1:"r";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:27;a:4:{s:1:"a";i:28;s:1:"b";s:19:"create presensiguru";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:28;a:4:{s:1:"a";i:29;s:1:"b";s:17:"show presensiguru";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:29;a:4:{s:1:"a";i:30;s:1:"b";s:17:"view presensiguru";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:30;a:4:{s:1:"a";i:31;s:1:"b";s:19:"delete presensiguru";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:31;a:4:{s:1:"a";i:32;s:1:"b";s:16:"create walikelas";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:32;a:4:{s:1:"a";i:33;s:1:"b";s:16:"delete walikelas";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:33;a:4:{s:1:"a";i:34;s:1:"b";s:14:"edit walikelas";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:34;a:4:{s:1:"a";i:35;s:1:"b";s:14:"view walikelas";s:1:"c";s:3:"web";s:1:"r";a:5:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:6;i:4;i:7;}}i:35;a:4:{s:1:"a";i:36;s:1:"b";s:14:"view perizinan";s:1:"c";s:3:"web";s:1:"r";a:6:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:6;i:5;i:7;}}i:36;a:4:{s:1:"a";i:37;s:1:"b";s:14:"edit perizinan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:37;a:4:{s:1:"a";i:38;s:1:"b";s:16:"delete perizinan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:38;a:4:{s:1:"a";i:39;s:1:"b";s:16:"create perizinan";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;}}i:39;a:4:{s:1:"a";i:40;s:1:"b";s:18:"view all perizinan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:6;}}i:40;a:4:{s:1:"a";i:41;s:1:"b";s:20:"view siswa perizinan";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:7;}}i:41;a:4:{s:1:"a";i:42;s:1:"b";s:18:"view own perizinan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:4;}}i:42;a:4:{s:1:"a";i:43;s:1:"b";s:15:"view all jadwal";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:6;}}i:43;a:4:{s:1:"a";i:44;s:1:"b";s:16:"view guru jadwal";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:44;a:4:{s:1:"a";i:45;s:1:"b";s:17:"view kelas jadwal";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:7;}}i:45;a:4:{s:1:"a";i:46;s:1:"b";s:22:"view all presensisiswa";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:6;}}i:46;a:4:{s:1:"a";i:47;s:1:"b";s:24:"view kelas presensisiswa";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:7;}}i:47;a:4:{s:1:"a";i:48;s:1:"b";s:23:"view guru presensisiswa";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:48;a:4:{s:1:"a";i:49;s:1:"b";s:19:"view presensi siswa";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:49;a:4:{s:1:"a";i:50;s:1:"b";s:12:"delete siswa";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:50;a:4:{s:1:"a";i:51;s:1:"b";s:15:"create prestasi";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:7;}}i:51;a:4:{s:1:"a";i:52;s:1:"b";s:13:"validasi izin";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:4;i:2;i:6;i:3;i:7;}}i:52;a:4:{s:1:"a";i:53;s:1:"b";s:11:"view materi";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:3;i:2;i:4;}}i:53;a:4:{s:1:"a";i:54;s:1:"b";s:10:"view extra";s:1:"c";s:3:"web";s:1:"r";a:5:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;i:4;i:8;}}i:54;a:4:{s:1:"a";i:55;s:1:"b";s:20:"view aturankelulusan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:55;a:4:{s:1:"a";i:56;s:1:"b";s:13:"view prestasi";s:1:"c";s:3:"web";s:1:"r";a:6:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;i:4;i:6;i:5;i:7;}}i:56;a:4:{s:1:"a";i:57;s:1:"b";s:16:"create kelulusan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:4;}}i:57;a:4:{s:1:"a";i:58;s:1:"b";s:14:"view statistik";s:1:"c";s:3:"web";s:1:"r";a:4:{i:0;i:1;i:1;i:4;i:2;i:6;i:3;i:7;}}i:58;a:4:{s:1:"a";i:59;s:1:"b";s:25:"view catatan_perkembangan";s:1:"c";s:3:"web";s:1:"r";a:5:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;i:4;i:7;}}i:59;a:4:{s:1:"a";i:60;s:1:"b";s:27:"create catatan_perkembangan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:7;}}i:60;a:4:{s:1:"a";i:61;s:1:"b";s:25:"edit catatan_perkembangan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:7;}}i:61;a:4:{s:1:"a";i:62;s:1:"b";s:27:"delete catatan_perkembangan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:4;i:2;i:7;}}i:62;a:4:{s:1:"a";i:63;s:1:"b";s:10:"view tugas";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:2;i:1;i:3;i:2;i:4;}}i:63;a:4:{s:1:"a";i:64;s:1:"b";s:17:"view daskelulusan";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:6;}}i:64;a:4:{s:1:"a";i:65;s:1:"b";s:15:"create prizinan";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:65;a:4:{s:1:"a";i:66;s:1:"b";s:13:"pilihan extra";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:2;}}i:66;a:4:{s:1:"a";i:67;s:1:"b";s:12:"view peserta";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:4;i:1;i:8;}}}s:5:"roles";a:8:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:10:"superadmin";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:4;s:1:"b";s:3:"tus";s:1:"c";s:3:"web";}i:2;a:3:{s:1:"a";i:6;s:1:"b";s:6:"kepsek";s:1:"c";s:3:"web";}i:3;a:3:{s:1:"a";i:7;s:1:"b";s:9:"walikelas";s:1:"c";s:3:"web";}i:4;a:3:{s:1:"a";i:2;s:1:"b";s:5:"siswa";s:1:"c";s:3:"web";}i:5;a:3:{s:1:"a";i:3;s:1:"b";s:4:"guru";s:1:"c";s:3:"web";}i:6;a:3:{s:1:"a";i:5;s:1:"b";s:8:"orangtua";s:1:"c";s:3:"web";}i:7;a:3:{s:1:"a";i:8;s:1:"b";s:7:"pembina";s:1:"c";s:3:"web";}}}', 1766376131);

-- membuang struktur untuk table school_rpl.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.cache_locks: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.catatan_perkembangans
CREATE TABLE IF NOT EXISTS `catatan_perkembangans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `walikelas_id` bigint unsigned NOT NULL,
  `catatan_akademik` text COLLATE utf8mb4_unicode_ci,
  `catatan_non_akademik` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catatan_perkembangans_siswa_id_foreign` (`siswa_id`),
  KEY `catatan_perkembangans_walikelas_id_foreign` (`walikelas_id`),
  CONSTRAINT `catatan_perkembangans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `catatan_perkembangans_walikelas_id_foreign` FOREIGN KEY (`walikelas_id`) REFERENCES `walikelas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.catatan_perkembangans: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.ekstrakurikulers
CREATE TABLE IF NOT EXISTS `ekstrakurikulers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pembina_id` bigint unsigned NOT NULL,
  `nama_extra` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jadwal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kuota` int NOT NULL DEFAULT '0',
  `pendaftaran_mulai` date NOT NULL,
  `pendaftaran_selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ekstrakurikulers_pembina_id_foreign` (`pembina_id`),
  CONSTRAINT `ekstrakurikulers_pembina_id_foreign` FOREIGN KEY (`pembina_id`) REFERENCES `pembinas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.ekstrakurikulers: ~1 rows (lebih kurang)
INSERT INTO `ekstrakurikulers` (`id`, `pembina_id`, `nama_extra`, `deskripsi`, `jadwal`, `tempat`, `kuota`, `pendaftaran_mulai`, `pendaftaran_selesai`, `created_at`, `updated_at`) VALUES
	(1, 3, 'menari', 'dwxe', 'Senin, 10:40 - 12:40', 'frt', 23, '2025-12-21', '2025-12-25', '2025-12-21 02:38:48', '2025-12-21 02:52:05'),
	(2, 1, 'fgh', 'vdg', 'Selasa, 12:07 - 13:07', 'n', 4, '2025-12-21', '2025-12-25', '2025-12-21 03:07:56', '2025-12-21 03:07:56');

-- membuang struktur untuk table school_rpl.extra_pesertas
CREATE TABLE IF NOT EXISTS `extra_pesertas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ekstrakurikuler_id` bigint unsigned NOT NULL,
  `siswa_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `extra_pesertas_ekstrakurikuler_id_foreign` (`ekstrakurikuler_id`),
  KEY `extra_pesertas_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `extra_pesertas_ekstrakurikuler_id_foreign` FOREIGN KEY (`ekstrakurikuler_id`) REFERENCES `ekstrakurikulers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `extra_pesertas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.extra_pesertas: ~0 rows (lebih kurang)
INSERT INTO `extra_pesertas` (`id`, `ekstrakurikuler_id`, `siswa_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 6, '2025-12-21 02:42:12', '2025-12-21 02:42:12'),
	(2, 1, 3, '2025-12-21 04:02:41', '2025-12-21 04:02:41'),
	(3, 2, 3, '2025-12-21 04:02:51', '2025-12-21 04:02:51');

-- membuang struktur untuk table school_rpl.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.failed_jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.gurus
CREATE TABLE IF NOT EXISTS `gurus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `mapel_id` bigint unsigned DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gurus_user_id_foreign` (`user_id`),
  KEY `gurus_mapel_id_foreign` (`mapel_id`),
  CONSTRAINT `gurus_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE SET NULL,
  CONSTRAINT `gurus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.gurus: ~3 rows (lebih kurang)
INSERT INTO `gurus` (`id`, `user_id`, `mapel_id`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `foto_profile`, `created_at`, `updated_at`) VALUES
	(1, 15, 1, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:00:08', '2025-12-20 18:00:08'),
	(2, 23, 6, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:01:08', '2025-12-20 18:04:57'),
	(3, 24, 9, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:01:46', '2025-12-20 18:05:16'),
	(4, 25, 8, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:02:22', '2025-12-20 18:05:03'),
	(5, 26, 5, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:02:47', '2025-12-20 18:04:50'),
	(6, 27, 4, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:03:11', '2025-12-20 18:04:44'),
	(7, 28, 3, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:03:43', '2025-12-20 18:04:37'),
	(8, 29, 2, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:04:23', '2025-12-20 18:04:32'),
	(9, 16, 11, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:05:23', '2025-12-20 18:05:23'),
	(10, 17, 12, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:05:33', '2025-12-20 18:05:33'),
	(11, 18, 13, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:05:42', '2025-12-20 18:05:42'),
	(12, 13, 10, NULL, NULL, 'Perempuan', NULL, NULL, '2025-12-20 18:05:52', '2025-12-20 18:06:06'),
	(13, 14, 14, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:06:16', '2025-12-20 18:06:16');

-- membuang struktur untuk table school_rpl.jadwals
CREATE TABLE IF NOT EXISTS `jadwals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mapel_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_selesai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jadwals_mapel_id_foreign` (`mapel_id`),
  KEY `jadwals_guru_id_foreign` (`guru_id`),
  KEY `jadwals_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `jadwals_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwals_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jadwals_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.jadwals: ~2 rows (lebih kurang)
INSERT INTO `jadwals` (`id`, `mapel_id`, `guru_id`, `kelas_id`, `hari`, `jam_mulai`, `jam_selesai`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 'Senin', '10:00', '11:00', '2025-12-20 18:15:02', '2025-12-20 18:15:02'),
	(2, 1, 1, 4, 'Selasa', '10:00', '11:00', '2025-12-20 18:15:23', '2025-12-20 18:15:23'),
	(3, 1, 1, 6, 'Sabtu', '10:00', '11:00', '2025-12-21 04:40:00', '2025-12-21 04:40:00');

-- membuang struktur untuk table school_rpl.jawaban_siswas
CREATE TABLE IF NOT EXISTS `jawaban_siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ujian_siswa_id` bigint unsigned DEFAULT NULL,
  `ujian_soal_id` bigint unsigned NOT NULL,
  `opsi_jawaban_id` bigint unsigned DEFAULT NULL,
  `jawaban_essay` text COLLATE utf8mb4_unicode_ci,
  `waktu_jawab` datetime DEFAULT NULL,
  `nilai` double NOT NULL DEFAULT '0',
  `is_benar` tinyint(1) DEFAULT NULL,
  `status_jawaban` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jawaban_siswas_ujian_siswa_id_foreign` (`ujian_siswa_id`),
  KEY `jawaban_siswas_ujian_soal_id_foreign` (`ujian_soal_id`),
  KEY `jawaban_siswas_opsi_jawaban_id_foreign` (`opsi_jawaban_id`),
  CONSTRAINT `jawaban_siswas_opsi_jawaban_id_foreign` FOREIGN KEY (`opsi_jawaban_id`) REFERENCES `opsi_jawabans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `jawaban_siswas_ujian_siswa_id_foreign` FOREIGN KEY (`ujian_siswa_id`) REFERENCES `ujian_siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `jawaban_siswas_ujian_soal_id_foreign` FOREIGN KEY (`ujian_soal_id`) REFERENCES `ujian_soals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.jawaban_siswas: ~0 rows (lebih kurang)
INSERT INTO `jawaban_siswas` (`id`, `ujian_siswa_id`, `ujian_soal_id`, `opsi_jawaban_id`, `jawaban_essay`, `waktu_jawab`, `nilai`, `is_benar`, `status_jawaban`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, NULL, '2025-12-21 11:49:10', 0, 0, NULL, '2025-12-21 04:48:52', '2025-12-21 04:49:10');

-- membuang struktur untuk table school_rpl.jenis_ujians
CREATE TABLE IF NOT EXISTS `jenis_ujians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `nama_jenis_ujian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jenis_ujians_guru_id_foreign` (`guru_id`),
  CONSTRAINT `jenis_ujians_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.jenis_ujians: ~1 rows (lebih kurang)
INSERT INTO `jenis_ujians` (`id`, `guru_id`, `nama_jenis_ujian`, `deskripsi`, `created_at`, `updated_at`) VALUES
	(1, 1, 'UTS', NULL, '2025-12-21 01:56:10', '2025-12-21 01:56:10');

-- membuang struktur untuk table school_rpl.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.jobs: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.job_batches: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.jurusans
CREATE TABLE IF NOT EXISTS `jurusans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.jurusans: ~4 rows (lebih kurang)
INSERT INTO `jurusans` (`id`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
	(1, 'IPS', '2025-12-20 17:51:54', '2025-12-20 17:51:54'),
	(2, 'IPA', '2025-12-20 17:51:57', '2025-12-20 17:51:57'),
	(3, 'BAHASA', '2025-12-20 17:52:01', '2025-12-20 17:52:01'),
	(4, 'UMUM', '2025-12-20 17:56:26', '2025-12-20 17:56:26');

-- membuang struktur untuk table school_rpl.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jurusan_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelas_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `kelas_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.kelas: ~3 rows (lebih kurang)
INSERT INTO `kelas` (`id`, `nama_kelas`, `jurusan_id`, `created_at`, `updated_at`) VALUES
	(1, '10A', 4, '2025-12-20 17:57:13', '2025-12-20 17:57:20'),
	(2, '10B', 4, '2025-12-20 17:57:31', '2025-12-20 17:57:31'),
	(3, '10C', 4, '2025-12-20 17:57:41', '2025-12-20 17:57:41'),
	(4, '11A', 1, '2025-12-20 17:57:50', '2025-12-20 17:57:55'),
	(5, '11B', 1, '2025-12-20 17:58:06', '2025-12-20 17:58:06'),
	(6, '12A', 1, '2025-12-20 17:58:15', '2025-12-20 17:58:15'),
	(7, '12B', 1, '2025-12-20 17:58:33', '2025-12-20 17:58:43'),
	(8, '11A', 2, '2025-12-20 17:58:52', '2025-12-20 17:58:52'),
	(9, '11B', 2, '2025-12-20 17:58:59', '2025-12-20 17:58:59'),
	(10, '12A', 2, '2025-12-20 17:59:09', '2025-12-20 17:59:09'),
	(11, '12B', 2, '2025-12-20 17:59:20', '2025-12-20 17:59:20'),
	(12, '12B', 3, '2025-12-20 17:59:29', '2025-12-20 17:59:29'),
	(13, '12A', 3, '2025-12-20 17:59:38', '2025-12-20 17:59:38'),
	(14, '11A', 3, '2025-12-20 17:59:49', '2025-12-20 17:59:49'),
	(15, '11B', 3, '2025-12-20 17:59:54', '2025-12-20 17:59:54');

-- membuang struktur untuk table school_rpl.kelulusans
CREATE TABLE IF NOT EXISTS `kelulusans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned DEFAULT NULL,
  `nama_siswa_legacy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan_legacy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aturan_kelulusan_id` bigint unsigned NOT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `status` enum('lulus','tidak_lulus') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` year NOT NULL,
  `is_legacy` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kelulusans_aturan_kelulusan_id_foreign` (`aturan_kelulusan_id`),
  KEY `kelulusans_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `kelulusans_aturan_kelulusan_id_foreign` FOREIGN KEY (`aturan_kelulusan_id`) REFERENCES `aturan_kelulusans` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `kelulusans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.kelulusans: ~0 rows (lebih kurang)
INSERT INTO `kelulusans` (`id`, `siswa_id`, `nama_siswa_legacy`, `jurusan_legacy`, `aturan_kelulusan_id`, `nilai_akhir`, `status`, `tahun_lulus`, `is_legacy`, `created_at`, `updated_at`) VALUES
	(1, 6, NULL, NULL, 1, 20.00, 'lulus', '2024', 0, '2025-12-21 05:27:56', '2025-12-21 05:27:56');

-- membuang struktur untuk table school_rpl.kepseks
CREATE TABLE IF NOT EXISTS `kepseks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kepseks_user_id_foreign` (`user_id`),
  CONSTRAINT `kepseks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.kepseks: ~0 rows (lebih kurang)
INSERT INTO `kepseks` (`id`, `user_id`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `foto_profile`, `created_at`, `updated_at`) VALUES
	(1, 47, NULL, NULL, NULL, NULL, NULL, '2025-12-21 02:24:46', '2025-12-21 02:24:46');

-- membuang struktur untuk table school_rpl.mapels
CREATE TABLE IF NOT EXISTS `mapels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jurusan_id` bigint unsigned DEFAULT NULL,
  `nama_mapel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mapels_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `mapels_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.mapels: ~3 rows (lebih kurang)
INSERT INTO `mapels` (`id`, `jurusan_id`, `nama_mapel`, `tingkat`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Agama', NULL, '2025-12-20 17:52:10', '2025-12-20 17:52:10'),
	(2, NULL, 'PPKN', NULL, '2025-12-20 17:52:17', '2025-12-20 17:52:17'),
	(3, NULL, 'Pendidikan jasmani', NULL, '2025-12-20 17:52:46', '2025-12-20 17:52:46'),
	(4, 1, 'Geografi', NULL, '2025-12-20 17:52:58', '2025-12-20 17:52:58'),
	(5, 1, 'Statistika', NULL, '2025-12-20 17:53:14', '2025-12-20 17:53:14'),
	(6, 2, 'Kimia', NULL, '2025-12-20 17:53:24', '2025-12-20 17:53:24'),
	(8, 2, 'Biologi', NULL, '2025-12-20 17:54:22', '2025-12-20 17:54:22'),
	(9, 3, 'Bahasa jepang', NULL, '2025-12-20 17:55:23', '2025-12-20 17:55:23'),
	(10, 3, 'Antropologi', NULL, '2025-12-20 17:55:31', '2025-12-20 17:56:03'),
	(11, 3, 'Bahasa inggris', NULL, '2025-12-20 17:55:42', '2025-12-20 17:55:42'),
	(12, 4, 'Ipa', NULL, '2025-12-20 17:56:49', '2025-12-20 17:56:49'),
	(13, NULL, 'Ips', NULL, '2025-12-20 17:56:58', '2025-12-20 17:56:58'),
	(14, NULL, 'Bahasa', NULL, '2025-12-20 17:57:03', '2025-12-20 17:57:03');

-- membuang struktur untuk table school_rpl.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.migrations: ~43 rows (lebih kurang)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2025_10_12_155615_create_permission_tables', 1),
	(5, '2025_11_01_171530_create_tus_table', 1),
	(6, '2025_11_01_171648_create_kepseks_table', 1),
	(7, '2025_11_04_103733_create_superadmins_table', 1),
	(8, '2025_11_08_000002_create_jurusans_table', 1),
	(9, '2025_11_08_000003_create_kelas_table', 1),
	(10, '2025_11_08_000004_create_siswas_table', 1),
	(11, '2025_11_08_000005_create_mapels_table', 1),
	(12, '2025_11_08_000006_create_gurus_table', 1),
	(13, '2025_11_08_000600_create_jadwals_table', 1),
	(14, '2025_11_08_081050_create_walikelas_table', 1),
	(15, '2025_11_08_133941_create_perizinans_table', 1),
	(16, '2025_11_08_151012_create_presensis_table', 1),
	(17, '2025_11_16_124021_create_tugas_table', 1),
	(18, '2025_11_16_124545_create_tugaspengumpulans_table', 1),
	(19, '2025_11_26_002954_create_orangtuas_table', 1),
	(20, '2025_11_28_210709_create_jenis_ujians_table', 1),
	(21, '2025_11_28_210710_create_soals_table', 1),
	(22, '2025_11_28_210727_create_opsi_jawabans_table', 1),
	(23, '2025_11_28_210808_create_ujians_table', 1),
	(24, '2025_11_29_130355_create_ujian_soals_table', 1),
	(25, '2025_11_29_130929_create_ujian_siswas_table', 1),
	(26, '2025_11_29_131255_create_jawaban_siswas_table', 1),
	(27, '2025_12_01_101149_add_is_benar_to_jawaban_siswas_table', 1),
	(28, '2025_12_01_123710_add_jumlah_paket_to_ujians_table', 1),
	(29, '2025_12_01_124034_add_paket_to_ujian_siswas_table', 1),
	(30, '2025_12_02_010613_add_guru_id_to_ujians_table_v2', 1),
	(31, '2025_12_02_032434_create_pembobotan_nilais_table', 1),
	(32, '2025_12_02_032451_create_rekap_nilai_akhirs_table', 1),
	(33, '2025_12_02_034509_add_pembobotan_nilai_id_to_rekap_nilai_akhirs_table', 1),
	(34, '2025_12_02_100000_create_catatan_perkembangans_table', 1),
	(35, '2025_12_10_232138_create_pembinas_table', 1),
	(36, '2025_12_10_232957_create_ekstrakurikulers_table', 1),
	(37, '2025_12_13_104933_create_extra_pesertas_table', 1),
	(38, '2025_12_13_152140_create_prestasis_table', 1),
	(39, '2025_12_14_112622_create_presensi_ekstras_table', 1),
	(40, '2025_12_14_212545_create_aturan_kelulusans_table', 1),
	(41, '2025_12_14_212546_create_kelulusans_table', 1),
	(42, '2025_12_17_150347_add_legacy_fields_to_kelulusans_table', 1),
	(43, '2025_12_18_141527_create_rekomendasi_jurusans_table', 1),
	(44, '2025_12_20_013538_add_semester_tahun_to_catatan_perkembangans', 1),
	(45, '2025_12_20_130917_add_jurusan_rekomendasi_id_to_rekomendasi_jurusans', 1);

-- membuang struktur untuk table school_rpl.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.model_has_permissions: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.model_has_roles: ~24 rows (lebih kurang)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\Models\\User', 1),
	(2, 'App\\Models\\User', 2),
	(2, 'App\\Models\\User', 3),
	(2, 'App\\Models\\User', 4),
	(2, 'App\\Models\\User', 5),
	(2, 'App\\Models\\User', 6),
	(2, 'App\\Models\\User', 7),
	(2, 'App\\Models\\User', 8),
	(2, 'App\\Models\\User', 9),
	(2, 'App\\Models\\User', 10),
	(2, 'App\\Models\\User', 11),
	(2, 'App\\Models\\User', 12),
	(3, 'App\\Models\\User', 13),
	(3, 'App\\Models\\User', 14),
	(7, 'App\\Models\\User', 14),
	(3, 'App\\Models\\User', 15),
	(3, 'App\\Models\\User', 16),
	(7, 'App\\Models\\User', 16),
	(3, 'App\\Models\\User', 17),
	(3, 'App\\Models\\User', 18),
	(4, 'App\\Models\\User', 19),
	(5, 'App\\Models\\User', 20),
	(5, 'App\\Models\\User', 21),
	(5, 'App\\Models\\User', 22),
	(3, 'App\\Models\\User', 23),
	(3, 'App\\Models\\User', 24),
	(3, 'App\\Models\\User', 25),
	(7, 'App\\Models\\User', 25),
	(3, 'App\\Models\\User', 26),
	(3, 'App\\Models\\User', 27),
	(3, 'App\\Models\\User', 28),
	(3, 'App\\Models\\User', 29),
	(8, 'App\\Models\\User', 30),
	(8, 'App\\Models\\User', 31),
	(8, 'App\\Models\\User', 32),
	(2, 'App\\Models\\User', 33),
	(2, 'App\\Models\\User', 34),
	(2, 'App\\Models\\User', 35),
	(2, 'App\\Models\\User', 36),
	(2, 'App\\Models\\User', 37),
	(2, 'App\\Models\\User', 38),
	(2, 'App\\Models\\User', 39),
	(2, 'App\\Models\\User', 40),
	(2, 'App\\Models\\User', 41),
	(2, 'App\\Models\\User', 42),
	(2, 'App\\Models\\User', 43),
	(2, 'App\\Models\\User', 44),
	(2, 'App\\Models\\User', 45),
	(2, 'App\\Models\\User', 46),
	(6, 'App\\Models\\User', 47);

-- membuang struktur untuk table school_rpl.opsi_jawabans
CREATE TABLE IF NOT EXISTS `opsi_jawabans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `soal_id` bigint unsigned NOT NULL,
  `opsi_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `urutan` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_benar` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `opsi_jawabans_soal_id_foreign` (`soal_id`),
  CONSTRAINT `opsi_jawabans_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.opsi_jawabans: ~8 rows (lebih kurang)
INSERT INTO `opsi_jawabans` (`id`, `soal_id`, `opsi_text`, `urutan`, `is_benar`, `created_at`, `updated_at`) VALUES
	(1, 1, 'r', 'A', 0, '2025-12-21 04:46:44', '2025-12-21 04:46:44'),
	(2, 1, 'dq', 'B', 1, '2025-12-21 04:46:44', '2025-12-21 04:46:44'),
	(3, 1, 't', 'C', 0, '2025-12-21 04:46:44', '2025-12-21 04:46:44'),
	(4, 1, '2', 'D', 0, '2025-12-21 04:46:44', '2025-12-21 04:46:44');

-- membuang struktur untuk table school_rpl.orangtuas
CREATE TABLE IF NOT EXISTS `orangtuas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `siswa_id` bigint unsigned DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orangtuas_user_id_foreign` (`user_id`),
  KEY `orangtuas_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `orangtuas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orangtuas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.orangtuas: ~1 rows (lebih kurang)
INSERT INTO `orangtuas` (`id`, `user_id`, `siswa_id`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `foto_profile`, `created_at`, `updated_at`) VALUES
	(1, 20, 3, NULL, NULL, NULL, NULL, NULL, '2025-12-21 04:03:40', '2025-12-21 04:03:40');

-- membuang struktur untuk table school_rpl.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.password_reset_tokens: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.pembinas
CREATE TABLE IF NOT EXISTS `pembinas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pembinas_user_id_foreign` (`user_id`),
  CONSTRAINT `pembinas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.pembinas: ~1 rows (lebih kurang)
INSERT INTO `pembinas` (`id`, `user_id`, `alamat`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `foto_profile`, `created_at`, `updated_at`) VALUES
	(1, 30, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:07:04', '2025-12-20 18:07:04'),
	(2, 31, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:07:37', '2025-12-20 18:07:37'),
	(3, 32, NULL, NULL, 'Laki-laki', NULL, NULL, '2025-12-20 18:07:54', '2025-12-20 18:07:54');

-- membuang struktur untuk table school_rpl.pembobotan_nilais
CREATE TABLE IF NOT EXISTS `pembobotan_nilais` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kelas_id` bigint unsigned NOT NULL,
  `mapel_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned NOT NULL,
  `bobot_tugas` int NOT NULL DEFAULT '0',
  `bobot_uts` int NOT NULL DEFAULT '0',
  `bobot_uas` int NOT NULL DEFAULT '0',
  `semester` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ganjil',
  `tahun_ajaran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2024/2025',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pembobotan` (`kelas_id`,`mapel_id`,`semester`,`tahun_ajaran`),
  KEY `pembobotan_nilais_mapel_id_foreign` (`mapel_id`),
  KEY `pembobotan_nilais_guru_id_foreign` (`guru_id`),
  CONSTRAINT `pembobotan_nilais_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembobotan_nilais_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pembobotan_nilais_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.pembobotan_nilais: ~1 rows (lebih kurang)
INSERT INTO `pembobotan_nilais` (`id`, `kelas_id`, `mapel_id`, `guru_id`, `bobot_tugas`, `bobot_uts`, `bobot_uas`, `semester`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 20, 30, 50, 'Ganjil', '2024/2025', '2025-12-21 01:58:35', '2025-12-21 01:58:35'),
	(3, 6, 1, 1, 20, 30, 50, 'Ganjil', '2025/2026', '2025-12-21 05:15:46', '2025-12-21 05:15:46');

-- membuang struktur untuk table school_rpl.perizinans
CREATE TABLE IF NOT EXISTS `perizinans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `tanggal_ajukan` date NOT NULL DEFAULT (curdate()),
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('izin','sakit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_surat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validasi` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `perizinans_user_id_foreign` (`user_id`),
  CONSTRAINT `perizinans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.perizinans: ~0 rows (lebih kurang)
INSERT INTO `perizinans` (`id`, `user_id`, `tanggal_ajukan`, `tanggal_mulai`, `tanggal_selesai`, `status`, `file_surat`, `validasi`, `created_at`, `updated_at`) VALUES
	(1, 43, '2025-12-21', '2025-12-21', '2026-01-25', 'izin', 'surat_izin/43_1766254878.pdf', 'disetujui', '2025-12-20 18:21:18', '2025-12-20 18:23:40'),
	(2, 15, '2025-12-21', '2025-12-21', '2025-12-24', 'izin', NULL, 'disetujui', '2025-12-21 02:27:52', '2025-12-21 02:28:04'),
	(3, 33, '2025-12-21', '2026-01-01', '2026-05-12', 'izin', NULL, 'disetujui', '2025-12-21 05:08:05', '2025-12-21 05:08:51');

-- membuang struktur untuk table school_rpl.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.permissions: ~56 rows (lebih kurang)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view users', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(2, 'view roles', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(3, 'view permissions', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(4, 'create users', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(5, 'show users', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(6, 'edit users', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(7, 'delete users', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(8, 'create roles', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(9, 'show roles', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(10, 'edit roles', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(11, 'delete roles', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(12, 'create permissions', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(13, 'show permissions', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(14, 'edit permissions', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(15, 'delete permissions', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(16, 'view total', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(17, 'view siswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(18, 'edit siswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(19, 'view guru', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(20, 'view jadwal', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(21, 'create jadwal', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(22, 'edit jadwal', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(23, 'edit presensisiswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(24, 'create presensisiswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(25, 'delete presensisiswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(26, 'view presensisiswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(27, 'show presensisiswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(28, 'create presensiguru', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(29, 'show presensiguru', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(30, 'view presensiguru', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(31, 'delete presensiguru', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(32, 'create walikelas', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(33, 'delete walikelas', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(34, 'edit walikelas', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(35, 'view walikelas', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(36, 'view perizinan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(37, 'edit perizinan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(38, 'delete perizinan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(39, 'create perizinan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(40, 'view all perizinan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(41, 'view siswa perizinan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(42, 'view own perizinan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(43, 'view all jadwal', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(44, 'view guru jadwal', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(45, 'view kelas jadwal', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(46, 'view all presensisiswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(47, 'view kelas presensisiswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(48, 'view guru presensisiswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(49, 'view presensi siswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(50, 'delete siswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(51, 'create prestasi', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(52, 'validasi izin', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(53, 'view materi', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(54, 'view extra', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(55, 'view aturankelulusan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(56, 'view prestasi', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(57, 'create kelulusan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(58, 'view statistik', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(59, 'view catatan_perkembangan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(60, 'create catatan_perkembangan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(61, 'edit catatan_perkembangan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(62, 'delete catatan_perkembangan', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(63, 'view tugas', 'web', '2025-12-20 18:29:23', '2025-12-20 18:29:55'),
	(64, 'view daskelulusan', 'web', '2025-12-21 02:18:37', '2025-12-21 02:18:37'),
	(65, 'create prizinan', 'web', '2025-12-21 02:26:49', '2025-12-21 02:26:49'),
	(66, 'pilihan extra', 'web', '2025-12-21 02:41:01', '2025-12-21 02:41:01'),
	(67, 'view peserta', 'web', '2025-12-21 02:56:51', '2025-12-21 02:56:51');

-- membuang struktur untuk table school_rpl.presensis
CREATE TABLE IF NOT EXISTS `presensis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `jadwal_id` bigint unsigned DEFAULT NULL,
  `perizinan_id` bigint unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','izin','sakit','alpa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hadir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `presensis_user_id_foreign` (`user_id`),
  KEY `presensis_jadwal_id_foreign` (`jadwal_id`),
  KEY `presensis_perizinan_id_foreign` (`perizinan_id`),
  CONSTRAINT `presensis_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwals` (`id`) ON DELETE SET NULL,
  CONSTRAINT `presensis_perizinan_id_foreign` FOREIGN KEY (`perizinan_id`) REFERENCES `perizinans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `presensis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.presensis: ~39 rows (lebih kurang)
INSERT INTO `presensis` (`id`, `user_id`, `jadwal_id`, `perizinan_id`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
	(1, 15, 2, NULL, '2025-12-23', 'hadir', '2025-12-20 18:23:26', '2025-12-20 18:23:26'),
	(2, 41, 2, NULL, '2025-12-23', 'hadir', '2025-12-20 18:23:26', '2025-12-20 18:23:26'),
	(3, 43, 2, 1, '2025-12-23', 'hadir', '2025-12-20 18:23:26', '2025-12-20 18:23:26'),
	(4, 45, 2, NULL, '2025-12-23', 'hadir', '2025-12-20 18:23:26', '2025-12-20 18:23:26'),
	(5, 43, NULL, NULL, '2025-12-21', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(6, 43, NULL, NULL, '2025-12-22', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(7, 43, NULL, NULL, '2025-12-24', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(8, 43, NULL, NULL, '2025-12-25', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(9, 43, NULL, NULL, '2025-12-26', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(10, 43, NULL, NULL, '2025-12-27', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(11, 43, NULL, NULL, '2025-12-28', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(12, 43, NULL, NULL, '2025-12-29', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(13, 43, NULL, NULL, '2025-12-30', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(14, 43, NULL, NULL, '2025-12-31', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(15, 43, NULL, NULL, '2026-01-01', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(16, 43, NULL, NULL, '2026-01-02', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(17, 43, NULL, NULL, '2026-01-03', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(18, 43, NULL, NULL, '2026-01-04', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(19, 43, NULL, NULL, '2026-01-05', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(20, 43, NULL, NULL, '2026-01-06', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(21, 43, NULL, NULL, '2026-01-07', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(22, 43, NULL, NULL, '2026-01-08', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(23, 43, NULL, NULL, '2026-01-09', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(24, 43, NULL, NULL, '2026-01-10', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(25, 43, NULL, NULL, '2026-01-11', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(26, 43, NULL, NULL, '2026-01-12', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(27, 43, NULL, NULL, '2026-01-13', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(28, 43, NULL, NULL, '2026-01-14', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(29, 43, NULL, NULL, '2026-01-15', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(30, 43, NULL, NULL, '2026-01-16', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(31, 43, NULL, NULL, '2026-01-17', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(32, 43, NULL, NULL, '2026-01-18', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(33, 43, NULL, NULL, '2026-01-19', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(34, 43, NULL, NULL, '2026-01-20', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(35, 43, NULL, NULL, '2026-01-21', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(36, 43, NULL, NULL, '2026-01-22', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(37, 43, NULL, NULL, '2026-01-23', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(38, 43, NULL, NULL, '2026-01-24', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(39, 43, NULL, NULL, '2026-01-25', 'izin', '2025-12-20 18:23:40', '2025-12-20 18:23:40'),
	(40, 15, 2, NULL, '2025-12-30', 'hadir', '2025-12-20 18:24:29', '2025-12-20 18:24:29'),
	(41, 41, 2, NULL, '2025-12-30', 'hadir', '2025-12-20 18:24:29', '2025-12-20 18:24:29'),
	(42, 43, 2, 1, '2025-12-30', 'izin', '2025-12-20 18:24:29', '2025-12-20 18:24:29'),
	(43, 45, 2, NULL, '2025-12-30', 'hadir', '2025-12-20 18:24:29', '2025-12-20 18:24:29'),
	(44, 15, NULL, NULL, '2025-12-21', 'izin', '2025-12-21 02:28:04', '2025-12-21 02:28:04'),
	(45, 15, NULL, NULL, '2025-12-22', 'izin', '2025-12-21 02:28:04', '2025-12-21 02:28:04'),
	(46, 15, NULL, NULL, '2025-12-24', 'izin', '2025-12-21 02:28:04', '2025-12-21 02:28:04'),
	(47, 15, 3, NULL, '2025-12-27', 'hadir', '2025-12-21 04:41:31', '2025-12-21 04:41:31'),
	(48, 4, 3, NULL, '2025-12-27', 'hadir', '2025-12-21 04:41:31', '2025-12-21 04:41:31'),
	(49, 5, 3, NULL, '2025-12-27', 'hadir', '2025-12-21 04:41:31', '2025-12-21 04:41:31'),
	(50, 33, 3, NULL, '2025-12-27', 'izin', '2025-12-21 04:41:31', '2025-12-21 04:41:31'),
	(51, 34, 3, NULL, '2025-12-27', 'hadir', '2025-12-21 04:41:31', '2025-12-21 04:41:31'),
	(52, 35, 3, NULL, '2025-12-27', 'hadir', '2025-12-21 04:41:31', '2025-12-21 04:41:31'),
	(53, 37, 3, NULL, '2025-12-27', 'hadir', '2025-12-21 04:41:31', '2025-12-21 04:41:31'),
	(54, 15, 3, NULL, '2026-01-03', 'hadir', '2025-12-21 04:42:24', '2025-12-21 04:42:24'),
	(55, 4, 3, NULL, '2026-01-03', 'hadir', '2025-12-21 04:42:24', '2025-12-21 04:42:24'),
	(56, 5, 3, NULL, '2026-01-03', 'hadir', '2025-12-21 04:42:24', '2025-12-21 04:42:24'),
	(57, 33, 3, NULL, '2026-01-03', 'izin', '2025-12-21 04:42:24', '2025-12-21 04:42:24'),
	(58, 34, 3, NULL, '2026-01-03', 'hadir', '2025-12-21 04:42:24', '2025-12-21 04:42:24'),
	(59, 35, 3, NULL, '2026-01-03', 'hadir', '2025-12-21 04:42:24', '2025-12-21 04:42:24'),
	(60, 37, 3, NULL, '2026-01-03', 'hadir', '2025-12-21 04:42:24', '2025-12-21 04:42:24'),
	(61, 15, 3, NULL, '2026-01-10', 'hadir', '2025-12-21 05:05:51', '2025-12-21 05:05:51'),
	(62, 4, 3, NULL, '2026-01-10', 'hadir', '2025-12-21 05:05:51', '2025-12-21 05:05:51'),
	(63, 5, 3, NULL, '2026-01-10', 'hadir', '2025-12-21 05:05:51', '2025-12-21 05:05:51'),
	(64, 33, 3, NULL, '2026-01-10', 'izin', '2025-12-21 05:05:51', '2025-12-21 05:05:51'),
	(65, 34, 3, NULL, '2026-01-10', 'hadir', '2025-12-21 05:05:51', '2025-12-21 05:05:51'),
	(66, 35, 3, NULL, '2026-01-10', 'hadir', '2025-12-21 05:05:51', '2025-12-21 05:05:51'),
	(67, 37, 3, NULL, '2026-01-10', 'hadir', '2025-12-21 05:05:51', '2025-12-21 05:05:51'),
	(68, 33, NULL, NULL, '2026-01-01', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(69, 33, NULL, NULL, '2026-01-02', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(70, 33, NULL, NULL, '2026-01-04', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(71, 33, NULL, NULL, '2026-01-05', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(72, 33, NULL, NULL, '2026-01-06', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(73, 33, NULL, NULL, '2026-01-07', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(74, 33, NULL, NULL, '2026-01-08', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(75, 33, NULL, NULL, '2026-01-09', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(76, 33, NULL, NULL, '2026-01-11', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(77, 33, NULL, NULL, '2026-01-12', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(78, 33, NULL, NULL, '2026-01-13', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(79, 33, NULL, NULL, '2026-01-14', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(80, 33, NULL, NULL, '2026-01-15', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(81, 33, NULL, NULL, '2026-01-16', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(82, 33, NULL, NULL, '2026-01-17', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(83, 33, NULL, NULL, '2026-01-18', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(84, 33, NULL, NULL, '2026-01-19', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(85, 33, NULL, NULL, '2026-01-20', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(86, 33, NULL, NULL, '2026-01-21', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(87, 33, NULL, NULL, '2026-01-22', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(88, 33, NULL, NULL, '2026-01-23', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(89, 33, NULL, NULL, '2026-01-24', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(90, 33, NULL, NULL, '2026-01-25', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(91, 33, NULL, NULL, '2026-01-26', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(92, 33, NULL, NULL, '2026-01-27', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(93, 33, NULL, NULL, '2026-01-28', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(94, 33, NULL, NULL, '2026-01-29', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(95, 33, NULL, NULL, '2026-01-30', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(96, 33, NULL, NULL, '2026-01-31', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(97, 33, NULL, NULL, '2026-02-01', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(98, 33, NULL, NULL, '2026-02-02', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(99, 33, NULL, NULL, '2026-02-03', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(100, 33, NULL, NULL, '2026-02-04', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(101, 33, NULL, NULL, '2026-02-05', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(102, 33, NULL, NULL, '2026-02-06', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(103, 33, NULL, NULL, '2026-02-07', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(104, 33, NULL, NULL, '2026-02-08', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(105, 33, NULL, NULL, '2026-02-09', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(106, 33, NULL, NULL, '2026-02-10', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(107, 33, NULL, NULL, '2026-02-11', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(108, 33, NULL, NULL, '2026-02-12', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(109, 33, NULL, NULL, '2026-02-13', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(110, 33, NULL, NULL, '2026-02-14', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(111, 33, NULL, NULL, '2026-02-15', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(112, 33, NULL, NULL, '2026-02-16', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(113, 33, NULL, NULL, '2026-02-17', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(114, 33, NULL, NULL, '2026-02-18', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(115, 33, NULL, NULL, '2026-02-19', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(116, 33, NULL, NULL, '2026-02-20', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(117, 33, NULL, NULL, '2026-02-21', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(118, 33, NULL, NULL, '2026-02-22', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(119, 33, NULL, NULL, '2026-02-23', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(120, 33, NULL, NULL, '2026-02-24', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(121, 33, NULL, NULL, '2026-02-25', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(122, 33, NULL, NULL, '2026-02-26', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(123, 33, NULL, NULL, '2026-02-27', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(124, 33, NULL, NULL, '2026-02-28', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(125, 33, NULL, NULL, '2026-03-01', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(126, 33, NULL, NULL, '2026-03-02', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(127, 33, NULL, NULL, '2026-03-03', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(128, 33, NULL, NULL, '2026-03-04', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(129, 33, NULL, NULL, '2026-03-05', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(130, 33, NULL, NULL, '2026-03-06', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(131, 33, NULL, NULL, '2026-03-07', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(132, 33, NULL, NULL, '2026-03-08', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(133, 33, NULL, NULL, '2026-03-09', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(134, 33, NULL, NULL, '2026-03-10', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(135, 33, NULL, NULL, '2026-03-11', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(136, 33, NULL, NULL, '2026-03-12', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(137, 33, NULL, NULL, '2026-03-13', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(138, 33, NULL, NULL, '2026-03-14', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(139, 33, NULL, NULL, '2026-03-15', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(140, 33, NULL, NULL, '2026-03-16', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(141, 33, NULL, NULL, '2026-03-17', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(142, 33, NULL, NULL, '2026-03-18', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(143, 33, NULL, NULL, '2026-03-19', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(144, 33, NULL, NULL, '2026-03-20', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(145, 33, NULL, NULL, '2026-03-21', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(146, 33, NULL, NULL, '2026-03-22', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(147, 33, NULL, NULL, '2026-03-23', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(148, 33, NULL, NULL, '2026-03-24', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(149, 33, NULL, NULL, '2026-03-25', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(150, 33, NULL, NULL, '2026-03-26', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(151, 33, NULL, NULL, '2026-03-27', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(152, 33, NULL, NULL, '2026-03-28', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(153, 33, NULL, NULL, '2026-03-29', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(154, 33, NULL, NULL, '2026-03-30', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(155, 33, NULL, NULL, '2026-03-31', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(156, 33, NULL, NULL, '2026-04-01', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(157, 33, NULL, NULL, '2026-04-02', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(158, 33, NULL, NULL, '2026-04-03', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(159, 33, NULL, NULL, '2026-04-04', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(160, 33, NULL, NULL, '2026-04-05', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(161, 33, NULL, NULL, '2026-04-06', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(162, 33, NULL, NULL, '2026-04-07', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(163, 33, NULL, NULL, '2026-04-08', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(164, 33, NULL, NULL, '2026-04-09', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(165, 33, NULL, NULL, '2026-04-10', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(166, 33, NULL, NULL, '2026-04-11', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(167, 33, NULL, NULL, '2026-04-12', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(168, 33, NULL, NULL, '2026-04-13', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(169, 33, NULL, NULL, '2026-04-14', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(170, 33, NULL, NULL, '2026-04-15', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(171, 33, NULL, NULL, '2026-04-16', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(172, 33, NULL, NULL, '2026-04-17', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(173, 33, NULL, NULL, '2026-04-18', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(174, 33, NULL, NULL, '2026-04-19', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(175, 33, NULL, NULL, '2026-04-20', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(176, 33, NULL, NULL, '2026-04-21', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(177, 33, NULL, NULL, '2026-04-22', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(178, 33, NULL, NULL, '2026-04-23', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(179, 33, NULL, NULL, '2026-04-24', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(180, 33, NULL, NULL, '2026-04-25', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(181, 33, NULL, NULL, '2026-04-26', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(182, 33, NULL, NULL, '2026-04-27', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(183, 33, NULL, NULL, '2026-04-28', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(184, 33, NULL, NULL, '2026-04-29', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(185, 33, NULL, NULL, '2026-04-30', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(186, 33, NULL, NULL, '2026-05-01', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(187, 33, NULL, NULL, '2026-05-02', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(188, 33, NULL, NULL, '2026-05-03', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(189, 33, NULL, NULL, '2026-05-04', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(190, 33, NULL, NULL, '2026-05-05', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(191, 33, NULL, NULL, '2026-05-06', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(192, 33, NULL, NULL, '2026-05-07', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(193, 33, NULL, NULL, '2026-05-08', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(194, 33, NULL, NULL, '2026-05-09', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(195, 33, NULL, NULL, '2026-05-10', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(196, 33, NULL, NULL, '2026-05-11', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(197, 33, NULL, NULL, '2026-05-12', 'izin', '2025-12-21 05:08:51', '2025-12-21 05:08:51'),
	(198, 15, 3, NULL, '2026-01-17', 'hadir', '2025-12-21 05:09:07', '2025-12-21 05:09:07'),
	(199, 4, 3, NULL, '2026-01-17', 'hadir', '2025-12-21 05:09:07', '2025-12-21 05:09:07'),
	(200, 5, 3, NULL, '2026-01-17', 'hadir', '2025-12-21 05:09:07', '2025-12-21 05:09:07'),
	(201, 33, 3, 3, '2026-01-17', 'izin', '2025-12-21 05:09:07', '2025-12-21 05:09:07'),
	(202, 34, 3, NULL, '2026-01-17', 'hadir', '2025-12-21 05:09:07', '2025-12-21 05:09:07'),
	(203, 35, 3, NULL, '2026-01-17', 'hadir', '2025-12-21 05:09:07', '2025-12-21 05:09:07'),
	(204, 37, 3, NULL, '2026-01-17', 'hadir', '2025-12-21 05:09:07', '2025-12-21 05:09:07'),
	(205, 15, 3, NULL, '2026-01-24', 'hadir', '2025-12-21 05:09:16', '2025-12-21 05:09:16'),
	(206, 4, 3, NULL, '2026-01-24', 'hadir', '2025-12-21 05:09:16', '2025-12-21 05:09:16'),
	(207, 5, 3, NULL, '2026-01-24', 'hadir', '2025-12-21 05:09:16', '2025-12-21 05:09:16'),
	(208, 33, 3, 3, '2026-01-24', 'izin', '2025-12-21 05:09:16', '2025-12-21 05:09:16'),
	(209, 34, 3, NULL, '2026-01-24', 'hadir', '2025-12-21 05:09:16', '2025-12-21 05:09:16'),
	(210, 35, 3, NULL, '2026-01-24', 'hadir', '2025-12-21 05:09:16', '2025-12-21 05:09:16'),
	(211, 37, 3, NULL, '2026-01-24', 'hadir', '2025-12-21 05:09:16', '2025-12-21 05:09:16'),
	(212, 15, 3, NULL, '2026-01-31', 'hadir', '2025-12-21 05:09:24', '2025-12-21 05:09:24'),
	(213, 4, 3, NULL, '2026-01-31', 'hadir', '2025-12-21 05:09:24', '2025-12-21 05:09:24'),
	(214, 5, 3, NULL, '2026-01-31', 'hadir', '2025-12-21 05:09:24', '2025-12-21 05:09:24'),
	(215, 33, 3, 3, '2026-01-31', 'izin', '2025-12-21 05:09:24', '2025-12-21 05:09:24'),
	(216, 34, 3, NULL, '2026-01-31', 'hadir', '2025-12-21 05:09:24', '2025-12-21 05:09:24'),
	(217, 35, 3, NULL, '2026-01-31', 'hadir', '2025-12-21 05:09:24', '2025-12-21 05:09:24'),
	(218, 37, 3, NULL, '2026-01-31', 'hadir', '2025-12-21 05:09:24', '2025-12-21 05:09:24');

-- membuang struktur untuk table school_rpl.presensi_ekstras
CREATE TABLE IF NOT EXISTS `presensi_ekstras` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `extra_peserta_id` bigint unsigned NOT NULL,
  `perizinan_id` bigint unsigned DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status` enum('hadir','izin','sakit','alpa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hadir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `presensi_ekstras_extra_peserta_id_foreign` (`extra_peserta_id`),
  KEY `presensi_ekstras_perizinan_id_foreign` (`perizinan_id`),
  CONSTRAINT `presensi_ekstras_extra_peserta_id_foreign` FOREIGN KEY (`extra_peserta_id`) REFERENCES `extra_pesertas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `presensi_ekstras_perizinan_id_foreign` FOREIGN KEY (`perizinan_id`) REFERENCES `perizinans` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.presensi_ekstras: ~0 rows (lebih kurang)
INSERT INTO `presensi_ekstras` (`id`, `extra_peserta_id`, `perizinan_id`, `tanggal`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, NULL, '2025-12-22', 'hadir', '2025-12-21 03:02:55', '2025-12-21 03:02:55'),
	(2, 1, NULL, '2025-12-21', 'hadir', '2025-12-21 03:04:18', '2025-12-21 03:04:18'),
	(3, 1, NULL, '2025-12-29', 'hadir', '2025-12-21 03:06:55', '2025-12-21 03:06:55');

-- membuang struktur untuk table school_rpl.prestasis
CREATE TABLE IF NOT EXISTS `prestasis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `nama_prestasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('akademik','non-akademik') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tingkat` enum('sekolah','kecamatan','kabupaten','provinsi','nasional','internasional') COLLATE utf8mb4_unicode_ci NOT NULL,
  `peringkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date NOT NULL,
  `file_bukti` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prestasis_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `prestasis_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.prestasis: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.rekap_nilai_akhirs
CREATE TABLE IF NOT EXISTS `rekap_nilai_akhirs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pembobotan_nilai_id` bigint unsigned DEFAULT NULL,
  `siswa_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `mapel_id` bigint unsigned NOT NULL,
  `rata_rata_tugas` decimal(5,2) DEFAULT '0.00',
  `nilai_uts` decimal(5,2) DEFAULT '0.00',
  `nilai_uas` decimal(5,2) DEFAULT '0.00',
  `nilai_akhir` decimal(5,2) DEFAULT '0.00',
  `semester` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Ganjil',
  `tahun_ajaran` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2024/2025',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_rekap` (`siswa_id`,`mapel_id`,`semester`,`tahun_ajaran`),
  KEY `rekap_nilai_akhirs_kelas_id_foreign` (`kelas_id`),
  KEY `rekap_nilai_akhirs_mapel_id_foreign` (`mapel_id`),
  KEY `rekap_nilai_akhirs_pembobotan_nilai_id_foreign` (`pembobotan_nilai_id`),
  CONSTRAINT `rekap_nilai_akhirs_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rekap_nilai_akhirs_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rekap_nilai_akhirs_pembobotan_nilai_id_foreign` FOREIGN KEY (`pembobotan_nilai_id`) REFERENCES `pembobotan_nilais` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rekap_nilai_akhirs_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.rekap_nilai_akhirs: ~4 rows (lebih kurang)
INSERT INTO `rekap_nilai_akhirs` (`id`, `pembobotan_nilai_id`, `siswa_id`, `kelas_id`, `mapel_id`, `rata_rata_tugas`, `nilai_uts`, `nilai_uas`, `nilai_akhir`, `semester`, `tahun_ajaran`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 1, 0.00, 0.00, 0.00, 0.00, 'Ganjil', '2024/2025', '2025-12-21 01:58:38', '2025-12-21 04:49:50'),
	(2, 1, 19, 1, 1, 0.00, 0.00, 0.00, 0.00, 'Ganjil', '2024/2025', '2025-12-21 01:58:38', '2025-12-21 04:49:50'),
	(9, 3, 4, 6, 1, 0.00, 0.00, 0.00, 0.00, 'Ganjil', '2025/2026', '2025-12-21 05:15:57', '2025-12-21 05:15:57'),
	(10, 3, 5, 6, 1, 0.00, 0.00, 0.00, 0.00, 'Ganjil', '2025/2026', '2025-12-21 05:15:57', '2025-12-21 05:15:57'),
	(11, 3, 6, 6, 1, 100.00, 0.00, 0.00, 20.00, 'Ganjil', '2025/2026', '2025-12-21 05:15:57', '2025-12-21 05:15:57'),
	(12, 3, 7, 6, 1, 0.00, 0.00, 0.00, 0.00, 'Ganjil', '2025/2026', '2025-12-21 05:15:57', '2025-12-21 05:15:57'),
	(13, 3, 8, 6, 1, 0.00, 0.00, 0.00, 0.00, 'Ganjil', '2025/2026', '2025-12-21 05:15:57', '2025-12-21 05:15:57'),
	(14, 3, 10, 6, 1, 0.00, 0.00, 0.00, 0.00, 'Ganjil', '2025/2026', '2025-12-21 05:15:57', '2025-12-21 05:15:57');

-- membuang struktur untuk table school_rpl.rekomendasi_jurusans
CREATE TABLE IF NOT EXISTS `rekomendasi_jurusans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` bigint unsigned NOT NULL,
  `jurusan_id` bigint unsigned DEFAULT NULL,
  `validasi` enum('pending','disetujui','ditolak') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan_wali_kelas` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rekomendasi_jurusans_siswa_id_foreign` (`siswa_id`),
  KEY `rekomendasi_jurusans_jurusan_id_foreign` (`jurusan_id`),
  CONSTRAINT `rekomendasi_jurusans_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusans` (`id`) ON DELETE SET NULL,
  CONSTRAINT `rekomendasi_jurusans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.rekomendasi_jurusans: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.roles: ~8 rows (lebih kurang)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'superadmin', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(2, 'siswa', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(3, 'guru', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(4, 'tus', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(5, 'orangtua', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(6, 'kepsek', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(7, 'walikelas', 'web', '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(8, 'pembina', 'web', '2025-12-20 18:06:40', '2025-12-20 18:06:40');

-- membuang struktur untuk table school_rpl.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.role_has_permissions: ~108 rows (lebih kurang)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(20, 2),
	(26, 2),
	(27, 2),
	(35, 2),
	(36, 2),
	(39, 2),
	(42, 2),
	(54, 2),
	(56, 2),
	(59, 2),
	(63, 2),
	(65, 2),
	(66, 2),
	(20, 3),
	(23, 3),
	(24, 3),
	(26, 3),
	(27, 3),
	(36, 3),
	(39, 3),
	(41, 3),
	(44, 3),
	(49, 3),
	(53, 3),
	(63, 3),
	(65, 3),
	(5, 4),
	(6, 4),
	(7, 4),
	(9, 4),
	(10, 4),
	(11, 4),
	(12, 4),
	(13, 4),
	(14, 4),
	(15, 4),
	(16, 4),
	(17, 4),
	(18, 4),
	(19, 4),
	(20, 4),
	(21, 4),
	(22, 4),
	(23, 4),
	(24, 4),
	(25, 4),
	(26, 4),
	(27, 4),
	(28, 4),
	(29, 4),
	(30, 4),
	(31, 4),
	(32, 4),
	(33, 4),
	(34, 4),
	(35, 4),
	(36, 4),
	(37, 4),
	(38, 4),
	(39, 4),
	(40, 4),
	(41, 4),
	(42, 4),
	(43, 4),
	(44, 4),
	(45, 4),
	(46, 4),
	(47, 4),
	(48, 4),
	(49, 4),
	(50, 4),
	(51, 4),
	(52, 4),
	(53, 4),
	(54, 4),
	(55, 4),
	(56, 4),
	(57, 4),
	(58, 4),
	(59, 4),
	(60, 4),
	(61, 4),
	(62, 4),
	(63, 4),
	(67, 4),
	(20, 5),
	(26, 5),
	(27, 5),
	(54, 5),
	(56, 5),
	(59, 5),
	(16, 6),
	(17, 6),
	(19, 6),
	(35, 6),
	(36, 6),
	(40, 6),
	(43, 6),
	(46, 6),
	(52, 6),
	(56, 6),
	(58, 6),
	(64, 6),
	(17, 7),
	(18, 7),
	(35, 7),
	(36, 7),
	(41, 7),
	(45, 7),
	(47, 7),
	(51, 7),
	(52, 7),
	(56, 7),
	(58, 7),
	(59, 7),
	(60, 7),
	(61, 7),
	(62, 7),
	(24, 8),
	(54, 8),
	(67, 8);

-- membuang struktur untuk table school_rpl.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.sessions: ~4 rows (lebih kurang)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('6utcQOdrnshqhNjIm5TGBywCDiJddb2TTA0JdlQX', 32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSUZ2STA1TmdjWVo5cXdvVFByTlJ0VzhWSTIyeTltZ0EzdVlzeTRKayI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzI7czoxMToiYWN0aXZlX3JvbGUiO3M6NzoicGVtYmluYSI7fQ==', 1766294677),
	('DtvcFjNoRk9O6aaZzYfoBuqno4t6bUPK9Iol5yKb', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibENPcW83NHB5c04xUTlqRTNneTRNWk9GdTJkR3pWR0prT2JQS1pNUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9rZWx1bHVzYW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTE6ImFjdGl2ZV9yb2xlIjtzOjEwOiJzdXBlcmFkbWluIjt9', 1766294920),
	('kU16cvhFelzRaFpQB07CjTcOmSZPYcETMkhUZiDQ', 15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR3RNY1l3clVVNjdsbVlkd21mUWNLb05xaVByY2dVamlYUjcxUnllSiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWthcC1uaWxhaS8zL3Nob3ciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxNTtzOjExOiJhY3RpdmVfcm9sZSI7czo0OiJndXJ1Ijt9', 1766294157),
	('NPuslS8bbVdqTwRw547x4ZiamODHo42FtaXhf1tg', 33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU1E0VVdGcERaQkdYNlJqMGxsNzUzaUZzZmNka1JMQmJQcFZmbUZMYiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yYXBvci1zYXlhIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzM7czoxMToiYWN0aXZlX3JvbGUiO3M6NToic2lzd2EiO30=', 1766294222),
	('UJf0gNXo5hyEMX1Ljjzgk3CwPzLDdQLiDvQL3BY6', 14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiQVltYjFQRGF6Tkl5VEl6QUdYY0RpbUl2ZndyODFLSHlWeTkxb1NabCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yYXBvciI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O3M6MTY6Im5lZWRfY2hvb3NlX3JvbGUiO2I6MDtzOjExOiJhY3RpdmVfcm9sZSI7czo5OiJ3YWxpa2VsYXMiO30=', 1766294190);

-- membuang struktur untuk table school_rpl.siswas
CREATE TABLE IF NOT EXISTS `siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `tanggal_lahir` date DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `siswas_user_id_foreign` (`user_id`),
  KEY `siswas_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE SET NULL,
  CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.siswas: ~6 rows (lebih kurang)
INSERT INTO `siswas` (`id`, `user_id`, `kelas_id`, `jenis_kelamin`, `alamat`, `tanggal_lahir`, `agama`, `foto_profile`, `created_at`, `updated_at`) VALUES
	(1, 10, 1, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:08:13', '2025-12-20 18:08:13'),
	(2, 11, 2, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:08:19', '2025-12-20 18:08:19'),
	(3, 12, 3, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:08:28', '2025-12-20 18:08:28'),
	(4, 4, 6, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:08:34', '2025-12-20 18:08:34'),
	(5, 5, 6, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:08:43', '2025-12-20 18:08:48'),
	(6, 33, 6, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(7, 34, 6, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(8, 35, 6, 'Perempuan', NULL, NULL, NULL, NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(9, 36, 7, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(10, 37, 6, 'Perempuan', NULL, NULL, NULL, NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(11, 38, 7, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(12, 39, 2, 'Perempuan', NULL, NULL, NULL, NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(13, 40, 3, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(14, 41, 4, 'Perempuan', NULL, NULL, NULL, NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(15, 42, 5, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(16, 43, 4, 'Perempuan', NULL, NULL, NULL, NULL, '2025-12-20 18:13:32', '2025-12-20 18:13:32'),
	(17, 44, 5, 'Laki-laki', NULL, NULL, NULL, NULL, '2025-12-20 18:13:32', '2025-12-20 18:13:32'),
	(18, 45, 4, 'Perempuan', NULL, NULL, NULL, NULL, '2025-12-20 18:13:32', '2025-12-20 18:13:32'),
	(19, 46, 1, 'Perempuan', NULL, NULL, NULL, NULL, '2025-12-20 18:13:32', '2025-12-20 18:13:32');

-- membuang struktur untuk table school_rpl.soals
CREATE TABLE IF NOT EXISTS `soals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jenis_ujian_id` bigint unsigned NOT NULL,
  `soal_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_soal` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `soals_jenis_ujian_id_foreign` (`jenis_ujian_id`),
  CONSTRAINT `soals_jenis_ujian_id_foreign` FOREIGN KEY (`jenis_ujian_id`) REFERENCES `jenis_ujians` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.soals: ~4 rows (lebih kurang)
INSERT INTO `soals` (`id`, `jenis_ujian_id`, `soal_text`, `tipe_soal`, `created_at`, `updated_at`) VALUES
	(1, 1, 'gbjjk', 'pg', '2025-12-21 04:46:44', '2025-12-21 04:46:44');

-- membuang struktur untuk table school_rpl.superadmins
CREATE TABLE IF NOT EXISTS `superadmins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `superadmins_user_id_foreign` (`user_id`),
  CONSTRAINT `superadmins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.superadmins: ~1 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.tugas
CREATE TABLE IF NOT EXISTS `tugas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `mapel_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `judul_tugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `file_tugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tugas_mapel_id_foreign` (`mapel_id`),
  KEY `tugas_guru_id_foreign` (`guru_id`),
  KEY `tugas_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `tugas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tugas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tugas_mapel_id_foreign` FOREIGN KEY (`mapel_id`) REFERENCES `mapels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.tugas: ~1 rows (lebih kurang)
INSERT INTO `tugas` (`id`, `mapel_id`, `guru_id`, `kelas_id`, `judul_tugas`, `deskripsi`, `file_tugas`, `deadline`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 1, 'g fd g', 'fcgdsrgv', NULL, '2025-12-23 01:30:00', '2025-12-20 18:30:20', '2025-12-20 18:30:20'),
	(2, 1, 1, 6, 'cgv', 'hjh', NULL, '2025-12-21 15:44:00', '2025-12-21 04:44:52', '2025-12-21 04:44:52');

-- membuang struktur untuk table school_rpl.tugaspengumpulans
CREATE TABLE IF NOT EXISTS `tugaspengumpulans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tugas_id` bigint unsigned NOT NULL,
  `siswa_id` bigint unsigned NOT NULL,
  `file_pengumpulan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `nilai` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tugaspengumpulans_tugas_id_foreign` (`tugas_id`),
  KEY `tugaspengumpulans_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `tugaspengumpulans_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tugaspengumpulans_tugas_id_foreign` FOREIGN KEY (`tugas_id`) REFERENCES `tugas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.tugaspengumpulans: ~1 rows (lebih kurang)
INSERT INTO `tugaspengumpulans` (`id`, `tugas_id`, `siswa_id`, `file_pengumpulan`, `catatan`, `nilai`, `created_at`, `updated_at`) VALUES
	(1, 2, 6, 'pengumpulan/vXwGyzB9W36IbocP9FDYsuLGunXr1RxpVyRjEOmr.pdf', NULL, 100, '2025-12-21 04:45:24', '2025-12-21 04:46:07');

-- membuang struktur untuk table school_rpl.tus
CREATE TABLE IF NOT EXISTS `tus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tus_user_id_foreign` (`user_id`),
  CONSTRAINT `tus_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.tus: ~0 rows (lebih kurang)

-- membuang struktur untuk table school_rpl.ujians
CREATE TABLE IF NOT EXISTS `ujians` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kelas_id` bigint unsigned NOT NULL,
  `guru_id` bigint unsigned DEFAULT NULL,
  `jenis_ujian` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_paket` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'random',
  `jumlah_paket` int NOT NULL DEFAULT '1',
  `jumlah_soal` int NOT NULL,
  `durasi_menit` int NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ujians_kelas_id_foreign` (`kelas_id`),
  KEY `ujians_guru_id_foreign` (`guru_id`),
  CONSTRAINT `ujians_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ujians_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.ujians: ~1 rows (lebih kurang)
INSERT INTO `ujians` (`id`, `kelas_id`, `guru_id`, `jenis_ujian`, `tipe_paket`, `jumlah_paket`, `jumlah_soal`, `durasi_menit`, `tanggal_mulai`, `tanggal_selesai`, `status`, `created_at`, `updated_at`) VALUES
	(1, 6, 1, 'UTS', 'random', 2, 21, 2, '2025-12-21 11:47:00', '2026-01-10 11:48:00', 'aktif', '2025-12-21 04:48:07', '2025-12-21 04:48:07');

-- membuang struktur untuk table school_rpl.ujian_siswas
CREATE TABLE IF NOT EXISTS `ujian_siswas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ujian_id` bigint unsigned NOT NULL,
  `siswa_id` bigint unsigned NOT NULL,
  `paket` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Paket soal: A, B, C, dst',
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_mulai',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ujian_siswas_ujian_id_foreign` (`ujian_id`),
  KEY `ujian_siswas_siswa_id_foreign` (`siswa_id`),
  CONSTRAINT `ujian_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ujian_siswas_ujian_id_foreign` FOREIGN KEY (`ujian_id`) REFERENCES `ujians` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.ujian_siswas: ~0 rows (lebih kurang)
INSERT INTO `ujian_siswas` (`id`, `ujian_id`, `siswa_id`, `paket`, `waktu_mulai`, `waktu_selesai`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 6, 'A', '2025-12-21 11:48:52', '2025-12-21 11:49:13', 'selesai', '2025-12-21 04:48:52', '2025-12-21 04:49:13');

-- membuang struktur untuk table school_rpl.ujian_soals
CREATE TABLE IF NOT EXISTS `ujian_soals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ujian_id` bigint unsigned NOT NULL,
  `soal_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ujian_soals_ujian_id_foreign` (`ujian_id`),
  KEY `ujian_soals_soal_id_foreign` (`soal_id`),
  CONSTRAINT `ujian_soals_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`),
  CONSTRAINT `ujian_soals_ujian_id_foreign` FOREIGN KEY (`ujian_id`) REFERENCES `ujians` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.ujian_soals: ~0 rows (lebih kurang)
INSERT INTO `ujian_soals` (`id`, `ujian_id`, `soal_id`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2025-12-21 04:48:21', '2025-12-21 04:48:21');

-- membuang struktur untuk table school_rpl.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.users: ~24 rows (lebih kurang)
INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'fufufalah', 'falah', 'falahsi@gmail.com', NULL, '$2y$12$Y2oDxk8yufzJOwoH44.zSuXKWpmtvJCIEF9YQLEvNYDOwZxslG12C', NULL, '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(2, 'fufuah', '230609016', 'hama@gmail.com', NULL, '$2y$12$y1eTLiKQ5AFzfh4v9QadpuzUrlLKRzsRloeEwjPfFJeIrf/y.IhqW', NULL, '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(3, 'roni', '230609017', 'roni@gmail.com', NULL, '$2y$12$8itH89mKGRamZyg6/GvDaeL9AhKtSwTV8VwAPdWCO9RExVwO/EA4O', NULL, '2025-12-20 17:50:41', '2025-12-20 17:50:41'),
	(4, 'falah', '121211', 'falah@gmail.com', NULL, '$2y$12$NjA5YjERDb0WGt7dHpNcheoMc6wXqv70ugLtR0cZMoxvBcRVA/kMi', NULL, '2025-12-20 17:50:42', '2025-12-20 17:50:42'),
	(5, 'daffa', '230609018', 'daffa@gmail.com', NULL, '$2y$12$xIe.WhdQW.3FONIu5fGAluufQp749uVwb31z7DI9zyLA7VkdJVlpu', NULL, '2025-12-20 17:50:42', '2025-12-20 17:50:42'),
	(6, 'ilham', '230609019', 'ilham@gmail.com', NULL, '$2y$12$nEb8m1WpB9xxplho90D/tOZzbjfaJwYDcMa034JWxhVVlzK5Yl2M.', NULL, '2025-12-20 17:50:42', '2025-12-20 17:50:42'),
	(7, 'ayu', '230609020', 'ayu@gmail.com', NULL, '$2y$12$r28jB43omHnsK22Mc3jAvuTUgJPejNpTvWjumUqGYnyatU/uU2fQi', NULL, '2025-12-20 17:50:42', '2025-12-20 17:50:42'),
	(8, 'vivi', '230609021', 'vivi@gmail.com', NULL, '$2y$12$08tlKTkEeurVVpjX4JMEDOQe7Uep2J5KuJTjDkCErZUcLO72JWTqm', NULL, '2025-12-20 17:50:42', '2025-12-20 17:50:42'),
	(9, 'damas', '230609022', 'damas@gmail.com', NULL, '$2y$12$6cDk13TgicP9C/AP/nRnQeciTMy3sa.8NiNMwq7Rl35LcrmOUiLjO', NULL, '2025-12-20 17:50:42', '2025-12-20 17:50:42'),
	(10, 'rafi', '230609023', 'rafi@gmail.com', NULL, '$2y$12$lc0ArT0EGD1PI8AzjjNxau4vCght2cUv.3TKjD6nbEJcnSGDCtCOK', NULL, '2025-12-20 17:50:43', '2025-12-20 17:50:43'),
	(11, 'reza', '230609024', 'reza@gmail.com', NULL, '$2y$12$ZALuer8D4ENtlGJcRHXEoe5qy.6PLlD7.02Ky12T0/xFle27CjP0a', NULL, '2025-12-20 17:50:43', '2025-12-20 17:50:43'),
	(12, 'alamsi', '230609025', 'alamsi@gmail.com', NULL, '$2y$12$7HJASZ8AkAtxOF6mIL9DsOEsTvFUxqetptba.Xr.TonZbBZMGSV26', NULL, '2025-12-20 17:50:43', '2025-12-20 17:50:43'),
	(13, 'mahad', '240609001', 'mahasiswa@gmail.com', NULL, '$2y$12$O5NU0ToBdGm5/YW/yYU12eIcSVpuO/HU5TSD0V6aX8fvMXjrHkG3K', NULL, '2025-12-20 17:50:43', '2025-12-20 17:50:43'),
	(14, 'rifki', '240609002', 'rifki@gmail.com', NULL, '$2y$12$fFPO4LqymKctNFwwI/fSQuqfpmbA.JV8yGGBs0zARcKYQ3yt85A3K', NULL, '2025-12-20 17:50:43', '2025-12-20 17:50:43'),
	(15, 'cahyo', '240609003', 'cahyo@gmail.com', NULL, '$2y$12$XKHkt9Mea48v0YVxBRS79Oa1tD40AO4tbVz8XnW.9irE.loFHOx9S', NULL, '2025-12-20 17:50:44', '2025-12-20 17:50:44'),
	(16, 'yono', '240609004', 'yono@gmail.com', NULL, '$2y$12$2xs0Q0Yn.y/Vb7QqiwoYz.h.EDCsrvY6xs4iqJ4PVnlpxpLuRdeW6', NULL, '2025-12-20 17:50:44', '2025-12-20 17:50:44'),
	(17, 'susi', '240609005', 'susi@gmail.com', NULL, '$2y$12$Uf79EZOdaKuRnON.PR0SMenTr4TWTL.Vxbt9eAseny7pkg3IVBl7a', NULL, '2025-12-20 17:50:44', '2025-12-20 17:50:44'),
	(18, 'dedi', '240609007', 'dedi@gmail.com', NULL, '$2y$12$yQWVbS1pJYSx.S0BuNcA0egwrecTe/wf1AdKBeFr7OJelYdFo.NMK', NULL, '2025-12-20 17:50:44', '2025-12-20 17:50:44'),
	(19, 'sulastris', '12111', 'sulastris@gmail.com', NULL, '$2y$12$sassOAyDMkQN1V7fh8n3xOsSBVAW5IUvcLuNf6AQ4FpDap5HLruoa', NULL, '2025-12-20 17:50:44', '2025-12-20 17:50:44'),
	(20, 'Budi Santoso', '081234567890', 'budiortu@gmail.com', NULL, '$2y$12$64QOs8Y9oQPV48.qyn6M..5liTmMgXF0kQ4fGJcIReF6o19FQQoaq', NULL, '2025-12-20 17:50:45', '2025-12-20 17:50:45'),
	(21, 'Siti Aminah', '082233445566', 'sitiortu@gmail.com', NULL, '$2y$12$czwHEgcu5VIG2J9XxCjK5O6BbzWO9hzUsa.u2l903Ua263SLKAJrW', NULL, '2025-12-20 17:50:45', '2025-12-20 17:50:45'),
	(22, 'Rudi Hartono', '083887766554', 'rudiortu@gmail.com', NULL, '$2y$12$ARyq5ayVUL.1v7SE9t9MMeRUutsD1LvSoFPSDBSQ4ifaBRCiEUPZ2', NULL, '2025-12-20 17:50:45', '2025-12-20 17:50:45'),
	(23, 'karso', '121212165', 'karso@gmail.com', NULL, '$2y$12$g0OxjObv302bTLQ99Q6ckuy9llCn9vHZtbFcqxPzLxPi/u.MDGyQG', NULL, '2025-12-20 18:01:08', '2025-12-20 18:01:08'),
	(24, 'fauzi', '45095804380', 'fauzi@gmail.com', NULL, '$2y$12$D7kZdiPXiVyCmCaeCBISKOrVWyNTtdb7VHov50WCi4N2qgcw6TZgm', NULL, '2025-12-20 18:01:46', '2025-12-20 18:01:46'),
	(25, 'wardi', '4890307498', 'wardi@gmail.com', NULL, '$2y$12$T.Gd6Vz6SiPpMBj3ya/UJe4/qIe0EjQ3Zs0D2C/4xLlktIZgBGLKq', NULL, '2025-12-20 18:02:22', '2025-12-20 18:02:22'),
	(26, 'montaya', '423253433', 'montaya@gmail.com', NULL, '$2y$12$2bjFWJAqUGtMXp.utM9QEuIQLkVJFNz6encckWs0tr9RNE8bam5FW', NULL, '2025-12-20 18:02:47', '2025-12-20 18:02:47'),
	(27, 'atrop', '86890906', 'atrop@gmail.com', NULL, '$2y$12$FnpMacB2afb4hlZJhDx.NeljvAmflqKk9g4kzv/kiKeHZgfLKRMPC', NULL, '2025-12-20 18:03:11', '2025-12-20 18:03:11'),
	(28, 'Karjas', '87890966', 'Karjas@gmail.com', NULL, '$2y$12$YG1R.K85SprTiQ166P6Steit8tP7lfzWNbOC7V3Djxrb7v3i1mWeO', NULL, '2025-12-20 18:03:43', '2025-12-20 18:03:43'),
	(29, 'andrew', '4389204', 'andrew@gmail.com', NULL, '$2y$12$b.pgj9gT9IAWFlrsc246F.aaxG3JBIdpZ53zgXAsFOAOv0Z2KhMYa', NULL, '2025-12-20 18:04:23', '2025-12-20 18:04:23'),
	(30, 'hama', '097675899', 'hamaa@gmail.com', NULL, '$2y$12$JX7FM.kmO3PcjKbdJftjauDsMehKPoxF0I3kJZUvTvam0kLhHipKS', NULL, '2025-12-20 18:07:04', '2025-12-20 18:07:04'),
	(31, 'naba', '099068905', 'naba@gmail.com', NULL, '$2y$12$XsxBCiNoe1xkOr3JgurAJuuLlunlgderS3kmv/yZHzHqHNnRLWU/K', NULL, '2025-12-20 18:07:37', '2025-12-20 18:07:37'),
	(32, 'anjis', '43289743230', 'anjis@gmail.com', NULL, '$2y$12$9sJ8kHRTVky8Q3AcItdKP.eDn6xnKMBOv/6Al5YNIOdkZf.MFLzzy', NULL, '2025-12-20 18:07:54', '2025-12-21 02:42:45'),
	(33, 'hamud habibi', '12111133553', 'kocak123@gmail.com', NULL, '$2y$12$CTC2lkVuIhjWyBVSDH7xfermRVC/xZa82nMhj/ec/iM5ewbADmEGS', NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(34, 'John Doe', '12345678', 'john@example.com', NULL, '$2y$12$wh0bFe/a4ynHT4z6MrU32uJ1k2DiIxfQMVsQkG9Qn74Hj6nmeSD2e', NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(35, 'Jane Smith', '23456789', 'jane@example.com', NULL, '$2y$12$jAAcCfqYB5xTW7B3yrYdz.Z5/z675swRRAtC3tYsBD9544XLllKBq', NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(36, 'Bob Johnson', '34567890', 'bob@example.com', NULL, '$2y$12$3wqOdwCelT5BXRRhCVVmc.ydhUQQW.Df9QCe8qpAmSHRljq50Kk9W', NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(37, 'Alice Brown', '45678901', 'alice@example.com', NULL, '$2y$12$K.ANQzmyud0IyTAQXBZnj.STzJ8eJXm14AWUSoLjbZb5VTNIdRjy.', NULL, '2025-12-20 18:13:30', '2025-12-20 18:13:30'),
	(38, 'Charlie White', '56789012', 'charlie@example.com', NULL, '$2y$12$EJ7pyUHHpywAaSn5rZlqfugiTIXRROdwJGwitYv8OiUJZ0wPtvQTy', NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(39, 'Student2', '12345679', 'student2@example.com', NULL, '$2y$12$IgCiGcNEFZfxJGTBcGvdbeHaPTibicJiy.MB60erldUuaf6SGbGT.', NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(40, 'Student3', '12345680', 'student3@example.com', NULL, '$2y$12$YzJ2S9LtTYzR.0qPWUS0oOVme38KvuKH3199dFyyyfHYxnZ/Fv3dO', NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(41, 'Student4', '12345681', 'student4@example.com', NULL, '$2y$12$bREZPCQVI9OD8boSBveE7OlMUGpZTGRt/0JpCUDwQihE9s.W8NN2u', NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(42, 'Student5', '12345682', 'student5@example.com', NULL, '$2y$12$I4k9I972TzwJRNXp8msDs.YWcPuywFelbcTQmHqpsr.wYPYv9DOHC', NULL, '2025-12-20 18:13:31', '2025-12-20 18:13:31'),
	(43, 'Student6', '12345683', 'student6@example.com', NULL, '$2y$12$yMDtr6DFWpMrsalUURziE.hWNjnSoYa/4xiFj18vm1RD2G8k/vqBe', NULL, '2025-12-20 18:13:32', '2025-12-20 18:13:32'),
	(44, 'Student7', '12345684', 'student7@example.com', NULL, '$2y$12$HFwC5p95IllTbIhBEv8.2ef98SFuWSqPJlccK5uAzOqYRiaoopkYC', NULL, '2025-12-20 18:13:32', '2025-12-20 18:13:32'),
	(45, 'Student8', '12345685', 'student8@example.com', NULL, '$2y$12$pWL.9cDRWEkduJMdHAHUI.URoOm1dbid9uM7J8hzrv6fOSbXbp8e6', NULL, '2025-12-20 18:13:32', '2025-12-20 18:13:32'),
	(46, 'Student10', '12345687', 'student10@example.com', NULL, '$2y$12$.sCpqlOU3MLiuzB3qSLVyOm08LIob.wKVThwb.a5Rjs4NYE4uJSca', NULL, '2025-12-20 18:13:32', '2025-12-20 18:13:32'),
	(47, 'awana', '2423492883', 'awan@gmail.com', NULL, '$2y$12$F21VkFYiMeFFBLsIkXD/u.NQECV0v55BIzbd4NQVowEdwspT4zJTO', NULL, '2025-12-21 02:21:17', '2025-12-21 02:21:27');

-- membuang struktur untuk table school_rpl.walikelas
CREATE TABLE IF NOT EXISTS `walikelas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `guru_id` bigint unsigned NOT NULL,
  `kelas_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `walikelas_guru_id_foreign` (`guru_id`),
  KEY `walikelas_kelas_id_foreign` (`kelas_id`),
  CONSTRAINT `walikelas_guru_id_foreign` FOREIGN KEY (`guru_id`) REFERENCES `gurus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `walikelas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Membuang data untuk tabel school_rpl.walikelas: ~1 rows (lebih kurang)
INSERT INTO `walikelas` (`id`, `guru_id`, `kelas_id`, `created_at`, `updated_at`) VALUES
	(2, 9, 5, '2025-12-20 18:14:39', '2025-12-20 18:14:39'),
	(3, 4, 4, '2025-12-20 18:22:56', '2025-12-20 18:22:56'),
	(4, 13, 6, '2025-12-21 02:05:46', '2025-12-21 02:05:46');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
