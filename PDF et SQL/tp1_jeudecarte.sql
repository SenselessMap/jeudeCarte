-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2025 at 09:47 PM
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
-- Database: `tp1_jeudecarte`
--

-- --------------------------------------------------------

--
-- Table structure for table `card_keyword`
--

CREATE TABLE `card_keyword` (
  `id_carte` int(11) NOT NULL,
  `id_keyword` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `card_keyword`
--

INSERT INTO `card_keyword` (`id_carte`, `id_keyword`) VALUES
(2, 4),
(4, 2),
(5, 3),
(8, 4),
(8, 7),
(9, 2),
(9, 6),
(10, 3),
(11, 7),
(12, 3),
(13, 7),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `carte`
--

CREATE TABLE `carte` (
  `id_carte` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `cardtype` enum('minion','spell','sigil') NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `evoimage_url` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `rarity` varchar(50) DEFAULT NULL,
  `atk` int(11) DEFAULT NULL,
  `hp` int(11) DEFAULT NULL,
  `evoatk` int(11) DEFAULT NULL,
  `evohp` int(11) DEFAULT NULL,
  `manacost` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `evodescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carte`
--

INSERT INTO `carte` (`id_carte`, `nom`, `cardtype`, `image_url`, `evoimage_url`, `type`, `rarity`, `atk`, `hp`, `evoatk`, `evohp`, `manacost`, `description`, `evodescription`) VALUES
(1, 'Noobion', 'minion', 'assets/images/cartes/1.png', 'assets/images/cartes/1b.png', 'Noob', 'Common', 1, 2, 3, 4, 1, '', ''),
(2, 'Trumpet Skeleton', 'minion', 'assets/images/cartes/2.png', 'assets/images/cartes/2b.png', 'Undead', 'Common', 2, 1, 4, 3, 2, 'Prayer: Draw a card', 'Prayer: Draw a card'),
(3, 'Violet sting', 'spell', 'assets/images/cartes/3.png', 'assets/images/cartes/3.png', 'Spell', 'Common', 2, 1, 4, 3, 2, 'Deal 3 damage to your opponent', 'Ce texte ne devrait pas être visible'),
(4, 'City guard', 'minion', 'assets/images/cartes/4.png', 'assets/images/cartes/4b.png', 'Human', 'Common', 3, 3, 3, 3, 3, 'Rush', 'Rush'),
(5, 'Static glitch', 'minion', 'assets/images/cartes/5.png', 'assets/images/cartes/5b.png', 'Noob', 'Common', 3, 3, 3, 3, 3, 'Enter: If you control an overloaded friendly minion, deal 3 damage to an enemy minion', ''),
(6, 'Database surfing', 'spell', 'assets/images/cartes/6.png', 'assets/images/cartes/6.png', 'Spell', 'Common', 3, 3, 3, 3, 4, 'Draw 2 cards, if at least 5 friendly minion overloaded this game, draw recover 2 mana and restore 2 health to your hero', 'Ce texte ne devrait pas être visible'),
(7, 'Super cola', 'spell', 'assets/images/cartes/7.png', 'assets/images/cartes/7.png', 'Spell', 'Common', 3, 3, 3, 3, 4, 'Give a friendly minion +3/+3', 'Ce texte ne devrait pas être visible'),
(8, 'Volt man', 'minion', 'assets/images/cartes/8.png', 'assets/images/cartes/8b.png', 'Noob', 'Common', 3, 4, 5, 6, 4, 'Guard', 'Guard and Prayer: Deal 3 to your opponent'),
(9, 'Departed soultaker', 'minion', 'assets/images/cartes/9.png', 'assets/images/cartes/9b.png', 'Undead', 'Common', 2, 2, 4, 4, 5, 'Toxic', 'Toxic and Overload: Destroy an enemy minion'),
(10, 'Murderous machine', 'minion', 'assets/images/cartes/10.png', 'assets/images/cartes/10b.png', 'Machine', 'Common', 4, 3, 6, 5, 5, 'Enter: Destroy a random overloaded enemy minion', ''),
(11, 'Power reactor', 'minion', 'assets/images/cartes/11.png', 'assets/images/cartes/11b.png', 'Structure', 'Common', 5, 5, 7, 7, 6, 'Guard. At the end of your turn, recover a static charge', 'Toxic and Overload: Destroy an enemy minion'),
(12, 'Project manager', 'minion', 'assets/images/cartes/12.png', 'assets/images/cartes/12b.png', 'Noob', 'Common', 3, 5, 5, 7, 6, 'Enter: Deal 4 damage to an enemy', ''),
(13, 'Ancient temple', 'sigil', 'assets/images/cartes/13.png', 'assets/images/cartes/13.png', 'Structure', 'Common', 3, 5, 5, 7, 7, 'All minions have Guard. At the end of your turn, give your minions +0/+1', ''),
(14, 'Heroic mayor', 'minion', 'assets/images/cartes/14.png', 'assets/images/cartes/14b.png', 'Human', 'Common', 5, 7, 7, 9, 8, 'Charge', 'Charge'),
(15, 'Christophe', '', '', '', NULL, NULL, 0, 0, NULL, NULL, 0, NULL, NULL),
(16, 'Lauzon', 'minion', 'assets/images/16.png', 'assets/images/16_evolve.png', '', '', 5, 5, NULL, NULL, 9, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `deck`
--

CREATE TABLE `deck` (
  `id_deck` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deck_carte`
--

CREATE TABLE `deck_carte` (
  `id_deck` int(11) NOT NULL,
  `id_carte` int(11) NOT NULL,
  `quantite` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

CREATE TABLE `keyword` (
  `id_keyword` int(11) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`id_keyword`, `keyword`, `description`) VALUES
(1, 'Charge', 'This minion may attack any enemy the turn it is played'),
(2, 'Rush', 'This card may attack enemy minions the turn it is played'),
(3, 'Enter', 'An effect that happens when this card is palyed from your hand'),
(4, 'Prayer', 'An effect that happens when this card is destroyed'),
(5, 'Toxic', 'Destroy any enemy minion this battles with. Bypasses shield'),
(6, 'Shield', 'Ignores 1 instance of damages'),
(7, 'Guard', 'Minion must battles with enemy minions with Guard before other enemies'),
(8, 'Overload', 'Effect that happens when you overloads a friendly minion with a static charge');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `page_visited` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `username`, `ip_address`, `page_visited`, `date`) VALUES
(1, 'admin - utilisateur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:03:14'),
(2, 'admin - utilisateur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:06:06'),
(3, 'admin - utilisateur', '::1', '/SiteCarte/index.php', '2025-07-11 15:06:12'),
(4, 'admin - utilisateur', '::1', '/SiteCarte/index.php', '2025-07-11 15:06:15'),
(5, 'admin - utilisateur', '::1', '/SiteCarte/index.php?action=test', '2025-07-11 15:06:16'),
(6, 'admin - utilisateur', '::1', '/SiteCarte/index.php', '2025-07-11 15:06:17'),
(7, 'admin - utilisateur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:06:18'),
(8, 'visiteur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:10:12'),
(9, 'utilisateur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:11:45'),
(10, 'utilisateur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:11:48'),
(11, 'utilisateur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:13:05'),
(12, 'utilisateur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:16:39'),
(13, 'utilisateur', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:16:41'),
(14, 'utilisateur', '::1', '/SiteCarte/index.php', '2025-07-11 15:16:43'),
(15, 'utilisateur', '::1', '/SiteCarte/index.php?action=logout', '2025-07-11 15:16:46'),
(16, 'visiteur', '::1', '/SiteCarte/index.php', '2025-07-11 15:16:46'),
(17, 'visiteur', '::1', '/SiteCarte/index.php?action=login', '2025-07-11 15:16:47'),
(18, 'visiteur', '::1', '/SiteCarte/index.php?action=login', '2025-07-11 15:16:48'),
(19, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:16:48'),
(20, 'Test User', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:16:51'),
(21, 'Test User', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:17:41'),
(22, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:17:42'),
(23, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:17:44'),
(24, 'Test User', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:17:46'),
(25, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:17:47'),
(26, 'Test User', '::1', '/SiteCarte/index.php?action=manageCards', '2025-07-11 15:17:48'),
(27, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:28:23'),
(28, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:28:24'),
(29, 'Test User', '::1', '/SiteCarte/index.php?action=editCard&id=1', '2025-07-11 15:28:26'),
(30, 'Test User', '::1', '/SiteCarte/index.php?action=editCard&id=1', '2025-07-11 15:29:57'),
(31, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:30:10'),
(32, 'Test User', '::1', '/SiteCarte/index.php?action=manageCards', '2025-07-11 15:30:13'),
(33, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:30:14'),
(34, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:30:57'),
(35, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:31:45'),
(36, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:31:45'),
(37, 'Test User', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:37:20'),
(38, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:37:22'),
(39, 'Test User', '::1', '/SiteCarte/index.php?action=logout', '2025-07-11 15:37:25'),
(40, 'visiteur', '::1', '/SiteCarte/index.php', '2025-07-11 15:37:25'),
(41, 'visiteur', '::1', '/SiteCarte/index.php?action=login', '2025-07-11 15:37:29'),
(42, 'visiteur', '::1', '/SiteCarte/index.php?action=login', '2025-07-11 15:37:30'),
(43, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:37:30'),
(44, 'Test User', '::1', '/SiteCarte/index.php?action=journal', '2025-07-11 15:37:31'),
(45, 'Test User', '::1', '/SiteCarte/index.php', '2025-07-11 15:37:34'),
(46, 'Test User', '::1', '/SiteCarte/index.php?action=logout', '2025-07-11 15:37:37'),
(47, 'visiteur', '::1', '/SiteCarte/index.php', '2025-07-11 15:37:37'),
(48, 'visiteur', '::1', '/SiteCarte/index.php?action=login', '2025-07-11 15:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_inscription` datetime DEFAULT current_timestamp(),
  `role` varchar(20) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `email`, `mot_de_passe`, `date_inscription`, `role`) VALUES
(1, 'Test User', 'test@test.com', '$2y$10$YLDf1NFvuXq0JjHaTUOeweKrxvYz.fETtB2CEm5vSMSn/ymT9ZA0S', '2025-05-22 19:38:58', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card_keyword`
--
ALTER TABLE `card_keyword`
  ADD PRIMARY KEY (`id_carte`,`id_keyword`),
  ADD KEY `id_keyword` (`id_keyword`);

--
-- Indexes for table `carte`
--
ALTER TABLE `carte`
  ADD PRIMARY KEY (`id_carte`);

--
-- Indexes for table `deck`
--
ALTER TABLE `deck`
  ADD PRIMARY KEY (`id_deck`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Indexes for table `deck_carte`
--
ALTER TABLE `deck_carte`
  ADD PRIMARY KEY (`id_deck`,`id_carte`),
  ADD KEY `id_carte` (`id_carte`);

--
-- Indexes for table `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`id_keyword`),
  ADD UNIQUE KEY `keyword` (`keyword`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carte`
--
ALTER TABLE `carte`
  MODIFY `id_carte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `deck`
--
ALTER TABLE `deck`
  MODIFY `id_deck` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keyword`
--
ALTER TABLE `keyword`
  MODIFY `id_keyword` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `card_keyword`
--
ALTER TABLE `card_keyword`
  ADD CONSTRAINT `card_keyword_ibfk_1` FOREIGN KEY (`id_carte`) REFERENCES `carte` (`id_carte`) ON DELETE CASCADE,
  ADD CONSTRAINT `card_keyword_ibfk_2` FOREIGN KEY (`id_keyword`) REFERENCES `keyword` (`id_keyword`) ON DELETE CASCADE;

--
-- Constraints for table `deck`
--
ALTER TABLE `deck`
  ADD CONSTRAINT `deck_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Constraints for table `deck_carte`
--
ALTER TABLE `deck_carte`
  ADD CONSTRAINT `deck_carte_ibfk_1` FOREIGN KEY (`id_deck`) REFERENCES `deck` (`id_deck`) ON DELETE CASCADE,
  ADD CONSTRAINT `deck_carte_ibfk_2` FOREIGN KEY (`id_carte`) REFERENCES `carte` (`id_carte`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
