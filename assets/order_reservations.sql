-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 07:29 AM
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
-- Database: `gengrahamz`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_reservations`
--

CREATE TABLE `order_reservations` (
  `reservation_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('reserved','cancelled','completed') NOT NULL DEFAULT 'reserved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_reservations`
--

INSERT INTO `order_reservations` (`reservation_id`, `username`, `prod_name`, `quantity`, `reservation_date`, `status`) VALUES
(3, 'padfrancis', 'Mango Graham Bar', 3, '2024-12-08 12:34:42', 'reserved'),
(4, 'padfrancis', 'Mango Graham Bar', 1, '2024-12-08 12:46:21', 'reserved'),
(5, 'padfrancis', 'Mango Graham Bar', 120, '2024-12-08 12:46:54', 'reserved'),
(6, 'padfrancis', 'Choco Graham Bar', 2, '2024-12-08 12:47:09', 'reserved'),
(7, 'padfrancis', 'Cookies and Cream Graham Bar', 2, '2024-12-08 12:47:23', 'reserved'),
(8, 'Jeth', 'Cookies and Cream Graham Bar', 1, '2024-12-09 00:11:26', 'reserved'),
(9, 'jeth', 'Cookies and Cream Graham Bar', 1, '2024-12-09 03:38:45', 'reserved'),
(10, 'Jeth', 'Mango Graham Bar', 3, '2024-12-09 06:37:16', 'reserved'),
(11, 'Jeth', 'Cookies and Cream Graham Bar', 4, '2024-12-09 06:39:34', 'reserved'),
(12, 'padfrancis', 'Cookies and Cream Graham Bar', 4, '2024-12-09 06:43:53', 'reserved'),
(13, 'padfrancis', 'Choco Graham Bar', 1, '2024-12-09 15:55:17', 'reserved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_reservations`
--
ALTER TABLE `order_reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_reservations`
--
ALTER TABLE `order_reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
