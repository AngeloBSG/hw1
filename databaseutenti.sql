-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 27, 2024 alle 10:07
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `databaseutenti`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `mipiace`
--

CREATE TABLE `mipiace` (
  `emailUtente` varchar(30) NOT NULL,
  `codiceRicetta` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `mipiace`
--

INSERT INTO `mipiace` (`emailUtente`, `codiceRicetta`) VALUES
('mario.rossi@gmail.com', '0001'),
('luca.verdi@gmail.com', '0003'),
('anna.neri@gmail.com', '0002');

-- --------------------------------------------------------

--
-- Struttura della tabella `ricetta`
--

CREATE TABLE `ricetta` (
  `codiceRicetta` varchar(10) NOT NULL,
  `nomeRicetta` varchar(20) NOT NULL,
  `ingredientiRicetta` varchar(500) NOT NULL,
  `preparazioneRicetta` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ricetta`
--

INSERT INTO `ricetta` (`codiceRicetta`, `nomeRicetta`, `ingredientiRicetta`, `preparazioneRicetta`) VALUES
('0001', 'Spaghetti al pomodor', 'spaghetti, pomodori, olio, basilico, sale', 'Riscaldare un filo d’olio e versare i pomodori. Far bollire l’acqua con l’aggiunta di sale e versare gli spaghetti. Unire gli spaghetti, privati dell’acqua, nel sugo. Servire con una foglia di basilico.'),
('0002', 'Pesto di basilico', 'Basilico, aglio, olio, parmigiano, sale', 'Tritare tutti gli ingredienti fino ad ottenere la consistenza desiderata.'),
('0003', 'Cotoletta alla milan', 'cotolette, pangrattato, uovo, olio, spezie', 'Immergere le cotolette nell’uovo sbattuto e poi nel pangrattato. Riscaldare l’olio e immergere la cotoletta e attendere fino alla doratura.'),
('0004', 'Tiramisù', 'Mascarpone, Uova, Savoiardi, Zucchero, Caffe, Cacao amaro in polvere', 'Preparare il caffè e lasciarlo raffreddare. Separare i tuorli dagli albumi. Unire e sbattere i tuorli con lo zucchero. Aggiungere poco alla volta il mascarpone. Montare a neve gli albumi e incorporarli al resto degli ingredienti. Spargere una base di crema sul fondo di una pirofila, immergere i savoiardi nel caffè e disporli in fila sulla crema. Alternare gli strati di crema e savoiardi. Terminare con uno strato di crema e spolverare con il cacao amaro. Lasciare riposare in frigo. Servire freddo. '),
('0005', 'Milkshake', 'Gelato, panna montata, latte, frutta o aromi a scelta.', 'Frullare gelato, latte e frutta/aromi fino ad ottenere la consistenza desiderata. Versare in un bicchiere e guarnire con la panna montata.');

-- --------------------------------------------------------

--
-- Struttura della tabella `ricettacaricata`
--

CREATE TABLE `ricettacaricata` (
  `emailUtente` varchar(30) NOT NULL,
  `codiceRC` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ricettacaricata`
--

INSERT INTO `ricettacaricata` (`emailUtente`, `codiceRC`) VALUES
('anna.neri@gmail.com', '0005'),
('giulia.bianchi@gmail.com', '0001'),
('giulia.bianchi@gmail.com', '0002'),
('luca.verdi@gmail.com', '0003'),
('mario.rossi@gmail.com', '0004');

-- --------------------------------------------------------

--
-- Struttura della tabella `ricettasalvata`
--

CREATE TABLE `ricettasalvata` (
  `emailUtente` varchar(30) NOT NULL,
  `codiceRS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ricettasalvata`
--

INSERT INTO `ricettasalvata` (`emailUtente`, `codiceRS`) VALUES
('anna.neri@gmail.com', '0001');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `passwordUt` varchar(20) NOT NULL,
  `sesso` varchar(5) NOT NULL,
  `annoNascita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`nome`, `cognome`, `email`, `passwordUt`, `sesso`, `annoNascita`) VALUES
('Anna', 'Neri', 'anna.neri@gmail.com', 'Anna_Neri03', 'F', 2003),
('Giulia', 'Bianchi', 'giulia.bianchi@gmail.com', 'Giulia_bianchi98', 'F', 1998),
('Luca', 'Verdi', 'luca.verdi@gmail.com', 'Luca_Verdi99', 'M', 1999),
('Mario', 'Rossi', 'mario.rossi@gmail.com', 'Mario_Rossi00', 'M', 2000);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `mipiace`
--
ALTER TABLE `mipiace`
  ADD KEY `emailUtente` (`emailUtente`),
  ADD KEY `codiceRicetta` (`codiceRicetta`);

--
-- Indici per le tabelle `ricetta`
--
ALTER TABLE `ricetta`
  ADD PRIMARY KEY (`codiceRicetta`);

--
-- Indici per le tabelle `ricettacaricata`
--
ALTER TABLE `ricettacaricata`
  ADD PRIMARY KEY (`codiceRC`),
  ADD KEY `emailUtente` (`emailUtente`);

--
-- Indici per le tabelle `ricettasalvata`
--
ALTER TABLE `ricettasalvata`
  ADD PRIMARY KEY (`codiceRS`),
  ADD KEY `emailUtente` (`emailUtente`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`email`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `mipiace`
--
ALTER TABLE `mipiace`
  ADD CONSTRAINT `mipiace_ibfk_1` FOREIGN KEY (`emailUtente`) REFERENCES `utente` (`email`),
  ADD CONSTRAINT `mipiace_ibfk_2` FOREIGN KEY (`codiceRicetta`) REFERENCES `ricetta` (`codiceRicetta`);

--
-- Limiti per la tabella `ricettacaricata`
--
ALTER TABLE `ricettacaricata`
  ADD CONSTRAINT `ricettacaricata_ibfk_1` FOREIGN KEY (`emailUtente`) REFERENCES `utente` (`email`),
  ADD CONSTRAINT `ricettacaricata_ibfk_2` FOREIGN KEY (`codiceRC`) REFERENCES `ricetta` (`codiceRicetta`);

--
-- Limiti per la tabella `ricettasalvata`
--
ALTER TABLE `ricettasalvata`
  ADD CONSTRAINT `ricettasalvata_ibfk_1` FOREIGN KEY (`emailUtente`) REFERENCES `utente` (`email`),
  ADD CONSTRAINT `ricettasalvata_ibfk_2` FOREIGN KEY (`codiceRS`) REFERENCES `ricetta` (`codiceRicetta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
