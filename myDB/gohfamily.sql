-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 10:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gohfamily`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `memname` varchar(30) NOT NULL,
  `mememail` varchar(30) NOT NULL,
  `mempass` varchar(20) NOT NULL,
  `memaccess` varchar(255) NOT NULL,
  `memdate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `memname`, `mememail`, `mempass`, `memaccess`, `memdate`) VALUES
(1, 'gohfamily', 'onlyeducation@gmail.com', 'gohfamily', 'family/family.html', '2024-11-24'),
(2, 'jeffrey', 'locutus.sg@gmail.com', 'jeffrey', 'family/jeffrey.html', '2024-11-24'),
(3, 'kenneth', 'kengoh99@gmail.com', 'kenneth', 'family/family.html', '2024-11-24'),
(4, 'sohhoon', 'gohshgourmet@gmail.com', 'sohhoon', 'family/family.html', '2024-11-24'),
(5, 'lydia', 'vision4g@yahoo.com.sg', 'lydia', 'family/lydia.html', '2024-11-24'),
(6, 'michaela', 'michaela.hrncirova@mzv.gov.cz', 'michaela', 'family/michaela.html', '2024-11-24'),
(7, 'visitor', 'onlybull@gmail.com', 'guest', 'home/home.html', '2025-06-01'),
(8, 'danielle', 'kengoh99@gmail.com', 'danielle', 'family/daniel.html', '2025-06-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
