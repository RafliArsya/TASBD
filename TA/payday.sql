-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2020 at 02:59 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payday`
--

-- --------------------------------------------------------

--
-- Table structure for table `diff_table`
--

CREATE TABLE `diff_table` (
  `id` int(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `hp_mul` int(2) NOT NULL,
  `hs_mul` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diff_table`
--

INSERT INTO `diff_table` (`id`, `name`, `hp_mul`, `hs_mul`) VALUES
(1, 'EASY', 1, 1),
(2, 'NORMAL', 1, 1),
(3, 'HARD', 1, 1),
(4, 'VERY HARD', 2, 2),
(5, 'OVERKILL', 3, 3),
(6, 'MAYHEM', 6, 2),
(7, 'DEATHWISH', 6, 1.5),
(8, 'DEATH SENTENCES', 6, 1.5);

-- --------------------------------------------------------

--
-- Table structure for table `enemy_char`
--

CREATE TABLE `enemy_char` (
  `id` int(4) NOT NULL,
  `char_name` varchar(20) NOT NULL,
  `dmg` float NOT NULL,
  `spesial` tinyint(1) NOT NULL,
  `faceplate` tinyint(1) NOT NULL,
  `shield` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enemy_char`
--

INSERT INTO `enemy_char` (`id`, `char_name`, `dmg`, `spesial`, `faceplate`, `shield`) VALUES
(1, 'SWAT', 160, 0, 0, 0),
(2, 'SHIELD', 80, 1, 0, 1),
(3, 'Bulldozer', 2000, 1, 1, 1),
(4, 'Sniper', 40, 1, 0, 0),
(5, 'Gensec SWAT', 80, 0, 0, 1),
(6, 'Taser', 300, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `username`, `password`) VALUES
(1, 'Rafli', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_ohk`
-- (See below for the actual view)
--
CREATE TABLE `view_ohk` (
`char_name` varchar(20)
,`dmg` float
,`weapon_name` varchar(30)
,`stats_dmg` float
);

-- --------------------------------------------------------

--
-- Table structure for table `weaponmods_table`
--

CREATE TABLE `weaponmods_table` (
  `weaponmods_id` int(4) NOT NULL,
  `weaponmods_name` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `dmg` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weaponmods_table`
--

INSERT INTO `weaponmods_table` (`weaponmods_id`, `weaponmods_name`, `type`, `dmg`) VALUES
(1, 'Low Suppressor', 'Barrel Ext', -5),
(2, 'Stub Compensator', 'Barrel Ext', 1),
(3, 'Roctec Sup', 'Barrel Ext', -3),
(4, 'Flash Hider', 'Barrel Ext', 2),
(5, 'Medium Barrel', 'Barrel', -2),
(6, 'Suppressed Barrel', 'Barrel', -5),
(7, 'HE Round', 'Ammo', -10),
(8, 'FMJ', 'Ammo', -15),
(9, '9mm', 'Ammo', 20),
(10, 'Slug Round', 'Ammo', 3);

-- --------------------------------------------------------

--
-- Table structure for table `weapontweakdata`
--

CREATE TABLE `weapontweakdata` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mag` int(5) NOT NULL,
  `ammo` int(5) NOT NULL,
  `dmg` int(5) NOT NULL,
  `acc` int(5) NOT NULL,
  `stability` int(5) NOT NULL,
  `concealment` int(5) NOT NULL,
  `rof` int(5) NOT NULL,
  `type` varchar(15) NOT NULL,
  `img_src` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weapontweakdata`
--

INSERT INTO `weapontweakdata` (`id`, `name`, `mag`, `ammo`, `dmg`, `acc`, `stability`, `concealment`, `rof`, `type`, `img_src`) VALUES
(1, 'ak', 30, 150, 56, 48, 60, 16, 652, 'Assault Rifle', 'https://i.imgur.com/U2YRNkd.png'),
(2, 'amcar', 20, 220, 42, 36, 76, 21, 545, 'Assault Rifle', 'https://i.imgur.com/HPax9eD.png'),
(3, 'M95', 5, 15, 3500, 92, 4, 1, 40, 'Sniper Rifle', 'https://i.imgur.com/ztvBWvT.png'),
(4, 'R700', 10, 40, 246, 92, 28, 10, 75, 'Sniper Rifle', 'https://i.imgur.com/Nhjgjem.png'),
(5, 'M60', 200, 400, 120, 56, 20, 1, 550, 'LMG', 'https://i.imgur.com/yKlV0hL.png'),
(6, 'Deagle', 10, 50, 120, 76, 28, 28, 240, 'Pistol', 'https://i.imgur.com/swZnzzo.png');

-- --------------------------------------------------------

--
-- Table structure for table `weapon_table`
--

CREATE TABLE `weapon_table` (
  `weapon_id` int(4) NOT NULL,
  `weapon_name` varchar(30) NOT NULL,
  `stats_dmg` float NOT NULL,
  `stats_shield` tinyint(1) NOT NULL,
  `stats_piercing` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weapon_table`
--

INSERT INTO `weapon_table` (`weapon_id`, `weapon_name`, `stats_dmg`, `stats_shield`, `stats_piercing`) VALUES
(1, 'ak', 56, 0, 0),
(2, 'amcar', 42, 0, 0),
(3, 'M95', 3500, 1, 1),
(4, 'R700', 250, 1, 1),
(5, 'Deagle', 120, 0, 1),
(6, '5/7 Pistol', 100, 1, 1),
(8, 'MSR', 290, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `weapon_weaponmods`
--

CREATE TABLE `weapon_weaponmods` (
  `id` int(11) NOT NULL,
  `weapon_id` int(11) NOT NULL,
  `weaponmods_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weapon_weaponmods`
--

INSERT INTO `weapon_weaponmods` (`id`, `weapon_id`, `weaponmods_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 2),
(5, 5, 3),
(6, 5, 4),
(7, 5, 8),
(8, 6, 3),
(9, 6, 4),
(10, 6, 9),
(11, 3, 5),
(12, 3, 6),
(13, 4, 5),
(14, 4, 6),
(15, 4, 7),
(18, 8, 8),
(19, 8, 2);

-- --------------------------------------------------------

--
-- Structure for view `view_ohk`
--
DROP TABLE IF EXISTS `view_ohk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_ohk`  AS  select `a`.`char_name` AS `char_name`,`a`.`dmg` AS `dmg`,`b`.`weapon_name` AS `weapon_name`,`b`.`stats_dmg` AS `stats_dmg` from (`enemy_char` `a` join `weapon_table` `b`) where `a`.`dmg` <= `b`.`stats_dmg` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diff_table`
--
ALTER TABLE `diff_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enemy_char`
--
ALTER TABLE `enemy_char`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `weaponmods_table`
--
ALTER TABLE `weaponmods_table`
  ADD PRIMARY KEY (`weaponmods_id`);

--
-- Indexes for table `weapontweakdata`
--
ALTER TABLE `weapontweakdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weapon_table`
--
ALTER TABLE `weapon_table`
  ADD PRIMARY KEY (`weapon_id`);

--
-- Indexes for table `weapon_weaponmods`
--
ALTER TABLE `weapon_weaponmods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_weaponid` (`weapon_id`),
  ADD KEY `FK_weaponmodsid` (`weaponmods_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enemy_char`
--
ALTER TABLE `enemy_char`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `weaponmods_table`
--
ALTER TABLE `weaponmods_table`
  MODIFY `weaponmods_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `weapontweakdata`
--
ALTER TABLE `weapontweakdata`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `weapon_table`
--
ALTER TABLE `weapon_table`
  MODIFY `weapon_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `weapon_weaponmods`
--
ALTER TABLE `weapon_weaponmods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `weapon_weaponmods`
--
ALTER TABLE `weapon_weaponmods`
  ADD CONSTRAINT `FK_weaponid` FOREIGN KEY (`weapon_id`) REFERENCES `weapon_table` (`weapon_id`),
  ADD CONSTRAINT `FK_weaponmodsid` FOREIGN KEY (`weaponmods_id`) REFERENCES `weaponmods_table` (`weaponmods_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
