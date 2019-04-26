-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3307
-- Généré le :  ven. 26 avr. 2019 à 08:52
-- Version du serveur :  5.7.22
-- Version de PHP :  7.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `image_id`, `creation_date`) VALUES
(1, 'trop cool', 17, 11, '2019-04-26 15:45:48'),
(2, 'genial', 17, 10, '2019-04-26 15:45:48'),
(3, 'parfait', 17, 11, '2019-04-26 15:46:11');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`id`, `user_id`, `path`, `creation_date`) VALUES
(4, 17, '/public/17/5cc2d89f279ae.jpg', '2019-04-26 10:08:31'),
(5, 17, '/public/17/5cc2e6ac561d3.jpg', '2019-04-26 11:08:28'),
(6, 17, '/public/17/5cc2e6b27ef9f.jpg', '2019-04-26 11:08:34'),
(7, 17, '/public/17/5cc2f42b9d37b.jpg', '2019-04-26 12:06:03'),
(8, 17, '/public/17/5cc2f4342279c.jpg', '2019-04-26 12:06:12'),
(9, 17, '/public/17/5cc2f43a6ff4f.jpg', '2019-04-26 12:06:18'),
(10, 1, '/public/1/5cc3240f6b582.jpg', '2019-04-26 15:30:23'),
(11, 1, '/public/1/5cc3241969568.jpg', '2019-04-26 15:30:33');

-- --------------------------------------------------------

--
-- Structure de la table `images_like`
--

CREATE TABLE `images_like` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `images_like`
--

INSERT INTO `images_like` (`id`, `user_id`, `image_id`) VALUES
(3, 7, 8),
(21, 17, 8),
(24, 17, 6),
(28, 1, 8),
(31, 1, 0),
(38, 1, 10),
(39, 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `session_id` varchar(15) DEFAULT NULL,
  `user_verification` varchar(15) DEFAULT NULL,
  `password_reset` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `session_id`, `user_verification`, `password_reset`) VALUES
(1, '42', '42@42.fr', 'a305a8124f1dc6ebe3204c2cb6e7ceae955b1378835260b9b79cda3d561d864780b4c90da76c10ec7638a4f595138a9d7804bfdf341244634095505d82d77033', '5cc32400c6300', NULL, NULL),
(2, 'alain', 'alain@42.fr', 'fe189092f23e0c09ec2b241021165e494b3b3ecc68060efaf5f9a9f6feab1f186915edf92de47ea16bf3ae3971344c485962547aa47d7cc8fc94462141978fd6', NULL, NULL, NULL),
(6, 'yann', 'yann.petitjean@hotmail.fr', 'fe189092f23e0c09ec2b241021165e494b3b3ecc68060efaf5f9a9f6feab1f186915edf92de47ea16bf3ae3971344c485962547aa47d7cc8fc94462141978fd6', NULL, '5cc0539fb4236', NULL),
(17, 'yannou', 'yann120@hotmail.fr', 'e579ab3080966c751adc8beaf5a82c138b9735e4cfe27d7960e11ef0d015ad9fb7e49a287b5428ac1972a013c19da836de2f6d6dd0ebd78a9bdd9e028e99922a', '5cc2d51c990e3', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images_like`
--
ALTER TABLE `images_like`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `images_like`
--
ALTER TABLE `images_like`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
