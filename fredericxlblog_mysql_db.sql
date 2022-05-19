-- phpMyAdmin SQL Dump
-- version OVH
-- https://www.phpmyadmin.net/
--
-- Hôte : fredericxlblog.mysql.db
-- Généré le : mer. 18 mai 2022 à 12:14
-- Version du serveur : 5.6.50-log
-- Version de PHP : 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fredericxlblog`
--
CREATE DATABASE IF NOT EXISTS `fredericxlblog` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fredericxlblog`;

-- --------------------------------------------------------

--
-- Structure de la table `app_web`
--

CREATE TABLE `app_web` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `app_web`
--

INSERT INTO `app_web` (`id`, `name`, `slug`, `url`, `date_creation`, `description`, `image`, `resume`) VALUES
(1, 'calculatrice', 'calculatrice', 'calculatrice', '2019-01-23', '<p>codée en jquery, premier essai, calculatrice simple. Les opérations, lorsqu\'elles sont tapées, et affichées au fur et a mesure dans l\'écran, sont un simple texte. L\'appuie sur une touche de la calculatrice (hors \"=\" et \"AC\") ne fait qu\'ajouter un caractère au texte. Lors de l\'appuie sur la touche \"AC\", le texte est transformé en \"0\".</p><p>Lors de l\'appuie sur \"=\", le texte est parcouru de gauche à droite, chaque fois qu\'une opération prioritaire est trouvée (* / ou %), le terme de gauche (le sous-ensemble paranthèsé, ou le nombre) est précédé d\'une paranthèse, et le terme de droit est suivi d\'une paranthèse.</p><p>Puis le texte est de nouveau parcourus de gauche à droite. Chaque fois qu\'un nombre est complètement parcouru, il est sauvé sous forme numérique. Chaque fois qu\'une opération est trouvée (* / % - +), elle est appliqué sur le terme à sa gauche et celui à sa droite (aussi sauvé sous forme numérique), et le résultat devient le nouveau terme de gauche lorsque la lecture est poursuivie vers la droite.</p><p>Le traitement des sous-ensembles parenthésés rappelle la fonction de calcul de manière récursive. Cette application web utilise donc les fonctions récursives.</p>', '/imagesApps/calculatrice.jpg', 'première version de calculatrice toute simple, en guise de première application web, pour m\'exercer.'),
(3, 'dessin', 'dessin', 'dessin', '2019-01-25', 'dessin à partir d\'une palette de 12 couleurs, suivant un cadrillage.', '/imagesApps/dessin.jpg', 'appli de dessin très simple et primaire, pour m\'exercer.');

-- --------------------------------------------------------

--
-- Structure de la table `app_web_competence_app_web`
--

