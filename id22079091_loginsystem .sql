-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2024 at 08:14 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22079091_loginsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '5c428d8875d2948607f3e3fe134d71b4');

-- --------------------------------------------------------

--
-- Table structure for table `customer_bookings`
--

CREATE TABLE `customer_bookings` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(11) DEFAULT 0,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `aadhar_number` varchar(20) NOT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `order_status` varchar(255) DEFAULT 'Pending',
  `customer_id` varchar(255) DEFAULT NULL,
  `land_type` varchar(255) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `category_type` varchar(50) NOT NULL,
  `area` text NOT NULL,
  `usage_kw` decimal(10,2) NOT NULL,
  `location` text NOT NULL,
  `electric_bill` varchar(255) NOT NULL,
  `aadhar_card` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `district` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_bookings`
--

INSERT INTO `customer_bookings` (`id`, `first_name`, `last_name`, `age`, `country`, `state`, `aadhar_number`, `pan_number`, `created_at`, `email`, `phone`, `status`, `order_status`, `customer_id`, `land_type`, `gender`, `dob`, `address`, `category_type`, `area`, `usage_kw`, `location`, `electric_bill`, `aadhar_card`, `photo`, `district`) VALUES
(43, 'aadil', 'aziz', 0, '', '', '224566249990', '', '2024-04-21 03:29:03', 'aadil@gmail.com', '', 'Completed', 'Pending', '463909', 'domestic', '', '0000-00-00', '', '', '', 0.00, '', '', '', '', ''),
(51, 'anjum', 'perwej', 0, NULL, 'state2', '8484844848', NULL, '2024-05-29 20:24:40', 'rajjacker73382@gmail.com', '06207024337', 'Completed', 'Pending', '786786', NULL, 'male', '2024-05-24', 'palajori , deoghar, jharkhand i,ndia\\r\\npalajori , deoghar, jharkhand i,ndia', 'type1', 'ssddsd', 5.00, 'adasd', 'uploads/and free delivery (21).png', 'uploads/and free delivery (20).png', 'uploads/and free delivery (19).png', 'district2');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `aadhar_number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `order_details` text DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solar_bookings`
--

CREATE TABLE `solar_bookings` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `age` int(11) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `aadhar_number` varchar(20) NOT NULL,
  `pan_number` varchar(10) NOT NULL,
  `booking_status` enum('successful','inprocess','cancelled') DEFAULT 'inprocess',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `contactno` varchar(11) DEFAULT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `contactno`, `posting_date`, `customer_id`) VALUES
(16, 'Shuvonil', 'mandal', 'ggsg@gmail.com', 'Roop@123456', '6202760987', '2024-04-28 06:34:21', '148018'),
(17, 'gg', 'gg', 'admin@gmail.com', 'Roop@123456', '1234567890', '2024-04-29 11:30:15', '218924'),
(18, 'sona', 'jaya', 'sonagupta123@gmail.com', 'Jaya123', '6206257274', '2024-05-04 15:22:16', '273964'),
(19, 'kanchan', 'kumari', 'jaya123@gmail.com', 'Jaya123', '6206257274', '2024-05-04 15:26:33', '257263'),
(20, 'll', 'bb', 'abc@Gmail.com', 'Abc@123', '9456612379', '2024-05-05 11:32:43', '251325'),
(21, 'aa', 'bb', 'abs@Gmail.com', 'Abs@56', '4678945625', '2024-05-05 12:19:42', '644155'),
(22, 'kajal', 'mishra', 'km9924655@gmail.com', 'Kajal@6209', '6209273321', '2024-05-06 04:36:24', '780015'),
(23, 'test', 'test', 'test@gmail.com', 'Rano@12345', '1234567890', '2024-05-06 11:21:27', '617545');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_bookings`
--
ALTER TABLE `customer_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aadhar_number` (`aadhar_number`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `unique_order` (`aadhar_number`,`email`,`name`);

--
-- Indexes for table `solar_bookings`
--
ALTER TABLE `solar_bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aadhar_number` (`aadhar_number`),
  ADD UNIQUE KEY `pan_number` (`pan_number`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_bookings`
--
ALTER TABLE `customer_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solar_bookings`
--
ALTER TABLE `solar_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
