-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2024 at 11:56 PM
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
-- Database: `modlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `id_game`, `name`) VALUES
(1, 1, 'Storage'),
(2, 1, 'Magic'),
(3, 2, 'Gameplay'),
(4, 2, 'Parts pack'),
(5, 2, 'Visual');

-- --------------------------------------------------------

--
-- Table structure for table `creators`
--

CREATE TABLE `creators` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `profile_link` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `creators`
--

INSERT INTO `creators` (`id`, `name`, `profile_link`) VALUES
(1, 'Benjee10', 'https://github.com/benjee10'),
(2, 'SuperMartijn642', 'https://www.curseforge.com/members/supermartijn642/projects');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mods_ammount` int(11) NOT NULL DEFAULT 0,
  `description` varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `name`, `mods_ammount`, `description`) VALUES
(1, 'Minecraft', 2, 'Minecraft es un videojuego de construcción y exploración en un entorno de mundo abierto, creado por el desarrollador sueco Markus Persson, más conocido como \"Notch\". Inicialmente lanzó el juego bajo su estudio Mojang, que más tarde pasó a ser parte de Microsoft. La versión original del juego, conocida como Java Edition, fue programada en Java, mientras que más adelante se desarrolló una versión en C++, llamada Bedrock Edition. Minecraft vio la luz por primera vez el 17 de mayo de 2009 y, tras varios ajustes y mejoras, su versión estable 1.0 fue lanzada el 18 de noviembre de 2011.'),
(2, 'Kerbal Space Program', 2, 'Kerbal Space Program, o KSP, es un simulador espacial donde los jugadores dirigen su propio programa espacial. El juego gira en torno a la construcción de cohetes, naves espaciales, vehículos de exploración y estaciones orbitales, con el objetivo de lanzarlos al espacio y realizar misiones a otros planetas o lunas dentro de un sistema planetario ficticio que recuerda al sistema solar.');

-- --------------------------------------------------------

--
-- Table structure for table `mods`
--

CREATE TABLE `mods` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `creation_date` date NOT NULL,
  `github_link` varchar(256) NOT NULL,
  `download_link` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mods`
--

INSERT INTO `mods` (`id`, `game_id`, `category_id`, `creator_id`, `name`, `description`, `creation_date`, `github_link`, `download_link`) VALUES
(1, 1, 1, 2, 'Trash Cans', 'Trash Cans adds Trash Cans which can be used to void items, fluids and energy! Items and Fluids can be whitelisted or blacklisted and an energy transfer limit can be set!', '2020-06-09', 'https://github.com/SuperMartijn642/TrashCans', 'https://www.curseforge.com/minecraft/mc-mods/trash-cans/files/all?page=1&pageSize=20'),
(2, 1, 1, 2, 'Portable Tanks', 'Portable Tanks adds fluid tanks which keep their contents when picked up. You can change the input and output using an empty hand. The output state allows the tanks to output to blocks underneath them. ', '2021-07-14', 'https://github.com/Dremoline/PortableTanks', 'https://www.curseforge.com/minecraft/mc-mods/portable-tanks/files/all?page=1&pageSize=20'),
(3, 2, 4, 1, 'Shuttle Orbiter Construction-Kit\r\n', 'This mod provides a set of parts designed to emulate the NASA Space Shuttle Orbiter. It works best paired with reDIRECT launch vehicle parts in a 2.5X scale solar system, but can be used however you please! Please consult the user manual for a brief guide on how to build and fly the Space Shuttle. ', '2021-04-29', 'https://github.com/benjee10/Shuttle-Orbiter-Construction-Kit/releases', 'https://spacedock.info/mod/2176/Shuttle%20Orbiter%20Construction%20Kit#changelog'),
(4, 2, 4, 1, 'HabTech2', 'Parts designed to replicate the US Orbital Section (USOS) of the International Space Station:\r\n- Pressurised modules & cupola\r\n- Integrated Truss Structure & solar arrays, including iROSA\r\n- External payloads & experiments\r\n- Other structural pieces, science parts and antennas\r\n- Canadarm2 & Mobile Base System\r\n- New additions to the ISS such as BEAM, Bishop airlock, and more', '2023-02-18', 'https://github.com/benjee10/HabTech2', 'https://spacedock.info/mod/2078/HabTech2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_category_game_id` (`id_game`);

--
-- Indexes for table `creators`
--
ALTER TABLE `creators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mods`
--
ALTER TABLE `mods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_mod_category_id` (`category_id`),
  ADD KEY `FK_mod_creator_id` (`creator_id`),
  ADD KEY `FK_mod_game_id` (`game_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `creators`
--
ALTER TABLE `creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mods`
--
ALTER TABLE `mods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `FK_category_game_id` FOREIGN KEY (`id_game`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `mods`
--
ALTER TABLE `mods`
  ADD CONSTRAINT `FK_mod_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_mod_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `creators` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_mod_game_id` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
