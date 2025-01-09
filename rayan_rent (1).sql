-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 11:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rayan_rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT 'NULL',
  `facebook_link` varchar(255) NOT NULL DEFAULT 'NULL',
  `instagram_link` varchar(255) NOT NULL,
  `twiter_link` varchar(255) NOT NULL,
  `copyright_text` text NOT NULL,
  `contract_officer` varchar(255) NOT NULL DEFAULT 'NULL',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_enquiries`
--

CREATE TABLE `booking_enquiries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `enquiry_no` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `status` enum('selected','rejected','pending','terminated') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_enquiries`
--

INSERT INTO `booking_enquiries` (`id`, `tenant_id`, `property_id`, `enquiry_no`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '60886', 'I am Interested', 'selected', '2025-01-08 03:33:28', '2025-01-08 03:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `keywords` text NOT NULL,
  `order` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `page_name` varchar(255) NOT NULL,
  `page_url` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_nl` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `content_nl` text NOT NULL,
  `content_en` text NOT NULL,
  `deletable` tinyint(1) NOT NULL DEFAULT 1,
  `nav_item` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cotact_links`
--

CREATE TABLE `cotact_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contractable_type` varchar(255) NOT NULL,
  `contractable_id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `is_signed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `short_name`, `created_at`, `updated_at`) VALUES
(1, 'Pakistan', 'PK', '2024-12-29 09:14:23', '2024-12-29 09:14:23'),
(2, 'Netherland', 'NL', '2024-12-29 09:14:23', '2024-12-29 09:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `enquires`
--

CREATE TABLE `enquires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspections`
--

CREATE TABLE `inspections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inspectionable_id` bigint(20) UNSIGNED NOT NULL,
  `inspectionable_type` varchar(255) NOT NULL,
  `inspection_code` varchar(255) NOT NULL,
  `inspection_type` varchar(255) NOT NULL,
  `inspection_date` date NOT NULL,
  `inspection_notes` text NOT NULL,
  `is_ready` tinyint(1) NOT NULL,
  `inspected_by` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `total_persons` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inspection_contents`
--

