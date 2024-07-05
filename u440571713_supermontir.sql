-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 05, 2024 at 06:45 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u440571713_supermontir`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
('fasdfasd', 'admin@gmail.com', '$2a$12$lHr5qSEJwljb/8sWOGOtyOaKqFUdcq0Ku04wDOau4FwPkadw5PlAq', '2023-12-12 08:10:34', '2023-12-12 08:10:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `price`, `qty`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('488ea90a-750b-4cd9-8e6a-f0a18646b31d', 'b5222e15-819d-435f-82ba-3e764d93d074', '56000', 1, '91a8adef-581b-438c-a6ed-230de3e33ef0', '2024-06-04 04:54:33', '2024-06-04 04:54:33', NULL),
('73d2844c-3916-4239-8e8b-74846cad36de', 'f257cc72-bd42-4349-9b2b-0b4c40a7a185', '20000000', 1, '91a8adef-581b-438c-a6ed-230de3e33ef0', '2024-06-04 04:54:36', '2024-06-04 04:54:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
('1443f79a-beea-4c01-96b7-871e129d3c85', 'Sepeda Motor', 'http://127.0.0.1:8001/storage/image/RvroqWkCzKpWz9hhOqskPigQDppqHCXtQHKxQDXi.png', '2023-12-12 03:30:13', '2023-12-12 04:58:24', NULL),
('b5374065-d243-4253-8897-0ab08b25b766', 'Mobil', 'http://127.0.0.1:8001/storage/image/S0MmLKtf83QTHqtnQGpsOkhk42OXj4cVmkI78lL7.png', '2023-12-12 03:54:12', '2023-12-12 04:58:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `garages`
--

CREATE TABLE `garages` (
  `id` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `vehicle_type` enum('Mobil','Sepeda Motor') NOT NULL,
  `plat` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `km` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garages`
--

INSERT INTO `garages` (`id`, `merk`, `type`, `vehicle_type`, `plat`, `user_id`, `created_at`, `updated_at`, `deleted_at`, `year`, `km`) VALUES
('3f0e8639-531f-48ba-b8cf-3e859b12b279', 'Honda', 'CB 150', 'Sepeda Motor', 'AA 1234 BB', 'd7730c3b-17db-4a24-b269-64172f68e7fd', '2024-06-05 02:18:48', '2024-06-05 02:18:48', NULL, '2018', '1200'),
('9484dc1b-d9a7-4120-aa27-f64a09c4868d', 'Honda', 'Vario', 'Sepeda Motor', 'BB 1234 CC', 'd7730c3b-17db-4a24-b269-64172f68e7fd', '2024-06-05 02:19:43', '2024-06-05 02:19:43', NULL, '2018', '1000'),
('c3a204d6-edb5-4a64-a8f9-b1043dd1df8b', 'Honda', 'Mobilio', 'Mobil', 'B1334CD', '91a8adef-581b-438c-a6ed-230de3e33ef0', '2024-06-04 04:56:01', '2024-06-04 04:56:01', NULL, '2024', '16000');

-- --------------------------------------------------------

--
-- Table structure for table `item_orders`
--

CREATE TABLE `item_orders` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `cart_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_orders`
--

