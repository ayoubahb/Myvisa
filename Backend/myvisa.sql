-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 01, 2023 at 08:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myvisa`
--

-- --------------------------------------------------------

--
-- Table structure for table `dossier`
--

CREATE TABLE `dossier` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `nationalite` varchar(255) NOT NULL,
  `situation` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `type_visa` varchar(255) NOT NULL,
  `date_depart` date NOT NULL,
  `date_arriver` date NOT NULL,
  `num_document` int(11) NOT NULL,
  `type_document` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dossier`
--

INSERT INTO `dossier` (`id`, `first_name`, `last_name`, `birthday`, `nationalite`, `situation`, `adresse`, `type_visa`, `date_depart`, `date_arriver`, `num_document`, `type_document`) VALUES
(3, 'x zxc z', 'sd', '1233-01-01', '', 'assa', 'asasas', 'asasas', '1233-01-01', '1233-01-01', 1213122, 'qascdscd'),
(4, 'ayoub', 'ahabbane', '1997-08-02', 'Maroccain', 'celebataire', 'BLED EL JED', 'Voyage', '2023-08-01', '2023-10-01', 12345678, 'Passport');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dossier`
--
ALTER TABLE `dossier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
