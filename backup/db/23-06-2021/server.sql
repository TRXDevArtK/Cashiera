-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 03:21 AM
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
-- Database: `server`
--

-- --------------------------------------------------------

--
-- Table structure for table `id_auth`
--

CREATE TABLE `id_auth` (
  `id` int(11) NOT NULL,
  `key` varchar(32) NOT NULL,
  `last_login` datetime NOT NULL,
  `first_login` datetime NOT NULL,
  `db_name` varchar(100) NOT NULL,
  `db_hostname` varchar(100) NOT NULL,
  `db_username` varchar(60) NOT NULL,
  `db_password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_auth`
--

INSERT INTO `id_auth` (`id`, `key`, `last_login`, `first_login`, `db_name`, `db_hostname`, `db_username`, `db_password`) VALUES
(1165, 'admin', '2021-06-23 01:14:12', '2021-06-23 01:14:12', 'tenant_1694033084', 'localhost', 'root', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `id_auth`
--
ALTER TABLE `id_auth`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `id_auth`
--
ALTER TABLE `id_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1166;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
