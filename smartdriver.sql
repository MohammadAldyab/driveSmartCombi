-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 12 apr 2024 om 06:53
-- Serverversie: 5.7.24
-- PHP-versie: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartdriver`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auto`
--

CREATE TABLE `auto` (
  `id` int(12) NOT NULL,
  `kenteken` varchar(6) NOT NULL,
  `merk` varchar(30) NOT NULL,
  `model` varchar(50) NOT NULL,
  `brandstof` varchar(30) NOT NULL,
  `heeft_cruise_control` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `auto`
--

INSERT INTO `auto` (`id`, `kenteken`, `merk`, `model`, `brandstof`, `heeft_cruise_control`) VALUES
(1, 'NRKMA', 'Mercedic', 'AMG', 'Benziene', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `bericht` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`id`, `naam`, `email`, `bericht`) VALUES
(18, 'tala', 'mona@gmail.com', 'Ik wil melding'),
(19, 'swwwwww', 'mona@gmail.com', 'sss'),
(20, 'Testcontact', 'test@test.nlf2', 'Test'),
(21, 'Omar', 'test@test.nlf2', 'TestStudent'),
(22, 'Omar', 'test@test.nlf2', 'TestDrijver'),
(23, 'Omar', 'test@test.nlf2', 'TestBezoeker'),
(24, 'la Game', 'Mohammad@gmail.com', 'Mohammad'),
(25, 'Mom', 'test@test.nlf2', 'test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `instructeur`
--

CREATE TABLE `instructeur` (
  `id` int(12) NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `achternaam` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `wachtwoord` varchar(70) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `instructeur`
--

INSERT INTO `instructeur` (`id`, `voornaam`, `achternaam`, `email`, `wachtwoord`, `is_admin`) VALUES
(1, 'Mohammad', 'Aldyab', 'omar@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(2, 'particulier', 'test', 'talal@gmail.com', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerling`
--

CREATE TABLE `leerling` (
  `id` int(12) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `adres` varchar(100) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `woonplaats` varchar(30) NOT NULL,
  `telefoon` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `leerling`
--

INSERT INTO `leerling` (`id`, `naam`, `adres`, `postcode`, `woonplaats`, `telefoon`, `email`, `wachtwoord`) VALUES
(1, 'Ahmed', 'Linne16', '45PX', 'Linne', 63908432, 'ahmed@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'kadir', 'Venlo', '453CX', 'Venlo', 8388283, 'kadir@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'testnaam', 'Bredeweg', '500NV', 'Roermond', 632456789, 'dddaad@gmail.com', '980ac217c6b51e7dc41040bec1edfec8'),
(4, 'testnaam', 'Bredeweg', '500NV', 'Roermond', 632456789, 'asas@dss', '1aabac6d068eef6a7bad3fdf50a05cc8'),
(5, 'testnaam', 'Bredeweg', '500NV', 'Roermond', 632456789, 'mosa@gmail.com', 'bcbe3365e6ac95ea2c0343a2395834dd');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lesblok`
--

CREATE TABLE `lesblok` (
  `id` int(20) NOT NULL,
  `instructeur_id` int(12) NOT NULL,
  `auto_kenteken` int(12) NOT NULL,
  `datum` date NOT NULL,
  `tijdblok` time NOT NULL,
  `leerling_id` int(12) DEFAULT NULL,
  `verslag` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `lesblok`
--

INSERT INTO `lesblok` (`id`, `instructeur_id`, `auto_kenteken`, `datum`, `tijdblok`, `leerling_id`, `verslag`) VALUES
(1, 2, 1, '2024-04-11', '13:33:12', 2, NULL),
(9, 1, 1, '2024-04-10', '16:02:54', 1, 'test'),
(10, 1, 1, '2024-04-10', '12:48:09', 2, 'Het kan goed zijn'),
(11, 1, 1, '2024-04-30', '00:40:16', 2, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `strippenkaart`
--

CREATE TABLE `strippenkaart` (
  `id` int(12) NOT NULL,
  `student_id` int(12) NOT NULL,
  `aantal_lessen` int(3) NOT NULL,
  `resterende_lessen` int(3) NOT NULL,
  `status` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `strippenkaart`
--

INSERT INTO `strippenkaart` (`id`, `student_id`, `aantal_lessen`, `resterende_lessen`, `status`) VALUES
(3, 1, 22, -15, 1),
(12, 2, 20, -2, 0),
(14, 2, 20, -1, 0),
(15, 2, 45, -7, 1),
(16, 3, 59, 0, 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `instructeur`
--
ALTER TABLE `instructeur`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `leerling`
--
ALTER TABLE `leerling`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `lesblok`
--
ALTER TABLE `lesblok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_kenteken` (`auto_kenteken`),
  ADD KEY `instructeur_id` (`instructeur_id`),
  ADD KEY `leerling_id` (`leerling_id`);

--
-- Indexen voor tabel `strippenkaart`
--
ALTER TABLE `strippenkaart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `instructeur`
--
ALTER TABLE `instructeur`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `leerling`
--
ALTER TABLE `leerling`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `lesblok`
--
ALTER TABLE `lesblok`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `strippenkaart`
--
ALTER TABLE `strippenkaart`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `lesblok`
--
ALTER TABLE `lesblok`
  ADD CONSTRAINT `lesblok_ibfk_1` FOREIGN KEY (`auto_kenteken`) REFERENCES `auto` (`id`),
  ADD CONSTRAINT `lesblok_ibfk_2` FOREIGN KEY (`instructeur_id`) REFERENCES `instructeur` (`id`),
  ADD CONSTRAINT `lesblok_ibfk_3` FOREIGN KEY (`leerling_id`) REFERENCES `leerling` (`id`);

--
-- Beperkingen voor tabel `strippenkaart`
--
ALTER TABLE `strippenkaart`
  ADD CONSTRAINT `strippenkaart_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `leerling` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
