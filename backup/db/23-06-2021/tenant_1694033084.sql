-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 03:18 AM
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
-- Database: `tenant_1694033084`
--

-- --------------------------------------------------------

--
-- Table structure for table `bundling`
--

CREATE TABLE `bundling` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `profit_max` decimal(10,2) NOT NULL,
  `name` varchar(32) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buying_history`
--

CREATE TABLE `buying_history` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `profit_min` decimal(10,2) NOT NULL,
  `profit_max` decimal(10,2) NOT NULL,
  `capital` decimal(10,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `teller` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `name`) VALUES
(1, 'catg_sample_1');

-- --------------------------------------------------------

--
-- Table structure for table `id_store`
--

CREATE TABLE `id_store` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `location` varchar(84) DEFAULT NULL,
  `config` int(1) NOT NULL,
  `color` varchar(8) NOT NULL,
  `logo` varchar(256) DEFAULT NULL,
  `print_logo` varchar(256) DEFAULT NULL,
  `print_msg` varchar(32) DEFAULT NULL,
  `mode` tinyint(1) NOT NULL,
  `timezone` varchar(20) NOT NULL,
  `latest_data` datetime DEFAULT NULL,
  `image_url` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `id_store`
--

INSERT INTO `id_store` (`id`, `name`, `location`, `config`, `color`, `logo`, `print_logo`, `print_msg`, `mode`, `timezone`, `latest_data`, `image_url`) VALUES
(1, 'toko_sample_1', NULL, 1, '#ff5959', NULL, NULL, NULL, 0, 'UTC', '2021-05-28 08:58:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `overall_result`
--

CREATE TABLE `overall_result` (
  `id` int(11) NOT NULL,
  `buy_latest_fetch` datetime DEFAULT NULL,
  `sell_latest_fetch` datetime DEFAULT NULL,
  `total_sales` decimal(10,2) DEFAULT NULL,
  `total_capital` decimal(10,2) DEFAULT NULL,
  `selling_number` int(11) DEFAULT NULL,
  `total_profit` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `desc` varchar(256) NOT NULL,
  `type` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_store` int(11) NOT NULL,
  `capital` decimal(10,2) NOT NULL,
  `profit_min` decimal(10,2) NOT NULL,
  `profit_max` decimal(10,2) NOT NULL,
  `discount` int(3) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `bundling` int(11) NOT NULL,
  `stats` int(11) NOT NULL,
  `inputter` varchar(16) DEFAULT NULL,
  `receipt` tinyint(1) NOT NULL,
  `latest_data` datetime NOT NULL,
  `image_url` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `owner` tinyint(1) NOT NULL,
  `delete_self` tinyint(1) NOT NULL,
  `delete_other` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `owner`, `delete_self`, `delete_other`) VALUES
(1, 'Owner', 1, 1, 1),
(2, 'Karyawan', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `selling_history`
--

CREATE TABLE `selling_history` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `capital` decimal(10,2) NOT NULL,
  `profit` decimal(10,2) NOT NULL,
  `report` varchar(256) DEFAULT NULL,
  `pricing_report` decimal(10,2) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `teller` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `id` int(11) NOT NULL,
  `name` varchar(16) NOT NULL,
  `image_url` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`id`, `name`, `image_url`) VALUES
(1, 'type_sample_1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` char(110) NOT NULL,
  `email` varchar(256) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` int(11) NOT NULL,
  `id_store` int(11) NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `call_name` varchar(16) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `image_url` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `role`, `id_store`, `full_name`, `call_name`, `status`, `salary`, `image_url`) VALUES
(1, 'admin', '$argon2id$v=19$m=65536,t=4,p=1$VUwyZllBb2NCSW84ZHJyaw$h3JRRnUgFXhsxzL+A26UWlCA6jJvItJgrDceIC95kkQ', 'trxdev@gmx.com', '85268043434', 1, 1, 'admin', 'admin', 1, '0.00', NULL);

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
-- Indexes for table `overall_result`
--
ALTER TABLE `overall_result`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `id_store`
--
ALTER TABLE `id_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `overall_result`
--
ALTER TABLE `overall_result`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `selling_history`
--
ALTER TABLE `selling_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
