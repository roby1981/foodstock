-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 04. Apr 2022 um 16:35
-- Server-Version: 10.5.15-MariaDB-0+deb11u1
-- PHP-Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `foodstock`
--
DROP DATABASE IF EXISTS `foodstock`;
CREATE DATABASE IF NOT EXISTS `foodstock` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `foodstock`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `generic`
--

DROP TABLE IF EXISTS `generic`;
CREATE TABLE `generic` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `measures`
--

DROP TABLE IF EXISTS `measures`;
CREATE TABLE `measures` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `shortcut` varchar(10) NOT NULL,
  `resizeable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `packaging`
--

DROP TABLE IF EXISTS `packaging`;
CREATE TABLE `packaging` (
  `id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `generic` varchar(255) NOT NULL,
  `packaging` varchar(255) NOT NULL,
  `measures` varchar(255) NOT NULL,
  `basic_amount` int(11) NOT NULL,
  `durability` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `exp_date` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stellvertreter-Struktur des Views `survey_stock`
-- (Siehe unten für die tatsächliche Ansicht)
--
DROP VIEW IF EXISTS `survey_stock`;
CREATE TABLE `survey_stock` (
`id` int(11)
,`product` varchar(255)
,`amount` int(11)
,`measure` varchar(255)
,`shortcut` varchar(10)
,`resizeable` tinyint(1)
,`packaging` varchar(255)
,`generic` varchar(255)
,`basic_amount` int(11)
,`user` varchar(255)
,`purchase_date` date
,`full_amount` bigint(21)
,`best_before_date` date
);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `creation_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur des Views `survey_stock`
--
DROP TABLE IF EXISTS `survey_stock`;

DROP VIEW IF EXISTS `survey_stock`;
CREATE OR REPLACE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `survey_stock`  AS SELECT `stock`.`id` AS `id`, `stock`.`product` AS `product`, `stock`.`amount` AS `amount`, `products`.`measures` AS `measure`, `measures`.`shortcut` AS `shortcut`, `measures`.`resizeable` AS `resizeable`, `packaging`.`value` AS `packaging`, `generic`.`value` AS `generic`, `products`.`basic_amount` AS `basic_amount`, `stock`.`user` AS `user`, `stock`.`date` AS `purchase_date`, `stock`.`amount`* `products`.`basic_amount` AS `full_amount`, `stock`.`exp_date` AS `best_before_date` FROM ((((`stock` left join `products` on(`stock`.`product` = `products`.`name`)) left join `measures` on(`measures`.`value` = `products`.`measures`)) left join `packaging` on(`packaging`.`value` = `products`.`packaging`)) left join `generic` on(`generic`.`value` = `products`.`generic`)) WHERE 1 ;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `generic`
--
ALTER TABLE `generic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `VALUE` (`value`),
  ADD UNIQUE KEY `value_2` (`value`);

--
-- Indizes für die Tabelle `measures`
--
ALTER TABLE `measures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indizes für die Tabelle `packaging`
--
ALTER TABLE `packaging`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `measures` (`measures`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE,
  ADD KEY `packaging` (`packaging`) USING BTREE,
  ADD KEY `generic` (`generic`),
  ADD KEY `name` (`name`) USING BTREE;

--
-- Indizes für die Tabelle `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product`),
  ADD KEY `user` (`user`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `generic`
--
ALTER TABLE `generic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `measures`
--
ALTER TABLE `measures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `packaging`
--
ALTER TABLE `packaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `generic` FOREIGN KEY (`generic`) REFERENCES `generic` (`value`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `measures` FOREIGN KEY (`measures`) REFERENCES `measures` (`value`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `packaging` FOREIGN KEY (`packaging`) REFERENCES `packaging` (`value`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `product` FOREIGN KEY (`product`) REFERENCES `products` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
