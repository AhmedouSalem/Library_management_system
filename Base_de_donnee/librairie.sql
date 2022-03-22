-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 fév. 2022 à 18:23
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `librairie`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `CategoryId` int(11) NOT NULL,
  `Parentcategoryid` char(18) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`CategoryId`, `Parentcategoryid`, `Name`, `Description`) VALUES
(1, '6900152484440', 'informatique et internet', 'Cree par Bernard larroche\nphp and mysql'),
(2, '9782616052277', 'informatique et internet', 'Livre pierre terrache AnalyseMath'),
(5, '9783161484100', 'Sport', 'Conseils Sport'),
(9, '978-2-3400-6104-0', 'Dictionnaires et langues', 'tous les niveaux'),
(10, '978-2-7550-0366-6', 'Dictionnaires et langues', 'tous les niveaux'),
(11, '978-2-0802-3676-0', 'Développement personnel', 'Flammarion'),
(13, '978-2-4090-2829-8', 'informatique et internet', 'internet'),
(14, '978-2-0919-3555-3', 'Scolaire', 'Ecriture Math exploration du monde'),
(15, '978-2-3400-4873-7', 'Scolaire', 'Dans cette catégorie, tous les ouvrages scolaires, de la maternelle à l\'enseignement supérieur. Les livres sont classés par date de parution, les plus récents en tête. 3 184 livres sont proposés dans cette catégorie.');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ClientId` int(11) NOT NULL,
  `Nom` varchar(30) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `DateNaissance` date NOT NULL,
  `Genre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ClientId`, `Nom`, `Address`, `DateNaissance`, `Genre`) VALUES
(17, 'Ahmedou Salem', 'lksar', '2000-01-16', 'male');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `CommandeId` int(11) NOT NULL,
  `CommandeDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Prix` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `ClientId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`CommandeId`, `CommandeDate`, `Prix`, `status`, `ClientId`) VALUES
(1, '2022-02-18 17:21:20', 7000, 2, 17),
(2, '2022-02-18 17:22:52', 16714, 1, 17);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `UserId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`UserId`, `username`, `password`, `category`, `image`) VALUES
(17, 'Ahmedou Salem', 'e3afed0047b08059d0fada10f400c1e5', 'Client', 'Ahmedou.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `loginm`
--

CREATE TABLE `loginm` (
  `MemberId` int(11) NOT NULL,
  `username` varchar(90) NOT NULL,
  `password` varchar(90) NOT NULL,
  `category` varchar(90) NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `loginm`
--

INSERT INTO `loginm` (`MemberId`, `username`, `password`, `category`) VALUES
(2, 'Administrateur', '90762d012cef522fb01e3f97cef5a059', 'member'),
(3, 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 'member');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `Id` int(11) NOT NULL,
  `ClientId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `products_commandes`
--

