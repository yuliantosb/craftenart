-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2018 at 01:38 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `craftenartv3`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `feature_image`, `description`, `created_at`, `updated_at`) VALUES
(6, 'Pillow', 'pillow', '1523091441_1963700261.jpg', '<p>Vestibulum in turpis a ipsum cursus tincidunt. Fusce iaculis lectus vel felis luctus scelerisque. Nam blandit et velit ac ultricies. Nullam eu lorem et nunc consectetur pulvinar at nec orci. Morbi consequat ante eget ante tincidunt pulvinar. Quisque molestie tincidunt viverra. Nullam luctus urna dui. Nullam sed nisl id nibh ultrices dignissim vitae vulputate sapien. Morbi suscipit arcu ac tortor iaculis bibendum. Aenean faucibus, est non euismod rhoncus, orci libero lacinia dui, eu facilisis leo elit et nulla. Integer eget viverra sapien, sed semper magna.</p>', '2018-04-08 01:32:26', '2018-04-08 01:32:26'),
(7, 'Keychain', 'keychain', '1523174374_1291896013.jpg', '<p>Sed lacinia molestie nunc, laoreet finibus urna ultrices nec. Aliquam a velit viverra, pellentesque sapien sed, euismod sapien. Cras varius rhoncus quam, non vestibulum urna cursus vel. Ut viverra sit amet augue quis porta. Nulla mollis turpis risus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus ut tempor nunc. Pellentesque at facilisis felis, at imperdiet elit. Phasellus pretium enim non neque ullamcorper luctus. Nulla in ornare nisl. Nulla vestibulum gravida dolor vitae aliquam.</p>', '2018-04-08 01:32:58', '2018-04-08 01:32:58'),
(8, 'Plush', 'plush', '1523091442_1132988588.jpg', '<p>Nunc accumsan pellentesque mi in malesuada. Praesent facilisis ipsum ut enim vestibulum, nec faucibus sem rhoncus. Etiam ligula mi, luctus a congue et, auctor id sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu facilisis nulla. Morbi vitae mattis enim, vitae aliquet urna. Pellentesque nunc arcu, aliquet eget tristique ut, rhoncus vel purus. Aenean purus urna, elementum pretium blandit a, euismod quis metus. Proin ornare imperdiet turpis, auctor tristique nisi ultricies et. Pellentesque a pellentesque orci. Sed varius fringilla urna, in tempor urna lobortis non. Etiam est libero, pharetra at tincidunt sed, porta sed metus.</p>', '2018-04-08 01:43:49', '2018-04-08 01:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `type` int(11) DEFAULT '0',
  `valid_thru` date NOT NULL,
  `exclude_item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exclude_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_single_user` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `convertion` double NOT NULL,
  `thousand_separator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `decimal_separator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `alias`, `code`, `symbol`, `convertion`, `thousand_separator`, `decimal_separator`, `created_at`, `updated_at`) VALUES