CREATE TABLE `inspection_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inspection_id` bigint(20) UNSIGNED NOT NULL,
  `content` longtext NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intrested_properties`
--

CREATE TABLE `intrested_properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `min_price` double NOT NULL DEFAULT 0,
  `max_price` double NOT NULL DEFAULT 0,
  `locations` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_contract_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `invoice_type` enum('landlord invoice','tenant invoice','quiry invoice') NOT NULL DEFAULT 'tenant invoice',
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT 0,
  `from_date` date NOT NULL,
  `till_date` date NOT NULL,
  `status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `paid_at` datetime DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `tenant_contract_id`, `invoice_number`, `invoice_type`, `property_id`, `amount`, `from_date`, `till_date`, `status`, `paid_at`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, '10224257', 'tenant invoice', 2, 3000, '2025-01-08', '2025-02-08', 'unpaid', NULL, NULL, '2025-01-08 03:35:32', '2025-01-08 03:35:32'),
(2, 1, '10502307', 'tenant invoice', 2, 3000, '2025-02-08', '2025-03-08', 'unpaid', NULL, NULL, '2025-01-08 03:35:32', '2025-01-08 03:35:32'),
(3, 1, '10435104', 'tenant invoice', 2, 3000, '2025-03-08', '2025-04-08', 'unpaid', NULL, NULL, '2025-01-08 03:35:32', '2025-01-08 03:35:32'),
(4, 1, '12014143', 'tenant invoice', 2, 3000, '2025-04-08', '2025-05-08', 'unpaid', NULL, NULL, '2025-01-08 03:35:32', '2025-01-08 03:35:32'),
(5, 1, '11588859', 'tenant invoice', 2, 3000, '2025-05-08', '2025-06-08', 'unpaid', NULL, NULL, '2025-01-08 03:35:32', '2025-01-08 03:35:32'),
(6, 1, '10552960', 'landlord invoice', 2, 2000, '2025-01-08', '2025-02-08', 'unpaid', NULL, NULL, '2025-01-08 03:36:03', '2025-01-08 03:36:03'),
(7, 1, '10135678', 'landlord invoice', 2, 2000, '2025-02-08', '2025-03-08', 'unpaid', NULL, NULL, '2025-01-08 03:36:03', '2025-01-08 03:36:03'),
(8, 1, '11359848', 'landlord invoice', 2, 2000, '2025-03-08', '2025-04-08', 'unpaid', NULL, NULL, '2025-01-08 03:36:03', '2025-01-08 03:36:03'),
(9, 1, '10397661', 'landlord invoice', 2, 2000, '2025-04-08', '2025-05-08', 'unpaid', NULL, NULL, '2025-01-08 03:36:03', '2025-01-08 03:36:03'),
(10, 1, '10826023', 'landlord invoice', 2, 2000, '2025-05-08', '2025-06-08', 'unpaid', NULL, NULL, '2025-01-08 03:36:03', '2025-01-08 03:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `issue_tickets`
--

CREATE TABLE `issue_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_contract_id` bigint(20) UNSIGNED NOT NULL,
  `issue_raised_by` bigint(20) UNSIGNED NOT NULL,
  `issue_ticket_type` bigint(20) UNSIGNED NOT NULL,
  `issue_code` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `description` text NOT NULL,
  `is_urgent` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL,
  `need_update` tinyint(1) NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `priority` varchar(255) NOT NULL,
  `assigned_to` bigint(20) UNSIGNED NOT NULL,
  `assigned_by` bigint(20) UNSIGNED NOT NULL,
  `issue_identification` text NOT NULL,
  `issue_resolved_description` text NOT NULL,
  `issue_created_by_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_ticket_invoices`
--

CREATE TABLE `issue_ticket_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_ticket_id` bigint(20) UNSIGNED NOT NULL,
  `cost` double NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `remark` text NOT NULL,
  `paid_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_ticket_types`
--

CREATE TABLE `issue_ticket_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `landlord_contracts`
--

