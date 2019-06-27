<?php
    if (file_exists('config/database.php'))
        include 'config/database.php';
    else if (file_exists('database.php'))
        include 'database.php';
        try {
            
            $base = new PDO($DB_HOST, $DB_USER, $DB_PASSWORD);
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "
            SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';
            SET AUTOCOMMIT = 0;
            START TRANSACTION;
            SET time_zone = '+00:00';
            
            
            /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
            /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
            /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
            /*!40101 SET NAMES utf8mb4 */;
            
            --
            -- Base de données :  `$DB_NAME`
            --
            
            CREATE DATABASE IF NOT EXISTS `$DB_NAME` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
                  USE `$DB_NAME`;
            
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
            (3, 'parfait', 17, 11, '2019-04-26 15:46:11'),
            (4, 'ca fonctionne en local!', 1, 11, '2019-05-16 08:46:14'),
            (5, 'efw', 1, 11, '2019-05-16 08:51:43'),
            (6, 'wef', 1, 10, '2019-05-16 08:53:34'),
            (7, 'fwe', 1, 10, '2019-05-16 08:58:46'),
            (8, 'fw', 1, 10, '2019-05-16 09:00:49'),
            (9, 'weg', 1, 10, '2019-05-16 09:02:21'),
            (10, 'lol', 1, 10, '2019-05-16 09:30:29'),
            (11, 'genial la fete des jardins', 1, 4, '2019-05-16 09:34:34'),
            (12, 'super cet evenement Yannou', 1, 8, '2019-05-16 09:44:43'),
            (13, 'miam la fete des fraises', 1, 5, '2019-05-16 09:52:07'),
            (14, 'spam', 1, 5, '2019-05-16 09:55:49'),
            (15, 'wfe', 1, 5, '2019-05-16 09:56:09'),
            (16, 'wef', 1, 10, '2019-05-16 10:12:28'),
            (17, 'ewf', 1, 10, '2019-05-16 10:14:55'),
            (18, 'wef', 1, 9, '2019-05-16 10:15:21'),
            (19, 'ewffe', 1, 9, '2019-05-16 10:15:54'),
            (20, 'wef', 1, 9, '2019-05-16 10:16:20'),
            (21, 'ewf', 1, 11, '2019-05-16 11:49:47'),
            (22, 'few', 1, 8, '2019-05-16 11:55:13'),
            (23, 'wef', 1, 6, '2019-05-16 12:06:45'),
            (24, 'ef', 1, 10, '2019-05-16 12:19:13'),
            (25, 'fwe', 1, 10, '2019-05-16 12:20:04'),
            (26, 'ewf', 1, 9, '2019-05-16 12:21:27'),
            (27, 'ewf', 1, 9, '2019-05-16 12:31:42'),
            (28, 'dsv', 1, 9, '2019-05-16 12:33:31'),
            (29, 'asc', 1, 5, '2019-05-16 12:34:18'),
            (30, 'ewf', 1, 5, '2019-05-16 12:34:47'),
            (31, 'sd', 1, 10, '2019-05-16 12:37:02'),
            (32, 'ewf', 1, 10, '2019-05-16 12:37:42'),
            (33, 'ewf', 1, 5, '2019-05-16 12:38:02'),
            (34, 'weffwe', 1, 9, '2019-05-16 12:40:02'),
            (35, 'lol cest cool', 1, 8, '2019-05-16 12:45:04'),
            (36, 'topissime', 1, 4, '2019-05-16 13:25:21'),
            (37, 'genialissime', 1, 4, '2019-05-16 13:25:40'),
            (38, 'cool', 1, 5, '2019-05-17 12:07:17'),
            (39, 'fv', 1, 11, '2019-05-21 09:57:45'),
            (40, '<b>coucou<?b>', 1, 11, '2019-05-21 10:07:00'),
            (41, '<i>lolilol</i>', 1, 11, '2019-05-21 10:07:26'),
            (42, 'wef', 21, 5, '2019-06-18 15:17:22'),
            (43, 'wef', 21, 21, '2019-06-18 15:17:39'),
            (44, 'sdf', 21, 20, '2019-06-18 15:17:50'),
            (45, '<i>lolilol</i>', 1, 24, '2019-06-19 08:41:55'),
            (46, 'dwf', 1, 23, '2019-06-19 12:22:27'),
            (47, 'cool', 1, 24, '2019-06-19 15:31:56'),
            (48, 'haha trop cool', 1, 23, '2019-06-19 15:32:11'),
            (49, 'trop fort', 1, 8, '2019-06-19 15:32:40'),
            (50, 'On se croirait a Venise!', 1, 22, '2019-06-19 15:34:21'),
            (51, '<b>coucou<?b>', 1, 24, '2019-06-19 15:42:13'),
            (52, 'cool', 1, 29, '2019-06-21 10:27:40'),
            (53, 'lol', 1, 32, '2019-06-21 10:27:45'),
            (54, 'cool', 1, 31, '2019-06-21 12:36:18'),
            (55, 'sg', 1, 45, '2019-06-24 16:28:52'),
            (56, 'ds', 1, 45, '2019-06-24 16:28:55'),
            (57, 'dsf', 1, 44, '2019-06-24 16:52:09'),
            (58, 'sdf', 1, 45, '2019-06-26 15:57:31'),
            (59, 'xcv', 1, 45, '2019-06-26 15:58:22'),
            (60, 'sd', 1, 44, '2019-06-26 15:59:18'),
            (61, 'sd', 1, 45, '2019-06-26 16:01:11'),
            (62, 'fw', 1, 44, '2019-06-26 16:14:22');
            
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
            (12, 1, '../public/1/5d08d44e4fecf.jpg', '2019-06-18 12:08:46'),
            (16, 1, '../public/1/5d08dc0302454.jpg', '2019-06-18 12:41:39'),
            (20, 1, '../public/1/5d08fe7ac7ee0.jpg', '2019-06-18 15:08:42'),
            (21, 21, '../public/21/5d09001dcb51f.jpg', '2019-06-18 15:15:41'),
            (22, 21, '../public/21/5d09002aeeac6.jpg', '2019-06-18 15:15:54'),
            (23, 21, '../public/21/5d0900bb1f700.jpg', '2019-06-18 15:18:19'),
            (24, 1, '../public/1/5d090339297d7.jpg', '2019-06-18 15:28:57'),
            (29, 1, '../public/1/5d0ca90993801.jpg', '2019-06-21 09:53:13'),
            (30, 1, '../public/1/5d0cafc7635ab.jpg', '2019-06-21 10:21:59'),
            (31, 1, '../public/1/5d0cafe63e975.jpg', '2019-06-21 10:22:30'),
            (32, 1, '../public/1/5d0cb0e99bcf8.jpg', '2019-06-21 10:26:49'),
            (33, 1, '../public/1/5d0cd0054c645.jpg', '2019-06-21 12:39:33'),
            (37, 1, '../public/1/5d0cdc53d33ba.jpg', '2019-06-21 13:32:03'),
            (38, 1, '../public/1/5d0cdc60d1247.jpg', '2019-06-21 13:32:16'),
            (40, 1, '../public/1/5d0ceca2330e1.jpg', '2019-06-21 14:41:38'),
            (41, 1, '../public/1/5d0ceca739992.jpg', '2019-06-21 14:41:43'),
            (42, 1, '../public/1/5d0cecb4eb116.jpg', '2019-06-21 14:41:56'),
            (43, 1, '../public/1/5d10baf16b2cf.jpg', '2019-06-24 11:58:41'),
            (44, 1, '../public/1/5d10bfdc31a57.jpg', '2019-06-24 12:19:40'),
            (45, 1, '../public/1/5d10eb2c9d1a2.jpg', '2019-06-24 15:24:28'),
            (48, 1, '../public/1/5d13999624a8d.jpg', '2019-06-26 16:13:10'),
            (50, 1, '../public/1/5d1399c37f014.jpg', '2019-06-26 16:13:55'),
            (52, 1, '../public/1/5d13a24774390.jpg', '2019-06-26 16:50:15');
            
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
            (39, 1, 6),
            (40, 21, 16),
            (42, 21, 22),
            (43, 21, 21),
            (46, 1, 31),
            (50, 1, 41),
            (52, 1, 45),
            (53, 1, 44),
            (54, 1, 52);
            
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
              `password_reset` varchar(15) DEFAULT NULL,
              `notification` tinyint(1) NOT NULL DEFAULT '1'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
            
            --
            -- Déchargement des données de la table `user`
            --
            
            INSERT INTO `user` (`id`, `username`, `email`, `password`, `session_id`, `user_verification`, `password_reset`, `notification`) VALUES
            (1, '42', '42@42.fr', '3828de540df750adc4a57bf08af152df1756fe2a1d277f7c86183d01846c3521f6e82357e7a260de9140260cee71dae01a2efd4587754ad74ecabb5028abed84', '5d1499eb8bc85', NULL, '5d139c5577067', 1),
            (2, 'alain', 'alain@42.fr', 'fe189092f23e0c09ec2b241021165e494b3b3ecc68060efaf5f9a9f6feab1f186915edf92de47ea16bf3ae3971344c485962547aa47d7cc8fc94462141978fd6', NULL, NULL, NULL, 1),
            (6, 'yann', 'yann.petitjean@hotmail.fr', 'fe189092f23e0c09ec2b241021165e494b3b3ecc68060efaf5f9a9f6feab1f186915edf92de47ea16bf3ae3971344c485962547aa47d7cc8fc94462141978fd6', NULL, '5cc0539fb4236', NULL, 1),
            (17, 'yannou', 'yann120@hotmail.fr', '3828de540df750adc4a57bf08af152df1756fe2a1d277f7c86183d01846c3521f6e82357e7a260de9140260cee71dae01a2efd4587754ad74ecabb5028abed84', NULL, NULL, NULL, 1),
            (18, 'yann.petitjean', 'ypetitjean06@gmail.com', '3828de540df750adc4a57bf08af152df1756fe2a1d277f7c86183d01846c3521f6e82357e7a260de9140260cee71dae01a2efd4587754ad74ecabb5028abed84', NULL, NULL, NULL, 1),
            (19, 'marc', 'marc@hotmail.fr', '5cdd6d768308af3ff2d261654273246ec2f8d4d7cb03be6bac435d86349679dbd0f80e56f19122e38bcc1784c6e53fe831576e3c839a2de9f3f7020bd333165d', NULL, '5ce3cae6960ff', NULL, 1),
            (20, 'Sego', 'sego@yopmail.com', 'cf343fe669a4e2ffda479b3514859a73b41c170edebe1fe26b9cd4725e7a99df10a7e553bf764ebcb547e7ac71aa5549a6307896fbf97789c923a9296499d9a6', NULL, '5d08fedf1f70f', NULL, 1),
            (21, 'segosego', 'segolene.alquier@yahoo.com', 'cf343fe669a4e2ffda479b3514859a73b41c170edebe1fe26b9cd4725e7a99df10a7e553bf764ebcb547e7ac71aa5549a6307896fbf97789c923a9296499d9a6', NULL, NULL, NULL, 1),
            (23, '54', '54@growth-tools.fr', '391024165a05b19a3a280cd113653b33d3ae36c7b776ded81714dc54de0a36aa7363c47bf1d8d9e38d10ed7a5de0d1f50a7b265e704895bbf1673fb0c3a34f22', NULL, NULL, NULL, 1),
            (24, 'alex', 'alex@yopmail.com', '7660477927a0d20803fad2ed7dbf56362afec28e130490f5b40b398331ca8330215561ff4c568a33c0f554f77a22209a3987eeafde63b6b7efadd5aa532c24b2', NULL, NULL, NULL, 1),
            (25, 'yann120', 'yann120@me.com', 'deccc2956cb2d84118fc4a33c9d85c7e3d5a4d6e438d4f9d4095186e4f46d844b5d5d4c1fdacf04a58720921d1e544f5c12baf834b4a172c85d27b07ef0b615e', NULL, '5d13a27b33728', NULL, 1);
            
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
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
            
            --
            -- AUTO_INCREMENT pour la table `images`
            --
            ALTER TABLE `images`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
            
            --
            -- AUTO_INCREMENT pour la table `images_like`
            --
            ALTER TABLE `images_like`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
            
            --
            -- AUTO_INCREMENT pour la table `user`
            --
            ALTER TABLE `user`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
            COMMIT;
            
            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
            
            $query = $base->prepare($sql);
            if ($query->execute())
                echo "base de donnée créée";
        }
        catch(exception $e) {
            die('Erreur '.$e->getMessage());
        }

?>