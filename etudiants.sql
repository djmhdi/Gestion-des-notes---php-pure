-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2018 at 08:14 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `etudiants`
--

-- --------------------------------------------------------

--
-- Table structure for table `etudiants`
--

CREATE TABLE `etudiants` (
  `num` int(10) UNSIGNED NOT NULL,
  `nom` varchar(15) DEFAULT NULL,
  `prenom` varchar(10) DEFAULT NULL,
  `filiere` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etudiants`
--

INSERT INTO `etudiants` (`num`, `nom`, `prenom`, `filiere`) VALUES
(1, 'alami', 'ahmed', 'MS-ISI'),
(2, 'benkirane', 'aicha', 'MS-ISI'),
(3, 'zaimi', 'amine', 'MS-ISI'),
(4, 'youssefi', 'hamza', 'MS-ISI'),
(5, 'bencharki', 'khansae', 'MS-ISI'),
(6, 'jilali', 'ilyas', 'MS-SD'),
(7, 'berradi', 'ali', 'MS-SD');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `intitule` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `intitule`) VALUES
(1, 'Traitement des documents électroniques'),
(2, 'Ingegnerie des systèmes d\'informations'),
(3, 'Programmation web'),
(4, 'Programmation avancée'),
(5, 'Conception orientée objet des SI');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `note` double NOT NULL,
  `num_etudiant` int(10) UNSIGNED NOT NULL,
  `id_semestre` int(10) UNSIGNED NOT NULL,
  `id_module` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`note`, `num_etudiant`, `id_semestre`, `id_module`) VALUES
(13, 1, 1, 1),
(14, 1, 1, 2),
(15, 1, 1, 4),
(16, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `semestres`
--

CREATE TABLE `semestres` (
  `id` int(10) UNSIGNED NOT NULL,
  `intitule` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semestres`
--

INSERT INTO `semestres` (`id`, `intitule`) VALUES
(1, 'Semestre 1'),
(2, 'Semestre 2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'mehdi', '7c4a8d09ca3762af61e59520943dc26494f8941b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`num_etudiant`,`id_semestre`,`id_module`),
  ADD KEY `FK_notes_2` (`id_module`),
  ADD KEY `FK_notes_3` (`id_semestre`);

--
-- Indexes for table `semestres`
--
ALTER TABLE `semestres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `num` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `semestres`
--
ALTER TABLE `semestres`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `FK_notes_1` FOREIGN KEY (`num_etudiant`) REFERENCES `etudiants` (`num`),
  ADD CONSTRAINT `FK_notes_2` FOREIGN KEY (`id_module`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `FK_notes_3` FOREIGN KEY (`id_semestre`) REFERENCES `semestres` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