CREATE TABLE `landlord_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `contract_code` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `price` double NOT NULL DEFAULT 0,
  `start_from` timestamp NULL DEFAULT NULL,
  `contract_period` int(11) NOT NULL,
  `signed_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `terminated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `terminated_on` timestamp NULL DEFAULT NULL,
  `termination_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landlord_contracts`
--

INSERT INTO `landlord_contracts` (`id`, `property_id`, `contract_code`, `link`, `price`, `start_from`, `contract_period`, `signed_at`, `expired_at`, `verified_at`, `created_by`, `verified_by`, `terminated_by`, `terminated_on`, `termination_reason`, `created_at`, `updated_at`) VALUES
(1, 2, '11761062', '1519950681-2025-01-08.pdf', 2000, '2025-01-07 19:00:00', 4, NULL, '2025-05-30 19:00:00', NULL, 2, NULL, NULL, NULL, NULL, '2025-01-08 03:36:03', '2025-01-08 03:36:03');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_01_061046_create_properties_table', 1),
(5, '2024_11_28_042505_create_personal_access_tokens_table', 1),
(6, '2024_11_28_152643_create_app_settings_table', 1),
(7, '2024_11_28_171822_create_cms_table', 1),
(8, '2024_11_28_172530_create_cotact_links_table', 1),
(9, '2024_11_28_172818_create_enquires_table', 1),
(10, '2024_11_28_173015_create_images_table', 1),
(11, '2024_11_28_173157_create_inspections_table', 1),
(12, '2024_11_28_174055_create_inspection_contents_table', 1),
(13, '2024_11_30_065027_create_intrested_properties_table', 1),
(14, '2024_11_30_070619_create_issue_tickets_table', 1),
(15, '2024_11_30_071103_create_issue_ticket_invoices_table', 1),
(16, '2024_11_30_071244_create_issue_ticket_types_table', 1),
(17, '2024_11_30_071336_create_landlord_contracts_table', 1),
(18, '2024_12_01_061910_create_property_features_table', 1),
(19, '2024_12_01_062008_create_property_has_many_features_table', 1),
(20, '2024_12_01_062231_create_property_quries_table', 1),
(21, '2024_12_01_062529_create_property_types_table', 1),
(22, '2024_12_01_062708_create_countries_table', 1),
(23, '2024_12_01_062745_create_provinces_table', 1),
(24, '2024_12_01_062954_create_resolved_tickets_table', 1),
(25, '2024_12_01_063232_create_subscriptions_table', 1),
(27, '2024_12_29_083012_create_booking_enquiries_table', 1),
(30, '2024_12_01_063409_create_tenant_contracts_table', 3),
(31, '2024_12_30_065310_create_invoices_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `description_en` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `property_code` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `contract_period` int(11) NOT NULL,
  `property_type_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `available_from` date DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `kitchens` int(11) DEFAULT NULL,
  `garages` int(11) DEFAULT NULL,
  `parkings` varchar(255) DEFAULT NULL,
  `toilets` int(11) NOT NULL DEFAULT 0,
  `youtube_url` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `landlord_price` double NOT NULL DEFAULT 0,
  `title_nl` text DEFAULT NULL,
  `description_nl` text DEFAULT NULL,
  `feature_image` varchar(255) DEFAULT NULL,
  `property_image` varchar(255) DEFAULT NULL,
  `banner` tinyint(1) NOT NULL DEFAULT 0,
  `features` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title_en`, `description_en`, `slug`, `property_code`, `price`, `contract_period`, `property_type_id`, `user_id`, `province_id`, `postcode`, `city`, `street_address`, `status`, `featured`, `available_from`, `area`, `bedrooms`, `bathrooms`, `kitchens`, `garages`, `parkings`, `toilets`, `youtube_url`, `latitude`, `longitude`, `landlord_price`, `title_nl`, `description_nl`, `feature_image`, `property_image`, `banner`, `features`, `created_at`, `updated_at`) VALUES
(1, 'Beautiful Single Home', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum quis porta. Morbi tincidunt viverra pharetra.</p><p>Vestibulum vel mauris et odio lobortis laoreet eget eu magna. Proin mauris erat, luctus at nulla ut, lobortis mattis magna. Morbi a arcu lacus. Maecenas tristique velit vitae nisi consectetur, in mattis diam sodales. Mauris sagittis sem mattis justo bibendum, a eleifend dolor facilisis. Mauris nec pharetra tortor, ac aliquam felis. Nunc pretium erat sed quam consectetur fringilla.</p><p>Aliquam ultricies nunc porta metus interdum mollis. Donec porttitor libero augue, vehicula tincidunt lectus placerat a. Sed tincidunt dolor non sem dictum dignissim. Nulla vulputate orci felis, ac ornare purus ultricies a. Fusce euismod magna orci, sit amet aliquam turpis dignissim ac. In at tortor at ligula pharetra sollicitudin. Sed tincidunt, purus eget laoreet elementum, felis est pharetra ante, tincidunt feugiat libero enim sed risus.</p><p>Sed at leo sit amet mi bibendum aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent cursus varius odio, non faucibus dui. Nunc vehicula lectus sed velit suscipit aliquam vitae eu ipsum. adipiscing elit.</p>', 'beautiful-single-home', '98549867', 1500, 6, 2, 1, 1, '17252', 'Peshawar', '20/F Green Road, Dhanmondi, Peshawar', 1, 0, '2025-01-31', 1600, 5, 4, 1, 1, '0', 4, NULL, NULL, NULL, 0, 'Beautiful Single Home', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum quis porta. Morbi tincidunt viverra pharetra.</p><p>Vestibulum vel mauris et odio lobortis laoreet eget eu magna. Proin mauris erat, luctus at nulla ut, lobortis mattis magna. Morbi a arcu lacus. Maecenas tristique velit vitae nisi consectetur, in mattis diam sodales. Mauris sagittis sem mattis justo bibendum, a eleifend dolor facilisis. Mauris nec pharetra tortor, ac aliquam felis. Nunc pretium erat sed quam consectetur fringilla.</p><p>Aliquam ultricies nunc porta metus interdum mollis. Donec porttitor libero augue, vehicula tincidunt lectus placerat a. Sed tincidunt dolor non sem dictum dignissim. Nulla vulputate orci felis, ac ornare purus ultricies a. Fusce euismod magna orci, sit amet aliquam turpis dignissim ac. In at tortor at ligula pharetra sollicitudin. Sed tincidunt, purus eget laoreet elementum, felis est pharetra ante, tincidunt feugiat libero enim sed risus.</p><p>Sed at leo sit amet mi bibendum aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent cursus varius odio, non faucibus dui. Nunc vehicula lectus sed velit suscipit aliquam vitae eu ipsum. adipiscing elit.</p>', '2000674433.jpg,293452798.jpg,68190594.jpg', '815683746.jpg,157072217.jpg,302944914.jpg', 0, '', '2024-12-29 04:21:56', '2024-12-29 04:29:09'),
(2, 'New Hostel Villa', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum quis porta. Morbi tincidunt viverra pharetra.</p><p>Vestibulum vel mauris et odio lobortis laoreet eget eu magna. Proin mauris erat, luctus at nulla ut, lobortis mattis magna. Morbi a arcu lacus. Maecenas tristique velit vitae nisi consectetur, in mattis diam sodales. Mauris sagittis sem mattis justo bibendum, a eleifend dolor facilisis. Mauris nec pharetra tortor, ac aliquam felis. Nunc pretium erat sed quam consectetur fringilla.</p><p>Aliquam ultricies nunc porta metus interdum mollis. Donec porttitor libero augue, vehicula tincidunt lectus placerat a. Sed tincidunt dolor non sem dictum dignissim. Nulla vulputate orci felis, ac ornare purus ultricies a. Fusce euismod magna orci, sit amet aliquam turpis dignissim ac. In at tortor at ligula pharetra sollicitudin. Sed tincidunt, purus eget laoreet elementum, felis est pharetra ante, tincidunt feugiat libero enim sed risus.</p><p>Sed at leo sit amet mi bibendum aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent cursus varius odio, non faucibus dui. Nunc vehicula lectus sed velit suscipit aliquam vitae eu ipsum. adipiscing elit.</p>', 'new-hostel-villa', '11901089', 2000, 3, 1, 1, 1, '17252', 'Peshawar', 'Village Palosi Peshawar', 1, 0, '2027-06-11', 12500, 6, 4, 1, 1, '1', 5, NULL, NULL, NULL, 0, 'New Hostel Villa', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum quis porta. Morbi tincidunt viverra pharetra.</p><p>Vestibulum vel mauris et odio lobortis laoreet eget eu magna. Proin mauris erat, luctus at nulla ut, lobortis mattis magna. Morbi a arcu lacus. Maecenas tristique velit vitae nisi consectetur, in mattis diam sodales. Mauris sagittis sem mattis justo bibendum, a eleifend dolor facilisis. Mauris nec pharetra tortor, ac aliquam felis. Nunc pretium erat sed quam consectetur fringilla.</p><p>Aliquam ultricies nunc porta metus interdum mollis. Donec porttitor libero augue, vehicula tincidunt lectus placerat a. Sed tincidunt dolor non sem dictum dignissim. Nulla vulputate orci felis, ac ornare purus ultricies a. Fusce euismod magna orci, sit amet aliquam turpis dignissim ac. In at tortor at ligula pharetra sollicitudin. Sed tincidunt, purus eget laoreet elementum, felis est pharetra ante, tincidunt feugiat libero enim sed risus.</p><p>Sed at leo sit amet mi bibendum aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent cursus varius odio, non faucibus dui. Nunc vehicula lectus sed velit suscipit aliquam vitae eu ipsum. adipiscing elit.</p>', '1426324201.jpg,1884039987.jpg', '1905672514.jpg,2141812850.jpg,192625580.jpg', 0, '', '2024-12-29 04:24:02', '2024-12-29 04:28:37'),
(3, 'Hotel', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum quis porta. Morbi tincidunt viverra pharetra.</p><p>Vestibulum vel mauris et odio lobortis laoreet eget eu magna. Proin mauris erat, luctus at nulla ut, lobortis mattis magna. Morbi a arcu lacus. Maecenas tristique velit vitae nisi consectetur, in mattis diam sodales. Mauris sagittis sem mattis justo bibendum, a eleifend dolor facilisis. Mauris nec pharetra tortor, ac aliquam felis. Nunc pretium erat sed quam consectetur fringilla.</p><p>Aliquam ultricies nunc porta metus interdum mollis. Donec porttitor libero augue, vehicula tincidunt lectus placerat a. Sed tincidunt dolor non sem dictum dignissim. Nulla vulputate orci felis, ac ornare purus ultricies a. Fusce euismod magna orci, sit amet aliquam turpis dignissim ac. In at tortor at ligula pharetra sollicitudin. Sed tincidunt, purus eget laoreet elementum, felis est pharetra ante, tincidunt feugiat libero enim sed risus.</p><p>Sed at leo sit amet mi bibendum aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent cursus varius odio, non faucibus dui. Nunc vehicula lectus sed velit suscipit aliquam vitae eu ipsum. adipiscing elit.</p>', 'hotel', '74933007', 1000, 5, 4, 1, 2, '235887', 'Lahore', 'F Green Road, Dhanmondi, Dhaka', 1, 0, '2025-01-25', 12500, 5, 4, 1, 1, '1', 4, NULL, NULL, NULL, 0, 'Hotel', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus tincidunt aliquam. Aliquam gravida massa at sem vulputate interdum et vel eros. Maecenas eros enim, tincidunt vel turpis vel,dapibus tempus nulla. Donec vel nulla dui. Pellentesque sed ante sed ligula hendrerit condimentum. Suspendisse rhoncus fringilla ipsum quis porta. Morbi tincidunt viverra pharetra.</p><p>Vestibulum vel mauris et odio lobortis laoreet eget eu magna. Proin mauris erat, luctus at nulla ut, lobortis mattis magna. Morbi a arcu lacus. Maecenas tristique velit vitae nisi consectetur, in mattis diam sodales. Mauris sagittis sem mattis justo bibendum, a eleifend dolor facilisis. Mauris nec pharetra tortor, ac aliquam felis. Nunc pretium erat sed quam consectetur fringilla.</p><p>Aliquam ultricies nunc porta metus interdum mollis. Donec porttitor libero augue, vehicula tincidunt lectus placerat a. Sed tincidunt dolor non sem dictum dignissim. Nulla vulputate orci felis, ac ornare purus ultricies a. Fusce euismod magna orci, sit amet aliquam turpis dignissim ac. In at tortor at ligula pharetra sollicitudin. Sed tincidunt, purus eget laoreet elementum, felis est pharetra ante, tincidunt feugiat libero enim sed risus.</p><p>Sed at leo sit amet mi bibendum aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent cursus varius odio, non faucibus dui. Nunc vehicula lectus sed velit suscipit aliquam vitae eu ipsum. adipiscing elit.</p>', '513926666.jpg,1820097615.jpg', '955975267.jpg,549497427.jpg,807957437.jpg', 0, '', '2024-12-29 04:26:00', '2024-12-29 04:28:49');

-- --------------------------------------------------------

--
-- Table structure for table `property_features`
--

CREATE TABLE `property_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_has_many_features`
--

CREATE TABLE `property_has_many_features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `property_feature_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_quries`
--