INSERT INTO `item_orders` (`id`, `user_id`, `cart_id`, `order_id`, `product_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('66ca85f5-a2f7-4028-a5ee-a02dd89dc40f', 'd7730c3b-17db-4a24-b269-64172f68e7fd', '0f054c16-30f8-4d15-a72c-c91385ce8baf', '7bcc3065-4e52-458a-963e-f0f7ebe239d0', 'f257cc72-bd42-4349-9b2b-0b4c40a7a185', '2024-06-05 02:23:33', '2024-06-05 02:23:33', NULL),
('a80fc4f2-624e-4411-b662-375ab7ee3f26', 'd7730c3b-17db-4a24-b269-64172f68e7fd', '957d06a5-6630-4c4a-8d67-3a4f724e7993', '7bcc3065-4e52-458a-963e-f0f7ebe239d0', 'b5222e15-819d-435f-82ba-3e764d93d074', '2024-06-05 02:23:33', '2024-06-05 02:23:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kupons`
--

CREATE TABLE `kupons` (
  `id` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `expired_at` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('selesai','proses') NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `garage_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `wa` varchar(255) NOT NULL,
  `status` enum('baru','proses','selesai') NOT NULL,
  `total` varchar(255) NOT NULL DEFAULT '0',
  `date_service` date DEFAULT NULL,
  `km` int(255) DEFAULT NULL,
  `part_penggantian` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `kupon_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `garage_id`, `address`, `name`, `wa`, `status`, `total`, `date_service`, `km`, `part_penggantian`, `note`, `kupon_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('7bcc3065-4e52-458a-963e-f0f7ebe239d0', 'd7730c3b-17db-4a24-b269-64172f68e7fd', '3f0e8639-531f-48ba-b8cf-3e859b12b279', 'Jl. Kaliurang km 6.8, Sleman, Yogyakarta', 'Muhammad Ma\'dum', '82134334545', 'baru', '20056000', NULL, NULL, NULL, NULL, NULL, '2024-06-05 02:23:33', '2024-06-05 02:23:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_payments`
--

CREATE TABLE `order_payments` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `xendit_order_id` varchar(255) DEFAULT NULL,
  `total` varchar(255) NOT NULL,
  `status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_payments`
--

INSERT INTO `order_payments` (`id`, `user_id`, `order_id`, `xendit_order_id`, `total`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('02ee6e66-42d0-4515-a80c-7df86214f663', 'd7730c3b-17db-4a24-b269-64172f68e7fd', '7bcc3065-4e52-458a-963e-f0f7ebe239d0', NULL, '20056000', 'unpaid', '2024-06-05 02:23:33', '2024-06-05 02:23:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `point` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
('b5222e15-819d-435f-82ba-3e764d93d074', 'Service, Gratis Oli', '56000', 'https://admindev.supermontir.id/storage/image/6fZu5UPdHDx8KmgN5sGsRPXyz3WuqY3XHJ1GUx7h.png', '1443f79a-beea-4c01-96b7-871e129d3c85', '<p>asdfasfd</p>', '2023-12-12 03:56:42', '2024-06-03 18:20:13', NULL),
('f257cc72-bd42-4349-9b2b-0b4c40a7a185', 'GANTI BAN PLUS BAN', '20000000', 'https://admindev.supermontir.id/storage/image/K8GtqysnxiaDkKUF7cIJo6Y1b3owf4Ep2rE9y38h.png', 'b5374065-d243-4253-8897-0ab08b25b766', 'Ganti Ban', '2023-12-12 05:03:55', '2024-06-03 18:20:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `wa` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `wa`, `password`, `jenis_kelamin`, `tanggal_lahir`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
('91a8adef-581b-438c-a6ed-230de3e33ef0', 'Mahyar', 'mahyar@test.com', '081288322262', '$2y$12$geE.bTPtudqmO746mh9u.u8vL8mULC5ikGXheEe1kUQTnix5KWG1O', NULL, NULL, NULL, '2024-06-04 04:52:56', '2024-06-04 04:52:56', NULL),
('d7730c3b-17db-4a24-b269-64172f68e7fd', 'Muhammad Ma\'dum', 'muhammad.madum2018@gmail.com', '1234', '$2y$12$ha/EDP1nVftq1KihvkvaiOie5.iIx4hWiwujdCD1lcE4xp9oHXllO', 'Laki-laki', '2023-12-10', 'https://dev.supermontir.id/storage/image/agpyjF5GHgTsmWfotunlFIKQpLoJeOvaRdtGAVm2.png', '2023-12-10 08:15:32', '2024-06-05 02:20:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_kupons`
--

CREATE TABLE `user_kupons` (
  `id` varchar(255) NOT NULL,
  `kupon_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` enum('used','unused','expired') NOT NULL DEFAULT 'unused',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_kupons`
--

INSERT INTO `user_kupons` (`id`, `kupon_id`, `user_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0fef97b9-52cd-4799-ab2b-cb7a7ab42d88', '1e2f78bd-1ceb-424d-98bb-cbd83a873bea', 'd7730c3b-17db-4a24-b269-64172f68e7fd', 'expired', '2023-12-20 06:47:10', '2023-12-20 06:57:16', NULL),
('e3a56b1b-55a6-4b27-bbce-d0bab2221f0f', '9c270d1a-9254-4ff4-bfc3-a73a58c5e871', 'd7730c3b-17db-4a24-b269-64172f68e7fd', 'expired', '2023-12-21 05:28:12', '2024-06-03 18:18:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `garages`
--
ALTER TABLE `garages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_orders`
--
ALTER TABLE `item_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kupons`
--
ALTER TABLE `kupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_payments`
--
ALTER TABLE `order_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_kupons`
--
ALTER TABLE `user_kupons`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
