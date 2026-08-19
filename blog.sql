-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2026 at 11:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('whitecliffe-clothhouse-cache-7f3ab4f9e7b8d0da3fd6ace8e33c28ec', 'i:1;', 1787128850),
('whitecliffe-clothhouse-cache-7f3ab4f9e7b8d0da3fd6ace8e33c28ec:timer', 'i:1787128850;', 1787128850),
('whitecliffe-clothhouse-cache-c525a5357e97fef8d3db25841c86da1a', 'i:1;', 1787128683),
('whitecliffe-clothhouse-cache-c525a5357e97fef8d3db25841c86da1a:timer', 'i:1787128683;', 1787128683),
('whitecliffe-clothhouse-cache-e54226ac164d56ba5d7f876e5b36d5bc', 'i:1;', 1787128889),
('whitecliffe-clothhouse-cache-e54226ac164d56ba5d7f876e5b36d5bc:timer', 'i:1787128888;', 1787128888);

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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 12, '2026-08-18 06:07:07', '2026-08-18 06:07:07'),
(2, 4, '2026-08-18 06:10:24', '2026-08-18 06:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, '2026-08-18 06:07:07', '2026-08-18 06:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Mens Shirt', 'mens-shirt', '2026-08-18 05:40:48', '2026-08-18 05:40:48'),
(2, 'Women T Shirt', 'women-t-shirt', '2026-08-18 06:30:14', '2026-08-18 06:30:14'),
(3, 'jeans', 'jeans', '2026-08-18 07:26:35', '2026-08-18 07:26:35');

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
(4, '2026_03_10_021618_create_posts_table', 2),
(6, '2026_04_16_044228_add_role_to_users_table', 3),
(7, '2026_08_18_084243_update_role_default_on_users_table', 4),
(8, '2026_08_18_084407_create_categories_table', 4),
(9, '2026_08_18_084447_create_products_table', 4),
(10, '2026_08_18_084554_create_orders_table', 4),
(11, '2026_08_18_084748_create_order_items_table', 4),
(12, '2026_08_18_084856_create_carts_table', 4),
(13, '2026_08_18_105559_drop_posts_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `shipping_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_amount`, `shipping_address`, `created_at`, `updated_at`) VALUES
(1, 4, 'delivered', 100.00, 'hhihi', '2026-08-18 06:10:52', '2026-08-18 06:27:00'),
(3, 4, 'delivered', 100.00, 'auckland', '2026-08-18 07:00:52', '2026-08-18 07:01:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 100.00, '2026-08-18 06:10:52', '2026-08-18 06:10:52'),
(2, 3, 1, 1, 100.00, '2026-08-18 07:00:52', '2026-08-18 07:00:52');

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, 4, 'The Best DevOps Blogs', 'The term “DevOps” seems to be everywhere these days, but I’ve found that understanding what it truly means and how it’s applied in practice can be surprisingly tricky. It’s a broad term that touches on everything from cultural philosophies and automation tools to specific practices like continuous integration and infrastructure as code. It can mean different things to different teams and organizations.', '2026-04-15 22:58:56', '2026-04-15 22:58:56'),
(2, 4, 'The Best Engineering Blogs...', 'The... world offf tech and software development evolves fast, with new frameworks and libraries advancing all the time. It’s important to stay tuned in, or you could be left behind. To make that less of a challenge, I’ve handpicked thirty engineering blogs that you should follow or at least bookmark for future reference.', '2026-04-15 22:59:16', '2026-04-16 03:35:54'),
(4, 5, 'A Best Cybersecurity Blogs', 'A the amount of data that companies create and use continues to grow, cybersecurity measures have to grow, too. Malicious attacks such as phishing, denial of service (DoS), and malware, cybersecurity risks can come from within an organization or from outside actors.', '2026-04-15 23:01:51', '2026-04-16 01:16:52'),
(6, 4, 'A Top blog websites', 'A Top blog websites and platforms for 2026 include WordPress.org (best for total control), WordPress.com and Wix (fast, easy setup), and Medium (built-in audience). For newsletters, Substack and Beehiiv are popular choices. Blogger remains a simple, free option, while Ghost is ideal for professional content creators', '2026-04-16 01:34:30', '2026-04-16 02:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `reorder_threshold` int(10) UNSIGNED NOT NULL DEFAULT 5,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `stock_quantity`, `reorder_threshold`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mens Blue fancy Shirt', 'mens-fancy-shirt-ax1p8h', 'Fancy Cloth', 100.00, 1, 5, 'products/813NnX8sQJgvb6ZsqSz3fziQIvypSFyNlSpNWoRl.jpg', 1, '2026-08-18 05:43:08', '2026-08-18 07:00:52'),
(2, 2, 'T Shirt', 't-shirt-WAQxrl', 'fancy', 69.88, 100, 5, 'products/91fT66orcjdYxR4hIZjrekhOw4SqVhcoJDflfgy3.jpg', 1, '2026-08-18 07:21:59', '2026-08-18 07:21:59'),
(3, 2, 'Women T Shirt', 'women-t-shirt-VvzXvu', 'fancy', 80.00, 100, 5, 'products/BOdyTS1ICNgKHr6WRcA5wl9DymHJJC8gCd3sprRy.jpg', 1, '2026-08-18 07:22:33', '2026-08-18 07:22:33'),
(4, 2, 'Grey mens t Shirt', 'grey-mens-t-shirt-c1abxe', 'fancy', 100.00, 100, 5, 'products/AxdaVzIvTtpwGJE7cl2jmNKjPsuIpvCL97tAcfrQ.jpg', 1, '2026-08-18 07:25:12', '2026-08-18 07:28:51'),
(5, 3, 'Blue Jeans', 'blue-jeans-lLHdt3', 'fancy', 200.00, 100, 5, 'products/54ZlCueUZkQ7OOJXTLii5jDw4QSDyeo4eHRrlSLS.jpg', 1, '2026-08-18 07:27:24', '2026-08-18 07:27:24'),
(6, 3, 'mens jeans', 'mens-jeans-9xHwz7', 'fancy', 200.00, 100, 5, 'products/7WDTGbPHuVPEXxfiYfbEBfUcW3UUR5fyqkVYFFbX.jpg', 1, '2026-08-18 07:28:06', '2026-08-18 07:28:06');

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
('0DTIYyYq39Dl2kXeGhRdfTydw0YDkj0s1M6zzRND', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZkhWUmRFcnlBaW04OE50ODVRWWVzSzdyU2IyVlhYN25pQzYzQ21nZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy8xIjtzOjU6InJvdXRlIjtzOjEzOiJwcm9kdWN0cy5zaG93Ijt9czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3VzZXJzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7fQ==', 1787053038),
('fPoVNo6aizhYlRnJ9PBjfZPx0kpKiayxw2To86a4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjVUQTY4UU1lSnJHODQ0YVhqSE42czRFY2NZSVl4ZVNRazFXRXk0RSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1787128604),
('iyE5KqrC22Vf0zs0TeHAeBK6Tm9hMqnV7qzcDcIh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ0lxcm8zUkhEa3owQ2tlZXdhZlFNdm9CdUxvbWFYdWhGclFNaW5VNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1787112625),
('J5wukoKRWK5cUHYUUkFYJ17fDfm7aT4DEOmPwQtU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTFdmWkFYRVhEZWRuSk5ZQVVKWmpHWWFZZEE4d3ZGcXMxNXhwazF4RSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdHMuaW5kZXgiO319', 1787128857),
('M1lmxP0Y05jRiTHRMhC5zIHkcTTSPKNOGR6QCgVZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMElVa0xzeHRzUGp1b2VuUWhQOExNbzQ3WTk1NmlhVERQV1JpVHJWeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdHMuaW5kZXgiO319', 1787053366),
('qpTOnzb4DvVBCVNtUzuvYRUhbocUxFyDM7vB0BO4', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVnM1eEpnb3lqZThwQ0ppNXhqSU0wckVUbjhWNmNXNnZqeG9JVGlmSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoyMDoiYWRtaW4ucHJvZHVjdHMuaW5kZXgiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O30=', 1787057554),
('XtgsesIwqe2KzkicqsJc3bevGkPaQNVMHmdxiXku', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajRLWTllQnhKWkk2WnJ2VXdxbVl4V21pU2R3QWk2RXU3REk5aE01cCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdHMuaW5kZXgiO319', 1787057965);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(4, 'Kartikbansal', 'kartik@gmail.com', NULL, '$2y$12$4D9WJjmD0hHYACR06Kju1e64zx6yZ9hTgN3SN1ZLRLK2zmqmGinbS', 'DnmgkDoH3nrzoHfWzGc6eOFjdhvBx0N4CGuk8XNS4FwYOZiPDxpyOgtyqma8', '2026-04-15 22:57:31', '2026-04-16 02:50:17', 'customer'),
(5, 'Kartik2', 'Kartik2@gmail.com', NULL, '$2y$12$.ETzJfjgXbi1UgS/gq7nsOiVtI/hWeS3GigxXZOebVLqVabDOSO76', NULL, '2026-04-15 23:01:33', '2026-04-15 23:01:33', 'customer'),
(6, 'admin', 'admin@gmail.com', NULL, '$2y$12$cBcEhtQ/ewPPFwNLFqFnJu61y1a7ZC3S6Ia69YrC9XmLAnUVmqqdG', 'H65vifQ1J2TlBgg8oNJtERkpLCjSphTV3f3LgznjSlFtkISILkcVtTU4dXvD', '2026-04-15 23:44:58', '2026-04-15 23:44:58', 'admin'),
(7, 'kartik202', 'kartik202@gmail.com', NULL, '$2y$12$IEhHAI65IZQ2UWbv.75SuOAPlK1PBU.rWc.QXRMdl/blo1zqaIYO2', NULL, '2026-04-16 02:51:27', '2026-04-16 03:38:10', 'customer'),
(8, 'Karti', 'karti@gmail.com', NULL, '$2y$12$4zzy7DslPRbgIur4lGLXs.0YIC5btd30IAo5xQeEmbNoaZrolSs6K', NULL, '2026-04-16 03:40:20', '2026-04-16 03:40:20', 'customer'),
(12, 'kartik30', 'kartik30@gmail.com', NULL, '$2y$12$DXzHjde7yHi6.efu8zjcieapVSl8/83MTjz45v3qI6fPbhY2Ll0x2', 'bWNK9KOmCNkJz8RXnyRF0A1xDQVJjTRpMLHMc0lmM9Qpr27dRZ3JWgHtIcwl', '2026-08-18 05:46:27', '2026-08-19 02:03:24', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_user_id_unique` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cart_items_cart_id_product_id_unique` (`cart_id`,`product_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_status_index` (`status`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_is_active_category_id_index` (`is_active`,`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