CREATE TABLE `property_quries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `contacted` tinyint(1) NOT NULL DEFAULT 0,
  `booked` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Villa', 'villa', 1, '2024-12-29 04:18:03', '2024-12-29 04:18:03'),
(2, 'House', 'house', 1, '2024-12-29 04:18:41', '2024-12-29 04:18:41'),
(3, 'Hostel', 'hostel', 1, '2024-12-29 04:19:00', '2024-12-29 04:19:00'),
(4, 'Hotel', 'hotel', 1, '2024-12-29 04:19:23', '2024-12-29 04:19:23');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `country_id`, `name`, `short_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Khyber Phonkhton Khwah', 'KP', 1, '2024-12-29 04:16:27', '2024-12-29 04:16:27'),
(2, 1, 'Panjab', 'PJ', 1, '2024-12-29 04:16:54', '2024-12-29 04:16:54'),
(3, 1, 'Sindth', 'ST', 1, '2024-12-29 04:17:26', '2024-12-29 04:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `resolved_tickets`
--

CREATE TABLE `resolved_tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `issue_ticket_id` bigint(20) UNSIGNED NOT NULL,
  `issue_note` text NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED NOT NULL,
  `assigned_by` bigint(20) UNSIGNED DEFAULT NULL,
  `issue_identification` text DEFAULT NULL,
  `issue_resolved_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CoqVr0tMgZbW3H4m7trkaBH8B9UVTlqs9CkbPDmb', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieDlWUnV6NEg5ckJlQ3VpMFp0b0hlZnV1OHZ1anRUbkc2TFg3YTk4OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90ZW5hbnQvYm9va2luZy9wcm9wZXJ0eS9jb21wbGFpbnRzL2NyZWF0ZS8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3MzYzMjI5MDY7fX0=', 1736330275),
