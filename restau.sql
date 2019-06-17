-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 17 juin 2019 à 16:58
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `restau`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `getAllCat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllCat` ()  NO SQL
BEGIN
    select * from categories;
END$$

DROP PROCEDURE IF EXISTS `getClientByName_Password`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getClientByName_Password` (IN `nom` VARCHAR(255), IN `pass` VARCHAR(255))  NO SQL
BEGIN
    select * from client where nom_cl=nom and mdp_cl=pass;
end$$

DROP PROCEDURE IF EXISTS `getItemByCat`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getItemByCat` (IN `cat_id` INT)  NO SQL
BEGIN
    select * from items where category=cat_id;
END$$

DROP PROCEDURE IF EXISTS `getTablesByDay`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTablesByDay` (IN `da` DATE)  NO SQL
BEGIN
    select num_table from reservation where date_reser=da;
END$$

DROP PROCEDURE IF EXISTS `insertReservation`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertReservation` (IN `nom` VARCHAR(100), IN `prenom` VARCHAR(100), IN `nombre` INT, IN `mail` VARCHAR(100), IN `num` INT, IN `da` DATE, IN `he` TIME, IN `ta` INT)  NO SQL
BEGIN
    INSERT INTO reservation(nom_reser,prenom_reser,nombre_p,email,numero,num_table,date_reser,heure_reser) VALUES (nom,prenom,nombre,mail,num,ta,da,he);
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'entree'),
(2, 'plat'),
(3, 'dessert'),
(4, 'boisson');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_cl` int(11) NOT NULL AUTO_INCREMENT,
  `nom_cl` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `prenom_cl` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `num_cl` int(11) NOT NULL,
  `email_cl` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `mdp_cl` int(11) NOT NULL,
  PRIMARY KEY (`id_cl`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_cl`, `nom_cl`, `prenom_cl`, `num_cl`, `email_cl`, `mdp_cl`) VALUES
(1, 'my', 'mu', 56236598, 'mu@gmail.com', 0);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_c` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` date NOT NULL,
  PRIMARY KEY (`id_c`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `faire`
--

DROP TABLE IF EXISTS `faire`;
CREATE TABLE IF NOT EXISTS `faire` (
  `id_faire` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` varchar(17) COLLATE utf8mb4_bin NOT NULL,
  `id_client` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id_faire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(250) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `image` varchar(250) COLLATE utf8_bin NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(1, 'salade', 'ertyuiopuyjt', 2000, 'sala.png', 1),
(3, 'coca', 'fdxfguiouyut', 500, 'coca.png', 4),
(4, 'zertyuiytre', 'zertyutre', 2000, 'burger.png', 2),
(5, 'rdtfyuiuyt', 'tyuiuytre', 300, 'fond.png', 3),
(6, 'fghjk', 'rtyuiyt', 3000, 'beignet.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_reser` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `prenom_reser` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `nombre_p` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `numero` int(11) NOT NULL,
  `num_table` int(11) NOT NULL,
  `date_reser` date NOT NULL,
  `heure_reser` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `nom_reser`, `prenom_reser`, `nombre_p`, `email`, `numero`, `num_table`, `date_reser`, `heure_reser`) VALUES
(15, 'yao', 'josuÃ©', 2, 'kadafia01@gmail.com', 43420319, 37, '2019-06-13', '05:11:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
