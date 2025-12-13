-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 13 déc. 2025 à 11:00
-- Version du serveur : 8.0.44-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecoride`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `roles`, `password`) VALUES
(2, 'protskiv.khrystyna@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$54UpEptTE5cj0R4EOqtoou89JbuLfSTySX5z19w9TuLoJ9M/Hbt0G');

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `id` int NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`id`, `label`) VALUES
(1, 'Renault'),
(3, 'Tesla'),
(4, 'Nisan'),
(6, 'Peugeot'),
(7, 'Fiat'),
(8, 'Suzuki');

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_at` date NOT NULL,
  `user_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `energy` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `model`, `color`, `registration`, `registration_at`, `user_id`, `brand_id`, `energy`) VALUES
(1, 'x-100', 'noir', 'ajdjnj  dc ,', '2025-10-07', 2, 3, 'ELECTRIC'),
(2, 'x-100', 'rouge', 'AP1393', '1993-01-13', 2, 6, 'ELECTRIC'),
(4, 'x-100', 'rouge', 'AP1394', '2025-12-01', 2, 4, 'ELECTRIC'),
(5, 'x-100', 'vert', 'AP1394', '2025-09-02', 2, 3, 'hybrid');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20251201140548', '2025-12-01 14:08:35', 18),
('DoctrineMigrations\\Version20251201145750', '2025-12-01 14:58:15', 62),
('DoctrineMigrations\\Version20251201153541', '2025-12-01 15:36:02', 161),
('DoctrineMigrations\\Version20251202084625', '2025-12-02 08:48:12', 59),
('DoctrineMigrations\\Version20251202094600', '2025-12-02 09:46:26', 77),
('DoctrineMigrations\\Version20251202134557', '2025-12-02 13:46:22', 32),
('DoctrineMigrations\\Version20251203141711', '2025-12-03 14:17:22', 99),
('DoctrineMigrations\\Version20251204090503', '2025-12-04 09:05:28', 108),
('DoctrineMigrations\\Version20251204095425', '2025-12-04 09:54:44', 101),
('DoctrineMigrations\\Version20251204134133', '2025-12-04 13:41:53', 31),
('DoctrineMigrations\\Version20251204155009', '2025-12-04 15:50:24', 27),
('DoctrineMigrations\\Version20251208145451', '2025-12-08 14:55:04', 107),
('DoctrineMigrations\\Version20251210121157', '2025-12-10 12:12:27', 19),
('DoctrineMigrations\\Version20251210131832', '2025-12-10 13:18:54', 65),
('DoctrineMigrations\\Version20251210133134', '2025-12-10 13:31:44', 51),
('DoctrineMigrations\\Version20251211092527', '2025-12-11 09:25:45', 19);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `travel`
--

CREATE TABLE `travel` (
  `id` int NOT NULL,
  `car_id` int NOT NULL,
  `date_depart` date NOT NULL,
  `date_arrive` date NOT NULL,
  `time_depart` time NOT NULL,
  `time_arrive` time NOT NULL,
  `place_depart` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_arrive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_places` int NOT NULL,
  `price` double NOT NULL,
  `owner_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `travel`
--

INSERT INTO `travel` (`id`, `car_id`, `date_depart`, `date_arrive`, `time_depart`, `time_arrive`, `place_depart`, `place_arrive`, `statu`, `nb_places`, `price`, `owner_id`) VALUES
(10, 1, '2025-12-08', '2025-12-08', '13:18:00', '14:18:00', 'Marseille', 'Aix', 'on my way', 1, 5, 2),
(12, 1, '2025-12-09', '2025-12-10', '02:41:00', '04:41:00', 'Marseille', 'Paris', 'on my way', 1, 5, 2),
(13, 1, '2025-11-18', '2025-11-17', '19:44:00', '16:46:00', 'Marseille', 'Paris', 'on my way', 1, 3, 2),
(14, 1, '2025-12-09', '2025-12-09', '22:55:00', '14:59:00', 'Marseille', 'Aix', 'on my way', 3, 9, 2),
(15, 1, '2025-12-17', '2025-12-18', '18:39:00', '21:14:00', 'Marseille', 'Paris', 'on my way', 2, 3, 7),
(16, 1, '2025-12-25', '2025-12-26', '17:55:00', '01:58:00', 'Marseille', 'Paris', 'on my way', 0, 5, 2),
(17, 1, '2025-12-11', '2025-12-11', '22:31:00', '12:31:00', 'Marseille', 'Aix', 'on my way', 2, 10, 2),
(18, 4, '2025-12-18', '2025-12-19', '00:18:00', '15:18:00', 'Marseille', 'Paris', 'on my way', 3, 15, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` int NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` json NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `credits` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `telephone`, `adress`, `birthday`, `photo`, `roles`, `is_verified`, `credits`) VALUES
(2, 'Khrystyna', 'Protskiv', 'khrystyna.protskiv@gmail.com', '$2y$13$54UpEptTE5cj0R4EOqtoou89JbuLfSTySX5z19w9TuLoJ9M/Hbt0G', 749882251, 'jcghbsdvbs sjdnv sj bns dc', '1993-01-13', NULL, '[]', 1, 20),
(5, 'Protskiv', 'Yurii', 'tester@gmail.com', '$2y$13$6ZvKSZwHb8hd5jO8N3loPu/V09jryAI7iVSdmGvGDdRpHj.MQLy62', 253315630, 'jcghbsdvbs sjdnv sj bns dc', NULL, NULL, '[]', 1, 15),
(7, 'John', 'Doe', 'tester@formation.studi', '$2y$10$tyGSq79pKsvka6tBeJI7R.Wm/y8Qm5zMm.y4CmjxfeKdh.QyVthbW', 15655605, 'knn fvk  jknk ,nb fvfnm dv', NULL, NULL, '[]', 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `user_travel`
--

CREATE TABLE `user_travel` (
  `user_id` int NOT NULL,
  `travel_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_travel`
--

INSERT INTO `user_travel` (`user_id`, `travel_id`) VALUES
(2, 10),
(5, 15),
(5, 16);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_773DE69D44F5D008` (`brand_id`),
  ADD KEY `IDX_773DE69DA76ED395` (`user_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2D0B6BCEC3C6F69F` (`car_id`),
  ADD KEY `IDX_2D0B6BCE7E3C61F9` (`owner_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- Index pour la table `user_travel`
--
ALTER TABLE `user_travel`
  ADD PRIMARY KEY (`user_id`,`travel_id`),
  ADD KEY `IDX_485970F3A76ED395` (`user_id`),
  ADD KEY `IDX_485970F3ECAB15B3` (`travel_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `travel`
--
ALTER TABLE `travel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `FK_773DE69D44F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`id`),
  ADD CONSTRAINT `FK_773DE69DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `travel`
--
ALTER TABLE `travel`
  ADD CONSTRAINT `FK_2D0B6BCE7E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2D0B6BCEC3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`);

--
-- Contraintes pour la table `user_travel`
--
ALTER TABLE `user_travel`
  ADD CONSTRAINT `FK_485970F3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_485970F3ECAB15B3` FOREIGN KEY (`travel_id`) REFERENCES `travel` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
