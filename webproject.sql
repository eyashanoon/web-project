-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 12:30 AM
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
-- Database: `webproject`
--
CREATE DATABASE IF NOT EXISTS `webproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `webproject`;

-- --------------------------------------------------------

--
-- Table structure for table `investor`
--

DROP TABLE IF EXISTS `investor`;
CREATE TABLE `investor` (
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `gender` char(1) NOT NULL,
  `birth_date` date NOT NULL,
  `qualification` char(1) NOT NULL,
  `qualification_file` text NOT NULL,
  `total_worth` bigint(20) NOT NULL,
  `cash` int(11) NOT NULL,
  `collectibles` int(11) NOT NULL,
  `real_estate` int(11) NOT NULL,
  `real_estate_file` text NOT NULL,
  `investments` int(11) NOT NULL,
  `prominent` text NOT NULL,
  `investments_file` text NOT NULL,
  `Investor_experiences` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `image` text NOT NULL,
  `phone` text NOT NULL,
  `qualification_file_type` text NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investor`
--

INSERT INTO `investor` (`first_name`, `last_name`, `gender`, `birth_date`, `qualification`, `qualification_file`, `total_worth`, `cash`, `collectibles`, `real_estate`, `real_estate_file`, `investments`, `prominent`, `investments_file`, `Investor_experiences`, `email`, `password`, `image`, `phone`, `qualification_file_type`, `id`) VALUES
('eysa', 'hanoon', 'M', '2024-06-15', '0', '1.docx', 40000, 15, 30000000, 53, '1.docx', 10, 'name', '1.docx', '            ;m;k,m,l kmzdvcfvsrfvnslr', 'cbdgd@vsfv.scds', '178062130181396bc976fc425704aa7f39728bdd', '1.jpg', 'kkk', '', 1),
('man', 'hamel', 'M', '2024-05-29', '2', '6.docx', 100000, 10, 10000, 20, '6.docx', 30, 'man', '6.docx', '0', 'man@gmail.com', 'fb96549631c835eb239cd614cc6b5cb7d295121a', '6.png', '2672810', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

DROP TABLE IF EXISTS `offers`;
CREATE TABLE `offers` (
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `project_email` varchar(25) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) NOT NULL,
  `percentage` int(11) NOT NULL,
  `notes` text NOT NULL,
  `date` datetime NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`investor_id`, `project_email`, `id`, `price`, `percentage`, `notes`, `date`, `status`) VALUES
(6, 'project1@project.pr', 26, 10000, 10, '111', '2024-06-25 08:54:51', 'y'),
(6, 'a2@a.a', 27, 10000, 10, '\r\n              nhfyikgkug', '2024-09-12 20:58:50', '');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `email` varchar(25) NOT NULL,
  `project_value` bigint(20) NOT NULL,
  `password` text NOT NULL,
  `picture` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `stage` text NOT NULL,
  `fund_goal` int(11) NOT NULL,
  `fund_use` text NOT NULL,
  `company_name` text NOT NULL,
  `industry` text NOT NULL,
  `website_url` text DEFAULT NULL,
  `phone_number` int(11) NOT NULL,
  `business_plan` text NOT NULL,
  `pitch_deck` text DEFAULT NULL,
  `market_analysis` text DEFAULT NULL,
  `revenue_model` text NOT NULL,
  `legal_doc` text NOT NULL,
  `video_ver` text NOT NULL,
  `milestones` text DEFAULT NULL,
  `expected_timeline` text DEFAULT NULL,
  `legal_entity` text DEFAULT NULL,
  `location` text NOT NULL,
  `type` text NOT NULL,
  `equity_percentage` int(11) NOT NULL,
  `asking_for` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`email`, `project_value`, `password`, `picture`, `name`, `description`, `stage`, `fund_goal`, `fund_use`, `company_name`, `industry`, `website_url`, `phone_number`, `business_plan`, `pitch_deck`, `market_analysis`, `revenue_model`, `legal_doc`, `video_ver`, `milestones`, `expected_timeline`, `legal_entity`, `location`, `type`, `equity_percentage`, `asking_for`) VALUES
('a2@a.a', 0, 'e0c9035898dd52fc65c41454cec9c4d2611bfb37', 'a2@a.a.png', '      a 2     ', '      a 2     ', '      a 2     ', 12, '      1 2     12', '      1 2     ', '      1 2     ', '      A 2     ', 4, 'a2@a.a.png', 'a2@a.a.png', 'a2', '      a 2     ', 'a2@a.a.png', 'a2@a.a.mp4', '      a 2     ', '      aa 2     ', '      a 2     ', 'a 2', '0', 0, 0),
('mm@ff.ff', 5000, 'ed70c57d7564e994e7d5f6fd6967cea8b347efbc', 'mm@ff.ff.png', 'ff', 'ff', 'fff', 44, 'ff', 'mm', 'kk', 'mmm', 2672810, 'mm@ff.ff.pdf', 'mm@ff.ff.pdf', 'jnjl, ,', 'mmm', 'mm@ff.ff.png', 'mm@ff.ff.mp4', '   kb', 'bb', 'vnb vgh', 'Afghanistan', 'Technology', 36, 10600),
('project1@project.pr', 150000, '98f54143ab4e86b28c3afee0f50f2f51cfb2ed38', 'project1@project.pr.png', 'project1', 'The Smart Home Energy Management System aims to optimize energy usage within households through advanced technology integration. Using smart sensors, the system monitors energy consumption patter...', '--', 5000, '--', 'projct1', '--', '--', 1, 'project1@project.pr.txt', 'project1@project.pr.txt', '--', '--', 'project1@project.pr.txt', 'project1@project.pr.mp4', '--', '--', '--', 'China', 'Engineering', 20, 5000),
('project2@project.pr', 10000, '98f54143ab4e86b28c3afee0f50f2f51cfb2ed38', 'project2@project.pr.png', 'project2', 'project2 disproject2 disproject2 disproject2 disproject2 disproject2 disproject2 disproject2 disproject2 disproject2 disproject2 disproject2 dis', '--', 5000, '--', 'projct2', '--', '--', 1, 'project2@project.pr.txt', 'project2@project.pr.txt', '--', '--', 'project2@project.pr.txt', 'project2@project.pr.mp4', '--', '--', '--', 'Iraq', 'Technology', 20, 5000),
('project3@project.pr', 10000000, '98f54143ab4e86b28c3afee0f50f2f51cfb2ed38', 'project3@project.pr.png', 'project3', 'project3 disproject3 disproject3 disproject3 disproject3 disproject3 disproject3 disproject3 disproject3 disproject3 dis', '--', 100000, '--', 'projct3', '--', '--', 1, 'project3@project.pr.txt', 'project3@project.pr.txt', '--', '--', 'project3@project.pr.txt', 'project3@project.pr.mp4', '--', '--', '--', 'Iraq', 'Manufacturing and Industrial', 20, 10000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `investor`
--
ALTER TABLE `investor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `offers_ibfk_2` (`project_email`),
  ADD KEY `investor_id` (`investor_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `investor`
--
ALTER TABLE `investor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_2` FOREIGN KEY (`project_email`) REFERENCES `project` (`email`),
  ADD CONSTRAINT `offers_ibfk_3` FOREIGN KEY (`investor_id`) REFERENCES `investor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
