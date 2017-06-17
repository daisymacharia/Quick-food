-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2017 at 09:55 AM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `rest_id`, `created_at`) VALUES
(1, 23, 1, '2017-06-14 17:20:38'),
(2, 24, 1, '2017-06-14 17:35:29'),
(3, 23, 1, '2017-06-14 17:36:04'),
(4, 23, 1, '2017-06-14 17:59:49'),
(5, 23, 1, '2017-06-14 18:43:05'),
(6, 23, 1, '2017-06-15 10:07:30'),
(7, 23, 1, '2017-06-15 12:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `status` enum('pending','cleared','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `stock_id`, `quantity`, `status`) VALUES
(1, 1, 1, 1, 'canceled'),
(2, 1, 2, 2, 'canceled'),
(3, 1, 3, 3, 'cleared'),
(4, 1, 4, 4, 'cleared'),
(5, 2, 1, 2, 'canceled'),
(6, 2, 2, 3, 'canceled'),
(7, 2, 3, 1, 'cleared'),
(8, 2, 4, 4, 'cleared'),
(9, 3, 1, 2, 'canceled'),
(10, 3, 2, 3, 'canceled'),
(11, 3, 3, 4, 'canceled'),
(12, 3, 4, 1, 'cleared'),
(13, 4, 1, 1, 'cleared'),
(14, 4, 2, 3, 'pending'),
(15, 4, 3, 1, 'pending'),
(16, 5, 1, 3, 'pending'),
(17, 5, 2, 3, 'pending'),
(18, 5, 3, 3, 'pending'),
(19, 5, 4, 3, 'pending'),
(20, 6, 1, 1, 'pending'),
(21, 6, 2, 3, 'pending'),
(22, 6, 3, 4, 'pending'),
(23, 7, 1, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` decimal(12,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `unit_price`) VALUES
(1, 'Chicken', '1000.00'),
(2, 'Samaki', '800.00'),
(3, 'Beef Stew', '800.00'),
(4, 'Mango', '20.00'),
(5, 'Mango', '2000.00');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `phone`, `email`, `location`, `address`, `created_at`) VALUES
(1, 'Panari', '314-667-8843 x577', 'sosinski@howe.info', '6879 Penelope Road', '9713 Ziemann Square Apt. 103\nPort Priscillaburgh, MO 49450', '2017-06-13 14:37:52'),
(2, 'Gravity', '(687) 606-9750 x483', 'dpouros@hills.com', '626 Annalise Plains', '564 Langworth Wells Suite 442\nWest Lenniefurt, OH 79145', '2017-06-13 14:37:52'),
(3, 'Queens Park', '517-415-3947 x7025', 'schaden.loren@lebsack.info', '4707 Breanna Centers Suite 924', '5930 Pacocha Crest\nWest Maximillia, IA 87109', '2017-06-13 14:37:52'),
(4, 'Hilton', '997.878.5664 x8686', 'olen80@sanford.org', '690 Caitlyn Mountain', '3355 Spencer Mount Apt. 096\nLake Howard, OR 67148', '2017-06-13 14:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(10) UNSIGNED NOT NULL,
  `rest_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `sell_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `expiry` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `rest_id`, `product_id`, `quantity`, `sell_price`, `expiry`, `created_at`) VALUES
(1, 1, 1, 74, '1500.00', '2017-06-13', '2017-06-15 12:12:55'),
(2, 1, 1, 43, '500.00', '2017-06-13', '2017-06-15 10:07:30'),
(3, 2, 1, 60, '1000.00', '2017-06-13', '2017-06-15 10:07:30'),
(4, 3, 2, 60, '750.00', '2017-06-13', '2017-06-14 18:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `location`, `address`, `role`, `password`, `created_at`) VALUES
(23, 'Muthami Geoffrey', '0716028726', 'ggeovry@gmail.com', NULL, '393 Ongata Rongai', 'user', '$2y$10$cXuh6kNk7w72pIlCjMgnBunvdW6xOZbbefAgvetj7v1NnqhQO8VAO', '2017-06-14 12:28:28'),
(24, 'John Doe', '0716028700', 'johndoe@mail.com', NULL, '393 Mtwapa', 'user', '$2y$10$iX8I9dV4buMaH1aDjOJbs.Pd.etxrRWYP3fsxE/z0M26yln21Bofa', '2017-06-14 17:35:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurants_email_unique` (`email`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
