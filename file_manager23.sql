-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2023 at 08:52 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file_manager23`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(99) NOT NULL,
  `email` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  `role` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Siam Ahmed', 'shiam@gmail.com', '$2y$10$dm9NkVHdFQfMoWUry.pT7OqgWVRhR6JNYrVmljDPHnQvQP8BhXzQG', 2, 1, '2023-01-09 09:48:21', '2023-01-09 09:48:21'),
(4, 'Riyaj H', 'riyaj@gmail.com', '$2y$10$/QelY1Y0Tv6oRB1LMUZtu.OLd1maWTOZCw2dYls0RGKALedhuSYgq', 3, 1, '2023-01-11 04:26:35', '2023-01-11 04:26:35'),
(5, 'Riyaj Hossen', 'riyajhossen73@gmail.com', '$2y$10$Bc2W0QU4V//IDieR.JXT2.N79.AgGPRPjynD4V7AfYdxi20e8tQl2', 1, 1, '2023-01-12 12:25:33', '2023-01-12 12:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(99) NOT NULL,
  `description` varchar(399) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Riyaj', 'Riyaj Hossen is a Laravel developer.', '2023-01-05 04:53:37', '2023-01-05 04:53:37'),
(2, 'Software', 'our software here', '2023-01-05 04:54:48', '2023-01-05 04:54:48'),
(6, 'Mobile', 'All Mobile here', '2023-01-10 13:37:41', '2023-01-10 13:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `name` varchar(199) NOT NULL,
  `description` varchar(999) NOT NULL,
  `file` varchar(299) NOT NULL,
  `uploaded_by` varchar(99) NOT NULL,
  `newnm` varchar(499) NOT NULL,
  `main_category` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL,
  `originalName` varchar(299) NOT NULL,
  `mimeType` varchar(99) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `description`, `file`, `uploaded_by`, `newnm`, `main_category`, `sub_category`, `originalName`, `mimeType`, `created_at`, `updated_at`) VALUES
(29, 'JPG image test', 'JPG image testing now', 'C:\\xampp\\tmp\\phpC5AD.tmp', 'Riyaj Hossen', 'File/Riyaj/Adobe/vGJZ6s2tlv0OvkyOwOB4IGCu99K0CkLd21Mc0APf.jpg', 1, 3, 'IMG_20230102_232920.jpg', 'image/jpeg', '2023-01-10 13:40:38', '2023-01-10 13:40:38'),
(30, 'Riyaj', 'web of riyaj', 'C:\\xampp\\tmp\\php34F8.tmp', 'Riyaj Hossen', 'File/Riyaj/Adobe/KNhVpey74FINpRq0xUGkSlhEif9fgFcYEBcq6AOk', 1, 3, 'ggg.zip', 'application/x-zip-compressed', '2023-01-10 14:19:20', '2023-01-10 14:19:20'),
(31, 'Any Name', 'anything', 'C:\\xampp\\tmp\\php6714.tmp', 'Riyaj Hossen', 'File/Software/Google/cWHe30zW8hvebc06SpOsERFAJdwBTMO3cBI5DLG8.jpg', 2, 4, 'riyaj.jpg', 'image/jpeg', '2023-01-10 14:41:24', '2023-01-10 14:41:24');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('riyajhossen73@gmail.com', '$2y$10$w3od7i68kfCBfQwmbxVWCOY8BB/1.fp2ULYxlJCSrC/jAVRhr990e', '2023-01-04 04:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(1) NOT NULL,
  `file_add` int(1) NOT NULL,
  `file_edit` int(1) NOT NULL,
  `file_delete` int(1) NOT NULL,
  `file_download` int(1) NOT NULL,
  `cat_add` int(1) NOT NULL,
  `cat_edit` int(1) NOT NULL,
  `cat_delete` int(1) NOT NULL,
  `admin_add` int(1) NOT NULL,
  `admin_change` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `file_add`, `file_edit`, `file_delete`, `file_download`, `cat_add`, `cat_edit`, `cat_delete`, `admin_add`, `admin_change`) VALUES
(1, 1, 0, 0, 0, 1, 1, 0, 0, 0),
(2, 0, 1, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `scategories`
--

CREATE TABLE `scategories` (
  `id` int(11) NOT NULL,
  `name` varchar(99) NOT NULL,
  `description` varchar(299) NOT NULL,
  `main_category` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `scategories`
--

INSERT INTO `scategories` (`id`, `name`, `description`, `main_category`, `created_at`, `updated_at`) VALUES
(2, 'Google Apk', 'All app of Google apk', 1, '2023-01-05 07:53:49', '2023-01-05 07:53:49'),
(3, 'Website', 'Wbesites created by Riyaj.', 1, '2023-01-09 11:52:47', '2023-01-09 11:52:47'),
(4, 'Microsoft', 'All of Microsoft corporation', 2, '2023-01-09 12:15:41', '2023-01-09 12:15:41'),
(5, 'Web Application', 'All Web Application of Riyaj', 1, '2023-01-10 13:39:55', '2023-01-10 13:39:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'riyaj', 'riyajhossen73@gmail.com', NULL, '$2y$10$l4aAric/E/iq3ucNPtEoDeYj86fPKDHUHKk4x0MlJUwTHkzlcPV3.', 'tBDXWULEIadSmqRFdAEjCSp8uY88T0c0tJtnha7IK6MZaHV0AJT2aPXJspXc', '2023-01-04 04:02:46', '2023-01-04 04:02:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `scategories`
--
ALTER TABLE `scategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scategories`
--
ALTER TABLE `scategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
