-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2017 at 04:45 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twert`
--

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `id` int(11) NOT NULL,
  `name` varchar(144) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hash`
--

CREATE TABLE IF NOT EXISTS `hash` (
  `id` int(12) NOT NULL,
  `keywordid` int(11) NOT NULL,
  `hash` varchar(144) COLLATE utf8_unicode_ci NOT NULL,
  `tweetid` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE IF NOT EXISTS `keyword` (
  `id` int(6) NOT NULL,
  `videoid` int(6) NOT NULL,
  `word` varchar(24) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL,
  `twertid` int(11) NOT NULL,
  `text` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `name`
--

CREATE TABLE IF NOT EXISTS `name` (
  `id` int(11) NOT NULL,
  `keywordid` int(11) NOT NULL,
  `name` varchar(144) COLLATE utf8_unicode_ci NOT NULL,
  `tweetid` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `twert`
--

CREATE TABLE IF NOT EXISTS `twert` (
  `id` int(6) NOT NULL,
  `videoid` int(11) NOT NULL,
  `twert` varchar(144) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(6) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci NOT NULL,
  `lastpost` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hash`
--
ALTER TABLE `hash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `name`
--
ALTER TABLE `name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `twert`
--
ALTER TABLE `twert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hash`
--
ALTER TABLE `hash`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `name`
--
ALTER TABLE `name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `twert`
--
ALTER TABLE `twert`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
