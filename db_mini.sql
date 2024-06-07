-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2024 at 12:00 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt_sales`
--

CREATE TABLE `dt_sales` (
  `id` int NOT NULL,
  `sales_id` int NOT NULL,
  `product_id` int NOT NULL,
  `invoice_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` mediumint NOT NULL,
  `weight` mediumint NOT NULL,
  `unit_price` bigint NOT NULL,
  `discount` double(8,2) NOT NULL,
  `price` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dt_tickets`
--

CREATE TABLE `dt_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_id` int NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_accounts`
--

CREATE TABLE `log_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `account_id` bigint NOT NULL,
  `privilege_id` bigint NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_request` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_response` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_api`
--

CREATE TABLE `log_api` (
  `id` bigint UNSIGNED NOT NULL,
  `privilege_id` bigint NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_request` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_response` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_mails`
--

CREATE TABLE `log_mails` (
  `id` bigint UNSIGNED NOT NULL,
  `account_id` bigint NOT NULL,
  `target` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_response` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `map_privileges`
--

CREATE TABLE `map_privileges` (
  `privilege_group_id` bigint NOT NULL,
  `privilege_id` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `map_privileges`
--

INSERT INTO `map_privileges` (`privilege_group_id`, `privilege_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(49, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(50, '2024_02_06_210959_create_table_core', 1),
(51, '2024_06_06_151849_create_table_transaction', 1),
(52, '2024_06_06_151858_create_table_sales', 1),
(53, '2024_06_06_151904_create_table_product', 1),
(54, '2024_06_06_151910_create_table_ticket', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_accounts`
--

CREATE TABLE `ms_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_trash` tinyint(1) NOT NULL DEFAULT '0',
  `is_login` tinyint(1) NOT NULL DEFAULT '0',
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `is_author` tinyint(1) NOT NULL DEFAULT '0',
  `login_attempt` tinyint NOT NULL DEFAULT '0',
  `password_request` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_password_request` timestamp NULL DEFAULT NULL,
  `expire_password_request` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  `privilege_group_id` bigint NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_accounts`
--

INSERT INTO `ms_accounts` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `hash`, `is_new`, `is_active`, `is_trash`, `is_login`, `is_locked`, `is_author`, `login_attempt`, `password_request`, `last_password_request`, `expire_password_request`, `last_login`, `created_by`, `updated_by`, `privilege_group_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'System', 'Admin', 'sysadmin@laravel.app', 'sysadmin', '$2y$10$jDOFyJFN68wCJSbsyZSAfedoP9d88U7aBPs0rEn3Ib4kCyjDAvdnS', '72a0d5ab745445acc798e65b2e67782b', 0, 1, 0, 0, 0, 1, 0, NULL, NULL, NULL, NULL, 0, 0, 1, NULL, '2024-06-07 02:17:46', '2024-06-07 02:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `ms_general`
--

CREATE TABLE `ms_general` (
  `key_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ms_menus`
--

CREATE TABLE `ms_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_menu_id` bigint NOT NULL,
  `label` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_active` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_menus`
--

INSERT INTO `ms_menus` (`id`, `parent_menu_id`, `label`, `alias`, `url`, `order`, `is_active`) VALUES
(1, 1, 'Upload', 'upload', 'master.upload.index', 0, 1),
(2, 1, 'Transaction', 'transaction', 'master.transaction.index', 1, 1),
(3, 1, 'Sales', 'sales', 'master.sales.index', 2, 1),
(4, 1, 'Product', 'product', 'master.product.index', 3, 1),
(5, 1, 'Ticket', 'ticket', 'master.ticket.index', 4, 1),
(6, 2, 'General', 'general', 'setting.general.index', 0, 1),
(7, 2, 'Privilege', 'privilege', 'setting.privilege.index', 1, 1),
(8, 2, 'Privilege Group', 'privigroup', 'setting.privigroup.index', 2, 1),
(9, 2, 'Account', 'account', 'setting.account.index', 3, 1),
(10, 3, 'Account Activity', 'accactivity', 'applog.accactivity.index', 0, 1),
(11, 3, 'Mail Trail', 'mailtrail', 'applog.mailtrail.index', 1, 1),
(12, 3, 'API Trail', 'apitrail', 'applog.apitrail.index', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_parent_menus`
--

CREATE TABLE `ms_parent_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `label` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_active` tinyint NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_parent_menus`
--

INSERT INTO `ms_parent_menus` (`id`, `label`, `alias`, `icon`, `order`, `is_active`) VALUES
(1, 'Master', 'master', 'fa-folder', 0, 1),
(2, 'Setting', 'setting', 'fa-cog', 1, 1),
(3, 'Application Log', 'applog', 'fa-keyboard', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_privileges`
--

CREATE TABLE `ms_privileges` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` bigint NOT NULL,
  `modules` tinyint NOT NULL,
  `desc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_privileges`
--

INSERT INTO `ms_privileges` (`id`, `code`, `menu_id`, `modules`, `desc`, `is_active`) VALUES
(1, 'UPCR', 1, 1, 'Upload master data', 1),
(2, 'TRRA', 2, 4, 'Read list of transaction data', 1),
(3, 'SLRA', 3, 4, 'Read list of sales data', 1),
(4, 'SLRD', 3, 5, 'Read detail of sales data', 1),
(5, 'PDRA', 4, 4, 'Read list of product data', 1),
(6, 'TCRA', 5, 4, 'Read list of ticket data', 1),
(7, 'TCRD', 5, 5, 'Read detail of ticket data', 1),
(8, 'GRUP', 6, 2, 'Update existing general setting data', 1),
(9, 'PRCR', 7, 1, 'Add new privilege data', 1),
(10, 'PRUP', 7, 2, 'Update existing privilege data', 1),
(11, 'PRRM', 7, 3, 'Remove existing privilege data', 1),
(12, 'PRRA', 7, 4, 'Read list of privilege data', 1),
(13, 'PGCR', 8, 1, 'Add new privilege group data', 1),
(14, 'PGUP', 8, 2, 'Update existing privilege group data', 1),
(15, 'PGRM', 8, 3, 'Remove existing privilege group data', 1),
(16, 'PGRA', 8, 4, 'Read list of privilege group data', 1),
(17, 'ACCR', 9, 1, 'Add new user account', 1),
(18, 'ACUP', 9, 2, 'Update existing user account', 1),
(19, 'ACRM', 9, 3, 'Remove existing user account', 1),
(20, 'ACRA', 9, 4, 'Read list of user account', 1),
(21, 'ACRD', 9, 5, 'Read detail of user account', 1),
(22, 'AARA', 10, 4, 'Read list of user account activity log', 1),
(23, 'MLRA', 11, 4, 'Read list of mailer log', 1),
(24, 'ATRA', 12, 4, 'Read list of api request log', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_privilege_groups`
--

CREATE TABLE `ms_privilege_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_privilege_groups`
--

INSERT INTO `ms_privilege_groups` (`id`, `name`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SUPERSU', 'Superuser Privilege', 0, 0, '2024-06-07 02:17:46', '2024-06-07 02:17:46'),
(2, 'USER', 'User Privilege', 0, 0, '2024-06-07 02:17:46', '2024-06-07 02:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `ms_products`
--

CREATE TABLE `ms_products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` mediumint NOT NULL,
  `price` bigint NOT NULL,
  `stock` mediumint NOT NULL,
  `sale` bigint NOT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_sales`
--

CREATE TABLE `ts_sales` (
  `id` int NOT NULL,
  `invoice_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_weight` mediumint NOT NULL,
  `shipping_fee` bigint NOT NULL,
  `total_price` bigint NOT NULL,
  `total_sale` bigint NOT NULL,
  `user_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_address` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_date` timestamp NULL DEFAULT NULL,
  `expedition_id` int NOT NULL,
  `shipping_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_date` timestamp NULL DEFAULT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_tickets`
--

CREATE TABLE `ts_tickets` (
  `id` bigint UNSIGNED NOT NULL,
  `ticket_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_date` timestamp NOT NULL,
  `customer_id` int NOT NULL,
  `subject` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ts_transactions`
--

CREATE TABLE `ts_transactions` (
  `id` int NOT NULL,
  `invoice_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_weight` mediumint NOT NULL,
  `shipping_fee` bigint NOT NULL,
  `total_price` bigint NOT NULL,
  `user_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `shipping_address` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_date` timestamp NOT NULL,
  `expedition_id` int NOT NULL,
  `shipping_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` timestamp NULL DEFAULT NULL,
  `created_by` bigint NOT NULL,
  `updated_by` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_sales`
--
ALTER TABLE `dt_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dt_tickets`
--
ALTER TABLE `dt_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_accounts`
--
ALTER TABLE `log_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_api`
--
ALTER TABLE `log_api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_mails`
--
ALTER TABLE `log_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_accounts`
--
ALTER TABLE `ms_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_general`
--
ALTER TABLE `ms_general`
  ADD PRIMARY KEY (`key_id`);

--
-- Indexes for table `ms_menus`
--
ALTER TABLE `ms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_parent_menus`
--
ALTER TABLE `ms_parent_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_privileges`
--
ALTER TABLE `ms_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_privilege_groups`
--
ALTER TABLE `ms_privilege_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ms_products`
--
ALTER TABLE `ms_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ts_sales`
--
ALTER TABLE `ts_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_tickets`
--
ALTER TABLE `ts_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ts_transactions`
--
ALTER TABLE `ts_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dt_tickets`
--
ALTER TABLE `dt_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_accounts`
--
ALTER TABLE `log_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_api`
--
ALTER TABLE `log_api`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_mails`
--
ALTER TABLE `log_mails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `ms_accounts`
--
ALTER TABLE `ms_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ms_menus`
--
ALTER TABLE `ms_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ms_parent_menus`
--
ALTER TABLE `ms_parent_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_privileges`
--
ALTER TABLE `ms_privileges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ms_privilege_groups`
--
ALTER TABLE `ms_privilege_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ts_tickets`
--
ALTER TABLE `ts_tickets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
