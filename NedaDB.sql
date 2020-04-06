-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 06, 2020 at 02:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `NedaDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Knjiga`
--

CREATE TABLE `Knjiga` (
  `id` int(11) NOT NULL,
  `naslov` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `opis` text NOT NULL,
  `cena` int(11) NOT NULL,
  `prodavnica` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Korisnik`
--

CREATE TABLE `Korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `nadimak` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `sifra` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Korisnik`
--

INSERT INTO `Korisnik` (`id`, `ime`, `prezime`, `nadimak`, `email`, `sifra`) VALUES
(5, 'dsadsa', 'dsadsa', 'dasdsa', 'dsada@dsadsa.com', 'dsadsa'),
(6, 'a', 'b', 'c', 'd@d.com', 'g');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Knjiga`
--
ALTER TABLE `Knjiga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Korisnik`
--
ALTER TABLE `Korisnik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Knjiga`
--
ALTER TABLE `Knjiga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Korisnik`
--
ALTER TABLE `Korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
