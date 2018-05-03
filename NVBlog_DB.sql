-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 30 Avril 2018 à 14:44
-- Version du serveur :  5.7.21-1ubuntu1
-- Version de PHP :  7.2.3-1ubuntu1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `NVBlog`
--
DROP DATABASE IF EXISTS NVBlog;
CREATE DATABASE NVBlog;
USE NVBlog;
-- --------------------------------------------------------

--
-- Structure de la table `Comment`
--

CREATE TABLE `Comment` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `publicationDate` datetime NOT NULL,
  `isValidated` tinyint(1) NOT NULL DEFAULT '0',
  `postId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Comment`
--

INSERT INTO `Comment` (`id`, `author`, `content`, `publicationDate`, `isValidated`, `postId`) VALUES
(1, 'Un visiteur', 'Nulla tempus eu nunc id consectetur. Nunc tempor efficitur tempus. Sed faucibus aliquet ex, non eleifend felis tempor sed. Proin interdum lorem dui, at iaculis ipsum eleifend at. Aenean tempus quam sit amet libero condimentum tincidunt eu a tellus.', '2018-05-01 07:00:00', 1, 2),
(2, 'Une autre visiteur', 'Nulla tempus eu nunc id consectetur. Nunc tempor efficitur tempus. Sed faucibus aliquet ex, non eleifend felis tempor sed. Proin interdum lorem dui, at iaculis ipsum eleifend at. Aenean tempus quam sit amet libero condimentum tincidunt eu a tellus.', '2018-04-30 21:00:00', 0, 2),
(3, 'Une autre visiteur', 'Nulla tempus eu nunc id consectetur. Nunc tempor efficitur tempus. Sed faucibus aliquet ex, non eleifend felis tempor sed. Proin interdum lorem dui, at iaculis ipsum eleifend at. Aenean tempus quam sit amet libero condimentum tincidunt eu a tellus.', '2018-04-30 21:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `Post`
--

CREATE TABLE `Post` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `updateDate` datetime NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Post`
--

INSERT INTO `Post` (`id`, `title`, `intro`, `content`, `updateDate`, `userId`) VALUES
(1, 'Article 1', 'Donec ac libero sapien. Nunc sit amet justo eu est laoreet iaculis. Maecenas eget feugiat libero, quis varius lacus. Aenean convallis lectus eu gravida tincidunt.', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac libero sapien. Nunc sit amet justo eu est laoreet iaculis. Maecenas eget feugiat libero, quis varius lacus. Aenean convallis lectus eu gravida tincidunt. Nulla lacinia eros eget leo dictum euismod. Aenean id risus vel libero porta varius eget nec augue. Donec scelerisque tellus sed lorem fermentum, nec aliquam elit varius. Vivamus ut odio placerat, viverra nibh non, euismod nulla. Pellentesque a lacus ligula.\r\n\r\nProin vitae tempus massa. Donec nec neque leo. Morbi lacinia vestibulum ultrices. Nam vitae magna aliquam, tincidunt nulla id, eleifend nunc. Fusce aliquet euismod erat. Nulla finibus consequat massa quis luctus. Phasellus vitae velit ac sem volutpat dignissim. Sed at tortor sem. Pellentesque pulvinar risus sed nunc blandit, quis porttitor enim scelerisque. Nulla dignissim sodales feugiat. Morbi orci justo, luctus nec iaculis non, efficitur ac dui. Nulla tempus eu nunc id consectetur. Nunc tempor efficitur tempus. Sed faucibus aliquet ex, non eleifend felis tempor sed. Proin interdum lorem dui, at iaculis ipsum eleifend at. Aenean tempus quam sit amet libero condimentum tincidunt eu a tellus.\r\n\r\nQuisque nisl risus, scelerisque eu ipsum a, auctor faucibus tellus. Vestibulum eu urna et ante imperdiet rutrum. Nulla libero ante, consectetur non euismod eu, pretium ut tellus. Vivamus maximus gravida ipsum, ac gravida sapien gravida nec. Nullam sit amet elit a libero semper volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam at mauris imperdiet, aliquet ex eu, vehicula velit. Quisque accumsan diam a nibh tempus, eget pretium justo bibendum. Morbi molestie, justo quis tristique aliquam, justo ante mattis sapien, ut aliquam magna ligula non urna. Cras quis elit eros. In lacinia enim quis posuere fringilla. Donec libero urna, auctor vel odio at, consequat aliquet odio. Praesent volutpat lectus gravida lectus auctor vestibulum. Pellentesque malesuada, neque vel vulputate commodo, erat enim finibus purus, quis ultrices tellus magna sed massa. Pellentesque eu faucibus urna, sed gravida ipsum. Quisque sit amet diam at ipsum tempor tincidunt nec et leo.\r\n\r\nMaecenas velit diam, sollicitudin interdum odio a, ultricies hendrerit dolor. Sed accumsan urna quis velit rhoncus, in dapibus dolor vulputate. Nullam libero orci, sagittis et accumsan eu, dapibus sed libero. Aenean cursus mollis elit viverra fringilla. Donec lacinia neque mattis, auctor tortor vitae, tempor odio. Vivamus congue lobortis tempor. Sed rhoncus, ligula eu varius eleifend, libero tortor pharetra lacus, viverra sagittis felis nibh in magna. Sed aliquam diam et nunc vestibulum mattis. Nunc dolor arcu, sollicitudin eu ante sit amet, eleifend finibus tortor.\r\n\r\nIn hac habitasse platea dictumst. Phasellus fermentum augue at odio fermentum dapibus. Vivamus ultrices ut sem a blandit. Donec urna purus, lacinia ac euismod a, fringilla quis lacus. Aliquam augue felis, rutrum vel ullamcorper vitae, facilisis nec nulla. Donec congue vulputate diam, non elementum nulla aliquam nec. Praesent ligula leo, pulvinar eleifend porttitor eu, elementum sed tortor. In cursus sed nulla quis ornare. Aenean tincidunt luctus dui malesuada porta. ', '2018-04-30 15:00:00', 1),
(2, 'Article 2', 'In hac habitasse platea dictumst. Phasellus fermentum augue at odio fermentum dapibus. Vivamus ultrices ut sem a blandit. Donec urna purus, lacinia ac euismod a, fringilla quis lacus. Aliquam augue felis, rutrum vel ull', '\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac libero sapien. Nunc sit amet justo eu est laoreet iaculis. Maecenas eget feugiat libero, quis varius lacus. Aenean convallis lectus eu gravida tincidunt. Nulla lacinia eros eget leo dictum euismod. Aenean id risus vel libero porta varius eget nec augue. Donec scelerisque tellus sed lorem fermentum, nec aliquam elit varius. Vivamus ut odio placerat, viverra nibh non, euismod nulla. Pellentesque a lacus ligula.\r\n\r\nProin vitae tempus massa. Donec nec neque leo. Morbi lacinia vestibulum ultrices. Nam vitae magna aliquam, tincidunt nulla id, eleifend nunc. Fusce aliquet euismod erat. Nulla finibus consequat massa quis luctus. Phasellus vitae velit ac sem volutpat dignissim. Sed at tortor sem. Pellentesque pulvinar risus sed nunc blandit, quis porttitor enim scelerisque. Nulla dignissim sodales feugiat. Morbi orci justo, luctus nec iaculis non, efficitur ac dui. Nulla tempus eu nunc id consectetur. Nunc tempor efficitur tempus. Sed faucibus aliquet ex, non eleifend felis tempor sed. Proin interdum lorem dui, at iaculis ipsum eleifend at. Aenean tempus quam sit amet libero condimentum tincidunt eu a tellus.\r\n\r\nQuisque nisl risus, scelerisque eu ipsum a, auctor faucibus tellus. Vestibulum eu urna et ante imperdiet rutrum. Nulla libero ante, consectetur non euismod eu, pretium ut tellus. Vivamus maximus gravida ipsum, ac gravida sapien gravida nec. Nullam sit amet elit a libero semper volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam at mauris imperdiet, aliquet ex eu, vehicula velit. Quisque accumsan diam a nibh tempus, eget pretium justo bibendum. Morbi molestie, justo quis tristique aliquam, justo ante mattis sapien, ut aliquam magna ligula non urna. Cras quis elit eros. In lacinia enim quis posuere fringilla. Donec libero urna, auctor vel odio at, consequat aliquet odio. Praesent volutpat lectus gravida lectus auctor vestibulum. Pellentesque malesuada, neque vel vulputate commodo, erat enim finibus purus, quis ultrices tellus magna sed massa. Pellentesque eu faucibus urna, sed gravida ipsum. Quisque sit amet diam at ipsum tempor tincidunt nec et leo.\r\n\r\nMaecenas velit diam, sollicitudin interdum odio a, ultricies hendrerit dolor. Sed accumsan urna quis velit rhoncus, in dapibus dolor vulputate. Nullam libero orci, sagittis et accumsan eu, dapibus sed libero. Aenean cursus mollis elit viverra fringilla. Donec lacinia neque mattis, auctor tortor vitae, tempor odio. Vivamus congue lobortis tempor. Sed rhoncus, ligula eu varius eleifend, libero tortor pharetra lacus, viverra sagittis felis nibh in magna. Sed aliquam diam et nunc vestibulum mattis. Nunc dolor arcu, sollicitudin eu ante sit amet, eleifend finibus tortor.\r\n\r\nIn hac habitasse platea dictumst. Phasellus fermentum augue at odio fermentum dapibus. Vivamus ultrices ut sem a blandit. Donec urna purus, lacinia ac euismod a, fringilla quis lacus. Aliquam augue felis, rutrum vel ullamcorper vitae, facilisis nec nulla. Donec congue vulputate diam, non elementum nulla aliquam nec. Praesent ligula leo, pulvinar eleifend porttitor eu, elementum sed tortor. In cursus sed nulla quis ornare. Aenean tincidunt luctus dui malesuada porta. ', '2018-04-16 00:00:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isValidated` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('member','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `User`
--

INSERT INTO `User` (`id`, `name`, `email`, `password`, `isValidated`, `role`) VALUES
(1, 'Nicolas Verjus', 'nverjus@protonmail.com', '$2y$10$6Y7/Xj.7tgfslPgIm9uKsuFIp18cMJsYTTaGuWK/KN4wftwzz.0cO', 1, 'admin'),
(2, 'Un Membre', 'nverjus@gmail.com', '$2y$10$oVE89wYddIJKXgD1YSA86eGxpAZnbvSiAwVve2ya8bA9DR8FWYRua', 1, 'member');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment_post` (`postId`);

--
-- Index pour la table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_user` (`userId`);

--
-- Index pour la table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Post`
--
ALTER TABLE `Post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`postId`) REFERENCES `Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
