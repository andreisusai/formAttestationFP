-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 06, 2021 at 10:24 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formation_plus`
--

-- --------------------------------------------------------

--
-- Table structure for table `attestation`
--

CREATE TABLE `attestation` (
  `idAttestation` int(11) NOT NULL,
  `etudiant` int(11) NOT NULL,
  `convention` int(11) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attestation`
--

INSERT INTO `attestation` (`idAttestation`, `etudiant`, `convention`, `message`) VALUES
(29, 2, 1, 'Bonjour ALEXANDRE FRANCINEAU,\r\n\r\n        Vous avez suivi 400h de formation chez FormationPlus.\r\n\r\n        Pouvez-vous nous retourner ce mail avec la pièce jointe signée.\r\n\r\n        Cordialement,\r\n\r\n        FormationPlus'),
(30, 4, 2, 'Bonjour SARAH GAUDINEAU,\r\n\r\n        Vous avez suivi 1200h de formation chez FormationPlus.\r\njdjjdjdj\r\n        Pouvez-vous nous retourner ce mail avec la pièce jointe signée.\r\n\r\n        Cordialement,\r\n\r\n        FormationPlus'),
(31, 3, 2, 'Bonjour MÉLODIE CLATOT,\r\n\r\n        Vous avez suivi 1200h de formation chez FormationPlus.\r\n\r\n        Pouvez-vous nous retourner ce mail avec la pièce jointe signée.\r\n\r\n        Cordialement,\r\n\r\n        FormationPlus');

-- --------------------------------------------------------

--
-- Table structure for table `convention`
--

CREATE TABLE `convention` (
  `idConvention` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `nbHeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `convention`
--

INSERT INTO `convention` (`idConvention`, `nom`, `nbHeur`) VALUES
(1, 'Stage', 400),
(2, 'Contrat pro', 1200),
(3, 'Alternance', 900);

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `idEtudiant` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `convention` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`idEtudiant`, `nom`, `prenom`, `mail`, `convention`) VALUES
(1, 'Dupont', 'Marie', 'marie@gmail.com', 1),
(2, 'Alexandre', 'Francineau', 'alexandre@gmail.com', 1),
(3, 'Mélodie', 'Clatot', 'melodie@gmail.com', 2),
(4, 'Sarah', 'Gaudineau', 'sarah@gmail.com', 2),
(5, 'Benoît', 'Nocus', 'benoit@gmail.com', 3),
(6, 'Maxim', 'Berger', 'maxim@gmail.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attestation`
--
ALTER TABLE `attestation`
  ADD PRIMARY KEY (`idAttestation`),
  ADD KEY `etudiant` (`etudiant`),
  ADD KEY `convention` (`convention`);

--
-- Indexes for table `convention`
--
ALTER TABLE `convention`
  ADD PRIMARY KEY (`idConvention`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`idEtudiant`),
  ADD KEY `convention` (`convention`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attestation`
--
ALTER TABLE `attestation`
  MODIFY `idAttestation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `convention`
--
ALTER TABLE `convention`
  MODIFY `idConvention` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `idEtudiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attestation`
--
ALTER TABLE `attestation`
  ADD CONSTRAINT `attestation_ibfk_1` FOREIGN KEY (`etudiant`) REFERENCES `etudiant` (`idEtudiant`),
  ADD CONSTRAINT `attestation_ibfk_2` FOREIGN KEY (`convention`) REFERENCES `convention` (`idConvention`);

--
-- Constraints for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`convention`) REFERENCES `convention` (`idConvention`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
