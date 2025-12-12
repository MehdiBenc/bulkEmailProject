-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 13 juin 2025 à 15:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bulk_email_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `message_envoye`
--

CREATE TABLE `message_envoye` (
  `id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `email_destinataire` varchar(255) NOT NULL,
  `date_envoi` datetime DEFAULT current_timestamp(),
  `expediteur_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message_envoye`
--

INSERT INTO `message_envoye` (`id`, `contenu`, `email_destinataire`, `date_envoi`, `expediteur_id`) VALUES
(17, 'hello', 'aliBeljed@gmail.com', '2025-06-11 14:12:41', 6),
(18, 'hello simo cv', 'simo@gmail.com', '2025-06-11 14:12:41', 6),
(19, 'hello', 'alislimani@gmail.com', '2025-06-11 14:24:48', 6),
(21, 'hello', 'simo@gmail.com', '2025-06-11 14:24:48', 6),
(22, 'hello!', 'alislimani@gmail.com', '2025-06-11 14:27:17', 6),
(23, 'hello', 'aliBeljed@gmail.com', '2025-06-11 14:27:17', 6),
(25, 'bonjour', 'iliasslahmadi@gmail.com', '2025-06-11 23:01:32', 15),
(26, 'bonjour', 'midou@gmail.com', '2025-06-11 23:01:32', 15),
(27, 'salam', 'alislimani@gmail.com', '2025-06-13 10:37:50', 6),
(28, 'salam', 'aliBeljed@gmail.com', '2025-06-13 10:37:50', 6),
(29, 'salam', 'simo@gmail.com', '2025-06-13 10:37:50', 6),
(31, 'hello', 'simo@gmail.com', '2025-06-13 15:08:02', 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `created_at`) VALUES
(1, '', 'benchekrounmehdi2006@gmail.com', '$2y$10$g8HDYWNCTKpMC4NHsh3F5OCvAzS86gzFkyPo893SpFkW.aes7NUMS', '2025-06-05 11:37:00'),
(2, '', 'karimsami@gmail.com', '$2y$10$IC.G1BbRZsjnHPdOT4T09e8av389ghDrLmEmkh4DUvs6/pOj7WkQi', '2025-06-05 12:32:44'),
(3, '', 'ahmed@gmail.com', '$2y$10$epLTwVZrYSF1Xo2oXziTPu0hk2HhLlkyrYLqGMijvJb0XxTwsH6.2', '2025-06-06 15:38:48'),
(4, '', 'amine@gmail.com', '$2y$10$QTXnLKIONTCD1JBoazZMVuChqHH28/WU5EqSWllmHSnb/3d.D/I0O', '2025-06-10 20:37:33'),
(5, '', 'tahadarif@gmail.com', '$2y$10$FHxbV4jGEPU.AaUbRNIBHegGi1MzS639EzrD8rqWF8J2667LLVhnK', '2025-06-11 13:52:48'),
(6, '', 'mehdi@gmail.com', '$2y$10$Nm.b7oDxT3Z1WA8mWTa1MOqSVEMdA0EvbSkNAGOx4qz/MFik5RpQi', '2025-06-11 14:11:36'),
(7, '', 'mehdi@gmailcom', '$2y$10$/sOMtBwh/C9IuremosD9n.pXM2N7FKzPYcbX6OG8U0UxNDDguRQ6K', '2025-06-11 21:17:34'),
(10, '', 'mohammed@gmail.com', '$2y$10$rVXtUUVOd6c4ab4Z5a8LmOeVKSJt6EG8LZrx/Q7I7aQYMT6XDqElK', '2025-06-11 21:27:23'),
(11, '', 'simo@gmail.com', '$2y$10$Q2RvW5R2sYX4G/exMgrIcuanf9arr.3.17S/xyQgs02kLIVCzXPhW', '2025-06-11 21:29:20'),
(12, '', 'reda@gmail.com', '$2y$10$/ewGAlEhiQWMOmOgvtQNhutTNtc4FGa3J4dCht7tKXUMmTyEyhsGm', '2025-06-11 21:30:19'),
(13, '', 'jamal@gmail.com', '$2y$10$Njp1lIQnrKXFwrYz0T2ROeDHBkSuqgmq.sZpQeZXaKZ3yZKzt.X1O', '2025-06-11 21:34:29'),
(14, '', 'hamid@gmail.com', '$2y$10$BcNuxow6i1uqLgskWgv9uOgZGU4927a7N6IR.r5nqb.cvNTu87eWS', '2025-06-11 21:37:25'),
(15, '', 'mio@gmail.com', '$2y$10$CtGMlvXzU38DHqMYKruIdeCebQmFjYv.mIMS69oeNDig0kRDVX/Ku', '2025-06-11 22:56:25'),
(16, '', 'jalil@gmail.com', '$2y$10$rhml2MAK1tdK.lUTdmOrkequlh3mY4VYAKKCSS2qNeHvSNVBBoOoa', '2025-06-13 15:33:40'),
(17, '', 'krimo@gmail.com', '$2y$10$CE1vaPq8IzBlkVBpHxyuc.8xn1vrRNAH0jFxkFbawe01Gyq3DZAaG', '2025-06-13 15:34:32');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `email`) VALUES
(1, 'Slimani', 'alislimani@gmail.com'),
(2, 'Ali', 'aliBeljed@gmail.com'),
(4, 'simo', 'simo@gmail.com'),
(5, 'iliasslahmadi', 'iliasslahmadi@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `message_envoye`
--
ALTER TABLE `message_envoye`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expediteur_id` (`expediteur_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `message_envoye`
--
ALTER TABLE `message_envoye`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `message_envoye`
--
ALTER TABLE `message_envoye`
  ADD CONSTRAINT `message_envoye_ibfk_1` FOREIGN KEY (`expediteur_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
