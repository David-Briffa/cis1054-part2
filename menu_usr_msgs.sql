CREATE DATABASE  IF NOT EXISTS `menu` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `menu`;
-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2022 at 02:42 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `menu`
--

-- --------------------------------------------------------

--
-- Table structure for table `usr_msgs`
--

DROP TABLE IF EXISTS `usr_msgs`;

CREATE TABLE `usr_msgs` (
  `msg_id` bigint(20) NOT NULL,
  `msg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `msg_name` varchar(100) NOT NULL,
  `msg_number` varchar(50) DEFAULT NULL,
  `msg_email` varchar(50) DEFAULT NULL,
  `msg_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usr_msgs`
--
ALTER TABLE `usr_msgs`
  ADD PRIMARY KEY (`msg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usr_msgs`
--
ALTER TABLE `usr_msgs`
  MODIFY `msg_id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;