CREATE TABLE `products_commandes` (
  `IdCle` int(11) NOT NULL,
  `ProduitCommande` int(11) NOT NULL,
  `CommandeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `products_commandes`
--

INSERT INTO `products_commandes` (`IdCle`, `ProduitCommande`, `CommandeId`) VALUES
(1, 19, 1),
(2, 16, 1),
(3, 16, 2),
(4, 1, 2),
(5, 7, 2),
(6, 7, 2),
(7, 19, 2);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `ProductId` int(11) NOT NULL,
  `NomLivre` varchar(100) NOT NULL,
  `Auteur` varchar(100) NOT NULL,
  `Description` longtext NOT NULL,
  `Prix` int(11) NOT NULL,
  `CategoryId` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`ProductId`, `NomLivre`, `Auteur`, `Description`, `Prix`, `CategoryId`, `image`) VALUES
(1, 'MySQL  ', 'Larroche_Bernard', 'Particulièrement destiné aux débutants, cet ouvrage permet de découvrir toutes les aspects de la programmation SQL par le biais du système de gestion de bases de données MySQL. Tous les concepts du langage procédural de MySQL sont décrits avec précision : variables, structure de contrôle, interactions avec la base, sous-programmes, curseurs, transactions, gestion des exceptions, déclencheurs, SQL dynamique. Couleur explique en outre comment exploiter une base MySQL (connexion et transactions) en programmant avec Java (JDBC) ou PHP 5. Chaque notion importante du livre est introduite à l\'aide d\'exemples simples et chaque chapitre se clôt par une série d\'exercices (avec corrigés disponibles en ligne) qui permettront au lecteur de tester ses connaissances. La seconde édition de cet ouvrage traite de la programmation avec la version de production 5.5 de MySQL : gestion du XML, signaux, événements. L\'optimisation des requêtes est également détaillée, notamment le fonctionnement de l\'optimiseur, l\'utilisation des statistiques et les plans d\'exécution. Enfin, différents techniques d\'optimisation sont présentées, telles que l\'indexation, les tables temporaires, le partitionnement et la dénormalisation.', 800, 1, 'Mysql_data.jpg'),
(6, 'Algorithme ', 'brousse', 'Découvrez l\'univers des algorithmes présents dans tous les systèmes informatiques d\'aujourd\'hui\r\nDe nos jours tous les programmes informatiques comme par exemple ceux qui utilisent la compression de données ou les moteurs de recherche utilisent des algorithmes. Un algorithme permet de faire un choix dans un problème qui lui est présenté, et plus l\'algorithme est puissant, plus le choix est rapide et bon.\r\nLe but de ce livre est d\'expliquer comment fonctionnent les algorithmes et comment on peut les tester et les mettre en oeuvre. Vous verrez également comment modéliser un problème de façon à ce qu\'il puisse être résolu par un ordinateur. Les algortihmes sont également la pièce maitresses des systèmes de Big Data.\r\nCe livre s\'adresse à toux ceux, étudiants, managers ouanalystes de données qui ont besoin des algorithmes dans la gestion des données qu\'ils manipulent.', 4900, 2, 'Algorithmique.jpg'),
(7, 'Merise  ', 'bernard', 'Merise (modélisation des données et des traitements, manipulations avec le langage SQL, conception d\'une application mobile) Ce livre sur la méthode Merise s\'adresse tout particulièrement aux étudiants en premier cycle d\'informatique, aux étudiants en école de gestion et à toute personne souhaitant une information simple, directe et pratique sur la méthode Merise et le langage SQL. Au travers des chapitres sur la méthode Merise, vous découvrirez comment : . Réaliser les différents modèles (modèles conceptuels, modèles logiques, modèles physiques) mais aussi les modèles spécifiques aux traitements (modèles conceptuels des traitements, modèles organisationnels des traitements...). . Modéliser avec les extensions Merise/2. . Comparer certains modèles Merise à certains diagrammes UML. Dans un chapitre dédié, le langage SQL est présenté de façon progressive et est illustré par de nombreux exemples. Vous y apprendrez à : . Manipuler, filtrer, trier, regrouper les données. . Créer, modifier, supprimer des tables. . Affecter ou enlever des droits à certains utilisateurs. L\'auteur n\'a volontairement gardé que le côté concret de la méthode Merise et du langage SQL, pour permettre au lecteur une immersion immédiate. Il propose également de nombreux exercices dont une étude de cas détaillée et guidée pour faciliter cette assimilation. Cette nouvelle édition du livre s\'enrichit d\'un chapitre vous offrant la possibilité de mettre en pratique les notions étudiées à travers la conception et le développement d\'une application mobile avec WINDEV Mobile.', 5007, 1, 'merise.jpg'),
(8, 'Bases De Données    ', 'C.J.Date', 'Cet ouvrage s\'adresse aux étudiants des premiers cycles en informatique ainsi qu\'à tous ceux qui désirent s\'initier à la discipline des bases de données. Les parcours de lecture préconisés par l\'auteur permettront à chacun d\'évoluer en fonction de ses besoins. L\'ouvrage est constitué de trois parties qui s\'enchaînent de manière rationnelle : pour maîtriser les bases de données il faut d\'abord en comprendre les concepts, puis il faut apprendre à les utiliser avant de savoir les construire. La première partie décrit les concepts fondamentaux des bases de données : structures de données, modèle relationnel et normalisation, technologie et SGBD. La deuxième partie décrit les différents aspects du langage SQL, depuis les formes et fonctions élémentaires jusqu\'aux fonctions avancées du modèle relationnel objet et de la programmation d\'applications. La troisième partie décrit les techniques et les méthodes de construction de bases de données relationnelles et relationnelles objet. On y trouve également une introduction à la rétro-ingénierie des bases de données. Ces chapitres et leurs annexes comportent plus de 300 exercices résolus, la plupart accompagnés de leurs corrigés, et des études de cas. Les chapitres se clôturent le plus souvent par une synthèse (Que retenir ?), par des pistes d\'approfondissement et un état de l\'art (Pour en savoir plus).', 5500, 1, 'BD.jpg'),
(16, 'Arabe Grand imagier Petits ate    ', 'Mathieu Guidère', 'Conforme au niveau de langue A1 du cadre européen (CECRL), cet imagierthématiqued’arabe a pour objectif de permettre à tout apprenant de : découvrir et d’apprendre plus facilement les mots de baseindispensables de la vie courante ; prononcer correctement chaque mot ; mémoriser le vocabulaire à son rythme et de façon ludique.Il comprend :*  430 mots de base illustrés, regroupés en 44 planches d’images thématiques*  90 activités corrigées*  8 jeux ou petits ateliers à découper et à réaliser tout seul*  fichiers audio à...', 900, 9, 'AR.jpg'),
(19, 'Les 5 portes   ', 'Fabrice Midal', 'Le bonheur de faireLe bonheur de voir clairLe bonheur d\'être en relationLe bonheur d\'être combléLe bonheur d\'être en paixCes 5 bonheurs sont les 5 portes qui te montrent le chemin de la vraie spiritualité.À l\'aide d\'un test, découvre ta porte principale : elle est la puissance qui te guide vers le bonheur. À travers des exercices et des rituels, apprivoise ces portes pour surmonter tous les défis de la vie.Plus qu\'un livre, une méthode initiatique.Avec son talent habituel, Bernard Gabay nous transmet les enseignements...', 5000, 11, 'Les-5-portes.jpg'),
(23, 'Réseaux informatique ', 'Yann Bardot, José Dordoigne', 'Ces deux livres offrent au lecteur un maximum d’informations sur les fondamentaux des réseaux informatiques et la maintenance et le dépannage de PC dans un environnement réseau. 1330 pages par nos experts.\r\n\r\nUn livre de la collection Ressources Informatiques\r\nRéseaux informatiques - Notions fondamentales (8e édition) - (Protocoles, Architectures, Réseaux sans fil, Virtualisation, Sécurité, IPv6...)\r\n\r\nExtrait du résumé : Ce livre sur les réseaux s\'adresse aussi bien aux personnes désireuses de comprendre les réseaux informatiques et les systèmes d\'exploitation, qu\'aux informaticiens plus expérimentés souhaitant renforcer et mettre à jour leurs connaissances…\r\n\r\nUn livre de la collection Ressources Informatiques\r\nMaintenance et dépannage d\'un PC en réseau (7e édition)\r\n\r\nExtrait du résumé : L\'objectif de ce livre est de vous permettre de maîtriser la maintenance et le dépannage de PC équipés du système d\'exploitation Microsoft Windows 10 (version 1909 ou antérieures), dans un environnement réseau et d\'acquérir ainsi toutes les connaissances nécessaires pour devenir le correspondant micro de votre entreprise…', 7000, 13, '232321.jpg'),
(26, 'Mon cahier ardoise', 'Nathan', 'Ecriture Math exploration du monde.Un cahier ardoise pour apprendre en s\'amusant en moyenne section, avec T\'choupi, le héros préféré des petits.\r\nCe cahier ardoise favorise favoriser un entraînement progressif fondé sur la répétition du geste. L\'enfant peut s\'entraîner autant de fois qu\'il le souhaite\r\nAvec ce nouveau format confortable pour écrire, votre enfant peu réviser toutes les matières de la maternelle : graphisme, maths, exploration du monde.\r\n\r\nLe contenu riche avec des illustrations affectives pour les enfant de moyenne section, dès 4 ans.\r\n\r\n', 2000, 14, '981060.jpg'),
(27, 'Mathématiques appliquées - ECG 1re et 2e années - Nouveaux programmes', 'Hervé Gras, Christian Leboeuf, Xavier Merlin', 'MéthodiX est la collection de référence d’ouvrages à l’usage des élèves de collège, lycée, des étudiants de licence et des classes préparatoires. Cet outil unique en son genre vous permettra de préparer efficacement vos examens ou les concours selon les cas… Chaque ouvrage de la collection contient :\r\n\r\ntoutes les méthodes essentielles sur un sujet donné,\r\nles astuces à connaître et les erreurs à éviter,\r\ndes conseils pour préparer les contrôles du jour J,\r\nles exercices incontournables et les corrigés détaillés.', 33000, 15, '535576.jpg'),
(28, 'Cours d\'hébreu biblique', 'Dany Pegon', 'L’hébreu se trouve à la croisée des civilisations orientale et occidentale. Langue du Tanach, du Premier Testament, il a profondément marqué notre culture. Mais son univers reste trop souvent clos, d’autant que la structure sémitique de la langue en rend l’accès difficile au lecteur français. Le Cours d’hébreu biblique offre une approche progressive de ce monde à la fois surprenant et fascinant. Né d’une expérience approfondie dans l’enseignement de cette langue dans un contexte francophone, ce cours est résolument pragmatique. À travers l’apprentissage de l’écriture, de la morphologie et de la syntaxe hébraïques, ce manuel permet à l’étudiant d’acquérir toutes les connaissances nécessaires pour lire le texte biblique dans l’original.', 7000, 10, 'lb.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryId`),
  ADD UNIQUE KEY `Parentcategoryid` (`Parentcategoryid`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientId`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`CommandeId`),
  ADD KEY `ClientId` (`ClientId`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`UserId`);

--
-- Index pour la table `loginm`
--
ALTER TABLE `loginm`
  ADD PRIMARY KEY (`MemberId`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ClientId` (`ClientId`),
  ADD KEY `ProductId` (`ProductId`);

--
-- Index pour la table `products_commandes`
--
ALTER TABLE `products_commandes`
  ADD PRIMARY KEY (`IdCle`),
  ADD KEY `ProduitCommande` (`ProduitCommande`),
  ADD KEY `CommandeId` (`CommandeId`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`ProductId`),
  ADD KEY `CategoryId` (`CategoryId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `CommandeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `loginm`
--
ALTER TABLE `loginm`
  MODIFY `MemberId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `products_commandes`
--
ALTER TABLE `products_commandes`
  MODIFY `IdCle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `ProductId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`ClientId`) REFERENCES `client` (`ClientId`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`ClientId`) REFERENCES `client` (`ClientId`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`ProductId`) REFERENCES `produits` (`ProductId`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`CategoryId`) REFERENCES `category` (`CategoryId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
