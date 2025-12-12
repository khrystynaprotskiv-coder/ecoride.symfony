-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 12 déc. 2025 à 11:44
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

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `roles`, `password`) VALUES
(2, 'protskiv.khrystyna@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$54UpEptTE5cj0R4EOqtoou89JbuLfSTySX5z19w9TuLoJ9M/Hbt0G');

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

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `model`, `color`, `registration`, `registration_at`, `user_id`, `brand_id`, `energy`) VALUES
(1, 'x-100', 'noir', 'ajdjnj  dc ,', '2025-10-07', 2, 3, 'ELECTRIC'),
(2, 'x-100', 'rouge', 'AP1393', '1993-01-13', 2, 6, 'ELECTRIC'),
(4, 'x-100', 'rouge', 'AP1394', '2025-12-01', 2, 4, 'ELECTRIC'),
(5, 'x-100', 'vert', 'AP1394', '2025-09-02', 2, 3, 'hybrid');

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

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `telephone`, `adress`, `birthday`, `photo`, `roles`, `is_verified`, `credits`) VALUES
(2, 'Khrystyna', 'Protskiv', 'khrystyna.protskiv@gmail.com', '$2y$13$54UpEptTE5cj0R4EOqtoou89JbuLfSTySX5z19w9TuLoJ9M/Hbt0G', 749882251, 'jcghbsdvbs sjdnv sj bns dc', '1993-01-13', NULL, '[]', 1, 20),
(5, 'Protskiv', 'Yurii', 'tester@gmail.com', '$2y$13$6ZvKSZwHb8hd5jO8N3loPu/V09jryAI7iVSdmGvGDdRpHj.MQLy62', 253315630, 'jcghbsdvbs sjdnv sj bns dc', NULL, NULL, '[]', 1, 15),
(7, 'Vénique', 'Cuomo', 'veronique.cuomo@formation.studi', '$2y$10$tyGSq79pKsvka6tBeJI7R.Wm/y8Qm5zMm.y4CmjxfeKdh.QyVthbW', 15655605, 'knn fvk  jknk ,nb fvfnm dv', NULL, NULL, '[]', 1, 20);

--
-- Déchargement des données de la table `user_travel`
--

INSERT INTO `user_travel` (`user_id`, `travel_id`) VALUES
(2, 10),
(5, 15),
(5, 16);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
