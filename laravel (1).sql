-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 10:07 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `color`, `description`, `name`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'red', 'Ăn sáng, trưa, tối', 'Ăn uống', 1, 1, NULL, NULL),
(2, 'blue', 'Mua các đồ dùng cần thiết cho sinh hoạt', 'Mua sắm', 1, 1, NULL, NULL),
(3, 'gray', 'Mỹ phẩm, son phấn, dưỡng da', 'Mỹ phẩm', 1, 1, NULL, NULL),
(4, 'yellow', 'Quấn áo, giày dép', 'Quần áo', 0, 1, NULL, NULL),
(5, 'black', 'Tiền cho các cuộc vui chơi', 'Vui chơi', 1, 1, NULL, NULL),
(6, 'green', 'Đổ xăng xe, bảo dưỡng xe, lộ phí đi lại', 'Đi lại', 1, 1, NULL, NULL),
(7, 'pink', 'Các khoản chi tiêu khác', 'Khác', 1, 1, NULL, NULL),
(10, 'green', 'Đi xe ôm công nghệ', 'Grab', 1, 3, NULL, NULL),
(11, 'pink', 'Vui chơi, sn của bạn bè, người yêu', 'Bạn bè', 1, 4, NULL, NULL),
(14, '#14b817', 'Nguồn thu do người dùng tự tạo', 'Nguồn thu', 0, 1, NULL, NULL),
(15, '#1bd80e', 'Nguồn thu hàng tháng', 'Nguồn thu', 0, 10, NULL, NULL),
(16, '#de1717', NULL, 'Ăn uống', 1, 10, NULL, NULL),
(17, '#c72383', NULL, 'Mua Quà', 1, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(28, '2014_10_12_000000_create_users_table', 1),
(29, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(30, '2019_08_19_000000_create_failed_jobs_table', 1),
(31, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(32, '2023_11_07_161327_tbl_users', 1),
(33, '2023_11_08_024533_create_wallets_table', 1),
(34, '2023_11_08_024628_create_categories_table', 1),
(35, '2023_11_08_024646_create_periods_table', 1),
(36, '2023_11_08_024702_create_plans_table', 1),
(37, '2023_11_08_024752_create_moneytypes_table', 1),
(38, '2023_11_08_024828_create_plan_categories_table', 1),
(39, '2023_11_08_025751_create_transactions_table', 1),
(42, '2014_10_12_100000_create_password_resets_table', 2),
(43, '2023_11_13_035724_wallet', 2),
(44, '2023_11_20_155132_add_rate_to_money_types_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `moneytypes`
--

CREATE TABLE `moneytypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` decimal(10,5) NOT NULL DEFAULT 1.00000,
  `wallet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `moneytypes`
--

INSERT INTO `moneytypes` (`id`, `name`, `rate`, `wallet_id`, `created_at`, `updated_at`) VALUES
(1, 'VNĐ', '24000.00000', NULL, NULL, NULL),
(2, 'USD', '0.00005', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` date DEFAULT NULL,
  `end_time` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `name`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(2, '3 tháng', '2023-01-01', '2023-04-01', NULL, NULL),
(3, '6 tháng', '2023-01-01', '2023-07-01', NULL, NULL),
(4, '12 tháng', '2023-01-01', '2024-01-01', NULL, NULL),
(5, '10 năm', '2023-01-01', '2033-01-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `period_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `name`, `user_id`, `period_id`, `created_at`, `updated_at`) VALUES
(1, 'Mua điện thoại ', 1, 4, NULL, NULL),
(2, 'Tương lai', 1, 4, NULL, NULL),
(3, 'Cố định', 2, 5, NULL, NULL),
(4, 'Mua xe', 3, 3, NULL, NULL),
(5, 'Cưới vợ', 5, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_categories`
--

CREATE TABLE `plan_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` double DEFAULT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_categories`
--

INSERT INTO `plan_categories` (`id`, `amount`, `plan_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 1000000, 1, 1, NULL, NULL),
(2, 2500000, 2, 5, NULL, NULL),
(3, 2000000, 3, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `avatar`, `email`, `name`, `password`, `phone`, `status`, `username`, `created_at`, `updated_at`) VALUES
(1, 'avt.meo.cute', 'meocon@gmail.com', 'Mèo', 'Meo@123', '036287130111', 1, 'MeoCon123', NULL, NULL),
(2, 'avt.cho.ngao', 'chongao@gmail.com', 'Chó', 'Cho@123', '394229171', 1, 'ChoNgao', NULL, NULL),
(3, 'avt.heo.map', 'heomap@gmail.com', 'Heo', 'Heo@123', '0987654321', 0, 'HeoMap', NULL, NULL),
(4, 'avt.khi.buon', 'khibuon@gmail.com', 'Khỉ', 'Khi@123', '0764384197', 1, 'KhiBuon', NULL, NULL),
(5, 'avt.gau.co.don', 'gaucodon@gmail.com', 'Gấu ', 'Gaucodon@123', '0864329874', 1, 'GauCoDon', NULL, NULL),
(6, NULL, 'admin@gmail.com', NULL, '123456', NULL, NULL, 'Admin', NULL, NULL),
(7, NULL, 'thai201200327@lms.utc.edu.vn', NULL, '$2y$12$CRtE3UsCuWBswWUHECEDbegB95Y1J9xQk1XRTRp26yhFem7OuRrmS', NULL, NULL, 'admin@gmail.com', NULL, NULL),
(10, NULL, 'minhanh99@gmail.com', NULL, '$2y$12$0Muqq1LXP6CSJWRLE3ih2eijA3qSml.nnmTwqboechpvnu0Ggp8cW', NULL, NULL, 'Admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` date DEFAULT NULL,
  `total` double DEFAULT NULL,
  `wallet_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `description`, `time`, `total`, `wallet_id`, `category_id`, `created_at`, `updated_at`) VALUES
(7, 'Ăn bún chả', '2023-11-21', 42000, 6, 16, NULL, NULL),
(8, 'Nguồn thu do người dùng nạp', '2023-11-21', 12000, 6, 14, NULL, NULL),
(10, 'Ăn bún chả', '2023-11-22', 35000, 6, 15, NULL, NULL),
(11, 'Ăn bún chả', '2023-11-21', 35000, 6, 16, NULL, NULL),
(12, 'Ăn bún chả', '2023-10-22', 35000, 6, 15, NULL, NULL),
(13, 'Mua hoa tặng CVHT', '2023-11-23', 100, 7, 17, NULL, NULL),
(14, 'Mua hoa tặng crush', '2023-11-24', 35000, 6, 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `money_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `icon`, `money`, `name`, `status`, `money_type_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2, NULL, '10000', 'Tesst', NULL, 2, 1, NULL, NULL),
(6, NULL, '46', 'Techcombank', NULL, 2, 10, NULL, NULL),
(7, NULL, '11900', 'VNPay', NULL, 2, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `icon`, `money`, `name`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'icon1', '10000000', 'BIDV', 1, 1, NULL, NULL),
(2, 'icon2', '1500000', 'TPBank', 1, 1, NULL, NULL),
(3, 'icon3', '2000000', 'Viettel money', 1, 1, NULL, NULL),
(4, 'icon4', '5000000', 'HDBank', 1, 1, NULL, NULL),
(5, 'icon2', '2500000', 'TPBank', 1, 2, NULL, NULL),
(6, 'icon3', '5000000', 'Viettel money', 0, 2, NULL, NULL),
(7, 'icon5', '10000000', 'VPBank', 1, 3, NULL, NULL),
(8, 'icon2', '23000000', 'TPBank', 1, 5, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moneytypes`
--
ALTER TABLE `moneytypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moneytypes_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plans_period_id_foreign` (`period_id`),
  ADD KEY `plans_user_id_foreign` (`user_id`);

--
-- Indexes for table `plan_categories`
--
ALTER TABLE `plan_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_categories_plan_id_foreign` (`plan_id`),
  ADD KEY `plan_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_category_id_foreign` (`category_id`),
  ADD KEY `transactions_wallet_id_foreign` (`wallet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallet_money_type_id_foreign` (`money_type_id`),
  ADD KEY `wallet_user_id_foreign` (`user_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `moneytypes`
--
ALTER TABLE `moneytypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `plan_categories`
--
ALTER TABLE `plan_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `moneytypes`
--
ALTER TABLE `moneytypes`
  ADD CONSTRAINT `moneytypes_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`);

--
-- Constraints for table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`id`),
  ADD CONSTRAINT `plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `plan_categories`
--
ALTER TABLE `plan_categories`
  ADD CONSTRAINT `plan_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `plan_categories_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallet` (`id`);

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `wallet_money_type_id_foreign` FOREIGN KEY (`money_type_id`) REFERENCES `wallets` (`id`),
  ADD CONSTRAINT `wallet_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
