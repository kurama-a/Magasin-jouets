-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 22 jan. 2025 à 11:46
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
-- Base de données : `magasinjouets`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ID_Client` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Telephone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_Client`, `Nom`, `Prenom`, `Email`, `Adresse`, `Telephone`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@email.com', '5 Rue des Lilas, Marseille', '0620304050'),
(2, 'Martin', 'Sophie', 'sophie.martin@email.com', '10 Av. de la République, Lille', '0750607080'),
(3, 'Bernard', 'Lucas', 'lucas.bernard@email.com', '8 Rue de la Paix, Lyon', '0611223344'),
(4, 'Leroy', 'Emma', 'emma.leroy@email.com', '12 Bd Haussmann, Paris', '0622334455'),
(5, 'Morel', 'Thomas', 'thomas.morel@email.com', '19 Av. des Champs, Nice', '0633445566'),
(6, 'Garcia', 'Marie', 'marie.garcia@email.com', '45 Rue du Marché, Toulouse', '0644556677'),
(7, 'Simon', 'Nathan', 'nathan.simon@email.com', '7 Rue du Stade, Bordeaux', '0655667788'),
(8, 'Rousseau', 'Camille', 'camille.rousseau@email.com', '3 Rue des Roses, Nantes', '0666778899'),
(9, 'Perez', 'Hugo', 'hugo.perez@email.com', '22 Rue des Écoles, Rennes', '0677889900'),
(10, 'Fischer', 'Alice', 'alice.fischer@email.com', '9 Rue des Champs, Strasbourg', '0688990011');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `ID_Commande` int(11) NOT NULL,
  `Date_Commande` date NOT NULL,
  `Total` float NOT NULL,
  `ID_Client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`ID_Commande`, `Date_Commande`, `Total`, `ID_Client`) VALUES
(1, '2024-01-15', 89.99, 1),
(2, '2024-01-16', 79.99, 2),
(3, '2024-01-17', 29.99, 3),
(4, '2024-01-18', 24.99, 4),
(5, '2024-01-19', 19.99, 5),
(6, '2024-01-20', 34.99, 6),
(7, '2024-01-21', 14.99, 7),
(8, '2024-01-22', 59.99, 8),
(9, '2024-01-23', 19.99, 9),
(10, '2024-01-24', 44.99, 10);

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `ID_Detail` int(11) NOT NULL,
  `ID_Commande` int(11) NOT NULL,
  `ID_Jouet` int(11) NOT NULL,
  `Quantite` int(11) NOT NULL CHECK (`Quantite` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`ID_Detail`, `ID_Commande`, `ID_Jouet`, `Quantite`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(3, 3, 3, 1),
(4, 4, 4, 2),
(5, 5, 5, 1),
(6, 6, 6, 1),
(7, 7, 7, 3),
(8, 8, 8, 1),
(9, 9, 9, 2),
(10, 10, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `ID_Fournisseur` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`ID_Fournisseur`, `Nom`, `Adresse`, `Telephone`, `Email`) VALUES
(1, 'Lego France', '75 Rue de Paris, Paris', '0102030405', 'contact@lego.fr'),
(2, 'Playmobil', '12 Av. des Jouets, Lyon', '0607080910', 'info@playmobil.com'),
(3, 'Hasbro', '50 Av. du Jeu, Bordeaux', '0611121314', 'service@hasbro.com'),
(4, 'Mattel', '88 Bd des Enfants, Toulouse', '0622232425', 'contact@mattel.com'),
(5, 'Mega Bloks', '15 Rue des Jouets, Nice', '0733343536', 'contact@megabloks.com'),
(6, 'Bandai', '42 Rue des Mangas, Marseille', '0644454647', 'support@bandai.com'),
(7, 'Fisher-Price', '100 Rue des Jouets, Nantes', '0655565758', 'contact@fisherprice.com'),
(8, 'VTech', '23 Rue des Gadgets, Lille', '0666676869', 'info@vtech.com'),
(9, 'Ravensburger', '19 Av. des Puzzles, Strasbourg', '0677787980', 'service@ravensburger.com'),
(10, 'Schleich', '5 Rue des Figurines, Rennes', '0688899091', 'contact@schleich.com');

-- --------------------------------------------------------

--
-- Structure de la table `jouet`
--

CREATE TABLE `jouet` (
  `ID_Jouet` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prix` float NOT NULL,
  `Categorie` varchar(255) NOT NULL,
  `Stock_disponible` int(11) NOT NULL,
  `ID_Fournisseur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `jouet`
--

INSERT INTO `jouet` (`ID_Jouet`, `Nom`, `Prix`, `Categorie`, `Stock_disponible`, `ID_Fournisseur`) VALUES
(1, 'Boîte de Lego Star Wars', 89.99, 'Construction', 50, 1),
(2, 'Château Playmobil', 79.99, 'Figurine', 40, 2),
(3, 'Monopoly', 29.99, 'Jeu de société', 100, 3),
(4, 'Barbie Princesse', 24.99, 'Poupée', 80, 4),
(5, 'Camion Mega Bloks', 19.99, 'Construction', 30, 5),
(6, 'Dragon Ball Z Figurine', 34.99, 'Figurine', 70, 6),
(7, 'Voiture Fisher-Price', 14.99, 'Véhicule', 60, 7),
(8, 'Tablette VTech', 59.99, 'Électronique', 25, 8),
(9, 'Puzzle Ravensburger 1000 pièces', 19.99, 'Puzzle', 90, 9),
(10, 'Dinosaures Schleich', 44.99, 'Figurine', 50, 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_Client`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Telephone` (`Telephone`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`ID_Commande`),
  ADD KEY `ID_Client` (`ID_Client`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`ID_Detail`),
  ADD KEY `ID_Commande` (`ID_Commande`),
  ADD KEY `ID_Jouet` (`ID_Jouet`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`ID_Fournisseur`),
  ADD UNIQUE KEY `Telephone` (`Telephone`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Index pour la table `jouet`
--
ALTER TABLE `jouet`
  ADD PRIMARY KEY (`ID_Jouet`),
  ADD KEY `ID_Fournisseur` (`ID_Fournisseur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `ID_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `ID_Commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `ID_Detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `ID_Fournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `jouet`
--
ALTER TABLE `jouet`
  MODIFY `ID_Jouet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID_Client`) ON DELETE CASCADE;

--
-- Contraintes pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD CONSTRAINT `details_commande_ibfk_1` FOREIGN KEY (`ID_Commande`) REFERENCES `commande` (`ID_Commande`) ON DELETE CASCADE,
  ADD CONSTRAINT `details_commande_ibfk_2` FOREIGN KEY (`ID_Jouet`) REFERENCES `jouet` (`ID_Jouet`) ON DELETE CASCADE;

--
-- Contraintes pour la table `jouet`
--
ALTER TABLE `jouet`
  ADD CONSTRAINT `jouet_ibfk_1` FOREIGN KEY (`ID_Fournisseur`) REFERENCES `fournisseur` (`ID_Fournisseur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
