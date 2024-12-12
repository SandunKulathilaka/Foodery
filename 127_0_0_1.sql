-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 09:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_db`
--
DROP DATABASE IF EXISTS `food_db`;
CREATE DATABASE IF NOT EXISTS `food_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `food_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(3, 'Sandun', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(5, 'OreoIceCream', '7c4a8d09ca3762af61e59520943dc26494f8941b'),
(6, 'kelum', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(3, 0, 'kelum', 'kalumpriyasad1998@gmail.com', '0750897786', 'hello world'),
(4, 7, 'priyasad', 'kalumpriyasad1998@gmail.com', '0750897786', 'good foods and delivery '),
(5, 7, 'sandun', 'sandun@gmail.com', '0123456789', 'very good service');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(5, 5, 'Sandun', '0772152084', 'sandun@gmail.com', 'credit card', 'dss, hjg, hj, hjgjg, jgjgj, gg, uiui - 1245', 'Ice Cream (12 x 2) - ', 24, '2024-05-13', 'completed'),
(6, 5, 'Sandun', '0772152084', 'sandun@gmail.com', 'cash on delivery', 'dss, hjg, hj, hjgjg, jgjgj, gg, uiui - 1245', 'Ice Cream (12 x 4) - ', 48, '2024-05-13', 'completed'),
(7, 5, '\r\nWarning:  Undefine', '\r\nWarning:', '\r\nWarning:  Undefined variable $fetch_profile in C', 'paypal', '\r\nWarning:  Undefined variable $fetch_profile in C:\\xampp\\htdocs\\Food-System\\User\\checkout.php on line 246\r\n\r\nWarning:  Trying to access array offset on value of type null in C:\\xampp\\htdocs\\Food-System\\User\\checkout.php on line 246\r\n', 'Oreo Ice Cream (3 x 2) - Chicken Pizza (13 x 1) - ', 19, '2024-05-19', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(300) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category`, `price`, `image`) VALUES
(13, 'Oreo Ice Cream', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'drinks', 3, 'dessert-3.png'),
(14, 'Faluda', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'drinks', 3, 'dessert-1.png'),
(16, 'Chicken Pizza', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'fast food', 13, 'pizza-2.png'),
(17, 'Chicken Burger', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'fast food', 9, 'burger-2.png'),
(18, 'Brownie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'desserts', 4, 'dessert-2.png'),
(19, 'pizza', 'large', 'main dish', 4000, 'pizza-2.png'),
(20, 'ice-cream', 'large', 'desserts', 450, 'dessert-5.png'),
(21, 'milk', 'cup', 'drinks', 600, 'dessert-3.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(2, 'Denise Higgins', 'wumykyti@mailinator.com', '832', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', ''),
(5, 'Sandun', 'sandun@gmail.com', '0772152084', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Colombo, Kiribathgoda, Sri Lanka - 12600'),
(6, 'Kai Hawkins', 'sisy@mailinator.com', '140', '487543ff6dfc8ff4527f76f6b61c9c9061365820', 'w, h, hjg, jk, jk, jk, jk - 47'),
(7, 'kelum', 'kalumpriyasad1998@gmail.com', '0750897786', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123, 456, weliweriya, miriswaththa, gampaha, 2222, Sri Lanka - 65774');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
