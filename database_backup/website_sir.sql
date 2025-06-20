-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2025 at 08:27 AM
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
-- Database: `website_sir`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_img` varchar(255) NOT NULL,
  `c_uploaded_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `c_name`, `c_img`, `c_uploaded_date`) VALUES
(1, 'Men', 'f.jpg', '2023-02-14 15:12:09'),
(2, 'Women', 'Screenshot-2021-09-13-at-10.41.03-AM-1024x671.png', '2023-02-18 15:08:12'),
(3, 'Kids', 'carousel-3.jpg', '2023-02-21 15:05:08'),
(4, 'test', 'Group Logo (1).png', '2025-06-20 05:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `p_id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_qty` int(11) NOT NULL,
  `p_status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `u_id`, `u_name`, `p_id`, `p_name`, `p_price`, `p_qty`, `p_status`, `date`) VALUES
(1, 3, 'Saif', 1, 'Bananza Satrangi', 2500, 3, 'Pending', '2023-03-02 14:55:43'),
(2, 3, 'Saif', 2, 'Bananza Satrangi Men Dress', 2000, 2, 'Pending', '2023-03-02 14:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_qty` int(11) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_desc` varchar(255) NOT NULL,
  `p_category` varchar(255) NOT NULL,
  `p_upload_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `p_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `p_name`, `p_qty`, `p_price`, `p_desc`, `p_category`, `p_upload_date`, `p_img`) VALUES
(1, 'Bananza Satrangi', 200, 2500, 'Best Quality Provider In Pakistan', 'Women', '2023-02-18 15:20:37', 'u.jpg'),
(2, 'Bananza Satrangi Men Dress', 50, 2000, 'Best Quality Provider In Pakistan', 'Men', '2023-02-18 15:21:50', 'head.jpg'),
(3, 'Gul Ahmed Men Dress', 2200, 2000, 'Best Quality Provider In Pakistan', 'Men', '2023-02-18 15:27:05', 'download.jpeg'),
(4, 'Causal Dress', 100, 3000, 'Best Quality Provider', 'Men', '2023-02-21 15:04:09', 'carousel-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `password`, `date`, `role`) VALUES
(1, 'Admin', 'Admin@gmail.com', '123', '2023-02-04 15:18:11', 1),
(2, 'User', 'Abc@gmail.com', 'abc', '2023-02-04 15:19:19', 2),
(3, 'Saif', 'Saif@gmail.com', '567', '2023-02-04 15:20:16', 2),
(4, 'Sohaib', 'Sohaib@gmail.com', '321', '2023-02-16 15:00:17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `StudentName` varchar(256) DEFAULT NULL,
  `Email` varchar(256) DEFAULT NULL,
  `Password` varchar(11) DEFAULT NULL,
  `StudentStatus` varchar(11) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `salry` int(11) NOT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `StudentName`, `Email`, `Password`, `StudentStatus`, `country`, `city`, `age`, `salry`, `dob`) VALUES
(4, 'Admin', 'Admin@gmail.com', '123', 'Approved', 'Pakistan', 'Karachi', 30, 20000, '2022-12-01'),
(5, 'Mubeen', 'Mubeen@gmail.com', '123', 'Pending', 'India', 'Delhi', 10, 50000, '2022-12-10'),
(10, 'Saif', 'Saif@gmail.com', '1234', 'Pending', 'Pakistan', 'Hyderabad', 40, 80000, '2022-12-30'),
(12, 'Sarim', 'Sarim@gmail.com', '657', 'Pending', 'Pakistan', 'Karachi', 30, 60000, '2022-12-24');

-- --------------------------------------------------------

--
-- Table structure for table `validation_age`
--

CREATE TABLE `validation_age` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `validation_age`
--

INSERT INTO `validation_age` (`id`, `name`, `age`) VALUES
(1, 'Abc', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `validation_age`
--
ALTER TABLE `validation_age`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `validation_age`
--
ALTER TABLE `validation_age`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
