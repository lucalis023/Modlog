SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `id_game` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `id_game`, `name`) VALUES
(1, 1, 'Storage'),
(2, 1, 'Magic'),
(3, 2, 'Gameplay'),
(4, 2, 'Parts pack'),
(5, 2, 'Visual'),
(23, 1, 'Information'),
(24, 1, 'API & Tweeks'),
(25, 1, 'Equipment'),
(26, 16, 'Modding Tools');

CREATE TABLE `creators` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `profile_link` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `creators` (`id`, `name`, `profile_link`) VALUES
(1, 'Benjee10', 'https://github.com/benjee10'),
(2, 'SuperMartijn642', 'https://www.curseforge.com/members/supermartijn642/projects'),
(9, 'mezz', 'https://www.curseforge.com/members/mezz/projects'),
(10, 'shedaniel', 'https://www.curseforge.com/members/shedaniel/projects'),
(11, 'TheIllusiveC4', 'https://www.curseforge.com/members/theillusivec4/projects'),
(12, 'techbrew', 'https://www.curseforge.com/members/techbrew/projects'),
(13, 'Pathoschild', 'https://next.nexusmods.com/profile/Pathoschild/about-me?gameId=1303');

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2048) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

INSERT INTO `games` (`id`, `name`, `description`, `image`) VALUES
(1, 'Minecraft', 'Minecraft es un videojuego de construcción y exploración en un entorno de mundo abierto, creado por el desarrollador sueco Markus Persson, más conocido como ', 'public/uploads/games/Minecraft_9f0fa896f8c3ace383ea6f3fdb6b832c.png'),
(2, 'Kerbal Space Program', 'Kerbal Space Program, o KSP, es un simulador espacial donde los jugadores dirigen su propio programa espacial. El juego gira en torno a la construcción de cohetes, naves espaciales, vehículos de exploración y estaciones orbitales, con el objetivo de lanzarlos al espacio y realizar misiones a otros planetas o lunas dentro de un sistema planetario ficticio que recuerda al sistema solar.', 'public/uploads/games/Kerbal Space Program_88d43cfd93c7043407d14c6af4988dd2.png'),
(16, 'Stardew Valley', 'Stardew Valley es un juego de simulación en el que heredas una granja y debes restaurarla. Puedes cultivar, criar animales, pescar, minar y relacionarte con los habitantes del pueblo, mientras mejoras la granja y puedes formar una familia.', 'public/uploads/games/Stardew Valley_ea9698dafd9b416c80ed31512f24af73.png');

CREATE TABLE `mods` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(2048) DEFAULT NULL,
  `creation_date` date NOT NULL,
  `github_link` varchar(256) DEFAULT NULL,
  `download_link` varchar(256) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `mods` (`id`, `game_id`, `category_id`, `creator_id`, `name`, `description`, `creation_date`, `github_link`, `download_link`, `image`) VALUES
