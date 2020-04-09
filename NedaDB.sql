-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2020 at 01:01 PM
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
  `prodavnica` text NOT NULL,
  `korisnik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Knjiga`
--

INSERT INTO `Knjiga` (`id`, `naslov`, `autor`, `opis`, `cena`, `prodavnica`, `korisnik_id`) VALUES
(1, 'Neda2', 'Autorka', 'Opisujem opisom', 2, 'dsada', 14),
(3, 'Neda', 'Nedic', 'nedam', 420, 'nema', 14),
(4, '3', '3', '3', 65, 's', 14),
(5, 'be', 'baa', 'bu', 55, 'gagag', 14),
(6, 'hi', 'ho', 'he', 99, 'hooo', 14);

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
(14, 'Neda', 'Vukovic', 'Neda Haker', 'neda@neda.com', 'neda'),
(19, 'Pera', 'Peric', 'ropefs17', 'rope@rope.com', 'rope');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Korisnik`
--
ALTER TABLE `Korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
