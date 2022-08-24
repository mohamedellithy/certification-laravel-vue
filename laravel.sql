-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 05, 2022 at 12:58 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `adsenses`
--

DROP TABLE IF EXISTS `adsenses`;
CREATE TABLE IF NOT EXISTS `adsenses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_name` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT '1' COMMENT '1 => top , 2 => bottom , 3 => right , 4 => left, 5 => after title page',
  `code_adsense` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

DROP TABLE IF EXISTS `certifications`;
CREATE TABLE IF NOT EXISTS `certifications` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `multi_generate` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `certifications_name_unique` (`name`),
  UNIQUE KEY `certifications_slug_unique` (`slug`),
  KEY `certifications_department_id_foreign` (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `have_child_departments` int(11) NOT NULL DEFAULT '1',
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_name_unique` (`name`),
  UNIQUE KEY `departments_slug_unique` (`slug`),
  KEY `departments_parent_id_foreign` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `slug`, `have_child_departments`, `parent_id`, `active`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Antonetta Champlin IV', 'praesentium-hic-cupiditate-accusantium-assumenda-enim-vero-aut', 0, NULL, 1, 'Reiciendis aspernatur necessitatibus est ratione laudantium modi. Qui at autem eveniet neque voluptatum odio.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(2, 'Delphine McKenzie', 'in-pariatur-numquam-omnis-architecto-eaque', 0, NULL, 1, 'Atque consequatur omnis aperiam sit voluptatem ratione excepturi ea. Dolorem amet iusto eum commodi alias est. Maiores ut fuga aut voluptates iusto quia sint. Vero nihil sed nihil inventore qui sit.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(3, 'Mr. Maurice Osinski DDS', 'aliquam-sint-debitis-fugit-neque-laborum', 1, NULL, 1, 'Quo ab earum nulla quia nobis. Non dolore dolore repellat.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(4, 'Prof. Oma Bashirian', 'iure-blanditiis-quisquam-nihil-nisi-quam-exercitationem', 1, NULL, 1, 'Sed incidunt eius ut commodi autem. Ipsa quia laborum exercitationem enim odit sint. Aspernatur laboriosam suscipit autem vitae mollitia cumque consequatur. Et rem rem veritatis qui.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(5, 'Mr. Lucio Altenwerth', 'et-velit-qui-ducimus-non-a-illo-voluptatibus', 0, NULL, 1, 'Sunt aspernatur in excepturi. Nemo deleniti reprehenderit ut sed magnam. Modi ut quia aperiam nihil quas placeat necessitatibus.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(6, 'Maci Sauer', 'earum-exercitationem-quasi-nostrum-ipsa-tempore', 0, NULL, 1, 'Sit voluptatem fugit enim est quidem voluptas recusandae. Eligendi qui a enim non quia. Reprehenderit eum nihil omnis odio aliquid quae maiores.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(7, 'Arvilla Lang', 'quo-magnam-non-qui-ut-quo-consectetur-est', 1, NULL, 1, 'Ipsum et id et labore at. Error odio voluptatem tempore labore ipsa ad voluptatem. Aperiam dolor veritatis enim et.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(8, 'Kenyatta Dicki', 'at-exercitationem-odio-et-aperiam-totam-tenetur', 1, NULL, 1, 'Officia occaecati velit eum mollitia velit tempore. Asperiores consequuntur similique saepe saepe similique. Ut ad excepturi minus alias voluptatibus. Illum vel eligendi magni repudiandae iure rerum.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(9, 'Minerva Conn', 'rerum-animi-iusto-rerum-laudantium-quia-et-est-qui', 0, NULL, 1, 'Et enim consequatur est. Quia molestiae quasi ea corrupti itaque repellat eius.', '2022-07-04 22:58:41', '2022-07-04 22:58:41'),
(10, 'Sid Johnston', 'aspernatur-consequuntur-cupiditate-quis', 1, NULL, 1, 'Et veritatis facere eius incidunt libero quidem. Omnis necessitatibus sapiente dolorem repellendus est nam voluptatibus. Recusandae porro maiores nobis officiis perferendis fugit.', '2022-07-04 22:58:41', '2022-07-04 22:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

DROP TABLE IF EXISTS `fonts`;
CREATE TABLE IF NOT EXISTS `fonts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_family` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cdn_font_url` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` int(11) NOT NULL,
  `imageable_type` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `alt` text COLLATE utf8mb4_unicode_ci,
  `title` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1),
(13, '2014_10_12_100000_create_password_resets_table', 1),
(14, '2019_08_19_000000_create_failed_jobs_table', 1),
(15, '2022_05_23_171309_create_departments_table', 1),
(16, '2022_05_25_091034_create_certifications_table', 1),
(17, '2022_05_25_092516_create_images_table', 1),
(18, '2022_06_01_160106_create_fonts_table', 1),
(19, '2022_06_01_160122_create_options_table', 1),
(20, '2022_06_14_124403_create_adsenses_table', 1),
(21, '2022_06_19_125844_add_multi_generate', 1),
(22, '2022_06_19_152030_add_text_align', 1);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `certification_id` bigint(20) UNSIGNED NOT NULL,
  `font_id` bigint(20) UNSIGNED DEFAULT NULL,
  `max_words` int(11) DEFAULT NULL,
  `min_words` int(11) DEFAULT NULL,
  `max_characters` int(11) DEFAULT NULL,
  `min_characters` int(11) DEFAULT NULL,
  `color_text` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Field',
  `font_type` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font_size_text` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direction_text` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_for_test` text COLLATE utf8mb4_unicode_ci,
  `width_box` double DEFAULT NULL,
  `height_box` double DEFAULT NULL,
  `transformX` double DEFAULT NULL,
  `transformY` double DEFAULT NULL,
  `target` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_width` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_height` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_asBackground` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_year` int(11) NOT NULL DEFAULT '1',
  `date_month` int(11) NOT NULL DEFAULT '1',
  `date_day` int(11) NOT NULL DEFAULT '1',
  `type_input` int(11) NOT NULL DEFAULT '0' COMMENT '0 => input , 1 => textarea',
  `formate_date` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recX` double DEFAULT NULL,
  `recY` double DEFAULT NULL,
  `recHeight` double DEFAULT NULL,
  `recWidth` double DEFAULT NULL,
  `recTop` double DEFAULT NULL,
  `recBottom` double DEFAULT NULL,
  `recLeft` double DEFAULT NULL,
  `recRight` double DEFAULT NULL,
  `max_date` date DEFAULT NULL,
  `min_date` date DEFAULT NULL,
  `text_before_date` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text_after_date` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_field` int(11) NOT NULL DEFAULT '0' COMMENT '1 => text , 2 => image or logo , 3 => date or time',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `text_align` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'right',
  PRIMARY KEY (`id`),
  KEY `options_certification_id_foreign` (`certification_id`),
  KEY `options_font_id_foreign` (`font_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$RzONkWkxFN65vf.0nnKxWeuUrxXR9FwASCOJiHF9ieYmWinjj4jxC', NULL, '2022-07-04 22:58:41', '2022-07-04 22:58:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
