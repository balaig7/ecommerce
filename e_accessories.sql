-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 05:16 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_accessories`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `is_childrens` enum('0','1') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `is_childrens`, `created_at`, `updated_at`) VALUES
(1, 'Laptops', '1', '1', '2022-03-05 00:49:18', '2022-03-05 00:49:18'),
(2, 'Mobiles', '1', '1', '2022-03-05 00:50:08', '2022-03-05 00:50:08'),
(3, 'Headphones', '1', '1', '2022-03-09 01:00:37', '2022-03-09 01:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `profile_id`, `user_name`, `password`, `display_name`, `role`, `created_at`, `modified_at`) VALUES
(1, 0, 'admin@mail.com', '$2y$10$JIasfnwT30zolseniD03FOha9W4a4kJmwHJMVHstR1378HBJbcoA2', 'Admin', 'admin', '2022-03-03 23:54:42', '2022-03-03 23:55:23'),
(8, 6, 'bala@mail.com', '$2y$10$S/hOJo/G8ASwZRZjMzwMAuWOr0jJycPt3zfBlWiQJyfml2cnFkODG', 'Bala', 'user', '2022-03-09 12:25:18', '2022-03-09 00:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_transactions`
--

CREATE TABLE `paypal_transactions` (
  `id` int(11) NOT NULL,
  `data` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `child_category_id` int(27) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_images_path` text NOT NULL,
  `product_images` varchar(255) NOT NULL,
  `thumnail_image_path` varchar(255) NOT NULL,
  `thumnail_image` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `original_price` decimal(6,2) NOT NULL,
  `discounted_price` decimal(6,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `parent_category_id`, `child_category_id`, `name`, `sku`, `description`, `quantity`, `product_images_path`, `product_images`, `thumnail_image_path`, `thumnail_image`, `status`, `original_price`, `discounted_price`, `created_at`, `updated_at`) VALUES
(1, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(2, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(3, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(4, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(5, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(6, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(7, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(8, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(9, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(10, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(11, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(12, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(13, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(14, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(15, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(16, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(17, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(18, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(19, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(20, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(21, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(22, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(23, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(24, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(25, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(26, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(27, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(28, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(29, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(30, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(31, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(32, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(33, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(34, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(35, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(36, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(37, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(38, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(39, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(40, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02'),
(41, 1, 16, 'Asus', 'SKU-N5YhDYFRMH1', '&lt;p&gt;test&lt;/p&gt;&lt;p&gt;test&lt;/p&gt;', 31, '../assets/uploads/Laptops/Asus/', 'product01.png,product03.png,product06.png,product08.png', '../assets/uploads/Laptops/thumnails/', 'product06.png', '1', '50.00', '40.00', '2022-03-15 23:04:02', '2022-03-15 23:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `session_cart`
--

CREATE TABLE `session_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session_cart`
--

INSERT INTO `session_cart` (`id`, `user_id`, `session_id`, `product_id`, `quantity`, `created_at`, `expired_at`) VALUES
(6, 8, '5a3ivthigbku5e2q9ueh621g9t', 5, 2, '2022-03-13 15:07:22', NULL),
(7, 8, '5a3ivthigbku5e2q9ueh621g9t', 38, 2, '2022-03-13 15:07:34', NULL),
(12, 8, '5a3ivthigbku5e2q9ueh621g9t', 40, 1, '2022-03-13 17:30:31', NULL),
(16, 8, '5a3ivthigbku5e2q9ueh621g9t', 3, 2, '2022-03-13 19:54:05', NULL),
(23, 8, '5a3ivthigbku5e2q9ueh621g9t', 6, 2, '2022-03-15 23:21:51', NULL),
(24, 8, '5a3ivthigbku5e2q9ueh621g9t', 1, 2, '2022-03-16 00:01:31', NULL),
(31, 0, 't36mkfnpft25hfkqr6jf99vbgh', 1, 7, '2022-03-22 21:16:00', NULL),
(32, 0, 't36mkfnpft25hfkqr6jf99vbgh', 5, 7, '2022-03-22 21:28:44', NULL),
(33, 0, 'so8g80c728thetdep155fe2t81', 24, 1, '2022-03-23 21:10:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(24) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `parent_id`, `name`, `created_at`, `updated_at`) VALUES
(16, 1, 'Asus', '2022-03-05 18:16:00', '2022-03-05 18:16:00'),
(17, 1, 'Dell', '2022-03-05 18:16:00', '2022-03-05 18:16:00'),
(18, 1, 'HP', '2022-03-05 18:16:00', '2022-03-05 18:16:00'),
(19, 1, 'Lenovo', '2022-03-05 18:16:00', '2022-03-05 18:16:00'),
(20, 1, 'Samsung', '2022-03-05 18:16:00', '2022-03-05 18:16:00'),
(21, 2, 'Asus', '2022-03-05 18:17:08', '2022-03-05 18:17:08'),
(22, 2, 'HTC', '2022-03-05 18:17:08', '2022-03-05 18:17:08'),
(23, 2, 'Redmi', '2022-03-05 18:17:08', '2022-03-05 18:17:08'),
(24, 2, 'Realme', '2022-03-05 18:17:09', '2022-03-05 18:17:09'),
(25, 2, 'Iphone', '2022-03-05 18:17:09', '2022-03-05 18:17:09'),
(26, 2, 'Samsung', '2022-03-05 18:17:09', '2022-03-05 18:17:09'),
(27, 3, 'Boat', '2022-03-09 01:00:37', '2022-03-09 01:00:37'),
(28, 3, 'Realme', '2022-03-09 01:00:37', '2022-03-09 01:00:37'),
(29, 3, 'Skull candy', '2022-03-09 01:00:37', '2022-03-09 01:00:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `phone` int(30) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `city`, `country`, `phone`, `created_at`, `updated_at`) VALUES
(6, 'Bala', 'bala@mail.com', NULL, NULL, NULL, 0, '2022-03-09 12:25:18', '2022-03-09 00:25:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_ratings`
--

CREATE TABLE `user_ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(44) NOT NULL,
  `user_id` int(44) NOT NULL,
  `comments` int(44) NOT NULL,
  `created_at` int(44) NOT NULL,
  `updated_at` int(44) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`) VALUES
(12, 8, 0),
(16, 8, 2),
(17, 8, 3),
(18, 8, 4),
(19, 8, 1),
(20, 8, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_cart`
--
ALTER TABLE `session_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `session_cart`
--
ALTER TABLE `session_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `delete_temp_session_data` ON SCHEDULE EVERY 1 DAY STARTS '2022-03-20 12:15:29' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Delete' DO DELETE FROM `session_cart` WHERE user_id='0'$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
