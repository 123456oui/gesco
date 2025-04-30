-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 30 avr. 2025 à 18:00
-- Version du serveur : 8.0.35-cluster
-- Version de PHP : 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gesco_elite`
--

-- --------------------------------------------------------

--
-- Structure de la table `actionmenus`
--

CREATE TABLE `actionmenus` (
  `menu_id` bigint NOT NULL,
  `action_id` bigint NOT NULL,
  `id` bigint NOT NULL,
  `updated_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `actionmenus`
--

INSERT INTO `actionmenus` (`menu_id`, `action_id`, `id`, `updated_at`, `created_at`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(1, 2, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 2, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 3, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 2, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 3, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 13, '2025-03-12 15:49:53', '2025-03-12 15:49:53'),
(12, 2, 14, '2025-03-12 15:49:53', '2025-03-12 15:49:53'),
(12, 3, 15, '2025-03-12 15:49:53', '2025-03-12 15:49:53'),
(13, 1, 16, '2025-03-13 11:49:11', '2025-03-13 11:49:11'),
(13, 2, 17, '2025-03-13 11:49:11', '2025-03-13 11:49:11'),
(13, 3, 18, '2025-03-13 11:49:11', '2025-03-13 11:49:11'),
(14, 1, 19, '2025-03-14 12:37:01', '2025-03-14 12:37:01'),
(15, 1, 23, '2025-03-14 21:13:05', '2025-03-14 21:13:05'),
(15, 2, 24, '2025-03-14 21:13:05', '2025-03-14 21:13:05'),
(15, 3, 25, '2025-03-14 21:13:05', '2025-03-14 21:13:05'),
(16, 1, 26, '2025-03-17 16:36:26', '2025-03-17 16:36:26'),
(16, 2, 27, '2025-03-17 16:36:26', '2025-03-17 16:36:26'),
(16, 3, 28, '2025-03-17 16:36:26', '2025-03-17 16:36:26'),
(17, 1, 29, '2025-03-17 16:37:32', '2025-03-17 16:37:32'),
(17, 2, 30, '2025-03-17 16:37:32', '2025-03-17 16:37:32'),
(17, 3, 31, '2025-03-17 16:37:32', '2025-03-17 16:37:32'),
(18, 1, 32, '2025-03-26 16:49:28', '2025-03-26 16:49:28'),
(18, 2, 33, '2025-03-26 16:49:28', '2025-03-26 16:49:28'),
(18, 3, 34, '2025-03-26 16:49:28', '2025-03-26 16:49:28'),
(1, 3, 35, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(3, 3, 36, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(4, 1, 37, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(4, 2, 38, '2025-03-26 17:32:18', '2025-03-26 17:32:18'),
(4, 3, 39, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(5, 1, 41, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(5, 3, 42, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(5, 2, 43, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(6, 1, 45, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(6, 2, 46, '2025-03-26 17:32:18', '2025-03-26 17:32:18'),
(6, 3, 47, '2025-03-27 11:26:43', '2025-03-27 11:26:43'),
(7, 1, 48, '2025-03-26 17:29:06', '2025-03-26 17:29:06'),
(7, 2, 49, '2025-03-26 17:32:18', '2025-03-26 17:32:18'),
(7, 3, 50, '2025-03-27 11:29:53', '2025-03-27 11:29:53'),
(8, 1, 51, '2025-03-27 11:32:24', '2025-03-27 11:32:24'),
(8, 2, 52, '2025-03-27 11:32:24', '2025-03-27 11:32:24'),
(8, 3, 53, '2025-03-27 11:32:24', '2025-03-27 11:32:24'),
(14, 2, 54, '2025-03-27 11:53:36', '2025-03-27 11:53:36'),
(14, 3, 55, '2025-03-27 11:53:36', '2025-03-27 11:53:36'),
(20, 1, 59, '2025-04-04 12:50:03', '2025-04-04 12:50:03'),
(20, 2, 60, '2025-04-04 12:50:03', '2025-04-04 12:50:03'),
(20, 3, 61, '2025-04-04 12:50:03', '2025-04-04 12:50:03'),
(21, 1, 62, '2025-04-04 16:56:04', '2025-04-04 16:56:04'),
(21, 2, 63, '2025-04-04 16:56:04', '2025-04-04 16:56:04'),
(21, 3, 64, '2025-04-04 16:56:04', '2025-04-04 16:56:04'),
(22, 1, 68, '2025-04-05 11:00:06', '2025-04-05 11:00:06'),
(22, 2, 69, '2025-04-05 11:00:06', '2025-04-05 11:00:06'),
(22, 3, 70, '2025-04-05 11:00:06', '2025-04-05 11:00:06'),
(23, 1, 71, '2025-04-07 13:17:05', '2025-04-07 13:17:05'),
(23, 2, 72, '2025-04-07 13:17:05', '2025-04-07 13:17:05'),
(23, 3, 73, '2025-04-07 13:17:05', '2025-04-07 13:17:05'),
(24, 1, 74, '2025-04-07 13:17:54', '2025-04-07 13:17:54'),
(24, 2, 75, '2025-04-07 13:17:54', '2025-04-07 13:17:54'),
(24, 3, 76, '2025-04-07 13:17:54', '2025-04-07 13:17:54'),
(19, 1, 77, '2025-04-08 16:51:50', '2025-04-08 16:51:50'),
(19, 2, 78, '2025-04-08 16:51:50', '2025-04-08 16:51:50'),
(19, 3, 79, '2025-04-08 16:51:50', '2025-04-08 16:51:50'),
(25, 1, 80, '2025-04-25 10:28:21', '2025-04-25 10:28:21'),
(25, 2, 81, '2025-04-25 10:28:21', '2025-04-25 10:28:21'),
(25, 3, 82, '2025-04-25 10:28:21', '2025-04-25 10:28:21'),
(26, 1, 83, '2025-04-25 12:11:55', '2025-04-25 12:11:55'),
(26, 2, 84, '2025-04-25 12:11:55', '2025-04-25 12:11:55'),
(26, 3, 85, '2025-04-25 12:11:55', '2025-04-25 12:11:55');

-- --------------------------------------------------------

--
-- Structure de la table `actions`
--

CREATE TABLE `actions` (
  `id` bigint NOT NULL,
  `nomAction` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `actions`
--

INSERT INTO `actions` (`id`, `nomAction`, `updated_at`, `created_at`) VALUES
(1, 'CREER', '2025-03-14 12:03:39', '0000-00-00 00:00:00'),
(2, 'SUPPRIMER', '2025-03-14 12:03:39', '2025-03-12 14:37:06'),
(3, 'MODIFIER', '2025-03-14 12:03:39', '2025-03-12 14:37:19'),
(4, 'EDITER', '2025-04-11 14:02:17', '2025-04-11 14:02:17');

-- --------------------------------------------------------

--
-- Structure de la table `banques`
--

CREATE TABLE `banques` (
  `id` int NOT NULL,
  `libellebanque` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `banques`
--

INSERT INTO `banques` (`id`, `libellebanque`, `updated_at`, `created_at`) VALUES
(1, 'ATLANTIQUE BANQUE', '2025-04-25 11:58:16', '2025-04-25 11:58:16'),
(3, 'ECOBANK', '2025-04-25 12:09:47', '2025-04-25 11:59:09'),
(4, 'BANK OF AFRICA', '2025-04-29 10:51:53', '2025-04-25 15:40:08');

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int NOT NULL,
  `idniveau` int NOT NULL,
  `Annee` varchar(255) NOT NULL,
  `libelleclasse` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `max` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id`, `idniveau`, `Annee`, `libelleclasse`, `updated_at`, `created_at`, `max`) VALUES
(10, 8, '2023-2024', 'CP1A', '2025-04-29 15:55:53', '2025-04-29 15:55:53', 7);

-- --------------------------------------------------------

--
-- Structure de la table `cycles`
--

CREATE TABLE `cycles` (
  `id` int NOT NULL,
  `libellecycle` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `cycles`
--

INSERT INTO `cycles` (`id`, `libellecycle`, `updated_at`, `created_at`) VALUES
(14, 'PRIMAIRE', '2025-04-14 14:36:34', '2025-04-11 14:32:28'),
(17, 'SECONDAIRE', '2025-04-14 14:35:50', '2025-04-14 14:24:17'),
(18, 'MATERNELLE', '2025-04-29 10:58:19', '2025-04-15 10:17:08');

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `Matricule` varchar(255) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Nomp` varchar(255) DEFAULT NULL,
  `Nomm` varchar(255) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `NumtelM` varchar(255) DEFAULT NULL,
  `NumtelP` varchar(255) DEFAULT NULL,
  `datenais` date NOT NULL,
  `lieunais` varchar(255) NOT NULL,
  `Sante` text,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `numbactnaiss` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`Matricule`, `Nom`, `Prenom`, `Nomp`, `Nomm`, `Photo`, `NumtelM`, `NumtelP`, `datenais`, `lieunais`, `Sante`, `created_at`, `updated_at`, `numbactnaiss`) VALUES
('005', '98989', 'iukujki', 'hkjljl', 'oulhlh', 'eleves/M9o6ctW3JnhNPNBQHHADKP3tw4lZtoLv6p5sheef.jpg', 'lhklhkhk', 'ou0uu,', '2025-04-09', 'khkjkj', 'sante de fer', '2025-04-30', '2025-04-30', '76767'),
('007', '009', '008', 'tjtuyo', 'ikio', 'eleves/5HnQGntYlcTQeCQLBn31LlBOL3omhvLs12IlLEBW.jpg', '97878979', '8797879', '2025-05-01', '990', 'sante', '2025-04-30', '2025-04-30', '001'),
('87uiu', '007', '009', 'mousa', 'sano', 'eleves/5vQA22QyR09PiKpZmXF3YQru31YdLJh6P7yGXGgC.jpg', 'y878799', '9878799', '2025-05-09', '8797iiuj', 'de fer', '2025-04-30', '2025-04-30', '009io'),
('9799jjn', '4rrrotol', 'kgkgohoioi', 'itkgkhj', 'jhjhk', '1746012158.jpeg', 'y86ikk', '99787jk', '2025-04-16', '8iiyu', 'jgjhhut', '2025-04-30', '2025-04-30', 'rrrtt5'),
('CP10062324', '23', '34', 'jkjkj', 'jkjkj', 'eleves/Oe9dcUGlFMbGFHrqMvcoD1zm6Rn7xJ523mJFmuMp.jpg', '890iok', '909ioi', '2025-04-30', '89898', 'fererr', '2025-04-30', '2025-04-30', '123o'),
('llkiooko', 'yjjhj', 'llkool', 'khljoo', 'ijijkjn', '1746020756.jpeg', '89887uj', 'l9989y', '2025-04-03', '09iijk', 'dddfgfdrr', '2025-04-30', '2025-04-30', 'iouo');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `Matricule` varchar(255) NOT NULL,
  `idcycle` int NOT NULL,
  `idniveau` int NOT NULL,
  `idclasse` int NOT NULL,
  `idanneescolaire` varchar(50) NOT NULL,
  `montantscolariteE` double NOT NULL,
  `idpcharge` int DEFAULT NULL,
  `iduser` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`Matricule`, `idcycle`, `idniveau`, `idclasse`, `idanneescolaire`, `montantscolariteE`, `idpcharge`, `iduser`, `created_at`, `updated_at`) VALUES
('005', 14, 8, 10, '2023-2024', 56780, NULL, 2, '2025-04-30 15:13:58', '2025-04-30 15:13:58'),
('007', 14, 8, 10, '2023-2024', 56780, NULL, 2, '2025-04-30 15:09:20', '2025-04-30 15:09:20'),
('87uiu', 14, 8, 10, '2023-2024', 56780, NULL, 2, '2025-04-30 14:55:08', '2025-04-30 14:55:08'),
('9799jjn', 14, 8, 10, '2023-2024', 6780, 2, 2, '2025-04-30 11:22:38', '2025-04-30 11:22:38'),
('CP10062324', 14, 8, 10, '2023-2024', 6780, 2, 2, '2025-04-30 16:30:04', '2025-04-30 16:30:04'),
('llkiooko', 14, 8, 10, '2023-2024', 56780, NULL, 2, '2025-04-30 13:45:56', '2025-04-30 13:45:56');

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` bigint NOT NULL,
  `parent_id` bigint DEFAULT NULL,
  `nomMenu` varchar(255) DEFAULT NULL,
  `lien` varchar(255) DEFAULT NULL,
  `interface` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `ordre` bigint DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `nomMenu`, `lien`, `interface`, `icon`, `ordre`, `visible`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Utilisateur', NULL, '1', NULL, 10, 1, '0000-00-00 00:00:00', NULL),
(2, 1, 'Profil', 'profil.index', '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(3, NULL, 'DEVELOPPEUR', NULL, '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(4, NULL, 'Paramétrage', NULL, '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(5, NULL, 'Inscription', NULL, '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(6, NULL, 'Réinscription', NULL, '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(7, NULL, 'Réglement', NULL, '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(8, NULL, 'Personnel', NULL, '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(9, 3, 'Action', 'action.index', '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(10, 3, 'Menu', 'menu.index', '1', NULL, NULL, 1, '0000-00-00 00:00:00', NULL),
(15, 1, 'utilisateurs', 'user.index', '1', NULL, 12, 1, '2025-03-14 12:59:41', '2025-03-14 21:13:05'),
(17, 4, 'Annee', 'annee.index', '1', NULL, NULL, 1, '2025-03-17 16:37:32', '2025-03-17 16:37:32'),
(18, 5, 'Eleve', 'Eleve.index', '1', NULL, 12, 1, '2025-03-26 16:49:28', '2025-03-26 16:49:28'),
(19, 4, 'Cycle', 'cycle.index', '1', NULL, NULL, 1, '2025-04-04 10:47:09', '2025-04-04 10:47:09'),
(20, 4, 'Niveau', 'niveau.index', '1', NULL, NULL, 1, '2025-04-04 12:50:03', '2025-04-04 12:50:03'),
(21, 4, 'Classe', 'classe.index', '1', NULL, NULL, 1, '2025-04-04 16:56:04', '2025-04-04 16:56:04'),
(22, 6, 'Eleve', 'releve.index', '1', NULL, NULL, 1, '2025-04-05 10:46:08', '2025-04-05 11:00:06'),
(23, 7, 'Scolarité', 'scolarite.index', '1', NULL, NULL, 1, '2025-04-07 13:17:05', '2025-04-07 13:17:05'),
(24, 7, 'Cantine', 'cantine.index', '1', NULL, NULL, 1, '2025-04-07 13:17:54', '2025-04-07 13:17:54'),
(25, 4, 'Banque', 'banque.index', '1', NULL, NULL, 1, '2025-04-25 10:28:21', '2025-04-25 10:28:21'),
(26, 4, 'Prise en Charge', 'pcharge.index', '1', NULL, NULL, 1, '2025-04-25 12:11:55', '2025-04-25 12:11:55');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(6, '2025_02_19_091655_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `mois`
--

CREATE TABLE `mois` (
  `id` int UNSIGNED NOT NULL,
  `nom_mois` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mois`
--

INSERT INTO `mois` (`id`, `nom_mois`) VALUES
(1, 'Janvier'),
(2, 'Fevrier'),
(3, 'Mars'),
(4, 'Avril'),
(5, 'Mai'),
(6, 'Juin'),
(7, 'Juillet'),
(8, 'Aout'),
(9, 'Septembrre'),
(10, 'Octobre'),
(11, 'Novembre'),
(12, 'Decembre');

-- --------------------------------------------------------

--
-- Structure de la table `niveaux`
--

CREATE TABLE `niveaux` (
  `id` int NOT NULL,
  `annee` varchar(255) NOT NULL,
  `idcycle` int NOT NULL,
  `libelleniveau` varchar(255) NOT NULL,
  `Montantscolarite` double NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `niveaux`
--

INSERT INTO `niveaux` (`id`, `annee`, `idcycle`, `libelleniveau`, `Montantscolarite`, `updated_at`, `created_at`) VALUES
(8, '2023-2024', 14, 'CP1', 56780, '2025-04-29 15:55:33', '2025-04-29 15:55:33');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pcharges`
--

CREATE TABLE `pcharges` (
  `id` int NOT NULL,
  `libellepcharge` varchar(255) NOT NULL,
  `pmontant` float NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pcharges`
--

INSERT INTO `pcharges` (`id`, `libellepcharge`, `pmontant`, `updated_at`, `created_at`) VALUES
(1, 'PARENTS', 4000, '2025-04-29 10:57:37', '2025-04-29 08:29:31'),
(2, 'ETAT', 50000, '2025-04-29 08:29:52', '2025-04-29 08:29:52'),
(3, 'AMPO', 75000, '2025-04-29 15:39:05', '2025-04-29 15:39:05');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `profilmenuactions`
--

CREATE TABLE `profilmenuactions` (
  `id` int NOT NULL,
  `menu_id` bigint NOT NULL,
  `profil_id` bigint NOT NULL,
  `action_id` bigint NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `profilmenuactions`
--

INSERT INTO `profilmenuactions` (`id`, `menu_id`, `profil_id`, `action_id`, `updated_at`, `created_at`) VALUES
(53, 15, 9, 1, '2025-03-18 13:59:29', '2025-03-18 13:59:29'),
(54, 15, 9, 2, '2025-03-18 13:59:29', '2025-03-18 13:59:29'),
(55, 15, 9, 3, '2025-03-18 13:59:59', '2025-03-18 13:59:59'),
(57, 10, 9, 1, '2025-03-26 16:39:05', '2025-03-26 16:39:05'),
(58, 10, 9, 2, '2025-03-26 16:39:05', '2025-03-26 16:39:05'),
(59, 10, 9, 3, '2025-03-26 16:39:26', '2025-03-26 16:39:26'),
(64, 2, 9, 1, '2025-03-26 16:58:06', '2025-03-26 16:58:06'),
(65, 2, 9, 2, '2025-03-26 16:58:06', '2025-03-26 16:58:06'),
(66, 2, 9, 3, '2025-03-26 16:58:20', '2025-03-26 16:58:20'),
(67, 9, 9, 1, '2025-03-27 12:02:21', '2025-03-27 12:02:21'),
(68, 9, 9, 2, '2025-03-27 12:02:21', '2025-03-27 12:02:21'),
(69, 9, 9, 3, '2025-03-27 12:02:21', '2025-03-27 12:02:21'),
(70, 1, 9, 1, '2025-03-27 12:04:54', '2025-03-27 12:04:54'),
(71, 1, 9, 2, '2025-03-27 12:04:54', '2025-03-27 12:04:54'),
(72, 1, 9, 3, '2025-03-27 12:04:54', '2025-03-27 12:04:54'),
(73, 3, 9, 1, '2025-03-27 12:36:43', '2025-03-27 12:36:43'),
(74, 3, 9, 2, '2025-03-27 12:36:43', '2025-03-27 12:36:43'),
(75, 3, 9, 3, '2025-03-27 12:36:43', '2025-03-27 12:36:43'),
(76, 18, 9, 1, '2025-03-27 13:22:32', '2025-03-27 13:22:32'),
(77, 18, 9, 2, '2025-03-27 13:22:32', '2025-03-27 13:22:32'),
(78, 18, 9, 3, '2025-03-27 13:23:27', '2025-03-27 13:23:27'),
(81, 18, 9, 3, '2025-04-04 10:54:40', '2025-04-04 10:54:40'),
(82, 20, 9, 1, '2025-04-04 14:18:20', '2025-04-04 14:18:20'),
(83, 20, 9, 2, '2025-04-04 14:18:20', '2025-04-04 14:18:20'),
(84, 20, 9, 3, '2025-04-04 14:18:20', '2025-04-04 14:18:20'),
(85, 21, 9, 1, '2025-04-04 16:57:47', '2025-04-04 16:58:33'),
(86, 21, 9, 2, '2025-04-04 16:57:47', '2025-04-04 16:57:47'),
(87, 21, 9, 3, '2025-04-04 16:58:18', '2025-04-04 16:58:18'),
(88, 21, 9, 1, '2025-04-07 13:46:04', '2025-04-07 13:46:04'),
(89, 23, 9, 1, '2025-04-07 13:44:34', '2025-04-07 13:44:34'),
(90, 23, 9, 2, '2025-04-07 13:44:34', '2025-04-07 13:44:34'),
(91, 23, 9, 3, '2025-04-07 13:44:34', '2025-04-07 13:44:34'),
(92, 15, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(93, 15, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(94, 15, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(95, 9, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(96, 9, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(97, 9, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(98, 10, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(99, 10, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(100, 10, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(101, 17, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(102, 17, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(103, 17, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(107, 20, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(108, 20, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(109, 20, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(110, 21, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(111, 21, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(112, 21, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(113, 18, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(114, 18, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(115, 18, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(116, 22, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(117, 22, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(118, 22, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(119, 23, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(120, 23, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(121, 23, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(122, 24, 11, 1, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(123, 24, 11, 2, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(124, 24, 11, 3, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(125, 19, 9, 1, '2025-04-10 16:39:17', '2025-04-10 16:39:17'),
(126, 19, 9, 2, '2025-04-10 16:39:17', '2025-04-10 16:39:17'),
(127, 19, 9, 3, '2025-04-10 16:41:09', '2025-04-10 16:41:09'),
(128, 25, 9, 1, '2025-04-25 11:01:18', '2025-04-25 11:01:18'),
(129, 25, 9, 2, '2025-04-25 11:01:18', '2025-04-25 11:01:18'),
(130, 25, 9, 3, '2025-04-25 11:01:18', '2025-04-25 11:01:18'),
(131, 26, 9, 1, '2025-04-25 12:39:31', '2025-04-25 12:39:31'),
(132, 26, 9, 2, '2025-04-25 12:39:31', '2025-04-25 12:39:31'),
(133, 26, 9, 3, '2025-04-25 12:39:31', '2025-04-25 12:39:31');

-- --------------------------------------------------------

--
-- Structure de la table `profilmenus`
--

CREATE TABLE `profilmenus` (
  `id` bigint NOT NULL,
  `menu_id` bigint NOT NULL,
  `profil_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `profilmenus`
--

INSERT INTO `profilmenus` (`id`, `menu_id`, `profil_id`, `created_at`, `updated_at`) VALUES
(61, 5, 8, '2025-03-14 12:54:58', '2025-03-14 12:54:58'),
(62, 6, 8, '2025-03-14 12:54:58', '2025-03-14 12:54:58'),
(71, 1, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(72, 2, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(73, 15, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(74, 3, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(75, 9, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(76, 10, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(77, 4, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(78, 17, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(79, 5, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(80, 6, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(81, 7, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(82, 8, 9, '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(101, 5, 10, '2025-03-27 12:38:49', '2025-03-27 12:38:49'),
(102, 4, 10, '2025-03-27 12:38:49', '2025-03-27 12:38:49'),
(103, 3, 10, '2025-03-27 12:38:49', '2025-03-27 12:38:49'),
(104, 1, 10, '2025-03-27 12:38:49', '2025-03-27 12:38:49'),
(105, 6, 10, '2025-03-27 12:38:49', '2025-03-27 12:38:49'),
(106, 7, 10, '2025-03-27 12:38:49', '2025-03-27 12:38:49'),
(107, 8, 10, '2025-03-27 12:38:49', '2025-03-27 12:38:49'),
(108, 5, 1, '2025-03-27 12:39:06', '2025-03-27 12:39:06'),
(109, 4, 1, '2025-03-27 12:39:06', '2025-03-27 12:39:06'),
(110, 3, 1, '2025-03-27 12:39:06', '2025-03-27 12:39:06'),
(111, 1, 1, '2025-03-27 12:39:06', '2025-03-27 12:39:06'),
(112, 6, 1, '2025-03-27 12:39:06', '2025-03-27 12:39:06'),
(113, 7, 1, '2025-03-27 12:39:06', '2025-03-27 12:39:06'),
(114, 8, 1, '2025-03-27 12:39:06', '2025-03-27 12:39:06'),
(115, 18, 9, '2025-03-27 13:21:43', '2025-03-27 13:21:43'),
(117, 20, 9, '2025-04-04 12:52:19', '2025-04-04 12:52:19'),
(118, 21, 9, '2025-04-07 13:43:48', '2025-04-07 13:43:48'),
(119, 23, 9, '2025-04-04 13:42:18', '2025-04-04 13:42:18'),
(120, 24, 9, '2025-04-04 13:42:18', '2025-04-04 13:42:18'),
(121, 1, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(122, 2, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(123, 15, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(124, 3, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(125, 9, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(126, 10, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(127, 4, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(128, 17, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(130, 20, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(131, 21, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(132, 5, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(133, 18, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(134, 6, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(135, 22, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(136, 7, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(137, 23, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(138, 24, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(139, 8, 11, '2025-04-08 09:28:03', '2025-04-08 09:28:03'),
(140, 19, 9, '2025-04-08 16:54:21', '2025-04-08 16:54:21'),
(141, 25, 9, '2025-04-25 10:59:42', '2025-04-25 10:59:42'),
(142, 26, 9, '2025-04-25 12:37:14', '2025-04-25 12:37:14');

-- --------------------------------------------------------

--
-- Structure de la table `profils`
--

CREATE TABLE `profils` (
  `id` bigint NOT NULL,
  `nomProfil` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `profils`
--

INSERT INTO `profils` (`id`, `nomProfil`, `updated_at`, `created_at`) VALUES
(1, 'Root', '2025-03-13 14:50:50', '2025-03-13 14:50:50'),
(8, 'SURVEILLANT', '2025-03-14 12:54:58', '2025-03-14 12:54:58'),
(9, 'ROOT2', '2025-03-17 16:49:21', '2025-03-17 16:49:21'),
(10, 'ZANGO', '2025-03-17 17:08:55', '2025-03-17 17:08:55'),
(11, 'CAISSIERE', '2025-04-08 09:28:03', '2025-04-08 09:28:03');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `sequence`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `sequence` (
`id` bigint
,`anneelibelle` varchar(9)
);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('c7mciAWrIOCdRdXhWr5XBiZnevTS3Ba8C5iiwCUx', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiTzFrajJ0bmIxUnFHdG54RW5SejNXSHZ4VDRqdWFpckRKM2RrYTdoRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9FbGV2ZS81LzE4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NDU5OTk1Mjc7fXM6NToibWVudXMiO2E6Nzp7aToxO2E6Mjp7aToxO2E6Mjp7aToyO2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjI7czo5OiJwYXJlbnRfaWQiO2k6MTtzOjc6Im5vbU1lbnUiO3M6NjoiUHJvZmlsIjtzOjQ6ImxpZW4iO3M6MTI6InByb2ZpbC5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMDAwMC0wMC0wMCAwMDowMDowMCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9aToxO2E6Mzp7aTowO3M6NToiQ1JFRVIiO2k6MTtzOjk6IlNVUFBSSU1FUiI7aToyO3M6ODoiTU9ESUZJRVIiO319aToxNTthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToxNTtzOjk6InBhcmVudF9pZCI7aToxO3M6Nzoibm9tTWVudSI7czoxMjoidXRpbGlzYXRldXJzIjtzOjQ6ImxpZW4iO3M6MTA6InVzZXIuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtpOjEyO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTQgMTI6NTk6NDEiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTQgMjE6MTM6MDUiO31pOjE7YTozOntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7fX19aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjE7czo5OiJwYXJlbnRfaWQiO047czo3OiJub21NZW51IjtzOjExOiJVdGlsaXNhdGV1ciI7czo0OiJsaWVuIjtOO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtpOjEwO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjAwMDAtMDAtMDAgMDA6MDA6MDAiO3M6MTA6InVwZGF0ZWRfYXQiO047fX1pOjQ7YToyOntpOjE7YTo2OntpOjI2O2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjI2O3M6OToicGFyZW50X2lkIjtpOjQ7czo3OiJub21NZW51IjtzOjE1OiJQcmlzZSBlbiBDaGFyZ2UiO3M6NDoibGllbiI7czoxMzoicGNoYXJnZS5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wNC0yNSAxMjoxMTo1NSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wNC0yNSAxMjoxMTo1NSI7fWk6MTthOjM6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjt9fWk6MjU7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6MjU7czo5OiJwYXJlbnRfaWQiO2k6NDtzOjc6Im5vbU1lbnUiO3M6NjoiQmFucXVlIjtzOjQ6ImxpZW4iO3M6MTI6ImJhbnF1ZS5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wNC0yNSAxMDoyODoyMSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wNC0yNSAxMDoyODoyMSI7fWk6MTthOjM6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjt9fWk6MjE7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6MjE7czo5OiJwYXJlbnRfaWQiO2k6NDtzOjc6Im5vbU1lbnUiO3M6NjoiQ2xhc3NlIjtzOjQ6ImxpZW4iO3M6MTI6ImNsYXNzZS5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wNC0wNCAxNjo1NjowNCI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wNC0wNCAxNjo1NjowNCI7fWk6MTthOjQ6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjtpOjM7czo1OiJDUkVFUiI7fX1pOjIwO2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjIwO3M6OToicGFyZW50X2lkIjtpOjQ7czo3OiJub21NZW51IjtzOjY6Ik5pdmVhdSI7czo0OiJsaWVuIjtzOjEyOiJuaXZlYXUuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMDQgMTI6NTA6MDMiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMDQgMTI6NTA6MDMiO31pOjE7YTozOntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7fX1pOjE5O2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjE5O3M6OToicGFyZW50X2lkIjtpOjQ7czo3OiJub21NZW51IjtzOjU6IkN5Y2xlIjtzOjQ6ImxpZW4iO3M6MTE6ImN5Y2xlLmluZGV4IjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7TjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTA0LTA0IDEwOjQ3OjA5IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTA0LTA0IDEwOjQ3OjA5Ijt9aToxO2E6Mzp7aTowO3M6NToiQ1JFRVIiO2k6MTtzOjk6IlNVUFBSSU1FUiI7aToyO3M6ODoiTU9ESUZJRVIiO319aToxNzthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToxNztzOjk6InBhcmVudF9pZCI7aTo0O3M6Nzoibm9tTWVudSI7czo1OiJBbm5lZSI7czo0OiJsaWVuIjtzOjExOiJhbm5lZS5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0xNyAxNjozNzozMiI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wMy0xNyAxNjozNzozMiI7fWk6MTthOjA6e319fWk6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aTo0O3M6OToicGFyZW50X2lkIjtOO3M6Nzoibm9tTWVudSI7czoxMjoiUGFyYW3DqXRyYWdlIjtzOjQ6ImxpZW4iO047czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMDAwMC0wMC0wMCAwMDowMDowMCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9fWk6NzthOjI6e2k6MTthOjI6e2k6MjQ7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6MjQ7czo5OiJwYXJlbnRfaWQiO2k6NztzOjc6Im5vbU1lbnUiO3M6NzoiQ2FudGluZSI7czo0OiJsaWVuIjtzOjEzOiJjYW50aW5lLmluZGV4IjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7TjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTA0LTA3IDEzOjE3OjU0IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTA0LTA3IDEzOjE3OjU0Ijt9aToxO2E6MDp7fX1pOjIzO2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjIzO3M6OToicGFyZW50X2lkIjtpOjc7czo3OiJub21NZW51IjtzOjEwOiJTY29sYXJpdMOpIjtzOjQ6ImxpZW4iO3M6MTU6InNjb2xhcml0ZS5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wNC0wNyAxMzoxNzowNSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wNC0wNyAxMzoxNzowNSI7fWk6MTthOjM6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjt9fX1pOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6NztzOjk6InBhcmVudF9pZCI7TjtzOjc6Im5vbU1lbnUiO3M6MTA6IlLDqWdsZW1lbnQiO3M6NDoibGllbiI7TjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7TjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIwMDAwLTAwLTAwIDAwOjAwOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319aTozO2E6Mjp7aToxO2E6Mjp7aToxMDthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToxMDtzOjk6InBhcmVudF9pZCI7aTozO3M6Nzoibm9tTWVudSI7czo0OiJNZW51IjtzOjQ6ImxpZW4iO3M6MTA6Im1lbnUuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjAwMDAtMDAtMDAgMDA6MDA6MDAiO3M6MTA6InVwZGF0ZWRfYXQiO047fWk6MTthOjM6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjt9fWk6OTthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aTo5O3M6OToicGFyZW50X2lkIjtpOjM7czo3OiJub21NZW51IjtzOjY6IkFjdGlvbiI7czo0OiJsaWVuIjtzOjEyOiJhY3Rpb24uaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjAwMDAtMDAtMDAgMDA6MDA6MDAiO3M6MTA6InVwZGF0ZWRfYXQiO047fWk6MTthOjM6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjt9fX1pOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6MztzOjk6InBhcmVudF9pZCI7TjtzOjc6Im5vbU1lbnUiO3M6MTE6IkRFVkVMT1BQRVVSIjtzOjQ6ImxpZW4iO047czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMDAwMC0wMC0wMCAwMDowMDowMCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9fWk6ODthOjE6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aTo4O3M6OToicGFyZW50X2lkIjtOO3M6Nzoibm9tTWVudSI7czo5OiJQZXJzb25uZWwiO3M6NDoibGllbiI7TjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7TjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIwMDAwLTAwLTAwIDAwOjAwOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319aTo2O2E6MTp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjY7czo5OiJwYXJlbnRfaWQiO047czo3OiJub21NZW51IjtzOjE0OiJSw6lpbnNjcmlwdGlvbiI7czo0OiJsaWVuIjtOO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjAwMDAtMDAtMDAgMDA6MDA6MDAiO3M6MTA6InVwZGF0ZWRfYXQiO047fX1pOjU7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6NTtzOjk6InBhcmVudF9pZCI7TjtzOjc6Im5vbU1lbnUiO3M6MTE6Ikluc2NyaXB0aW9uIjtzOjQ6ImxpZW4iO047czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMDAwMC0wMC0wMCAwMDowMDowMCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9aToxO2E6MTp7aToxODthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToxODtzOjk6InBhcmVudF9pZCI7aTo1O3M6Nzoibm9tTWVudSI7czo1OiJFbGV2ZSI7czo0OiJsaWVuIjtzOjExOiJFbGV2ZS5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO2k6MTI7czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yNiAxNjo0OToyOCI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yNiAxNjo0OToyOCI7fWk6MTthOjQ6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjtpOjM7czo4OiJNT0RJRklFUiI7fX19fX1zOjEwOiJtZW51c0Zyb250IjthOjA6e31zOjQ6InVzZXIiO086MTU6IkFwcFxNb2RlbHNcVXNlciI6MzI6e3M6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NToidXNlcnMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxOToicHJldmVudHNMYXp5TG9hZGluZyI7YjowO3M6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7czoxMzoiACoAYXR0cmlidXRlcyI7YToxNzp7czoyOiJpZCI7aToyO3M6Mzoibm9tIjtzOjU6IlpBTkdPIjtzOjY6InByZW5vbSI7czo5OiJBYmRvdWxheWUiO3M6OToidGVsZXBob25lIjtzOjE4OiIoKzIyNikgNzAtMjItMTItNDciO3M6MTE6ImlkZW50aWZpYW50IjtzOjQ6ImFibG8iO3M6OToicHJvZmlsX2lkIjtpOjk7czo1OiJhY3RpZiI7aToxO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGFkbWluLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJDVJcExCT2haWXpVWU5vUTlYcXovQ3VINm12WWpKSU9QNFpXRk03a0kxSS9WLlEwR1c3d3FhIjtzOjc6InVzZXJfaWQiO2k6MjtzOjE3OiJ0d29fZmFjdG9yX3NlY3JldCI7TjtzOjI1OiJ0d29fZmFjdG9yX3JlY292ZXJ5X2NvZGVzIjtOO3M6MjM6InR3b19mYWN0b3JfY29uZmlybWVkX2F0IjtOO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yMCAxNDowNzo1OCI7fXM6MTE6IgAqAG9yaWdpbmFsIjthOjE3OntzOjI6ImlkIjtpOjI7czozOiJub20iO3M6NToiWkFOR08iO3M6NjoicHJlbm9tIjtzOjk6IkFiZG91bGF5ZSI7czo5OiJ0ZWxlcGhvbmUiO3M6MTg6IigrMjI2KSA3MC0yMi0xMi00NyI7czoxMToiaWRlbnRpZmlhbnQiO3M6NDoiYWJsbyI7czo5OiJwcm9maWxfaWQiO2k6OTtzOjU6ImFjdGlmIjtpOjE7czo1OiJlbWFpbCI7czoxNToiYWRtaW5AYWRtaW4uY29tIjtzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7TjtzOjg6InBhc3N3b3JkIjtzOjYwOiIkMnkkMTIkNUlwTEJPaFpZelVZTm9ROVhxei9DdUg2bXZZakpJT1A0WldGTTdrSTFJL1YuUTBHVzd3cWEiO3M6NzoidXNlcl9pZCI7aToyO3M6MTc6InR3b19mYWN0b3Jfc2VjcmV0IjtOO3M6MjU6InR3b19mYWN0b3JfcmVjb3ZlcnlfY29kZXMiO047czoyMzoidHdvX2ZhY3Rvcl9jb25maXJtZWRfYXQiO047czoxNDoicmVtZW1iZXJfdG9rZW4iO047czoxMDoiY3JlYXRlZF9hdCI7TjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTIwIDE0OjA3OjU4Ijt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YToxOntzOjE3OiJlbWFpbF92ZXJpZmllZF9hdCI7czo4OiJkYXRldGltZSI7fXM6MTc6IgAqAGNsYXNzQ2FzdENhY2hlIjthOjA6e31zOjIxOiIAKgBhdHRyaWJ1dGVDYXN0Q2FjaGUiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YToxOntpOjA7czoxNzoicHJvZmlsZV9waG90b191cmwiO31zOjE5OiIAKgBkaXNwYXRjaGVzRXZlbnRzIjthOjA6e31zOjE0OiIAKgBvYnNlcnZhYmxlcyI7YTowOnt9czoxMjoiACoAcmVsYXRpb25zIjthOjA6e31zOjEwOiIAKgB0b3VjaGVzIjthOjA6e31zOjEwOiJ0aW1lc3RhbXBzIjtiOjE7czoxMzoidXNlc1VuaXF1ZUlkcyI7YjowO3M6OToiACoAaGlkZGVuIjthOjQ6e2k6MDtzOjg6InBhc3N3b3JkIjtpOjE7czoxNDoicmVtZW1iZXJfdG9rZW4iO2k6MjtzOjI1OiJ0d29fZmFjdG9yX3JlY292ZXJ5X2NvZGVzIjtpOjM7czoxNzoidHdvX2ZhY3Rvcl9zZWNyZXQiO31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjExOiIAKgBmaWxsYWJsZSI7YTozOntpOjA7czo0OiJuYW1lIjtpOjE7czo1OiJlbWFpbCI7aToyO3M6ODoicGFzc3dvcmQiO31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO31zOjIwOiIAKgByZW1lbWJlclRva2VuTmFtZSI7czoxNDoicmVtZW1iZXJfdG9rZW4iO3M6MTQ6IgAqAGFjY2Vzc1Rva2VuIjtOO31zOjU6ImFubmVlIjtzOjk6IjIwMjMtMjAyNCI7fQ==', 1746034507),
('ioCZw6e5YHHuTWHLDqC63gZzwSJMnnvDxpJuVCB3', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDJkYXBUTHN3b1NPN000VkhubnRHTHJHeVQyZXM4Zng2d094aXN5VyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9FbGV2ZS81LzE4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1746030273),
('iuqaRto8rKS2QH04nhqydKjNgJAa1JJgvTUawoc1', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:128.0) Gecko/20100101 Firefox/128.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2M5YmxSOGxOSnhrRThYVktkZ3Q0UzRmdHFQOW54WlBnazljT1VYNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9FbGV2ZS9jcmVhdGUvNS8xOCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746028109),
('P24hWEnnB7S1HACJ7MWeElGPpOMOL5KSO6u4SkTc', 2, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiR1VFWVA5Q0I2ckIxZnBhVVZnd3ZTbDJvanlUcFZnM0JUbGRYdkd1YyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9uaXZlYXVieWlkLzUvMTg/bml2ZWF1SWQ9OCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQ2MDM0NjI5O31zOjU6Im1lbnVzIjthOjc6e2k6MTthOjI6e2k6MTthOjI6e2k6MjthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToyO3M6OToicGFyZW50X2lkIjtpOjE7czo3OiJub21NZW51IjtzOjY6IlByb2ZpbCI7czo0OiJsaWVuIjtzOjEyOiJwcm9maWwuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjAwMDAtMDAtMDAgMDA6MDA6MDAiO3M6MTA6InVwZGF0ZWRfYXQiO047fWk6MTthOjM6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjt9fWk6MTU7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6MTU7czo5OiJwYXJlbnRfaWQiO2k6MTtzOjc6Im5vbU1lbnUiO3M6MTI6InV0aWxpc2F0ZXVycyI7czo0OiJsaWVuIjtzOjEwOiJ1c2VyLmluZGV4IjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7aToxMjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTE0IDEyOjU5OjQxIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTE0IDIxOjEzOjA1Ijt9aToxO2E6Mzp7aTowO3M6NToiQ1JFRVIiO2k6MTtzOjk6IlNVUFBSSU1FUiI7aToyO3M6ODoiTU9ESUZJRVIiO319fWk6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToxO3M6OToicGFyZW50X2lkIjtOO3M6Nzoibm9tTWVudSI7czoxMToiVXRpbGlzYXRldXIiO3M6NDoibGllbiI7TjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7aToxMDtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIwMDAwLTAwLTAwIDAwOjAwOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319aTo0O2E6Mjp7aToxO2E6Njp7aToyNjthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToyNjtzOjk6InBhcmVudF9pZCI7aTo0O3M6Nzoibm9tTWVudSI7czoxNToiUHJpc2UgZW4gQ2hhcmdlIjtzOjQ6ImxpZW4iO3M6MTM6InBjaGFyZ2UuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMjUgMTI6MTE6NTUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMjUgMTI6MTE6NTUiO31pOjE7YTozOntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7fX1pOjI1O2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjI1O3M6OToicGFyZW50X2lkIjtpOjQ7czo3OiJub21NZW51IjtzOjY6IkJhbnF1ZSI7czo0OiJsaWVuIjtzOjEyOiJiYW5xdWUuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMjUgMTA6Mjg6MjEiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMjUgMTA6Mjg6MjEiO31pOjE7YTozOntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7fX1pOjIxO2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjIxO3M6OToicGFyZW50X2lkIjtpOjQ7czo3OiJub21NZW51IjtzOjY6IkNsYXNzZSI7czo0OiJsaWVuIjtzOjEyOiJjbGFzc2UuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMDQgMTY6NTY6MDQiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMDQgMTY6NTY6MDQiO31pOjE7YTo0OntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7aTozO3M6NToiQ1JFRVIiO319aToyMDthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToyMDtzOjk6InBhcmVudF9pZCI7aTo0O3M6Nzoibm9tTWVudSI7czo2OiJOaXZlYXUiO3M6NDoibGllbiI7czoxMjoibml2ZWF1LmluZGV4IjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7TjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTA0LTA0IDEyOjUwOjAzIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTA0LTA0IDEyOjUwOjAzIjt9aToxO2E6Mzp7aTowO3M6NToiQ1JFRVIiO2k6MTtzOjk6IlNVUFBSSU1FUiI7aToyO3M6ODoiTU9ESUZJRVIiO319aToxOTthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToxOTtzOjk6InBhcmVudF9pZCI7aTo0O3M6Nzoibm9tTWVudSI7czo1OiJDeWNsZSI7czo0OiJsaWVuIjtzOjExOiJjeWNsZS5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wNC0wNCAxMDo0NzowOSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wNC0wNCAxMDo0NzowOSI7fWk6MTthOjM6e2k6MDtzOjU6IkNSRUVSIjtpOjE7czo5OiJTVVBQUklNRVIiO2k6MjtzOjg6Ik1PRElGSUVSIjt9fWk6MTc7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6MTc7czo5OiJwYXJlbnRfaWQiO2k6NDtzOjc6Im5vbU1lbnUiO3M6NToiQW5uZWUiO3M6NDoibGllbiI7czoxMToiYW5uZWUuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTcgMTY6Mzc6MzIiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTcgMTY6Mzc6MzIiO31pOjE7YTowOnt9fX1pOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6NDtzOjk6InBhcmVudF9pZCI7TjtzOjc6Im5vbU1lbnUiO3M6MTI6IlBhcmFtw6l0cmFnZSI7czo0OiJsaWVuIjtOO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjAwMDAtMDAtMDAgMDA6MDA6MDAiO3M6MTA6InVwZGF0ZWRfYXQiO047fX1pOjc7YToyOntpOjE7YToyOntpOjI0O2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjI0O3M6OToicGFyZW50X2lkIjtpOjc7czo3OiJub21NZW51IjtzOjc6IkNhbnRpbmUiO3M6NDoibGllbiI7czoxMzoiY2FudGluZS5pbmRleCI7czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wNC0wNyAxMzoxNzo1NCI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wNC0wNyAxMzoxNzo1NCI7fWk6MTthOjA6e319aToyMzthOjI6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aToyMztzOjk6InBhcmVudF9pZCI7aTo3O3M6Nzoibm9tTWVudSI7czoxMDoiU2NvbGFyaXTDqSI7czo0OiJsaWVuIjtzOjE1OiJzY29sYXJpdGUuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMDcgMTM6MTc6MDUiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDQtMDcgMTM6MTc6MDUiO31pOjE7YTozOntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7fX19aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjc7czo5OiJwYXJlbnRfaWQiO047czo3OiJub21NZW51IjtzOjEwOiJSw6lnbGVtZW50IjtzOjQ6ImxpZW4iO047czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMDAwMC0wMC0wMCAwMDowMDowMCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9fWk6MzthOjI6e2k6MTthOjI6e2k6MTA7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6MTA7czo5OiJwYXJlbnRfaWQiO2k6MztzOjc6Im5vbU1lbnUiO3M6NDoiTWVudSI7czo0OiJsaWVuIjtzOjEwOiJtZW51LmluZGV4IjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7TjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIwMDAwLTAwLTAwIDAwOjAwOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtOO31pOjE7YTozOntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7fX1pOjk7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6OTtzOjk6InBhcmVudF9pZCI7aTozO3M6Nzoibm9tTWVudSI7czo2OiJBY3Rpb24iO3M6NDoibGllbiI7czoxMjoiYWN0aW9uLmluZGV4IjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7TjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIwMDAwLTAwLTAwIDAwOjAwOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtOO31pOjE7YTozOntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7fX19aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjM7czo5OiJwYXJlbnRfaWQiO047czo3OiJub21NZW51IjtzOjExOiJERVZFTE9QUEVVUiI7czo0OiJsaWVuIjtOO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjAwMDAtMDAtMDAgMDA6MDA6MDAiO3M6MTA6InVwZGF0ZWRfYXQiO047fX1pOjg7YToxOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6ODtzOjk6InBhcmVudF9pZCI7TjtzOjc6Im5vbU1lbnUiO3M6OToiUGVyc29ubmVsIjtzOjQ6ImxpZW4iO047czo5OiJpbnRlcmZhY2UiO3M6MToiMSI7czo0OiJpY29uIjtOO3M6NToib3JkcmUiO047czo3OiJ2aXNpYmxlIjtpOjE7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMDAwMC0wMC0wMCAwMDowMDowMCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9fWk6NjthOjE6e2k6MDtPOjg6InN0ZENsYXNzIjoxMDp7czoyOiJpZCI7aTo2O3M6OToicGFyZW50X2lkIjtOO3M6Nzoibm9tTWVudSI7czoxNDoiUsOpaW5zY3JpcHRpb24iO3M6NDoibGllbiI7TjtzOjk6ImludGVyZmFjZSI7czoxOiIxIjtzOjQ6Imljb24iO047czo1OiJvcmRyZSI7TjtzOjc6InZpc2libGUiO2k6MTtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIwMDAwLTAwLTAwIDAwOjAwOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319aTo1O2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEwOntzOjI6ImlkIjtpOjU7czo5OiJwYXJlbnRfaWQiO047czo3OiJub21NZW51IjtzOjExOiJJbnNjcmlwdGlvbiI7czo0OiJsaWVuIjtOO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtOO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjAwMDAtMDAtMDAgMDA6MDA6MDAiO3M6MTA6InVwZGF0ZWRfYXQiO047fWk6MTthOjE6e2k6MTg7YToyOntpOjA7Tzo4OiJzdGRDbGFzcyI6MTA6e3M6MjoiaWQiO2k6MTg7czo5OiJwYXJlbnRfaWQiO2k6NTtzOjc6Im5vbU1lbnUiO3M6NToiRWxldmUiO3M6NDoibGllbiI7czoxMToiRWxldmUuaW5kZXgiO3M6OToiaW50ZXJmYWNlIjtzOjE6IjEiO3M6NDoiaWNvbiI7TjtzOjU6Im9yZHJlIjtpOjEyO3M6NzoidmlzaWJsZSI7aToxO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMjYgMTY6NDk6MjgiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMjYgMTY6NDk6MjgiO31pOjE7YTo0OntpOjA7czo1OiJDUkVFUiI7aToxO3M6OToiU1VQUFJJTUVSIjtpOjI7czo4OiJNT0RJRklFUiI7aTozO3M6ODoiTU9ESUZJRVIiO319fX19czoxMDoibWVudXNGcm9udCI7YTowOnt9czo0OiJ1c2VyIjtPOjE1OiJBcHBcTW9kZWxzXFVzZXIiOjMyOntzOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6InVzZXJzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTk6InByZXZlbnRzTGF6eUxvYWRpbmciO2I6MDtzOjEwOiIAKgBwZXJQYWdlIjtpOjE1O3M6NjoiZXhpc3RzIjtiOjE7czoxODoid2FzUmVjZW50bHlDcmVhdGVkIjtiOjA7czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTc6e3M6MjoiaWQiO2k6MjtzOjM6Im5vbSI7czo1OiJaQU5HTyI7czo2OiJwcmVub20iO3M6OToiQWJkb3VsYXllIjtzOjk6InRlbGVwaG9uZSI7czoxODoiKCsyMjYpIDcwLTIyLTEyLTQ3IjtzOjExOiJpZGVudGlmaWFudCI7czo0OiJhYmxvIjtzOjk6InByb2ZpbF9pZCI7aTo5O3M6NToiYWN0aWYiO2k6MTtzOjU6ImVtYWlsIjtzOjE1OiJhZG1pbkBhZG1pbi5jb20iO3M6MTc6ImVtYWlsX3ZlcmlmaWVkX2F0IjtOO3M6ODoicGFzc3dvcmQiO3M6NjA6IiQyeSQxMiQ1SXBMQk9oWll6VVlOb1E5WHF6L0N1SDZtdllqSklPUDRaV0ZNN2tJMUkvVi5RMEdXN3dxYSI7czo3OiJ1c2VyX2lkIjtpOjI7czoxNzoidHdvX2ZhY3Rvcl9zZWNyZXQiO047czoyNToidHdvX2ZhY3Rvcl9yZWNvdmVyeV9jb2RlcyI7TjtzOjIzOiJ0d29fZmFjdG9yX2NvbmZpcm1lZF9hdCI7TjtzOjE0OiJyZW1lbWJlcl90b2tlbiI7TjtzOjEwOiJjcmVhdGVkX2F0IjtOO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMjAgMTQ6MDc6NTgiO31zOjExOiIAKgBvcmlnaW5hbCI7YToxNzp7czoyOiJpZCI7aToyO3M6Mzoibm9tIjtzOjU6IlpBTkdPIjtzOjY6InByZW5vbSI7czo5OiJBYmRvdWxheWUiO3M6OToidGVsZXBob25lIjtzOjE4OiIoKzIyNikgNzAtMjItMTItNDciO3M6MTE6ImlkZW50aWZpYW50IjtzOjQ6ImFibG8iO3M6OToicHJvZmlsX2lkIjtpOjk7czo1OiJhY3RpZiI7aToxO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGFkbWluLmNvbSI7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO047czo4OiJwYXNzd29yZCI7czo2MDoiJDJ5JDEyJDVJcExCT2haWXpVWU5vUTlYcXovQ3VINm12WWpKSU9QNFpXRk03a0kxSS9WLlEwR1c3d3FhIjtzOjc6InVzZXJfaWQiO2k6MjtzOjE3OiJ0d29fZmFjdG9yX3NlY3JldCI7TjtzOjI1OiJ0d29fZmFjdG9yX3JlY292ZXJ5X2NvZGVzIjtOO3M6MjM6InR3b19mYWN0b3JfY29uZmlybWVkX2F0IjtOO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjtOO3M6MTA6ImNyZWF0ZWRfYXQiO047czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yMCAxNDowNzo1OCI7fXM6MTA6IgAqAGNoYW5nZXMiO2E6MDp7fXM6ODoiACoAY2FzdHMiO2E6MTp7czoxNzoiZW1haWxfdmVyaWZpZWRfYXQiO3M6ODoiZGF0ZXRpbWUiO31zOjE3OiIAKgBjbGFzc0Nhc3RDYWNoZSI7YTowOnt9czoyMToiACoAYXR0cmlidXRlQ2FzdENhY2hlIjthOjA6e31zOjEzOiIAKgBkYXRlRm9ybWF0IjtOO3M6MTA6IgAqAGFwcGVuZHMiO2E6MTp7aTowO3M6MTc6InByb2ZpbGVfcGhvdG9fdXJsIjt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6MTM6InVzZXNVbmlxdWVJZHMiO2I6MDtzOjk6IgAqAGhpZGRlbiI7YTo0OntpOjA7czo4OiJwYXNzd29yZCI7aToxO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjtpOjI7czoyNToidHdvX2ZhY3Rvcl9yZWNvdmVyeV9jb2RlcyI7aTozO3M6MTc6InR3b19mYWN0b3Jfc2VjcmV0Ijt9czoxMDoiACoAdmlzaWJsZSI7YTowOnt9czoxMToiACoAZmlsbGFibGUiO2E6Mzp7aTowO3M6NDoibmFtZSI7aToxO3M6NToiZW1haWwiO2k6MjtzOjg6InBhc3N3b3JkIjt9czoxMDoiACoAZ3VhcmRlZCI7YToxOntpOjA7czoxOiIqIjt9czoyMDoiACoAcmVtZW1iZXJUb2tlbk5hbWUiO3M6MTQ6InJlbWVtYmVyX3Rva2VuIjtzOjE0OiIAKgBhY2Nlc3NUb2tlbiI7Tjt9czo1OiJhbm5lZSI7czo5OiIyMDIzLTIwMjQiO30=', 1746035265);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifiant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profil_id` bigint NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `telephone`, `identifiant`, `profil_id`, `actif`, `email`, `email_verified_at`, `password`, `user_id`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'ZANGO', 'Abdoulaye', '(+226) 70-22-12-47', 'ablo', 9, 1, 'admin@admin.com', NULL, '$2y$12$5IpLBOhZYzUYNoQ9Xqz/CuH6mvYjJIOP4ZWFM7kI1I/V.Q0GW7wqa', 2, NULL, NULL, NULL, NULL, NULL, '2025-03-20 14:07:58'),
(7, 'ILBOUDO', 'P JOSIANE EMELIE', '(+226) 61-98-23-26', 'JOSIANE', 11, 1, 'ilboudojosiane@gmail.com', NULL, '$2y$12$Uykh5BFJSdfMcVr86iIw9OP8/p1VbEGmbwDLGeAkrdAWhhm7RFQXy', 2, NULL, NULL, NULL, NULL, '2025-04-08 09:37:19', '2025-04-08 09:37:19');

-- --------------------------------------------------------

--
-- Structure de la vue `sequence`
--
DROP TABLE IF EXISTS `sequence`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sequence`  AS SELECT 1 AS `id`, '2021-2022' AS `anneelibelle`union all select 2 AS `2`,'2022-2023' AS `2022-2023` union all select 3 AS `3`,'2023-2024' AS `2023-2024` union all select 4 AS `4`,'2024-2025' AS `2024-2025`  ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actionmenus`
--
ALTER TABLE `actionmenus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `banques`
--
ALTER TABLE `banques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idniveau` (`idniveau`);

--
-- Index pour la table `cycles`
--
ALTER TABLE `cycles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`Matricule`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`Matricule`,`idanneescolaire`),
  ADD KEY `idcycle` (`idcycle`),
  ADD KEY `idniveau` (`idniveau`),
  ADD KEY `Matricule` (`Matricule`),
  ADD KEY `idpcharge` (`idpcharge`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mois`
--
ALTER TABLE `mois`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `niveaux`
--
ALTER TABLE `niveaux`
  ADD PRIMARY KEY (`id`,`annee`),
  ADD KEY `idcycle` (`idcycle`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `pcharges`
--
ALTER TABLE `pcharges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `profilmenuactions`
--
ALTER TABLE `profilmenuactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `profilmenus`
--
ALTER TABLE `profilmenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`,`profil_id`),
  ADD KEY `profil_id` (`profil_id`);

--
-- Index pour la table `profils`
--
ALTER TABLE `profils`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id` (`id`),
  ADD KEY `profil_id` (`profil_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actionmenus`
--
ALTER TABLE `actionmenus`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT pour la table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `banques`
--
ALTER TABLE `banques`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `cycles`
--
ALTER TABLE `cycles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pcharges`
--
ALTER TABLE `pcharges`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profilmenuactions`
--
ALTER TABLE `profilmenuactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT pour la table `profilmenus`
--
ALTER TABLE `profilmenus`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT pour la table `profils`
--
ALTER TABLE `profils`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`idniveau`) REFERENCES `niveaux` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`idcycle`) REFERENCES `cycles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inscriptions_ibfk_2` FOREIGN KEY (`idniveau`) REFERENCES `niveaux` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inscriptions_ibfk_3` FOREIGN KEY (`Matricule`) REFERENCES `eleves` (`Matricule`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `inscriptions_ibfk_4` FOREIGN KEY (`idpcharge`) REFERENCES `pcharges` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `niveaux`
--
ALTER TABLE `niveaux`
  ADD CONSTRAINT `idcycle` FOREIGN KEY (`idcycle`) REFERENCES `cycles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `profilmenus`
--
ALTER TABLE `profilmenus`
  ADD CONSTRAINT `profilmenus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profilmenus_ibfk_2` FOREIGN KEY (`profil_id`) REFERENCES `profils` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`profil_id`) REFERENCES `profils` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