(1, 'USD', 'usd', '840', '$', 1, ',', '.', NULL, NULL),
(2, 'IDR', 'idr', '360', 'Rp. ', 14000, '.', ',', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identity_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `sex` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` double(20,2) NOT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `size`, `alt`, `description`, `created_at`, `updated_at`) VALUES
(4, '1523091440_941947773.jpg', 55751.00, '1505033387_520952711', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(5, '1523091441_540051495.jpg', 42575.00, '1505033387_2048754791', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(6, '1523091441_702136196.jpg', 92106.00, '1505033388_814253677', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(7, '1523091441_972877992.jpg', 65042.00, '1505033388_1072843330', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(8, '1523091441_651292559.jpg', 42747.00, '1505033388_1143256004', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(9, '1523091441_1299041992.jpg', 45764.00, '1505033388_1200328047', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(10, '1523091441_1293348271.jpg', 117974.00, '1505033389_182124064', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(11, '1523091441_398560140.jpg', 54868.00, '1505033389_770253609', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(12, '1523091441_1534982947.jpg', 55823.00, '1505033389_1483754457', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(13, '1523091441_763685851.jpg', 45764.00, '1505033389_1564331740', NULL, '2018-04-07 01:57:21', '2018-04-07 01:57:21'),
(14, '1523091441_1963700261.jpg', 44550.00, '1505033390_1026595619', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(15, '1523091442_1430491826.jpg', 50355.00, '1505033390_1131137160', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(16, '1523091442_1731552160.jpg', 45750.00, '1505033390_1684707542', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(17, '1523091442_1633869597.jpg', 39417.00, '1505033391_565086388', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(18, '1523091442_219948532.jpg', 42989.00, '1505033391_866325790', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(19, '1523091442_1026346096.jpg', 45092.00, '1505033391_1060559879', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(20, '1523091442_1106363963.jpg', 53019.00, '1505033391_1083794922', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(21, '1523091442_80413326.jpg', 43705.00, '1505033392_960692221', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(22, '1523091442_793485243.jpg', 67412.00, '1505033392_1868043995', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(23, '1523091442_1132988588.jpg', 76750.00, '1505033392_2140069668', NULL, '2018-04-07 01:57:22', '2018-04-07 01:57:22'),
(24, '1523174374_1291896013.jpg', 116333.00, '5680048', NULL, '2018-04-08 00:59:34', '2018-04-08 00:59:34'),
(25, '1523174449_1896286883.jpg', 106860.00, '61sF6qhqcbL._SL1500_', NULL, '2018-04-08 01:00:49', '2018-04-08 01:00:49'),
(26, '1523174761_2130110311.jpg', 68856.00, 'P1194_701-00892_01', NULL, '2018-04-08 01:06:01', '2018-04-08 01:06:01'),
(27, '1523356438_317184553.jpg', 35879.00, 'img04', NULL, '2018-04-10 03:33:58', '2018-04-10 03:33:58'),
(28, '1523356438_368345398.jpg', 35689.00, 'img05', NULL, '2018-04-10 03:33:58', '2018-04-10 03:33:58'),
(29, '1523356438_2073116297.jpg', 72444.00, 'img06', NULL, '2018-04-10 03:33:58', '2018-04-10 03:33:58');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2018_03_26_033658_create_orders_table', 2),
(5, '2018_03_30_155208_entrust_setup_tables', 3),
(12, '2018_03_31_083405_create_product_galleries_table', 5),
(18, '2018_03_31_083045_create_stocks_table', 7),
(19, '2018_03_31_084706_create_stock_details_table', 7),
(20, '2018_03_31_082715_create_products_table', 8),
(21, '2018_03_31_125335_create_media_table', 9),
(22, '2018_03_31_154435_create_product_tag_table', 10),
(24, '2018_03_31_083444_create_product_attributes_table', 11),
(26, '2018_03_31_082856_create_categories_table', 12),
(27, '2018_03_31_082958_create_tags_table', 12),
(28, '2018_04_01_030457_create_currencies_table', 12),
(29, '2018_04_02_043849_create_ships_table', 13),
(30, '2018_04_02_044027_create_customers_table', 13),
(31, '2018_03_31_154509_create_product_category_table', 14),
(32, '2018_04_02_044232_create_coupons_table', 14),
(33, '2018_03_31_084205_create_reviews_table', 15),
(34, '2018_04_10_063424_create_order_details_table', 16),
(35, '2018_04_10_101710_create_settings_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(20,2) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `payment_date` date DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_channel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_approval_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_session_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `number`, `amount`, `name`, `phone`, `email`, `address`, `payment_date`, `payment_status`, `payment_channel`, `payment_approval_code`, `payment_session_id`, `created_at`, `updated_at`) VALUES
(1, '199193061', 90.00, 'Yulianto', '089611081675', 'yulianto.saparudin@gmail.com', 'Jl. Sukacita No 90', '2018-04-10', 'success', 'credit card', NULL, NULL, NULL, NULL),
(2, '199193062', 90.00, 'Yulianto', '089611081675', 'yulianto.saparudin@gmail.com', 'Jl. Sukacita No 90', '2018-04-10', 'success', 'credit card', NULL, NULL, NULL, NULL),
(3, '199193063', 90.00, 'Yulianto', '089611081675', 'yulianto.saparudin@gmail.com', 'Jl. Sukacita No 90', '2018-04-10', 'success', 'credit card', NULL, NULL, NULL, NULL),
(4, '199193064', 90.00, 'Yulianto', '089611081675', 'yulianto.saparudin@gmail.com', 'Jl. Sukacita No 90', '2018-04-10', 'success', 'credit card', NULL, NULL, NULL, NULL),
(5, '199193065', 90.00, 'Yulianto', '089611081675', 'yulianto.saparudin@gmail.com', 'Jl. Sukacita No 90', '2018-04-10', 'success', 'credit card', NULL, NULL, NULL, NULL),
(6, '199193066', 90.00, 'Yulianto', '089611081675', 'yulianto.saparudin@gmail.com', 'Jl. Sukacita No 90', '2018-04-10', 'success', 'credit card', NULL, NULL, NULL, NULL),
(7, '199193067', 90.00, 'Yulianto', '089611081675', 'yulianto.saparudin@gmail.com', 'Jl. Sukacita No 90', '2018-04-10', 'success', 'credit card', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` double(20,2) NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `coupon_code`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 40.00, NULL, 1, NULL, NULL),
(2, 2, 1, 40.00, NULL, 1, NULL, NULL),
(3, 3, 2, 40.00, NULL, 1, NULL, NULL),
(4, 3, 1, 40.00, NULL, 1, NULL, NULL),
(5, 4, 4, 40.00, NULL, 1, NULL, NULL),
(6, 5, 4, 40.00, NULL, 1, NULL, NULL),
(7, 6, 4, 40.00, NULL, 1, NULL, NULL),
(8, 7, 4, 40.00, NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(20,2) NOT NULL,
  `sale` double(20,2) DEFAULT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` bigint(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `picture`, `slug`, `price`, `sale`, `sku`, `weight`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Teddy Bear', '1523091442_1132988588.jpg', 'teddy-bear-1', 30.00, NULL, 'TEDDY001', 250, '<p>Nunc accumsan pellentesque mi in malesuada. Praesent facilisis ipsum ut enim vestibulum, nec faucibus sem rhoncus. Etiam ligula mi, luctus a congue et, auctor id sem. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu facilisis nulla. Morbi vitae mattis enim, vitae aliquet urna. Pellentesque nunc arcu, aliquet eget tristique ut, rhoncus vel purus. Aenean purus urna, elementum pretium blandit a, euismod quis metus. Proin ornare imperdiet turpis, auctor tristique nisi ultricies et. Pellentesque a pellentesque orci. Sed varius fringilla urna, in tempor urna lobortis non. Etiam est libero, pharetra at tincidunt sed, porta sed metus.</p>', '2018-04-08 01:34:14', '2018-04-08 01:44:14'),
(2, 'Racoon', '1523091442_219948532.jpg', 'racoon-1', 20.00, NULL, 'RACOON001', 350, '<p>Vestibulum in turpis a ipsum cursus tincidunt. Fusce iaculis lectus vel felis luctus scelerisque. Nam blandit et velit ac ultricies. Nullam eu lorem et nunc consectetur pulvinar at nec orci. Morbi consequat ante eget ante tincidunt pulvinar. Quisque molestie tincidunt viverra. Nullam luctus urna dui. Nullam sed nisl id nibh ultrices dignissim vitae vulputate sapien. Morbi suscipit arcu ac tortor iaculis bibendum. Aenean faucibus, est non euismod rhoncus, orci libero lacinia dui, eu facilisis leo elit et nulla. Integer eget viverra sapien, sed semper magna.</p>', '2018-04-08 01:35:57', '2018-04-08 01:44:39'),
(4, 'Simba', '1523091442_80413326.jpg', 'simba', 25.00, NULL, 'SIMBA01', 280, '<p>Sed lacinia molestie nunc, laoreet finibus urna ultrices nec. Aliquam a velit viverra, pellentesque sapien sed, euismod sapien. Cras varius rhoncus quam, non vestibulum urna cursus vel. Ut viverra sit amet augue quis porta. Nulla mollis turpis risus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus ut tempor nunc. Pellentesque at facilisis felis, at imperdiet elit. Phasellus pretium enim non neque ullamcorper luctus. Nulla in ornare nisl. Nulla vestibulum gravida dolor vitae aliquam.</p>', '2018-04-08 01:59:07', '2018-04-08 01:59:07'),
(6, 'Siberian Husky', '1523174374_1291896013.jpg', 'siberian-husky', 5.00, NULL, 'HUSKY001', 120, '<p>Phasellus blandit urna vitae augue aliquet ornare. Ut lectus ligula, tincidunt a ex sed, pretium ullamcorper sapien. Morbi quis dignissim nunc. Vestibulum rutrum facilisis dolor et tincidunt. Nam sed ante id lacus ultricies pellentesque ut ac ipsum. Vivamus vehicula laoreet lorem, non volutpat nibh molestie in. Sed eu molestie tortor. Ut faucibus varius eros, et pellentesque massa placerat id. Ut nec massa viverra, finibus tellus at, vehicula urna.</p>', '2018-04-08 02:03:45', '2018-04-08 02:03:45'),
(7, 'Poop', '1523091442_1731552160.jpg', 'poop', 65.00, NULL, 'POOP1', 250, '<p>Phasellus blandit urna vitae augue aliquet ornare. Ut lectus ligula, tincidunt a ex sed, pretium ullamcorper sapien. Morbi quis dignissim nunc. Vestibulum rutrum facilisis dolor et tincidunt. Nam sed ante id lacus ultricies pellentesque ut ac ipsum. Vivamus vehicula laoreet lorem, non volutpat nibh molestie in. Sed eu molestie tortor. Ut faucibus varius eros, et pellentesque massa placerat id. Ut nec massa viverra, finibus tellus at, vehicula urna.</p>', '2018-04-08 02:09:29', '2018-04-08 02:09:29'),
(8, 'Pug', '1523091442_1633869597.jpg', 'pug', 10.00, NULL, 'PUG001', 350, '<p>Nam fringilla fringilla varius. Praesent non justo ipsum. Curabitur eget nisl ultrices, fermentum nisi ac, dictum nisl. Pellentesque dignissim, risus a tincidunt faucibus, nisl turpis volutpat nisi, posuere blandit orci felis sit amet libero. Etiam rhoncus mollis risus sit amet finibus. Donec malesuada purus a ante dapibus tempor. Nam finibus risus sem, a consequat metus malesuada sit amet.</p>', '2018-04-08 02:14:47', '2018-04-08 02:14:47'),
(9, 'German Shepheard', '1523091440_941947773.jpg', 'german-shepheard', 15.00, NULL, 'GERMAN01', 350, '<p>In ac arcu vel quam volutpat mollis nec vitae nulla. Donec ipsum justo, facilisis vitae venenatis vel, porttitor vitae metus. Donec ac lacinia mauris. Sed pulvinar leo sit amet nisl ornare, id ullamcorper arcu volutpat. Cras posuere neque nec tellus interdum, ac vehicula lorem tincidunt. Aenean finibus fermentum nunc ut rutrum. Nulla non nisl non mauris commodo convallis eu consequat metus. Ut ultrices sit amet arcu ac lobortis.&nbsp;</p>', '2018-04-08 02:15:55', '2018-04-08 02:15:55'),
(10, 'Santa Claus', '1523091441_1299041992.jpg', 'santa-claus', 20.00, NULL, 'SANTA001', 260, '<p>Donec congue consequat velit non laoreet. Nam vulputate tortor tincidunt, interdum massa eget, varius neque. Aliquam odio justo, hendrerit ut suscipit vitae, feugiat non massa. Nulla dui lacus, condimentum eget lacus eu, ultrices mollis velit. Quisque consequat dui neque.</p>', '2018-04-08 02:18:03', '2018-04-08 02:18:03'),
(11, 'Pokemon Scary', '1523174449_1896286883.jpg', 'pokemon-scary', 25.00, NULL, 'POKEMON01', 160, '<p>Vestibulum finibus nisi sed justo luctus, a consectetur mauris molestie. Etiam in varius magna. Duis lacus mi, pulvinar id dui eget, elementum efficitur lectus. Duis nec pretium turpis, a rhoncus eros. Sed consectetur vel nisl eget porttitor. Pellentesque cursus a nisi non laoreet. Duis fermentum odio orci, sed lacinia nunc malesuada in. Sed quis maximus massa, venenatis sollicitudin mi.</p>', '2018-04-08 02:19:17', '2018-04-08 02:19:17'),
(12, 'Green Angrybird', '1523091441_763685851.jpg', 'green-angrybird', 52.00, 48.00, 'ANGRY001', 420, '<p>In mattis, eros quis laoreet cursus, massa orci gravida sapien, vel cursus est turpis a ligula. Vivamus euismod hendrerit quam nec suscipit. Curabitur eget ligula ut metus vulputate vehicula ac non diam. Curabitur at neque ut erat euismod luctus. Sed nisi nulla, venenatis non mauris sed, finibus tempus arcu. Pellentesque congue nulla cursus tristique suscipit.</p>', '2018-04-08 02:20:46', '2018-04-08 02:20:46'),
(13, 'Blue Angrybird', '1523091442_1430491826.jpg', 'blue-angrybird', 72.00, NULL, 'ANGRY002', 120, '<p>Pellentesque eros nunc, semper in varius a, auctor eget magna. Ut semper lacus augue, at egestas velit condimentum vel. Duis convallis feugiat turpis sit amet tempus. Morbi vulputate libero quis elit ullamcorper vehicula. Fusce viverra quam sed neque mollis tempor. Proin eu ante tristique enim pulvinar ultrices eu in neque. Donec hendrerit mauris vel odio lacinia vehicula. Maecenas facilisis diam ut turpis efficitur viverra. Morbi vulputate risus vitae lorem vestibulum, sed convallis libero efficitur.</p>', '2018-04-08 02:21:53', '2018-04-08 02:21:53'),
(14, 'Green Pig', '1523091441_1534982947.jpg', 'green-pig', 120.00, 100.00, 'ANGRY003', 450, '<p>Donec rutrum scelerisque hendrerit. Aliquam non feugiat lorem. Nam at mi in arcu maximus iaculis eget in orci. Donec purus arcu, iaculis non ante nec, tempor varius est. In hac habitasse platea dictumst. Duis nec diam velit. Aliquam purus sapien, elementum vitae pharetra quis, mattis sed lacus.</p>', '2018-04-08 02:23:26', '2018-04-08 02:23:26'),
(15, 'Lion', '1523091441_398560140.jpg', 'lion', 65.00, 40.00, 'LION01', 4, '<p>Nullam non sapien tempus, posuere nisl eget, tristique erat. Pellentesque quis euismod quam, at aliquam eros. Donec et euismod ligula, at condimentum augue. Integer elementum, nisl blandit rhoncus finibus, ipsum metus accumsan dui, non efficitur tortor nunc id mauris. Sed nec lacus porttitor, vulputate ipsum et, lobortis metus. Cras finibus pellentesque semper.&nbsp;</p>', '2018-04-08 02:26:38', '2018-04-08 02:26:38'),
(17, 'Pikachu', '1523174761_2130110311.jpg', 'pikachu', 5.00, NULL, 'POKEMON01', 100, '<p>Phasellus mattis libero nunc, quis pulvinar nunc tincidunt sit amet. Sed lacinia leo elementum metus ultricies, id viverra tellus porta. Pellentesque ac felis egestas, tempus ligula in, cursus felis. In malesuada dolor et scelerisque feugiat. Duis sit amet dolor scelerisque, ornare purus eget, vehicula orci. Duis nec hendrerit ligula. Nulla ac lacus bibendum, pellentesque leo at, sodales tortor.</p>', '2018-04-08 02:27:57', '2018-04-08 04:44:25'),
(18, 'Omayte', '1523091441_972877992.jpg', 'omayte', 25.00, NULL, 'POKEMON02', 380, '<p>Nulla non purus pellentesque, tincidunt ligula nec, egestas nisi. Mauris sed sem urna. Proin sit amet egestas nisi, vel elementum erat. Maecenas non suscipit sem. Etiam fermentum mi urna. Maecenas magna libero, scelerisque in dapibus eu, efficitur auctor quam. Mauris hendrerit lectus vehicula ex cursus ullamcorper.&nbsp;</p>', '2018-04-08 02:29:11', '2018-04-08 02:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(1, 8),
(2, 8),
(4, 6),
(6, 7),
(7, 6),
(8, 8),
(9, 8),
(10, 8),
(11, 7),
(12, 6),
(13, 8),
(14, 6),
(15, 8),
(16, 8),
(17, 7),
(18, 8);

-- --------------------------------------------------------

--
-- Table structure for table `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`) VALUES
(1, 1),
(1, 2),
(2, 9),
(2, 10),
(4, 9),
(4, 11),
(6, 9),
(6, 14),
(7, 12),
(7, 13),
(8, 9),
(8, 14),
(9, 9),
(9, 14),
(10, 15),
(10, 16),
(11, 15),
(11, 17),
(12, 15),
(12, 18),
(13, 15),
(13, 18),
(14, 15),
(14, 18),
(15, 9),
(15, 19),
(16, 9),
(16, 19),
(17, 15),
(17, 17),
(18, 15),
(18, 17);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `rate`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 'Good as fuck', 1, NULL, NULL),
(2, 2, 1, 4, 'Good but just so so', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `content_en`, `content_id`, `created_at`, `updated_at`) VALUES
(1, 'banner', '[{\"img\" : \"1523356438_317184553.jpg\",\"align\" : \"centerize\",\"title\" : \"Future Design Idea\",\"header\" : \"Pendant Lamp\",\"subheader\" : \"Luxury and Glamour\",\"content\" : \"Lorem ipsum adalah sebuah text dummy untuk membuat data dummy\", \"url\" : \"shop/pendant-lamp\", \"url_text\" : \"Cekedot\"},{\"img\" : \"1523356438_368345398.jpg\",\"align\" : \"right\",\"title\" : \"Saya adalah Banner\",\"header\" : \"Banner Saya\",\"subheader\" : \"Saya dan Banner adalah sama\",\"content\" : \"Tidak ada yang dapat dibedakan antara saya dan Banner\",\"url\" : \"shop/banner-adalah-saya\",\"url_text\" : \"Capcus Cyin\"},{\"img\" : \"1523356438_2073116297.jpg\",\"align\" : \"left\",\"title\" : \"Kami adalah Ibu Indonesia\",\"header\" : \"Ibu Indonesia\",\"subheader\" : \"Saya tidak tahu syariat islam\",\"content\" : \"Yang kutahu sari konde ibu Indonesia sangatlah indah Lebih cantik dari cadar dirimu\",\"url\" : \"shop/ibu-indonesia\",\"url_text\" : \"Take Beer\"}]', '[\n{\n\"img\" : \"1523356438_317184553.jpg\",\n\"align\" : \"centerize\",\n\"title\" : \"Future Design Idea\"\n\"header\" : \"Pendant Lamp\"\n\"subheader\" : \"Luxury and Glamour\"\n\"content\" : \"Lorem ipsum adalah sebuah text dummy untuk membuat data dummy\"\n\"url\" : \"shop/pendant-lamp\"\n\"url_text\" : \"Cekedot\"\n},\n{\n\"img\" : \"1523356438_368345398.jpg\",\n\"align\" : \"right\",\n\"title\" : \"Saya adalah Banner\"\n\"header\" : \"Banner adalah saya\"\n\"subheader\" : \"Saya dan Banner adalah sama\"\n\"content\" : \"Tidak ada yang dapat dibedakan antara saya dan Banner\"\n\"url\" : \"shop/banner-adalah-saya\"\n\"url_text\" : \"Capcus Cyin\"\n},\n{\n\"img\" : \"1523356438_2073116297.jpg\",\n\"align\" : \"left\",\n\"title\" : \"Kami adalah Ibu Indonesia\"\n\"header\" : \"Ibu Indonesia engkau adalah ciri khas negeri ini\"\n\"subheader\" : \"Saya tidak tahu syariat islam\"\n\"content\" : \"Yang kutahu sari konde ibu Indonesia sangatlah indah Lebih cantik dari cadar dirimu\"\n\"url\" : \"shop/ibu-indonesia\"\n\"url_text\" : \"Take Beer\"\n}\n]', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

CREATE TABLE `ships` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `courier_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_weight` double DEFAULT NULL,
  `cost` double DEFAULT NULL,
  `service_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_description` text COLLATE utf8mb4_unicode_ci,
  `estimate_delivery` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `amount`, `created_at`, `updated_at`) VALUES
(4, 1, 10, '2018-04-08 01:44:14', '2018-04-08 01:44:14'),
(5, 2, 5, '2018-04-08 01:44:39', '2018-04-08 01:44:39'),
(6, 4, 5, '2018-04-08 01:59:07', '2018-04-08 01:59:07'),
(8, 6, 50, '2018-04-08 02:03:45', '2018-04-08 02:03:45'),
(9, 7, 10, '2018-04-08 02:09:29', '2018-04-08 02:09:29'),
(10, 8, 5, '2018-04-08 02:14:47', '2018-04-08 02:14:47'),
(11, 9, 12, '2018-04-08 02:15:55', '2018-04-08 02:15:55'),
(12, 10, 3, '2018-04-08 02:18:03', '2018-04-08 02:18:03'),
(13, 11, 5, '2018-04-08 02:19:17', '2018-04-08 02:19:17'),
(14, 12, 15, '2018-04-08 02:20:46', '2018-04-08 02:20:46'),
(15, 13, 5, '2018-04-08 02:21:53', '2018-04-08 02:21:53'),
(16, 14, 2, '2018-04-08 02:23:26', '2018-04-08 02:23:26'),
(17, 15, 12, '2018-04-08 02:26:38', '2018-04-08 02:26:38'),
(18, 16, 12, '2018-04-08 02:26:38', '2018-04-08 02:26:38'),
(20, 18, 6, '2018-04-08 02:29:11', '2018-04-08 02:29:11'),
(21, 17, 10, '2018-04-08 04:44:25', '2018-04-08 04:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `stock_id` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `stock_id`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'Init new product', '2018-04-08 01:34:14', '2018-04-08 01:34:14'),
(2, 2, 5, 'Init new product', '2018-04-08 01:35:57', '2018-04-08 01:35:57'),
(4, 4, 10, 'Init new product', '2018-04-08 01:44:14', '2018-04-08 01:44:14'),
(5, 5, 5, 'Init new product', '2018-04-08 01:44:39', '2018-04-08 01:44:39'),
(6, 6, 5, 'Init new product', '2018-04-08 01:59:07', '2018-04-08 01:59:07'),
(8, 8, 50, 'Init new product', '2018-04-08 02:03:45', '2018-04-08 02:03:45'),
(9, 9, 10, 'Init new product', '2018-04-08 02:09:29', '2018-04-08 02:09:29'),
(10, 10, 5, 'Init new product', '2018-04-08 02:14:47', '2018-04-08 02:14:47'),
(11, 11, 12, 'Init new product', '2018-04-08 02:15:55', '2018-04-08 02:15:55'),
(12, 12, 3, 'Init new product', '2018-04-08 02:18:03', '2018-04-08 02:18:03'),
(13, 13, 5, 'Init new product', '2018-04-08 02:19:17', '2018-04-08 02:19:17'),
(14, 14, 15, 'Init new product', '2018-04-08 02:20:46', '2018-04-08 02:20:46'),
(15, 15, 5, 'Init new product', '2018-04-08 02:21:53', '2018-04-08 02:21:53'),
(16, 16, 2, 'Init new product', '2018-04-08 02:23:26', '2018-04-08 02:23:26'),
(17, 17, 12, 'Init new product', '2018-04-08 02:26:38', '2018-04-08 02:26:38'),
(18, 18, 12, 'Init new product', '2018-04-08 02:26:38', '2018-04-08 02:26:38'),
(19, 19, 10, 'Init new product', '2018-04-08 02:27:57', '2018-04-08 02:27:57'),
(20, 20, 6, 'Init new product', '2018-04-08 02:29:11', '2018-04-08 02:29:11'),
(21, 21, 10, 'Init new product', '2018-04-08 04:44:25', '2018-04-08 04:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `feature_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `description`, `feature_image`, `created_at`, `updated_at`) VALUES
(1, 'Teddy', 'teddy', NULL, NULL, '2018-04-08 01:18:51', '2018-04-08 01:18:51'),
(2, 'Bear', 'bear', NULL, NULL, '2018-04-08 01:18:51', '2018-04-08 01:18:51'),
(9, 'Animal', 'animal', NULL, NULL, '2018-04-08 01:44:39', '2018-04-08 01:44:39'),
(10, 'Racoon', 'racoon', NULL, NULL, '2018-04-08 01:44:39', '2018-04-08 01:44:39'),
(11, 'Simba', 'simba', NULL, NULL, '2018-04-08 01:59:07', '2018-04-08 01:59:07'),
(12, 'Emoji', 'emoji', NULL, NULL, '2018-04-08 02:00:22', '2018-04-08 02:00:22'),
(13, 'Poop', 'poop', NULL, NULL, '2018-04-08 02:00:22', '2018-04-08 02:00:22'),
(14, 'Dog', 'dog', NULL, NULL, '2018-04-08 02:03:45', '2018-04-08 02:03:45'),
(15, 'Character', 'character', NULL, NULL, '2018-04-08 02:18:03', '2018-04-08 02:18:03'),
(16, 'Christmas', 'christmas', NULL, NULL, '2018-04-08 02:18:03', '2018-04-08 02:18:03'),
(17, 'Pokemon', 'pokemon', NULL, NULL, '2018-04-08 02:19:17', '2018-04-08 02:19:17'),
(18, 'Angry Bird', 'angry-bird', NULL, NULL, '2018-04-08 02:20:46', '2018-04-08 02:20:46'),
(19, 'Lion', 'lion', NULL, NULL, '2018-04-08 02:26:38', '2018-04-08 02:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Yulianto', 'yulianto.saparudin@gmail.com', 'password', NULL, NULL, NULL),
(2, 'Joel', 'joel@dev.me', 'PASSWORD', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_number_unique` (`number`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
