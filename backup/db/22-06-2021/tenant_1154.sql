-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2021 at 08:13 AM
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
-- Database: `tenant_1154`
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

--
-- Dumping data for table `bundling`
--

INSERT INTO `bundling` (`id`, `product_id`, `profit_max`, `name`, `amount`, `status`) VALUES
(1, 1, '1000.00', 'abc', 10, 1),
(2, 2, '123123.00', 'asd', 1, 1);

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

--
-- Dumping data for table `buying_history`
--

INSERT INTO `buying_history` (`id`, `datetime`, `profit_min`, `profit_max`, `capital`, `amount`, `product_id`, `teller`) VALUES
(1, '2021-06-03 23:24:49', '10000.00', '20000.00', '1000.00', 10, 1, 0),
(2, '2021-06-04 01:00:54', '20000.00', '40000.00', '10000.00', 10, 2, 0),
(3, '2021-06-19 00:16:54', '5000.00', '5000.00', '1000.00', 1, 4, 0);

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
(1, 'Barang'),
(3, 'asd');

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
(1, 'toko_sample_1', '', 1, '#ffffff', 'null', './img/product/7bc95ef3-f602-4ba2-b8b0-984877419c60.png', '', 0, 'Asia/Jakarta', '2021-06-19 05:50:13', './img/product/107c8c0f-fe58-4ec0-9789-8f76d4ab60cb.png'),
(2, 'toko_22', 'toko 1 jl anz2', 0, '#ffffff', ' asd', './img/product/64795e63-cd58-41f7-89ae-be649b5f4513.jpg', '', 0, 'Asia/Jakarta', '2021-06-16 11:24:02', './img/product/db4235b0-9ae6-42b5-b90d-044b0f76f740.png'),
(3, 'a', 'b', 0, '#fffff', NULL, NULL, NULL, 0, 'UTC', '2021-06-19 00:22:26', '');

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

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `category`, `brand`, `desc`, `type`, `stock`, `id_store`, `capital`, `profit_min`, `profit_max`, `discount`, `weight`, `bundling`, `stats`, `inputter`, `receipt`, `latest_data`, `image_url`) VALUES
(1, '11223344', 'BARANG HP 1', 1, 'hp', 'ini adalah hp 1', 1, 8, 1, '1000.00', '10000.00', '20000.00', 10, '20.00', 1, 1, 'admin', 0, '2021-06-16 04:45:09', './img/product/45824bad-0bbd-46b4-8cf0-2a42b4462430.png'),
(2, '22123123', 'VIVO V19', 1, 'vivo', 'iaskdkwad', 1, -1, 1, '10000.00', '20000.00', '40000.00', 5, '5.00', 2, 1, 'admin', 1, '2021-06-16 04:44:55', './img/product/314227c7-ba70-4250-b609-923685aeb2e6.jpg'),
(4, '112233', 'ayay', 1, 'aya', '12312', 2, 1, 1, '1000.00', '5000.00', '5000.00', 0, '1.00', 1, 1, 'admin', 1, '2021-06-19 00:16:54', NULL);

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

--
-- Dumping data for table `selling_history`
--

INSERT INTO `selling_history` (`id`, `datetime`, `capital`, `profit`, `report`, `pricing_report`, `amount`, `product_id`, `teller`) VALUES
(1, '2021-06-01 00:00:00', '1000.00', '1000.00', '', '0.00', 1, 1, 0),
(2, '2021-06-16 05:44:13', '1000.00', '20000.00', '', '0.00', 1, 1, 1),
(3, '2021-06-16 05:44:13', '1000.00', '20000.00', 'bsbsh', '55.00', 1, 1, 1),
(4, '2021-06-16 05:44:13', '1000.00', '20000.00', 'bsbsh', '55.00', 1, 1, 1),
(5, '2021-06-16 05:44:13', '1000.00', '20000.00', 'bsbsh', '55.00', 1, 1, 1),
(6, '2021-06-16 05:44:13', '1000.00', '20000.00', 'bsbsh', '55.00', 1, 1, 1),
(7, '2021-06-16 05:44:13', '1000.00', '20000.00', 'bsbsh', '55.00', 1, 1, 1),
(8, '2021-06-16 05:44:13', '1000.00', '20000.00', 'bsbsh', '55.00', 1, 1, 1),
(9, '2021-06-17 07:33:25', '1000.00', '20000.00', '', '0.00', 1, 1, 1),
(10, '2021-06-17 07:34:52', '10000.00', '40000.00', '', '0.00', 1, 2, 1),
(11, '2021-06-17 07:40:36', '1000.00', '20000.00', '', '0.00', 1, 1, 1),
(12, '2021-06-17 07:47:31', '10000.00', '40000.00', '', '0.00', 1, 2, 1),
(13, '2021-06-19 05:50:48', '1000.00', '21000.00', '', '0.00', 1, 1, 1),
(14, '2021-06-19 06:47:01', '1000.00', '20000.00', '', '0.00', 1, 1, 1),
(15, '2021-06-20 08:28:49', '1000.00', '21000.00', '', '0.00', 1, 1, 1),
(16, '2021-06-20 09:36:13', '1000.00', '21000.00', '', '0.00', 1, 1, 1),
(17, '2021-06-21 11:59:00', '1000.00', '19000.00', '', '0.00', 1, 1, 1),
(18, '2021-06-22 11:50:05', '1000.00', '15080.00', '', '0.00', 1, 1, 1),
(19, '2021-06-22 11:50:45', '1000.00', '21000.00', '', '0.00', 1, 1, 1),
(20, '2021-06-22 12:19:12', '1000.00', '21000.00', '', '0.00', 1, 1, 1),
(21, '2021-06-22 12:24:56', '1000.00', '21000.00', '', '0.00', 1, 1, 1);

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
(1, 'type_sample_1', './img/product/03bfe1d7-b14e-483b-b825-93746dcfca97.png'),
(2, 'aaaaas', './img/product/9daa2806-c147-4dd1-a70a-e5891c7e0d76.png');

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
(1, 'admin', '$argon2id$v=19$m=65536,t=4,p=1$eXo1ZlJrNExBNFJEalNQSA$s0VGDoyqbAzSDo3m3tCuU5zaDfjy71MzTV4+AYpAx1s', 'trxdev@gmx.com', '85268043434', 1, 1, 'admin', 'admin', 1, '0.00', './img/product/3678a2b2-3c28-4d81-8616-3e0a92b2d34c.png'),
(3, 'abc', '$argon2id$v=19$m=65536,t=4,p=1$b3EwU05sclNCeC9aQ3g3Tw$9h+kxUTGXOg37utPFYQgjRVQUrXtj4VWWcG0oq9lM68', 'asd@gmx.com', '123132', 2, 2, 'sukroooo', 'ayyysukto', 1, '112233.00', './img/product/c4815a6c-1f50-421c-a6d6-9de0420fcbc7.jpg'),
(4, 'asd', '$argon2id$v=19$m=65536,t=4,p=1$dHplaFVXWFpXbTJyOGN4Mw$H98j6+DZZteVE0q6p4hurw0t/9r0rWdIuajvuv5FDXM', 'asd', '123', 2, 1, 'asd', 'asd', 1, '123.00', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `id_store`
--
ALTER TABLE `id_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `overall_result`
--
ALTER TABLE `overall_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