('u61HgHMRsf1AODdpATV2gf0S5XbtIGtNHJi9cHW6', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVFRyT0dRNEFMcTFEUUVTWU9uN1Y5WXBmek1RaXBlUXVlWjFvQ3J4NSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9wcm9wZXJ0aWVzL25ldy1ob3N0ZWwtdmlsbGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTczNjMxNjIyMjt9fQ==', 1736328451);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subscribed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenant_contracts`
--

CREATE TABLE `tenant_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `contract_code` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `start_from` timestamp NULL DEFAULT NULL,
  `contract_period` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `signed_at` timestamp NULL DEFAULT NULL,
  `expired_at` timestamp NULL DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `commission_amount` double NOT NULL,
  `commission_paid_at` timestamp NULL DEFAULT NULL,
  `commission_verified_by` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `contract_verified_by` bigint(20) UNSIGNED DEFAULT NULL,
  `persons` int(11) NOT NULL DEFAULT 1,
  `terminated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `terminated_on` timestamp NULL DEFAULT NULL,
  `termination_reason` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenant_contracts`
--

INSERT INTO `tenant_contracts` (`id`, `property_id`, `contract_code`, `user_id`, `price`, `start_from`, `contract_period`, `link`, `signed_at`, `expired_at`, `verified_at`, `commission_amount`, `commission_paid_at`, `commission_verified_by`, `created_by`, `contract_verified_by`, `persons`, `terminated_by`, `terminated_on`, `termination_reason`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '10320785', 3, 3000, '2025-01-07 19:00:00', 5, '2134386713-2025-01-08.pdf', '2025-01-08 03:56:47', '2025-05-30 19:00:00', NULL, 1000, NULL, NULL, 2, NULL, 5, NULL, NULL, NULL, 0, '2025-01-08 03:35:32', '2025-01-08 03:56:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL DEFAULT 'male',
  `email` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `role` enum('admin','landlord','tenant','technision') NOT NULL DEFAULT 'tenant',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `company_name`, `country_id`, `province_id`, `phone`, `city`, `postcode`, `street_address`, `role`, `email_verified_at`, `password`, `remember_token`, `status`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'First', 'Landlord', 'male', 'landlord@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'landlord', NULL, '$2y$12$76MIlu1WHs9XEaPX9pX8WeRIHr7NSwSVU7TMlbjU/Ybnye9lq7/ny', NULL, '1', NULL, '2024-12-29 03:48:49', '2024-12-29 03:48:49'),
(2, 'Super', 'Admin', 'male', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', NULL, '$2y$12$hei/G3ZlwDeBV5oi//zQb.2pbNvl3w6ZQixQ42Gz3WdqOurJ6a/Bq', NULL, '1', NULL, '2024-12-29 04:13:12', '2024-12-29 04:13:12'),
(3, 'First', 'Tenant', 'male', 'tenant@gmail.com', NULL, NULL, NULL, '+923449702585', NULL, NULL, NULL, 'tenant', NULL, '$2y$12$hei/G3ZlwDeBV5oi//zQb.2pbNvl3w6ZQixQ42Gz3WdqOurJ6a/Bq', NULL, '1', NULL, '2024-12-29 06:28:14', '2025-01-01 11:59:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_enquiries`
--
ALTER TABLE `booking_enquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cotact_links`
--
ALTER TABLE `cotact_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquires`
--
ALTER TABLE `enquires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspections`
--
ALTER TABLE `inspections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection_contents`
--
ALTER TABLE `inspection_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intrested_properties`
--
ALTER TABLE `intrested_properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_property_id_foreign` (`property_id`);

--
-- Indexes for table `issue_tickets`
--
ALTER TABLE `issue_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_ticket_invoices`
--
ALTER TABLE `issue_ticket_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_ticket_types`
--
ALTER TABLE `issue_ticket_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landlord_contracts`
--
ALTER TABLE `landlord_contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landlord_contracts_property_id_foreign` (`property_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_features`
--
ALTER TABLE `property_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_has_many_features`
--
ALTER TABLE `property_has_many_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_has_many_features_property_id_foreign` (`property_id`),
  ADD KEY `property_has_many_features_property_feature_id_foreign` (`property_feature_id`);

--
-- Indexes for table `property_quries`
--
ALTER TABLE `property_quries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provinces_country_id_foreign` (`country_id`);

--
-- Indexes for table `resolved_tickets`
--
ALTER TABLE `resolved_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_contracts`
--
ALTER TABLE `tenant_contracts`
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
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_enquiries`
--
ALTER TABLE `booking_enquiries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cotact_links`
--
ALTER TABLE `cotact_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enquires`
--
ALTER TABLE `enquires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspections`
--
ALTER TABLE `inspections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspection_contents`
--
ALTER TABLE `inspection_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intrested_properties`
--
ALTER TABLE `intrested_properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `issue_tickets`
--
ALTER TABLE `issue_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_ticket_invoices`
--
ALTER TABLE `issue_ticket_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_ticket_types`
--
ALTER TABLE `issue_ticket_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landlord_contracts`
--
ALTER TABLE `landlord_contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_features`
--
ALTER TABLE `property_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_has_many_features`
--
ALTER TABLE `property_has_many_features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_quries`
--
ALTER TABLE `property_quries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resolved_tickets`
--
ALTER TABLE `resolved_tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenant_contracts`
--
ALTER TABLE `tenant_contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `landlord_contracts`
--
ALTER TABLE `landlord_contracts`
  ADD CONSTRAINT `landlord_contracts_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_has_many_features`
--
ALTER TABLE `property_has_many_features`
  ADD CONSTRAINT `property_has_many_features_property_feature_id_foreign` FOREIGN KEY (`property_feature_id`) REFERENCES `property_features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_has_many_features_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `provinces_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
