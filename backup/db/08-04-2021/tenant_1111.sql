-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2021 at 08:55 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tenant_1111`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundling`
--

CREATE TABLE `bundling` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `prodif_max` decimal(10,2) NOT NULL,
  `name` varchar(32) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `buying_history`
--

CREATE TABLE `buying_history` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `datetime` datetime NOT NULL,
  `capital` decimal(10,2) NOT NULL,
  `profit` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `teller` int(11) NOT NULL,
  `code` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `id_store`
--

CREATE TABLE `id_store` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `location` varchar(84) NOT NULL,
  `config` int(1) NOT NULL,
  `color` varchar(6) NOT NULL,
  `logo` blob NOT NULL,
  `print_logo` blob NOT NULL,
  `print_msg` varchar(32) NOT NULL,
  `mode` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `category` int(11) NOT NULL,
  `brand` varchar(32) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `capital` decimal(10,2) NOT NULL,
  `profit_min` decimal(10,2) NOT NULL,
  `profit_max` decimal(10,2) NOT NULL,
  `discount` int(3) NOT NULL,
  `weight` decimal(5,4) NOT NULL,
  `bundling` int(1) NOT NULL,
  `stats` int(2) NOT NULL,
  `inputter` varchar(16) NOT NULL,
  `struct` int(1) NOT NULL,
  `last_mod` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `selling_history`
--

CREATE TABLE `selling_history` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `datetime` datetime NOT NULL,
  `capital` decimal(10,2) NOT NULL,
  `profit` decimal(10,2) NOT NULL,
  `report` varchar(255) NOT NULL,
  `pricing_report` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `teller` int(11) NOT NULL,
  `code` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` int(11) NOT NULL,
  `id_store` int(11) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `call_name` varchar(16) NOT NULL,
  `status` int(2) NOT NULL,
  `salary` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bundling`
--
ALTER TABLE `bundling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buying_history`
--
ALTER TABLE `buying_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_store`
--
ALTER TABLE `id_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selling_history`
--
ALTER TABLE `selling_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
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
-- AUTO_INCREMENT for table `buying_history`
--
ALTER TABLE `buying_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_store`
--
ALTER TABLE `id_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `selling_history`
--
ALTER TABLE `selling_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