CREATE TABLE `app_web_competence_app_web` (
  `app_web_id` int(11) NOT NULL,
  `competence_app_web_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_dessin`
--

CREATE TABLE `categorie_dessin` (
  `id` int(11) NOT NULL,
  `representant_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_dessin`
--

INSERT INTO `categorie_dessin` (`id`, `representant_id`, `name`, `slug`) VALUES
(21, 169, 'portrait', 'portrait'),
(22, 171, 'célébrité', 'celebrite'),
(23, 171, 'stylo', 'stylo'),
(24, 170, 'croquis', 'croquis'),
(25, 171, 'detaillé', 'detaille'),
(32, 206, 'feutre', 'feutre');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_dessin_dessin`
--

CREATE TABLE `categorie_dessin_dessin` (
  `categorie_dessin_id` int(11) NOT NULL,
  `dessin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_dessin_dessin`
--

INSERT INTO `categorie_dessin_dessin` (`categorie_dessin_id`, `dessin_id`) VALUES
(21, 169),
(21, 170),
(21, 171),
(22, 171),
(23, 169),
(23, 170),
(23, 171),
(24, 169),
(24, 170),
(24, 206),
(25, 171),
(32, 206);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `compo_id` int(11) DEFAULT NULL,
  `drawing_id` int(11) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `texte_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `discriminator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `author_id`, `compo_id`, `drawing_id`, `photo_id`, `texte_id`, `created_at`, `content`, `discriminator`) VALUES
(1, 1, NULL, 169, NULL, NULL, '2019-06-13 00:00:00', 'commentaire ajouté via BDD avec inheritance mapping', 'commentdrawing'),
(2, 1, NULL, 169, NULL, NULL, '2019-06-14 01:11:27', 'un test', 'commentdrawing'),
(3, 1, NULL, 169, NULL, NULL, '2019-06-14 01:37:52', 'p</p><h1>h1</h1>', 'commentdrawing'),
(4, 2, NULL, 169, NULL, NULL, '2019-06-14 19:07:30', 'commentaire via form dans page', 'commentdrawing'),
(5, 2, NULL, 169, NULL, NULL, '2019-06-14 19:07:49', 'second commentaire pour être sur', 'commentdrawing'),
(6, 2, NULL, 169, NULL, NULL, '2019-06-14 19:12:50', 'second commentaire pour être sur', 'commentdrawing'),
(7, 2, NULL, 169, NULL, NULL, '2019-06-14 19:13:01', 'troisième, test', 'commentdrawing'),
(8, 2, NULL, 169, NULL, NULL, '2019-06-14 19:14:59', 'quatirème', 'commentdrawing'),
(9, 2, NULL, 169, NULL, NULL, '2019-06-14 19:15:59', '5', 'commentdrawing'),
(10, 2, NULL, 169, NULL, NULL, '2019-06-14 19:18:32', '5', 'commentdrawing'),
(11, 2, NULL, 169, NULL, NULL, '2019-06-14 19:18:37', '6', 'commentdrawing'),
(12, 1, 6, NULL, NULL, NULL, '2019-06-19 11:49:34', 'test', 'commentcompo'),
(13, 1, 6, NULL, NULL, NULL, '2019-06-19 11:50:35', 'test', 'commentcompo'),
(14, 1, 6, NULL, NULL, NULL, '2019-06-19 11:50:44', 'test 2', 'commentcompo'),
(15, 1, NULL, NULL, NULL, 1, '2019-06-19 11:51:44', 'test', 'commenttexte'),
(16, 1, NULL, NULL, NULL, 1, '2019-06-19 11:51:51', 'testttt', 'commenttexte'),
(17, 1, NULL, NULL, 1, NULL, '2019-06-19 11:52:15', 'mekzjfe', 'commentphoto'),
(18, 1, NULL, NULL, 1, NULL, '2019-06-19 11:52:21', 'ypjony', 'commentphoto'),
(19, 6, NULL, 169, NULL, NULL, '2019-06-20 23:38:06', 'autre commentaire, directement sur site distant', 'commentdrawing'),
(20, 3, NULL, 169, NULL, NULL, '2019-06-21 14:04:46', 'test après https', 'commentdrawing');

-- --------------------------------------------------------

--
-- Structure de la table `competence_app_web`
--

CREATE TABLE `competence_app_web` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `compos`
--

CREATE TABLE `compos` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` longtext COLLATE utf8mb4_unicode_ci,
  `date_creation` date DEFAULT NULL,
  `date_publication` date NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `compos`
--

INSERT INTO `compos` (`id`, `url`, `name`, `slug`, `caption`, `date_creation`, `date_publication`, `image`, `display`) VALUES
(6, '/compos/2p1.mp3', 'ataraxie - partie 1', 'ataraxie-partie-1', 'Seconde composition que j\'ai faite, avec le logiciel \"dance ejay 7\". Première des compositions que j\'ai conservées. Elle est basée, comme la plupart de mes vieilles compositions, sur une mélodie entendue lors d\'un rêve. Sa composition était faite dans un état d\'ataraxie, un sentiment de plénitude et de quiétude intense, non semblable à la joie, sans rapport avec le rire ou l\'amusement, mais en rapport avec un bien être relatif à la sensation de voir enfin sa vie suivre un chemin plaisant et passionnant, et d\'être enfin pleinement soit-même. Cette sensation nait du bien-être ressentit lors de l\'apogée de ma phase créatrice, le fait de créer, d\'inventer, d\'imaginer... Et surtout en terme de musique, me procurant grande satisfaction. Je l\'ai composée (ainsi que la majorité des autres) un été paisible qui a été synonyme de curiosité et de créativité. Je l\'ai composée au milieu d\'inventions et de créations de schémas de graphiques et de scenarii d\'un jeu vidéo, et de lectures sur la cosmologie. Cette musique est divisée en 4 parties, dont voici la première. Cette division est due à la limitation à 2 minutes de la version gratuite du logiciel dance ejay 7 que je possédais à l\'époque. Les 4 parties de la composition sont donc à écouter les unes à la suite des autres. Je n\'ai fait qu\'une légende pour l\'intégralité des 4 parties. Note : l\'ataraxie de cette musique est parfois entrecoupée par de brutaux et brefs changements d\'atmosphères, vers quelque chose de plus inquiétant, sombre et étrange. Je ne me l\'explique pas vraiment : je me laisse aller lorsque je compose, mes émotions guident ma composition, je suis presque plus spectateur de ma composition qu\'acteur lorsque je compose. Je saurais seulement dire que ces phases sont les manifestations de brutaux changements émotionnels que j\'ai ressentis lors de la composition, et qui se sont aussitôt dissipés. Je n\'ai pas réellement décidé de composer ces sifflements étranges, je les ai juste entendus dans ma tête lorsque mes émotions se sont brusquement modifiées, avant de réentendre aussi sec la mélodie calme. J\'ai alors composé ce que j\'entendais sans réfléchir.', '2005-07-01', '2019-01-23', '/imagesCompos/leverTerre.jpg', 0),
(7, '/compos/2p2.mp3', 'ataraxie - partie 2', 'ataraxie-partie-2', 'cf ataraxie - partie 1', '2005-07-01', '2019-01-23', '/imagesCompos/leverTerre.jpg', 0),
(8, '/compos/2p3.mp3', 'ataraxie - partie 3', 'ataraxie-partie-3', 'cf ataraxie - partie 1', '2005-07-01', '2019-01-23', '/imagesCompos/leverTerre.jpg', 0),
(9, '/compos/2p4.mp3', 'ataraxie - partie 4', 'ataraxie-partie-4', 'cf ataraxie - partie 1', '2005-07-01', '2019-01-23', '/imagesCompos/leverTerre.jpg', 0),
(10, '/compos/7.mp3', 'détaché du réel', 'detache-du-reel', 'composée à partir d\'une mélodie entendue dans un rêve où une silouhette floue, indiscernable et grise, se tenait debout a côté de mon lit. Ce rêve et cette mélodie était accompagnés d\'un sentiment étrange de détachement du réel, aussi fascinant et beau que triste et inquiétant.', '2004-08-01', '2019-06-12', '/imagesCompos/flou.jpg', 0),
(11, '/compos/8.mp3', 'rêve inquiétant', 'reve-inquietant', NULL, '2014-08-01', '2019-06-12', '/imagesCompos/flou.jpg', 0),
(12, '/compos/14.mp3', 'enthousiasme / fascination / aube', 'enthousiasme-fascination-aube', NULL, '2004-08-01', '2019-06-12', '/imagesCompos/aube.jpg', 0),
(13, '/compos/10.mp3', 'anxiété', 'anxiete', NULL, '2005-11-01', '2019-06-12', '/imagesCompos/flou.jpg', 0),
(14, '/compos/16.mp3', 'épris', 'epris', NULL, '2006-01-01', '2019-06-12', '/imagesCompos/chienetloup.jpg', 1),
(15, '/compos/19v2.mp3', 'folie', 'folie', NULL, '2006-01-01', '2019-06-12', '/imagesCompos/flou.jpg', 1),
(16, '/compos/21v12.mp3', 'fin', 'fin', NULL, '2006-01-01', '2019-06-12', '/imagesCompos/flou.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `dessin`
--

CREATE TABLE `dessin` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` longtext COLLATE utf8mb4_unicode_ci,
  `date_creation` date DEFAULT NULL,
  `date_publication` datetime NOT NULL,
  `display` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `dessin`
--

INSERT INTO `dessin` (`id`, `url`, `nom`, `slug`, `caption`, `date_creation`, `date_publication`, `display`) VALUES
(169, '/dessins/adel.jpg', 'profil', 'profil', 'portrait de modèle vivant au stylo', '2013-01-01', '2019-01-10 20:06:59', NULL),
(170, '/dessins/anaellePhoto.jpg', 'portrait miroir appareil photo', 'portrait-miroir-appareil-photo', 'portrait via photo, selfie dans un miroir avec appareil photo réflèxe', '2012-01-01', '2019-01-10 20:06:59', NULL),
(171, '/dessins/bronson.jpg', 'charles bronson', 'charles-bronson', 'Charles Bronson, dans \"il était une fois dans l\'ouest\", jouant de l\'harmonica', '2012-01-01', '2019-01-10 20:06:59', NULL),
(172, '/dessins/camille.jpg', 'femme fourrure', 'femme-fourrure', 'portrait au stylo', '2011-01-01', '2019-01-22 14:37:26', NULL),
(177, '/dessins/chaire.jpg', 'chaire', 'chaire', 'légende', '2013-01-01', '2019-01-22 15:30:48', NULL),
(181, '/dessins/chat.jpg', 'chat', 'chat', 'aucune légende n\'a été rédigée', '2017-01-01', '2019-01-22 15:40:58', NULL),
(182, '/dessins/doom3.jpg', 'doom3', 'doom3', NULL, '2005-01-01', '2019-01-22 16:06:13', NULL),
(185, '/dessins/fox.jpg', 'fox', 'fox', 'dessin inachevé au stylo', '2008-01-01', '2019-01-28 23:02:48', NULL),
(186, '/dessins/gaelle.jpg', 'femme en robe', 'femme-en-robe', 'portrait au stylo', '2013-01-01', '2019-01-28 23:05:40', NULL),
(187, '/dessins/giulioJulie.jpg', 'un verre dans un bar', 'un-verre-dans-un-bar', 'deux personnes qui boivent un verre dans un bar', '2013-01-01', '2019-01-30 21:19:19', NULL),
(188, '/dessins/grosTasQuiTire.jpg', 'ennemi de doom 3', 'ennemi-de-doom-3', 'un ennemi de doom 3 qui tire des boules de feu avec ses bras', '2008-01-01', '2019-01-30 21:24:21', NULL),
(189, '/dessins/issues.jpg', 'peluche issues korn', 'peluche-issues-korn', 'pochette de l\'album issues de korn, peluche abandonnée, au stylo.', '2008-01-01', '2019-01-30 21:28:31', NULL),
(190, '/dessins/issuesPastel.jpg', 'issues pastel', 'issues-pastel', 'pochette de l\'album issues de korn, au pastel. Version personnalisée, en écoutant les phases \"étranges\" de \"wake up\". J\'ai voulu y retranscrire la sensation qu\'on a en écoutant ces phases de quelques secondes, qui donnent l\'impression d\'être effleuré par la folie, la sensation d\'une chose glacée qui nous frôle et nous amplie, ce moment d\'angoisse passager qui serre la gorge, glace le sang et fait dresser les cheveux sur la tête.', '2008-01-01', '2019-01-30 21:44:53', NULL),
(192, '/dessins/joeyJordinson.jpg', 'joey jordinson', 'joey-jordinson', 'batteur de slipknot : joey jordinson.', '2005-01-01', '2019-01-30 22:22:57', NULL),
(193, '/dessins/lion.jpg', 'lion', 'lion', NULL, NULL, '0000-00-00 00:00:00', NULL),
(194, '/dessins/lostSoulDoom3.jpg', 'lost soul doom3', 'lostSoulDoom3', NULL, NULL, '0000-00-00 00:00:00', NULL),
(195, '/dessins/mickThompson.jpg', 'mick Thompson', 'mickThompson', NULL, NULL, '0000-00-00 00:00:00', NULL),
(196, '/dessins/oeil.jpg', 'oeil', 'oeil', NULL, NULL, '0000-00-00 00:00:00', NULL),
(197, '/dessins/plongee.jpg', 'plongee', 'plongee', NULL, NULL, '0000-00-00 00:00:00', NULL),
(198, '/dessins/racaud.jpg', 'fille allongée', 'fille-allongee', NULL, NULL, '0000-00-00 00:00:00', NULL),
(199, '/dessins/scarlett.jpg', 'visage', 'visage', NULL, NULL, '0000-00-00 00:00:00', NULL),
(206, '/dessins/severac.jpg', 'piano', 'piano', 'piano au feutre bleu dans un salon', '2019-04-05', '2019-06-12 11:41:28', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`) VALUES
('20190105200622'),
('20190105212403'),
('20190122154949'),
('20190123091143'),
('20190123103230'),
('20190123112504'),
('20190123133311'),
('20190123180130'),
('20190125134607'),
('20190125150013'),
('20190201123648'),
('20190611145110'),
('20190612165058'),
('20190612214150'),
('20190612221813'),
('20190613183404'),
('20190619150239'),
('20190622123147'),
('20190622124351'),
('20190622125705');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` longtext COLLATE utf8mb4_unicode_ci,
  `date_creation` datetime DEFAULT NULL,
  `date_publication` datetime DEFAULT NULL,
  `display` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id`, `url`, `name`, `slug`, `caption`, `date_creation`, `date_publication`, `display`) VALUES
(1, '/photos/bueges.jpg', 'bueges', 'bueges', NULL, '2019-06-04 00:00:00', '2019-06-11 00:00:00', NULL),
(3, '/photos/nenuphars.jpg', 'nenuphars', 'nenuphars', NULL, '2019-06-08 00:00:00', '2019-06-11 00:00:00', NULL),
(4, '/photos/refletArbres.jpg', 'reflet d\'arbres', 'reflet-d-arbres', NULL, '2019-06-08 00:00:00', '2019-06-11 00:00:00', NULL),
(5, '/photos/refletEglise.jpg', 'reflets d\'une église', 'reflet-eglise', NULL, '2019-06-08 00:00:00', '2019-06-11 00:00:00', NULL),
(7, '/photos/voute.jpg', 'voute', 'voute', 'voute', '2019-03-01 00:00:00', '2019-06-12 13:56:39', NULL),
(8, '/photos/branches.jpg', 'branches', 'branches', 'branches', '2019-02-01 00:00:00', '2019-06-22 00:00:00', NULL),
(9, '/photos/coucher.jpg', 'coucher', 'coucher', 'coucher de soleil', '2019-03-20 00:00:00', '2019-06-22 00:00:00', NULL),
(10, '/photos/refletsArgent.jpg', 'refletsArgent', 'refletsArgent', 'reflets argentés', '2019-03-20 00:00:00', '2019-06-22 00:00:00', NULL),
(11, '/photos/refletsAuvergne.jpg', 'refletsAuvergne', 'refletsAuvergne', 'refletsAuvergne', '2019-03-20 00:00:00', '2019-06-22 00:00:00', NULL),
(12, '/photos/sapins.jpg', 'sapins', 'sapins', 'sapins', '2019-03-20 00:00:00', '2019-06-22 00:00:00', NULL),
(13, '/photos/murChateau.jpg', 'murChateau', 'murChateau', 'murChateau', '2019-03-20 00:00:00', '2019-06-22 00:00:00', NULL),
(14, '/photos/eiffel.jpg', 'eiffel', 'eiffel', NULL, '2019-02-01 00:00:00', '2019-06-22 13:57:52', NULL),
(15, '/photos/marais.jpg', 'arais.', 'arais', NULL, '2019-02-01 00:00:00', '2019-06-22 13:58:25', NULL),
(16, '/photos/ombresChinoises.jpg', 'ombresChinoises', 'ombreschinoises', NULL, '2019-03-01 00:00:00', '2019-06-22 13:59:08', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `drawing_id` int(11) NOT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `texte_id` int(11) DEFAULT NULL,
  `compo_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `value` int(11) NOT NULL,
  `discriminator` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'ROLE_ADMIN');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

CREATE TABLE `texte` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resume` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `date_publication` date NOT NULL,
  `display` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `texte`
--

INSERT INTO `texte` (`id`, `name`, `slug`, `contenu`, `image`, `resume`, `date_creation`, `date_publication`, `display`) VALUES
(1, 'ouverture', 'ouverture', '<p>Chère Lillia.</p><p>C\'est sous l\'emprise de la solitude, du remord et de la crainte que je t\'écris aujourd\'hui. La crainte que tu ne me pardonne pas. La crainte que tu ne me crois pas. La crainte que tu refuse de me revoir tout simplement. Mon stylo tremble, et peine à glisser correctement sur le papier. Crois le ou non : ces mots, c\'est sur la table de ta chambre que je te les écris. Cette lourde table en noyer massif, que viennent, à leur habitude, caresser quelques rayons de soleil mal filtrés par tes vieux rideaux blancs. Cette vieille pièce est en parfaite harmonie avec mon état d\'esprit actuel : sombre et silencieuse, mais pourtant pleine d\'objets, de marques et de traces de toutes sortes. Les traces d\'une ancienne vie, d\'une histoire, d\'activités, de mouvements et sentiments divers, venant se mêler en une cacophonie muette et figée qui semble peu à peu s\'éteindre et s\'estomper comme un vieux souvenir.</p><p>Cette pièce m\'est totalement famillière. J\'en connais les moindres recoins, les moindres tiroirs, ainsi que le fonctionnement et l\'histoire de chaque objet qui vient la peupler. Pour la simple et bonne raison que cette chambre, ta chambre ! eut été nôtre il fut un temps. Car enfin, si ta porte sera toujours fermée à clé avant que tu n\'entres, que tu ne lise ces lignes, c\'est parce que la clé qui permet de l\'ouvrir se trouve dans ma poche et s\'y est toujours trouvée.</p><p>Oui, tu l\'auras compris, c\'est bien moi : Franck. Non, ce n\'est pas une blague. Si je n\'espère pas que tu me crois immédiatement, j\'espère seulement que le doute et l\'espoir, si tu en ressens encore à mon égard, te permettront de lire ce qui suit. Le temps ayant rendu les souvenirs flous, simplistes et grossiers, les ayant interprétés et déformés à sa guise, j\'ai décidé de laisser parler l\'ensemble des poèmes, lettres, extraits de journal intime et textes en tout genre, que j\'ai pu écrire ces dernières années. En plus de t\'expliquer la raison de ma longue abscence et de mon retour, ils te retraceront notre rencontre et notre histoire mieux que je ne l\'aurais fait à l\'heure actuelle. Parsemés de détails dont nous seuls avons connaissance, ils se chargeront de te prouver la véracité de mon discours.</p><p>L\'homme que tu as un jour aimé.</p>', '/imagesTextes/vieuxBureau.jpg', 'introduction d\'un roman de science fiction', '2008-01-01', '2019-01-01', 0),
(2, 'la coquille', 'la-coquille', '<p>Comme tous les jours à cette heure ci, le soleil épanche par l\'ouverture béante ses doux et chaleureux rayons sur la faune et la flore scolaire, abreuvant goulûment les piaillements, gloussements et mouvements foisonnants et désorganisés. Cette fourmilière, où règnent abondance et variété, est emplie de couleurs vives en tout genre, qui happent le regard et percent l\'oeil, le pénétrant en profondeur pour imprégner l\'âme. Les sons fluctuant de bouches à oreilles, les gestes saisissant la vue, les regards marquant l\'âme, sont tant de lianes fermement tissées entre les individus. Ces dernières forment une toile, support de riches échanges, dans laquelle éclosent par endroit des idées, pour s\'épandre de branche en branche, et peu à peu se modifier, se personnaliser, se subdiviser. Elles constituent ainsi une marre éparse et diversifiée, mais pourtant unie, porteuse d\'une nature commune et personnelle, permettant de l\'identifier, de la distinguer de son environnement par des limites floues et volatiles. Cette marrée humaine est tantôt conditionnée par la houle d\'une émotion, le flux d\'une pensée, l\'écume d\'une agitation, le ressac d\'une contradiction, évoluant en un équilibre instable, pouvant rapidement décliner vers la tempête, ou s\'apaiser en une eau calme et douce.</p><p>Cependant, bien que cette clairière regorge de vie, d\'animations et de couleurs, notre esprit fatigué, s\'abandonnant à son bourdonnement et son agitation joviale, se laissant tranquillement porter par le courant, s\'enivrant de ses senteurs, ne parvient pas à y trouver repos.</p>', '/imagesTextes/clairière.jpg', 'petit début de texte avorté', '2012-01-01', '2019-01-23', 0),
(5, 'pas encore nommé', 'pas-encore-nomme', '<p>Verano pose son regard autour de lui. Un sol d\'un blanc calcaire, sableux, dans lequel se mêlent quelques petits cailloux tout aussi éclatants. Il pose le pied sur l\'un deux, qui s\'effrite sans résistance, comme un petit grumeaux de sable mouillé. Autour de lui, un paysage invariable, plat, à perte de vue. La blancheur éblouissante du sol contraste avec la noirceur apaisante du ciel. Verano plonge dans ses pensés : « Comme c\'est étrange... Les semelles contre le sol, la tête directement dans le vide. » il regarde une étoile, aussi terne que les autres, et essaie de prendre la mesure de l\'immensité de l\'espace qui les séparent. Un espace infini dans lequel ce lointain soleil, d\'une taille incommonsurable, semble aussi gros qu\'une tête d\'épingle. Entre ces étoiles et sa peau, rien. Du « rien » à perte de vue. Un espace vide dans lequel des mondes bulles, parfois inertes, parfois foisonnants de vie, flottent en silence.<br />\r\n<br />\r\n« Verano ! … Verano ! » une voix raisonne autour de lui. Le sol devient flou, des couleurs viennent se mêler au noir du ciel. Des herbes lui chatouillent les mollets, il s\'affaisse sous son propre poids.<br />\r\n- Moi qui me sentais si léger...<br />\r\nVerano soupire. Rien ne l\'apaise et ne le fascine autant que de quitter notre échelle pour toucher du doigt un petit fragment de l\'immensité de l\'univers.<br />\r\n- Aller, il est temps de redescendre. Je sais que tu n\'es pas du matin mais tu vas être en retard !<br />\r\n- J\'arrive.<br />\r\nVerano jette un dernier coup d\'oeil sur la lune, encore à moitié plongée dans la nuit. De l\'autre côté, les premières rougeurs font leur apparition. Une fine pellicule rougeâtre, rapidement dégradée en jaune, argenté, et bleu foncé, avant de se mêler au noir de la nuit. L\'aube approche.<br />\r\n<br />\r\nAprès une préparation sommaire, il part sur les chemins forestiers. Le jour s\'est levé. Il fait plutôt doux, mais l\'humidité transpire des denses feuillages verts et de la terre noire, imbibée par les récentes pluies. Verano, abrité par les arbres à la silhouette élancée, observe leur cime s\'agiter au vent. Les plus hautes feuilles, baignées dans la chaude lumière orangée du soleil rasant, émettent un bruissement agréable a l\'oreille. Le ciel est dégagé, bleu et lumineux, l\'été arrive.<br />\r\n<br />\r\n20 minutes de marche, le temps d\'émerger. Le voilà arrivé dans une clairière. Ses nouveaux élèves l\'attendent, debout dans les hautes herbes grasses et pleines de rosée. La plupart d\'entre eux sont timides, mais tous semblent enthousiastes.<br />\r\n<br />\r\n\"Nous allons commencer la journée debout, et la finir assis. Le but de votre premier cours : construire votre future salle de classe.\"</p>', '/imagesTextes/clairière.jpg', 'pas encore écrit', '2019-06-22', '2019-06-24', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `hash`, `picture`, `slug`, `email`) VALUES
(1, 'login', '$2y$13$gthy2tvSMNndUvw5.c3C8usaQFGqsiviyUeGYIJaj7j3jbllZtWrq', NULL, 'login', 'fred.malard@wanadoo.fr'),
(2, 'admin', '$2y$13$QvfGK7//BYpkrGEukzGx6er1sen9PDOjrV98dE9vlGYn1wdojolz6', NULL, 'admin', 'fred.malard@gmx.fr'),
(3, 'test', '$2y$13$2Yjqyg83.vy1ShLPE0wJH.99ptCX5s9T3S6S2LjbaGs99NVrdJnje', NULL, 'test', 'fred.malard@wanadoo.fr'),
(4, 'untest', '$2y$13$TgrgUuayGh4BLJR.WFNtqehkufihoD42jboTUVeieumTDno.IgVtm', NULL, 'untest', 'e@b.fr'),
(5, 'testConfirm', '$2y$13$9tLiPX3YRlATTqMxInIPsemHlgj2anekDrOM1L80mCLSsbAdrYlza', NULL, 'testconfirm', 'e@b.fr'),
(6, 'frederic', '$2y$13$J2Ffw/rdQHhxMgFUtAeFke0kMpZVoFcESGopacyvGL324habUiyfi', NULL, 'frederic', 'fred.malard@wanadoo.fr');

-- --------------------------------------------------------

--
-- Structure de la table `web_site`
--

CREATE TABLE `web_site` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `app_web`
--
ALTER TABLE `app_web`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `app_web_competence_app_web`
--
ALTER TABLE `app_web_competence_app_web`
  ADD PRIMARY KEY (`app_web_id`,`competence_app_web_id`),
  ADD KEY `IDX_553114FF1B1B2ACD` (`app_web_id`),
  ADD KEY `IDX_553114FF359B923A` (`competence_app_web_id`);

--
-- Index pour la table `categorie_dessin`
--
ALTER TABLE `categorie_dessin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C45BFB216C4A52F0` (`representant_id`);

--
-- Index pour la table `categorie_dessin_dessin`
--
ALTER TABLE `categorie_dessin_dessin`
  ADD PRIMARY KEY (`categorie_dessin_id`,`dessin_id`),
  ADD KEY `IDX_1B3DEAE2543F5929` (`categorie_dessin_id`),
  ADD KEY `IDX_1B3DEAE2F960562E` (`dessin_id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9474526CF675F31B` (`author_id`),
  ADD KEY `IDX_9474526CF1454301` (`compo_id`),
  ADD KEY `IDX_9474526CE6552D89` (`drawing_id`),
  ADD KEY `IDX_9474526C7E9E4C8C` (`photo_id`),
  ADD KEY `IDX_9474526CEA6DF1F1` (`texte_id`);

--
-- Index pour la table `competence_app_web`
--
ALTER TABLE `competence_app_web`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `compos`
--
ALTER TABLE `compos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dessin`
--
ALTER TABLE `dessin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D8892622F675F31B` (`author_id`),
  ADD KEY `IDX_D8892622E6552D89` (`drawing_id`),
  ADD KEY `IDX_D88926227E9E4C8C` (`photo_id`),
  ADD KEY `IDX_D8892622EA6DF1F1` (`texte_id`),
  ADD KEY `IDX_D8892622F1454301` (`compo_id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `IDX_332CA4DDD60322AC` (`role_id`),
  ADD KEY `IDX_332CA4DDA76ED395` (`user_id`);

--
-- Index pour la table `texte`
--
ALTER TABLE `texte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `web_site`
--
ALTER TABLE `web_site`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `app_web`
--
ALTER TABLE `app_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categorie_dessin`
--
ALTER TABLE `categorie_dessin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `competence_app_web`
--
ALTER TABLE `competence_app_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `compos`
--
ALTER TABLE `compos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `dessin`
--
ALTER TABLE `dessin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `texte`
--
ALTER TABLE `texte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `web_site`
--
ALTER TABLE `web_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `app_web_competence_app_web`
--
ALTER TABLE `app_web_competence_app_web`
  ADD CONSTRAINT `FK_553114FF1B1B2ACD` FOREIGN KEY (`app_web_id`) REFERENCES `app_web` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_553114FF359B923A` FOREIGN KEY (`competence_app_web_id`) REFERENCES `competence_app_web` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `categorie_dessin`
--
ALTER TABLE `categorie_dessin`
  ADD CONSTRAINT `FK_C45BFB216C4A52F0` FOREIGN KEY (`representant_id`) REFERENCES `dessin` (`id`);

--
-- Contraintes pour la table `categorie_dessin_dessin`
--
ALTER TABLE `categorie_dessin_dessin`
  ADD CONSTRAINT `FK_1B3DEAE2543F5929` FOREIGN KEY (`categorie_dessin_id`) REFERENCES `categorie_dessin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1B3DEAE2F960562E` FOREIGN KEY (`dessin_id`) REFERENCES `dessin` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C7E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`),
  ADD CONSTRAINT `FK_9474526CE6552D89` FOREIGN KEY (`drawing_id`) REFERENCES `dessin` (`id`),
  ADD CONSTRAINT `FK_9474526CEA6DF1F1` FOREIGN KEY (`texte_id`) REFERENCES `texte` (`id`),
  ADD CONSTRAINT `FK_9474526CF1454301` FOREIGN KEY (`compo_id`) REFERENCES `compos` (`id`),
  ADD CONSTRAINT `FK_9474526CF675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `FK_D88926227E9E4C8C` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`),
  ADD CONSTRAINT `FK_D8892622E6552D89` FOREIGN KEY (`drawing_id`) REFERENCES `dessin` (`id`),
  ADD CONSTRAINT `FK_D8892622EA6DF1F1` FOREIGN KEY (`texte_id`) REFERENCES `texte` (`id`),
  ADD CONSTRAINT `FK_D8892622F1454301` FOREIGN KEY (`compo_id`) REFERENCES `compos` (`id`),
  ADD CONSTRAINT `FK_D8892622F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `FK_332CA4DDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_332CA4DDD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