(1, 1, 1, 1, 'Trash Cans', 'Trash Cans adds Trash Cans which can be used to void items, fluids and energy! Items and Fluids can be whitelisted or blacklisted and an energy transfer limit can be set!', '2020-06-09', 'https://github.com/SuperMartijn642/TrashCans', 'https://www.curseforge.com/minecraft/mc-mods/trash-cans/files/all?page=1&pageSize=20', NULL),
(3, 2, 4, 1, 'Shuttle Orbiter Construction-Kit\r\n', 'This mod provides a set of parts designed to emulate the NASA Space Shuttle Orbiter. It works best paired with reDIRECT launch vehicle parts in a 2.5X scale solar system, but can be used however you please! Please consult the user manual for a brief guide on how to build and fly the Space Shuttle. ', '2021-04-29', 'https://github.com/benjee10/Shuttle-Orbiter-Construction-Kit/releases', 'https://spacedock.info/mod/2176/Shuttle%20Orbiter%20Construction%20Kit#changelog', NULL),
(4, 2, 4, 1, 'HabTech2', 'Parts designed to replicate the US Orbital Section (USOS) of the International Space Station:\r\n- Pressurised modules & cupola\r\n- Integrated Truss Structure & solar arrays, including iROSA\r\n- External payloads & experiments\r\n- Other structural pieces, science parts and antennas\r\n- Canadarm2 & Mobile Base System\r\n- New additions to the ISS such as BEAM, Bishop airlock, and more', '2023-02-18', 'https://github.com/benjee10/HabTech2', 'https://spacedock.info/mod/2078/HabTech2', NULL),
(10, 1, 23, 9, 'Just Enough Items', '', '2015-11-23', '', 'https://www.curseforge.com/minecraft/mc-mods/jei/files/all?page=1&pageSize=20', 'public/uploads/mods/Just Enough Items_444686acd412d95ec363d602e4e8eea9.png'),
(11, 1, 24, 10, 'Cloth Config API', 'Cloth Config API is a config screen api.', '2019-10-19', '', 'https://www.curseforge.com/minecraft/mc-mods/cloth-config/files/all?page=1&pageSize=20', 'public/uploads/mods/Cloth Config API_e0dc11d7cc55d21298dceb42d57660e9.png'),
(12, 1, 25, 11, 'Curios API', '', '2018-12-27', '', 'https://www.curseforge.com/minecraft/mc-mods/curios/files/all?page=1&pageSize=20', 'public/uploads/mods/Curios API_b9a260f1171e12a9d748bdd60e1ddd2d.png'),
(13, 1, 23, 12, 'JourneyMap', 'JourneyMap is a client+server mod for Forge or Fabric and Quilt which maps your Minecraft world in real-time as you explore. You can view the map in a web browser or in-game as a Minimap or full-screen. ', '2011-09-19', '', 'https://www.curseforge.com/minecraft/mc-mods/journeymap/files/all?page=1&pageSize=20', 'public/uploads/mods/JourneyMap_e2b4f70a2939727c4c6fe13627c31b84.png'),
(14, 16, 26, 13, 'SMAPI', 'SMAPI is the mod loader for Stardew Valley. It works fine with GOG and Steam achievements, its compatible with Linux/macOS/Windows, you can uninstall it anytime, and there\"s a friendly community if you need help. SMAPI is required for most types of Stardew Valley mod.', '2018-06-16', '', 'https://www.nexusmods.com/stardewvalley/mods/2400?tab=files', 'public/uploads/mods/SMAPI_9dfff72127c0a004628e93fec8605cdd.png'),
(15, 16, 26, 13, 'Content Patcher', 'Content Patcher loads content packs that change the game\"s data, images, and maps without replacing XNB files. Content packs can make changes dynamically based on many in-game details like location, weather, date, festivals or events, spouse, relationships, whether you have a Joja membership, etc.', '2018-02-25', 'https://github.com/Pathoschild/StardewMods/tree/stable/ContentPatcher', 'https://www.nexusmods.com/stardewvalley/mods/1915?tab=files', 'public/uploads/mods/Content Patcher_c988aa2060fbd5227a72f7523c49e944.png');

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`) VALUES
(1, 'KK', 'leokessy2005@gmail.com', '$2y$10$i9AvtjUzTvU8WVCV58zjVup8gswlvXaV3MV1YQEIAs2OMwW3wdP6S', 1),
(2, 'zz', 'zz@gmail.com', '$2y$10$wocO6toV5jvoFjOCOm3hteSJNSrgRafp5IL1jj3vYBEc9DReFS5/.', 0),
(3, 'Josue', 'a@a', '$2y$10$AZHaCbje/3AHlYl8q2MLYewqATscGexPXjfEJ.MjsMNHgrE.9HQ5q', 0);

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_category_game_id` (`id_game`);

ALTER TABLE `creators`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `mods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_mod_game_id` (`game_id`),
  ADD KEY `FK_mod_category_id` (`category_id`),
  ADD KEY `FK_mod_creator_id` (`creator_id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

ALTER TABLE `creators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `mods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `categories`
  ADD CONSTRAINT `FK_category_game_id` FOREIGN KEY (`id_game`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

ALTER TABLE `mods`
  ADD CONSTRAINT `FK_mod_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_mod_creator_id` FOREIGN KEY (`creator_id`) REFERENCES `creators` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_mod_game_id` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;