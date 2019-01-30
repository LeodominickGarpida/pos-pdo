-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2018 at 03:59 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` char(60) DEFAULT NULL,
  `type` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `username`, `password`, `type`, `status`, `created_at`, `updated_at`) VALUES
(15, 'Dominick Garpida', 'doms', '$2y$12$10A0RxmzIFTYxsQQxVKbdOMWECAin3Tfytkd9V6Lpf0d/FQdktfNy', 1, 1, '2018-11-03 13:28:39', '2018-11-06'),
(16, 'Patricia Palamos', 'pats', '$2y$12$O/l7t/zFapatojYsNPMpK.biP9ZFx0jkJpMTpQU2.2KrmLvsfuyj6', 0, 1, '2018-11-03 13:29:15', '2018-11-06'),
(20, 'Charles bading', 'cashboy', '$2y$12$n6/IgzR1F5RPXNU3yBmNqeIBACpBwuYOu/miUt3zjODf2HmXPSsF6', 0, 1, '2018-11-06 11:43:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `status`, `created_at`, `updated_at`) VALUES
(41, 'None', 1, '2018-11-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(164, 'Food', 1, '2018-11-03', NULL),
(166, 'Beverages', 1, '2018-11-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `subtotal` int(60) DEFAULT NULL,
  `amount_paid` int(60) DEFAULT NULL,
  `amount_due` int(60) DEFAULT NULL,
  `discount` int(60) DEFAULT '0',
  `grandtotal` int(11) DEFAULT '0',
  `cashier` int(11) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `stauts` int(60) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `subtotal`, `amount_paid`, `amount_due`, `discount`, `grandtotal`, `cashier`, `order_date`, `stauts`) VALUES
(193, 120, 120, 0, 0, 120, 15, '2018-11-06', 1),
(194, 120, 120, 0, 0, 120, 15, '2018-11-05', 1),
(195, 120, 120, 0, 0, 120, 15, '2018-11-06', 1),
(196, 100, 100, 0, 0, 100, 15, '2018-11-06', 1),
(197, 90, 90, 0, 0, 90, 15, '2018-11-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `product_id`, `quantity`, `status`) VALUES
(45, 124, '52', '2', 1),
(46, 124, '50', '1', 1),
(47, 124, '46', '1', 1),
(48, 125, '43', '1', 1),
(49, 125, '44', '1', 1),
(50, 126, '53', '1', 1),
(51, 127, '49', '1', 1),
(52, 128, '47', '2', 1),
(53, 129, '53', '1', 1),
(54, 130, '53', '1', 1),
(55, 131, '40', '1', 1),
(56, 132, '53', '1', 1),
(57, 133, '53', '1', 1),
(58, 134, '40', '1', 1),
(59, 135, '43', '1', 1),
(60, 136, '51', '1', 1),
(61, 137, '40', '1', 1),
(62, 138, '41', '1', 1),
(63, 139, '53', '2', 1),
(64, 140, '53', '1', 1),
(65, 149, '40', '1', 1),
(66, 150, '40', '1', 1),
(67, 151, '40', '1', 1),
(68, 152, '40', '1', 1),
(69, 153, '43', '1', 1),
(70, 154, '40', '1', 1),
(71, 155, '40', '1', 1),
(72, 156, '40', '1', 1),
(73, 157, '42', '1', 1),
(74, 158, '48', '1', 1),
(75, 159, '40', '1', 1),
(76, 160, '42', '1', 1),
(77, 161, '42', '1', 1),
(78, 162, '43', '1', 1),
(79, 163, '42', '1', 1),
(80, 164, '45', '2', 1),
(81, 165, '51', '1', 1),
(82, 166, '42', '1', 1),
(83, 167, '41', '2', 1),
(84, 168, '41', '3', 1),
(85, 169, '41', '2', 1),
(86, 170, '50', '1', 1),
(87, 171, '50', '2', 1),
(88, 172, '44', '1', 1),
(89, 173, '43', '1', 1),
(90, 174, '40', '1', 1),
(91, 175, '40', '1', 1),
(92, 176, '40', '1', 1),
(93, 177, '40', '1', 1),
(94, 178, '43', '1', 1),
(95, 179, '45', '1', 1),
(96, 180, '40', '1', 1),
(97, 181, '44', '1', 1),
(98, 182, '40', '1', 1),
(99, 183, '40', '1', 1),
(100, 184, '40', '1', 1),
(101, 185, '40', '1', 1),
(102, 186, '41', '1', 1),
(103, 187, '44', '1', 1),
(104, 188, '42', '1', 1),
(105, 189, '40', '1', 1),
(106, 190, '45', '1', 1),
(107, 192, '43', '1', 1),
(108, 193, '43', '1', 1),
(109, 194, '43', '1', 1),
(110, 195, '43', '1', 1),
(111, 196, '44', '2', 1),
(112, 197, '53', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `quantity`, `price`, `category_id`, `brand_id`) VALUES
(39, 'champorado', 8, 12100, 164, 0),
(40, 'Crispy Liempo', -1, 70, 164, 41),
(41, 'Pizza Pocket', 0, 50, 164, 41),
(42, 'Giant Hotdog Sandwich', 3, 80, 164, 41),
(43, 'Pinoy Classic BBQ', 0, 120, 164, 41),
(44, 'Hotdogs', 4, 50, 164, 41),
(45, 'Potato Wedges', 5, 90, 164, 41),
(46, 'Cheesy Nachos', 9, 45, 164, 41),
(47, 'Japanes Teriyaki Sauce', 9, 100, 164, 41),
(48, 'European Garlic Butter', 8, 200, 164, 41),
(49, 'American Buffalo Sauce', 5, 150, 164, 41),
(50, 'Korean BBQ', 6, 70, 164, 41),
(51, 'Mexican Buffallo', 7, 120, 164, 41),
(52, 'Crispy Fried Chicken With Rice', 9, 80, 164, 41),
(53, 'bulalo', 13, 45, 164, 41);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
