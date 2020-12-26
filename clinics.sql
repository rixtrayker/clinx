-- -------------------------------------------------------------
-- TablePlus 3.12.0(354)
--
-- https://tableplus.com/
--
-- Database: clinics
-- Generation Time: 2020-12-26 20:35:30.8400
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `admin_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `admin_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `admin_permission` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int unsigned NOT NULL,
  `admin_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_permission_permission_id_index` (`permission_id`),
  KEY `admin_permission_admin_id_index` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `admin_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `admin_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_role_role_id_index` (`role_id`),
  KEY `admin_role_admin_id_index` (`admin_id`),
  CONSTRAINT `admin_role_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  CONSTRAINT `admin_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `super_admin` tinyint(1) DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
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

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permission_role` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int unsigned NOT NULL,
  `role_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permission_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `inherit_id` int unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_inherit_id_index` (`inherit_id`),
  KEY `permissions_name_index` (`name`),
  KEY `permissions_slug_index` (`slug`),
  CONSTRAINT `permissions_inherit_id_foreign` FOREIGN KEY (`inherit_id`) REFERENCES `permissions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `role_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin_permission` (`id`, `permission_id`, `admin_id`, `created_at`, `updated_at`) VALUES
('1', '1', '1', '2020-12-22 19:46:24', '2020-12-22 19:46:24');

INSERT INTO `admin_role` (`id`, `role_id`, `admin_id`, `created_at`, `updated_at`) VALUES
('1', '1', '1', '2020-12-22 19:46:24', '2020-12-22 19:46:24');

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `super_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Amr', 'a@gmail.com', NULL, '1', '$2y$10$tU6U2TE6mg3hpPiXIzGeDuAFh.iuSiZa5CggolrEGSGRF0Rs6y8Ay', NULL, '2020-12-22 19:46:24', '2020-12-22 19:46:24');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '2014_10_12_000000_create_users_table', '1'),
('2', '2014_10_12_100000_create_password_resets_table', '1'),
('3', '2019_08_19_000000_create_failed_jobs_table', '1'),
('4', '2020_12_21_232724_create_admin_password_resets_table', '2'),
('5', '2020_12_21_232724_create_admins_table', '2'),
('6', '2015_02_07_172606_create_roles_table', '3'),
('7', '2015_02_07_172633_create_role_user_table', '3'),
('8', '2015_02_07_172649_create_permissions_table', '3'),
('9', '2015_02_07_172657_create_permission_role_table', '3'),
('10', '2015_02_17_152439_create_permission_user_table', '3'),
('11', '2015_11_30_232041_bigint_user_keys', '4'),
('12', '2016_02_06_172606_create_users_table_if_doesnt_exist', '4'),
('19', '2020_12_23_000530_create_admin_permission_table', '5'),
('20', '2020_12_23_000540_create_admin_role_table', '6');

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
('1', '4', '1', '2020-12-23 19:30:19', '2020-12-23 19:30:19');

INSERT INTO `permissions` (`id`, `inherit_id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
('4', NULL, 'roles', '{\"create\":true,\"view\":true,\"update\":true,\"delete\":true}', 'manage roles', '2020-12-23 19:28:39', '2020-12-23 19:28:39');

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
('1', '1', '1', '2020-12-23 19:34:44', '2020-12-23 19:34:44');

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
('1', 'Super Admin', 'super-admin', NULL, '2020-12-22 19:46:24', '2020-12-22 19:46:24');

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Amr', 'a@gmail.com', NULL, '$2y$10$tU6U2TE6mg3hpPiXIzGeDuAFh.iuSiZa5CggolrEGSGRF0Rs6y8Ay', '', '2020-12-22 19:46:24', '2020-12-22 19:46:24');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;