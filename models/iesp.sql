-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 09 fév. 2022 à 08:17
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `iesp`
--

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `identite` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `compteId` int(11) NOT NULL,
  `niveauId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `identite`, `active`, `compteId`, `niveauId`) VALUES
(1, 'Nardy A', 0, 2, 2),
(2, 'Nardy A', 1, 2, 2),
(3, 'Emmanuela 1', 1, 5, 2),
(4, 'Marc', 1, 7, 2),
(5, 'Gisele 3', 1, 6, 2),
(6, 'Medard', 1, 8, 3),
(7, 'Julien', 1, 9, 4),
(8, 'Emmanuel Direction', 1, 11, 4);

-- --------------------------------------------------------

--
-- Structure de la table `ajustefeedback`
--

CREATE TABLE `ajustefeedback` (
  `id` int(11) NOT NULL,
  `dateHeureEnreg` datetime NOT NULL,
  `agentId` int(11) NOT NULL,
  `feedbackId` int(11) NOT NULL,
  `donneeId` int(11) NOT NULL,
  `niveauId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ajustefeedback`
--

INSERT INTO `ajustefeedback` (`id`, `dateHeureEnreg`, `agentId`, `feedbackId`, `donneeId`, `niveauId`) VALUES
(1, '2022-01-25 08:27:55', 2, 1, 41, 2),
(5, '2022-01-25 11:50:39', 7, 2, 50, 2),
(6, '2022-01-25 13:32:34', 7, 3, 59, 2),
(7, '2022-01-26 07:55:28', 7, 4, 67, 4),
(9, '2022-01-26 12:15:18', 7, 6, 90, 2),
(10, '2022-01-26 12:34:07', 7, 7, 94, 3),
(11, '2022-01-27 11:04:30', 8, 8, 110, 2),
(14, '2022-01-31 13:53:05', 8, 9, 144, 2),
(15, '2022-02-02 17:45:54', 8, 11, 154, 2),
(16, '2022-02-07 12:33:38', 8, 12, 166, 2);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id` int(11) NOT NULL,
  `dateEnreg` datetime NOT NULL,
  `identite` varchar(200) NOT NULL,
  `email` varchar(240) NOT NULL,
  `nomUtilisateur` varchar(200) NOT NULL,
  `motDePasse` varchar(200) NOT NULL,
  `typeCompte` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `dateEnreg`, `identite`, `email`, `nomUtilisateur`, `motDePasse`, `typeCompte`, `active`) VALUES
(1, '2021-09-25 00:00:00', 'Christelle K', 'rifinashuza.kuderha@gmail.com', '6bb31a15585b16d35a17ec8975245ae1f43a432d', '6bb31a15585b16d35a17ec8975245ae1f43a432d', 'Call-Center Agent', 1),
(2, '2021-09-25 00:00:00', 'Nardy', 'rifin.kuderha@gmail.com', '39f2b7cf9fdcb69eb810ae400d51ec8d967bb6e9', '39f2b7cf9fdcb69eb810ae400d51ec8d967bb6e9', 'Call-Center Agent', 1),
(3, '2021-09-25 00:00:00', 'esther', 'rifinashuza.kuderha@gmail.com', 'cfc9be49b53afecb4090a384ac6c4c0a51a2cbf2', 'cfc9be49b53afecb4090a384ac6c4c0a51a2cbf2', 'Partner', 1),
(4, '2021-09-25 00:00:00', 'Amina', 'rifinashuza.kuderha@gmail.com', '5b34d8ef2b15327d9819788c89a4c6f7661651d7', '5b34d8ef2b15327d9819788c89a4c6f7661651d7', 'admin', 1),
(5, '2022-01-25 09:19:00', 'Emmanuella', 'emmanuelantabala2@gmail.com', 'efdb8f7f2fe9c47e34dfe1fb7c491d0638ec2d86', 'efdb8f7f2fe9c47e34dfe1fb7c491d0638ec2d86', 'Call-Center Agent', 1),
(6, '2022-01-25 09:20:00', 'Gisele', 'giselekas13@gmail.com', '563ad8e28f7b4b9238731695b5703a52f24c9ce1', '563ad8e28f7b4b9238731695b5703a52f24c9ce1', 'Call-Center Agent', 1),
(7, '2022-01-25 09:21:00', 'Marc', 'mutulwatambwe205@gmail.com', 'd33c80bc45d65303e33ca83108a9952b745af9ef', 'd33c80bc45d65303e33ca83108a9952b745af9ef', 'Call-Center Agent', 1),
(8, '2022-01-25 09:21:00', 'Medard', 'rifin.ashuza@iescongo.com', 'c3975e311e9a87b91563e4fcc06018d54e2758d5', 'c3975e311e9a87b91563e4fcc06018d54e2758d5', 'Call-Center Agent', 1),
(9, '2022-01-25 09:22:00', 'Julien', 'amin.julien@gmail.com', '5c682c2d1ec4073e277f9ba9f4bdf07e5794dabe', '5c682c2d1ec4073e277f9ba9f4bdf07e5794dabe', 'Call-Center Agent', 1),
(10, '2022-01-25 10:15:00', 'POTA Agent', 'rifinashuza.kuderha@gmail.com', '4d778f53588f74418e9a833a65e3c45c3bb61d2a', '4d778f53588f74418e9a833a65e3c45c3bb61d2a', 'Partner', 1),
(11, '2022-01-27 08:19:00', 'Emmanuel', 'shadrack.mulekya@iescongo.com', 'bd234ba4276433f0e5fc7a8fa2d18274fa711567', 'bd234ba4276433f0e5fc7a8fa2d18274fa711567', 'Call-Center Agent', 1),
(12, '2022-01-27 08:25:00', 'POTA2', 'rifin.kuderha@gmail.com', 'da45e305b82d6854d44b00572ca298f3fde40d58', 'da45e305b82d6854d44b00572ca298f3fde40d58', 'Partner', 1),
(13, '2022-01-27 09:07:00', 'PAM Agent 1', 'ashuza.kuderha@ucbukavu.ac.cd', 'bd5ce5fdaa0afbc20f82707e9543a688450bcb12', 'bd5ce5fdaa0afbc20f82707e9543a688450bcb12', 'Partner', 1);

-- --------------------------------------------------------

--
-- Structure de la table `donnee`
--

CREATE TABLE `donnee` (
  `id` int(11) NOT NULL,
  `valeur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `donnee`
--

INSERT INTO `donnee` (`id`, `valeur`) VALUES
(1, 'Accident de circulation impliquant un chauffeur de ZOA'),
(2, 'Accident de circulation impliquant un chauffeur de ZOA'),
(3, 'Corruption du chef du village'),
(4, 'Abus sexuelle par un agent'),
(5, 'Corruption'),
(6, 'Corruption d\'un recenseur de ZOA'),
(7, 'Corruption d\'un recenseur de ZOA'),
(8, 'Corruption d\'un recenseur de ZOA'),
(9, 'Corruption d\'un recenseur de ZOA'),
(10, 'Corruption d\'un recenseur de ZOA'),
(11, 'Corruption d\'un recenseur de ZOA'),
(12, 'Corruption d\'un recenseur de ZOA'),
(13, 'Corruption'),
(14, 'Corruption'),
(15, 'Abus sexuelle par un agent'),
(16, 'Abus sexuelle par un agent'),
(17, 'Abus sexuelle par un agent'),
(18, 'Abus sexuelle par un agent'),
(19, 'Abus sexuelle par un agent'),
(20, 'Detournement des vivres par les agents du CRS'),
(21, 'Detournement des vivres par les agents du CRS'),
(22, 'Detournement des vivres par les agents du CRS'),
(23, 'Detournement des vivres par les agents du CRS'),
(24, 'Detournement des vivres par les agents du CRS'),
(25, 'Detournement des vivres par les agents du CRS'),
(26, 'Detournement des vivres par les agents du CRS'),
(27, 'Detournement des vivres par les agents du CRS'),
(28, 'Corruption par um'),
(29, 'Detournement de plusieurs kilos de riz'),
(30, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires'),
(31, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(32, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(33, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(34, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(35, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(36, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(37, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(38, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(39, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(40, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(41, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires et autres personnes'),
(42, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires'),
(43, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires'),
(44, 'C\'est un presume detournement. Les vivres ont ete bien distribues aux beneficiaires'),
(45, 'Corruption des agents de Caritas'),
(46, 'Corruption des agents de Caritas et agents de l\'etat'),
(47, 'Corruption des agents de Caritas et agents de l\'etat par la population'),
(48, 'Corruption des agents de Caritas et agents de l\'etat par la population dans tous les villages'),
(49, 'Zero corruption'),
(50, 'Zero corruption dans les projets de CARITAS'),
(51, 'Trois filles ont ete violees par les rebelles'),
(52, 'Trois filles violees et leurs maisons brulees'),
(53, 'Zero viole. Juste des incendies des maisons'),
(54, 'Attaque des rebelles a Cirunga par les rebelles. Certaines sources disent qu\'il y\'a eu violences sexuelles et incendies'),
(55, 'Attaques par des soldats assimiles aux FARDC'),
(56, 'Attaque des rebelles a Cirunga par les rebelles. Certaines sources disent qu\'il y\'a eu violences sexuelles et incendies. Ce qui est frappant ce que une source anonyme affirme que ces sont les FARDC'),
(57, 'Attaque des rebelles a Cirunga par les rebelles. Certaines sources disent qu\'il y\'a eu violences sexuelles et incendies. Ce qui est frappant ce que une source anonyme affirme que ces sont les FARDC'),
(58, 'Nous devons donc retires nos agents dans la zone. Dites a l\'appelant que nous sommes entrain de preparer l\'aide humanitaire pour soigner les filles violes la semaine prochaine. Dites leurs pret pour la reception des kits'),
(59, 'Nous devons donc retires nos agents dans la zone. Dites a l\'appelant que nous sommes entrain de preparer l\'aide humanitaire pour soigner les filles violes la semaine prochaine. Dites leurs pret pour la reception des kits et medicaments'),
(60, 'Corruption des agents de l\'Etat par le personnel de Caritas'),
(61, 'Corruption en repetition'),
(62, 'Corruption des agents de l\'Etat par le personnel de Caritas'),
(63, 'Corruption en repetition des agents de l\'Etat par le personnel de Caritas'),
(64, 'Corruption en repetition des agents de l\'Etat par le personnel de Caritas. Cas aussi de tribalisme'),
(65, 'Corruption en repetition des agents de l\'Etat par le personnel de Caritas. Cas aussi de tribalisme et nepotisme.'),
(66, 'Peuvent-ils decrire les personnes impliquees'),
(67, 'Peuvent-ils decrire les personnes impliquees dans le detournement?'),
(68, 'Un agent de Caritas attrapé dans un hôtel avec une petite fille'),
(69, 'Un agent de Caritas attrapé dans un hôtel avec une petite fille  et les gens veulent le brulé vif'),
(70, 'un véhicule de  l\'organisation  JOHUNNITER vient d\'être braquer  à sake'),
(71, 'Détournement des camions de vivre des habitants de Kavumu par les agents de PAM entre le lundi 17/01/2022 et le jeudi 20/01/2022'),
(72, 'faux'),
(73, 'Détournement des camions de vivre des habitants de Kavumu par les agents de PAM entre le lundi 17/01/2022 et le jeudi 20/01/2022'),
(74, 'Attaque des rebelles MAIMAI Kabido à Masisi centre. Kidnapping de 4 agents de Caritas, tuerie d\'un agent de Caritas, vole des biens des  agents, incendies des véhicules de Caritas.'),
(75, 'En effet,  un svéhicule de l\'organisation JOHUNNITER vient de se produire sur la route  sake à 4 kilomètres du bureau du groupement et deux agents viennent d\'être kidnapper par ce même groupe d\'assaillants militaires'),
(76, 'Grève de la population du territoire de Masisi. Pas de kidnaping, incendie de 2 véhicules Caritas, 3 agents de Caritas blessés.'),
(77, 'Attaque des rebelles MAIMAI Kabido à Masisi centre. Kidnapping de 4 agents de Caritas, tuerie d\'un agent de Caritas, vole des biens des  agents, incendies des véhicules de Caritas.'),
(78, 'Oui, c\'était un agent de Caritas que nous avons attrapé avec une petite fille. La population voulait le bruler vif sans être au courant de la réalité. Heureusement que la fille nous a révélé que l\'homme en question c\'est son oncle et c\'est sa mère qui l\'a envoyé le voir. Le chef de quartier par chance avait le numéro de la maman et nous l\'avons contacter et a affirmé'),
(79, 'un véhicule de  l\'organisation  JOHUNNITER vient d\'être braquer   sur la route sake à 4 kilomètre du bureau du groupement et deux agents viennent d\'être kidnappés par le même groupe d\'assaillant militaire'),
(80, 'Un agent de Caritas attrapé dans un hôtel avec une petite fille  et les gens veulent le brulé vif, nous dit un monsieur de Bunia. Par ailleurs une autorité nous confirme que c\'était une erreur et que l\'homme a été relâcher parce que la fille c\'est sa nièce.'),
(81, 'l\'infromation est confirmée par le chef Bula'),
(82, 'FAUSSE ALERTE'),
(83, 'un véhicule de  l\'organisation  JOHANNITER vient d\'être braquer   sur la route sake à 4 kilomètre du bureau du groupement et deux agents viennent d\'être kidnappés par le même groupe Armé'),
(84, 'Est ce que nous pouvons avoir les identites de ces agens? Est ce que le lieu d\'origine de ces assaillants et connu? Leurs destinations?'),
(85, 'il  faudrait peut etre renseigner l\' appartenance du groupe armé'),
(86, 'Détournement des camions de vivre des habitants de Kavumu par les agents de PAM entre le lundi 17/01/2022 et le jeudi 20/01/2022'),
(87, 'Non. Par contre, après  verification avec le commandant de la place, il confirme avoir arreté un presumé detourneur. Donc nous devons attendre .  A notre niveau nous essayons de fouiller encore'),
(88, 'Détournement des camions de vivre des habitants de Kavumu par les agents de PAM entre le lundi 17/01/2022 et le jeudi 20/01/2022'),
(89, 'Il s\'agit de combien de camion? Ces dernieres etaient stationnees ou?'),
(90, 'Il s\'agit de combien de camion? Ces dernieres etaient stationnees ou?'),
(91, 'après notre interaction avec le gérant      de l\'hôtel, il confirme avoir protégé  l\'agent dans un endroit sûr'),
(92, 'Un agent de Caritas attrapé dans un hôtel avec une petite fille  et les gens veulent le brulé vif, nous dit un monsieur de Bunia. Par ailleurs une autorité nous confirme que c\'était une erreur et que l\'homme a été relâcher parce que la fille c\'est sa nièce.'),
(93, 'Comme c\'est sa niece, nous lui demanderons nous meme de fournir les pieces d\'identite de sa niece. Dites a l\'informateur de toujours nous signaler ces genres de cas'),
(94, '#PIR 1: priere d\'instruire le call center de demander la carte d\'identité\r\n#PIR 2: Conacter le bureau de World vison a Bunia pour préparer le retour dl\'Agent à Goma\r\n\r\nDites a l\'informateur de toujours nous signaler ces genres de cas'),
(95, 'Une corruption par les chefs de Mubumbano à Walungu avec les agents de PAM.   \r\nUn habitant  nous renseigne qu\'ils n\'ont pas reçu les sacs de farine comme prévu. Les agents ont promis 200sacs mais ont reçu que 100.'),
(96, 'Une pluie  torrentielle attaque les champs de ZOA à KAMBA aujourd\'hui le 27/01/2022 à 3h du matin. Suite à cette pluie le champs de Kakamba nécessite une irrigation urgente pour sauver les produits champêtres. Selon la source, seulement un agent hydraulique de ZOA répondant au nom de BAFU NGEMBAKA est sur terrain et manque quoi faire devant cette situation.'),
(97, 'un champ de 1ha a été ravager par des criquets et toutes les cultures sont détruites'),
(98, 'Affirmatif, la pluie torrentielle attaque 3 champs de ZOA dans le village de KAKAMBA aujourd\'hui le 27/01/2022 depuis 3h du matin.  Un champs est déjà détruit et deux autres tentent de céder si une intervention d\'irrigation n\'arrive pas d\'ici peu. Telle est l\'affirmation du TDR du RUZIZI KAMANYOLA, Mr Alain.'),
(99, 'Une pluie  torrentielle attaque les champs de ZOA à KAMBA aujourd\'hui le 27/01/2022 à 3h du matin. Suite à cette pluie le champs de Kakamba nécessite une irrigation urgente pour sauver les produits champêtres. Selon la source, seulement un agent hydraulique de ZOA répondant au nom de BAFU NGEMBAKA est sur terrain et manque quoi faire devant cette situation.'),
(100, 'Le chef quant à lui nous relate que les agents avaient promis 100sacs mais ce sont les villageois qui avaient mal compris l\'information à cause de l\'un d\'eux qui avait mis en place une mauvaise information et qui a été propagé aux autres. Pour la vérification de ce fait, nous aurons besoin de contacter aussi un agent de PAM'),
(101, 'Une corruption par les chefs de Mubumbano à Walungu avec les agents de PAM.   \r\nUn habitant  nous renseigne qu\'ils n\'ont pas reçu les sacs de farine comme prévu. Les agents ont promis 200sacs mais ont reçu que 100.'),
(102, 'Corruption de denrée alimentaire distribué par PAM par le chef du village de Mubumbano'),
(103, 'Une corruption par les chefs de Mubumbano à Walungu avec les agents de PAM.   \r\nUn habitant  nous renseigne qu\'ils n\'ont pas reçu les sacs de farine comme prévu. Les agents ont promis 200sacs mais ont reçu que 100.'),
(104, 'Une pluie  torrentielle attaque les champs de ZOA à KAMBA aujourd\'hui le 27/01/2022 à 3h du matin. Suite à cette pluie le champs de Kakamba nécessite une irrigation urgente pour sauver les produits champêtres. Selon la source, seulement un agent hydraulique de ZOA répondant au nom de BAFU NGEMBAKA est sur terrain et manque quoi faire devant cette situation.'),
(105, 'Un champ  d\'1ha de l\'organisation CRS a été attaqué par des criquets à MUSUSU après une forte pluie de deux jours et ont détruit presque toute les cultures. L\'agronome JEAN MARIE en charge du  champ est en déplacement à MUDAKA. Peut on avoir une suggestion pour y remédier à note niveau en attendant l\'arrivé de l\'Agronome?'),
(106, 'un champ de 1ha a été ravager par des criquets et toutes les cultures sont détruites. On peut avoir une suggestion pour y poster solution à notre niveau en attendant votre intervention?'),
(107, 'faux'),
(108, 'Une corruption par les chefs de Mubumbano à Walungu avec les agents de PAM.   \r\nUn habitant  nous renseigne qu\'ils n\'ont pas reçu les sacs de farine comme prévu. Les agents ont promis 200sacs mais ont reçu que 100.'),
(109, 'ok nous tacherons de corriger ça prochainement , l\'agent sera interpellé et subira des actions disciplinaires.'),
(110, 'ok nous tacherons de corriger ça prochainement , l\'agent sera interpellé et subira des actions disciplinaires.'),
(111, 'La Corruption \r\n     Il y aurait une corruption du chef de village xxxx de Masisi. les agents de POTA ont reçu les pots de vin de main du chef du dit village. Les habitant se plaignent de ne pas avoir reçu les denrées alimentaires comme était prévu par l\'organisation. Au lieu de 4sacs de farine de Mais, 20L d\'huile d\'arachide,10kg de sucre et 6box de sel promis, Ils disent avoir reçu que 2sacs de farine de Mais, 20L d\'huile d\'arachide, 5kg de sucre et 3box de sel la moitié de ce qui a été prévu pour eux.'),
(112, 'Après une conversation avec le commanda du village XXX, celui-ci nous confirme le fait en disant que la population n\'a pas eu ce qui était promis par la POTA. 2sacs de farine, 20L d\'huile, 5kg de sucre et 3box de sel ce ce qu\'a reçu chacun d\'eux'),
(113, 'La Corruption \r\n     Il y aurait une corruption du chef de village xxxx de Masisi. les agents de POTA ont reçu les pots de vin de main du chef du dit village. Les habitant se plaignent de ne pas avoir reçu les denrées alimentaires comme était prévu par l\'organisation. Au lieu de 4sacs de farine de Mais, 20L d\'huile d\'arachide,10kg de sucre et 6box de sel promis, Ils disent avoir reçu que 2sacs de farine de Mais, 20L d\'huile d\'arachide, 5kg de sucre et 3box de sel la moitié de ce qui a été prévu pour eux.'),
(114, 'Corruption\r\n\r\n Il semblerais qu\'une équipe des trois agents de POTA dont agent X, Y, Z auraient réussi les pots de vin de la part du chef de village XXXX nommé Mr X, afin de détourner une partie denrées alimentaires prévue comme assistance des habitants de son village.'),
(115, 'La Corruption \r\n     Il y aurait une corruption du chef de village xxxx de Masisi. les agents de POTA ont reçu les pots de vin de main du chef du dit village. Les habitant se plaignent de ne pas avoir reçu les denrées alimentaires comme était prévu par l\'organisation. Au lieu de 4sacs de farine de Mais, 20L d\'huile d\'arachide,10kg de sucre et 6box de sel promis, Ils disent avoir reçu que 2sacs de farine de Mais, 20L d\'huile d\'arachide, 5kg de sucre et 3box de sel la moitié de ce qui a été prévu pour eux.'),
(116, 'La Corruption Il y aurait une corruption du chef de village xxxx de Masisi. les agents de POTA ont reçu les pots de vin de main du chef du dit village. Les habitant se plaignent de ne pas avoir reçu les denrées alimentaires comme était prévu par l\'organisation. Au lieu de 4sacs de farine de Mais, 20L d\'huile d\'arachide,10kg de sucre et 6box de sel promis, Ils disent avoir reçu que 2sacs de farine de Mais, 20L d\'huile d\'arachide, 5kg de sucre et 3box de sel la moitié de ce qui a été prévu pour eux.  L chef XXX a été intercepter entrain de vendre un lot d\'environ 10 sac à un commerçant du village'),
(117, 'La Corruption Il y aurait une corruption du chef de village xxxx de Masisi. les agents de POTA ont reçu les pots de vin de main du chef du dit village. Les habitant se plaignent de ne pas avoir reçu les denrées alimentaires comme était prévu par l\'organisation. Au lieu de 4sacs de farine de Mais, 20L d\'huile d\'arachide,10kg de sucre et 6box de sel promis, Ils disent avoir reçu que 2sacs de farine de Mais, 20L d\'huile d\'arachide, 5kg de sucre et 3box de sel la moitié de ce qui a été prévu pour eux.  L chef XXX a été intercepter entrain de vendre un lot d\'environ 10 sacs à un commerçant du village'),
(118, 'l\'abbé confirme'),
(119, 'Kalehe'),
(120, 'Kalehe'),
(121, 'Kalehe'),
(122, 'Kalehe'),
(123, 'Kalehe'),
(124, 'Kalehe'),
(125, 'Kalehe'),
(126, 'Kalehe'),
(127, 'Kalehe'),
(128, 'Kalehe'),
(129, 'Kalehe'),
(130, 'Kalehe'),
(131, 'Kalehe'),
(132, 'Kalehe'),
(133, 'Kalehe'),
(134, 'Viol de 2 Filles a Kalehe par des agents de PATO le dimanche 30 Janv 2022 entre 13h et 14h. Je continue avec les triangulation pour affirmer les faits.'),
(135, 'Viol de 2 Filles a Kalehe par des agents de PATO le dimanche 30 Janv 2022 entre 13h et 14h. Je continue avec les triangulation pour affirmer les faits.'),
(136, 'Viol de 2 Filles a Kalehe par des agents de PATO le dimanche 30 Janv 2022 entre 13h et 14h. Je continue avec les triangulation pour affirmer les faits. Nous vennons d\'etre informe que les agents sont aux arrets. Le chef de la police aimerait entre entrer en contact avec vous. Nous aimerons avoir votre feedback pour savoir quoi lui repondre.'),
(137, 'Viol de 2 Filles a Kalehe par des agents de PATO le dimanche 30 Janv 2022 entre 13h et 14h. Je continue avec les triangulation pour affirmer les faits. Nous sommes informes que les presumes sont a l\'arret a la police. Le chef de la police locale demande l\'avis de PATO concernant la procedure a appliquer.'),
(138, 'Viol de 2 Filles a Kalehe par des agents de PATO le dimanche 30 Janv 2022 entre 13h et 14h. Je continue avec les triangulation pour affirmer les faits. Nous sommes informes que les presumes sont a l\'arret a la police. Le chef de la police locale demande l\'avis de PATO concernant la procedure a appliquer.'),
(139, 'Viol de 2 Filles a Kalehe par des agents de PATO le dimanche 30 Janv 2022 entre 13h et 14h. Je continue avec les triangulation pour affirmer les faits. Nous sommes informes que les presumes sont a l\'arret a la police. Le chef de la police locale demande l\'avis de PATO concernant la procedure a appliquer.'),
(140, 'Vous dire dire au responsable de la police que nous envoyons une delegation sur place'),
(141, 'Vous dire dire au responsable de la police que nous envoyons une delegation sur place'),
(142, 'Vous dire dire au responsable de la police que nous envoyons une delegation sur place.'),
(143, 'Vous dire dire au responsable de la police que nous envoyons une delegation sur place.'),
(144, 'Vous dire dire au responsable de la police que nous envoyons une delegation sur place.'),
(145, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes'),
(146, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes'),
(147, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes'),
(148, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes'),
(149, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes'),
(150, 'Attaque de plusieurs  vehicule de l\'organisation'),
(151, 'Attaque de plusieurs  vehicule de l\'organisation'),
(152, 'Attaque de plusieurs  vehicule de l\'organisation. Nous avons besoin de votre orientation concernant les blesses'),
(153, 'Comminiquez a la communqute d\'envoyer rapidement nos chauffeurs'),
(154, 'Comminiquez a la communqute d\'envoyer rapidement nos chauffeurs. Et nous signaler quels sont les hopitaux choisis'),
(155, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes'),
(156, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes'),
(157, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes dans l\'attaque.'),
(158, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes dans l\'attaque.'),
(159, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes dans l\'attaque.'),
(160, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes dans l\'attaque.'),
(161, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes dans l\'attaque. Les personnes impliquees ne sont pas encore identifiees.'),
(162, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes dans l\'attaque. Les personnes impliquees ne sont pas encore identifiees. Nous poursuivons avec les triangulations. Nous avons besoin de votre réponse concernant l\'urgence de prendre en charge les blessés.'),
(163, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes dans l\'attaque. Les personnes impliquees ne sont pas encore identifiees.'),
(164, 'un accident signaler a Kabare. Deux presumes chauffeurs de  POTA decedes dans l\'attaque. Les personnes impliquees ne sont pas encore identifiees.'),
(165, 'Ils peuvent transporter les blessés à l\'hopital'),
(166, 'Ils peuvent transporter les blessés à l\'hopital'),
(167, 'Besoin de connaitre la date de la prochaine distribution des vivres'),
(168, 'Quelques personnes mécontentes veulent avoir d\'autres Kits');

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `dateHeureEnreg` datetime NOT NULL,
  `soumissionId` int(11) NOT NULL,
  `donneeId` int(11) NOT NULL,
  `pointfocalId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `feedback`
--

INSERT INTO `feedback` (`id`, `dateHeureEnreg`, `soumissionId`, `donneeId`, `pointfocalId`) VALUES
(1, '2022-01-25 04:44:44', 1, 30, 2),
(2, '2022-01-25 11:09:09', 2, 49, 3),
(3, '2022-01-25 13:30:44', 3, 58, 3),
(4, '2022-01-26 05:01:14', 4, 66, 3),
(5, '2022-01-26 11:56:44', 5, 84, 3),
(6, '2022-01-26 12:13:03', 6, 89, 3),
(7, '2022-01-26 12:27:31', 7, 93, 3),
(8, '2022-01-27 11:03:38', 7, 109, 3),
(9, '2022-01-31 13:07:54', 12, 140, 5),
(10, '2022-01-31 13:09:20', 12, 141, 5),
(11, '2022-02-02 17:43:38', 13, 153, 5),
(12, '2022-02-07 12:31:03', 16, 165, 5);

-- --------------------------------------------------------

--
-- Structure de la table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `dateEvent` date NOT NULL,
  `heure` time NOT NULL,
  `lieu` varchar(200) NOT NULL,
  `sourceId` int(11) NOT NULL,
  `donneeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `information`
--

INSERT INTO `information` (`id`, `dateEvent`, `heure`, `lieu`, `sourceId`, `donneeId`) VALUES
(1, '2022-01-21', '03:00:00', 'Masisi', 1, 1),
(2, '2022-01-21', '03:00:00', 'Masisi', 2, 2),
(3, '2022-01-21', '09:00:00', 'Miti', 3, 3),
(4, '2022-01-21', '03:30:00', 'Kalehe Centre', 4, 4),
(5, '2022-01-21', '06:00:00', 'Burhinyi', 5, 5),
(6, '2022-01-21', '06:30:00', 'Burhinyi Center', 5, 6),
(7, '2022-01-22', '06:00:00', 'Burhinyi Center', 5, 7),
(8, '2022-01-22', '06:00:00', 'Burhinyi Center', 5, 8),
(9, '2022-01-22', '06:00:00', 'Burhinyi Center', 5, 9),
(10, '2022-01-22', '06:00:00', 'Burhinyi Center', 5, 10),
(11, '2022-01-22', '06:00:00', 'Burhinyi Center', 5, 11),
(12, '2022-01-22', '06:00:00', 'Burhinyi Center', 5, 12),
(13, '2022-01-24', '13:00:00', 'Mangina', 6, 20),
(14, '2022-01-24', '16:17:00', 'Mangina', 6, 29),
(15, '2022-01-25', '05:00:00', 'Mubumbano', 7, 45),
(16, '2022-01-25', '03:00:00', 'Cirunga', 8, 51),
(17, '2022-01-24', '00:00:00', 'Cirunga', 8, 52),
(18, '2022-01-24', '05:00:00', 'Cirunga Centre', 8, 53),
(19, '2022-01-25', '00:00:00', 'Cirungas centre', 8, 55),
(20, '2022-01-25', '07:00:00', 'Idjwi', 9, 60),
(21, '2022-01-25', '05:04:00', 'Idjwi Nord', 9, 61),
(22, '2022-01-26', '11:30:00', 'Bunia', 10, 68),
(23, '2022-01-26', '11:30:00', 'Bunia', 11, 69),
(24, '2022-01-26', '18:10:00', 'route sake', 12, 70),
(25, '2022-01-17', '09:03:00', 'KAVUMU', 13, 71),
(26, '2022-01-17', '10:15:00', 'KAVUMU CENTRE', 13, 72),
(27, '2022-01-26', '12:20:00', 'MASISI CENTRE', 14, 74),
(28, '2022-01-26', '17:30:00', 'route sake', 12, 75),
(29, '2022-01-26', '11:18:00', 'MASISI CENTRE', 14, 76),
(30, '2022-01-26', '11:00:00', 'Bunia', 11, 78),
(31, '2022-01-26', '12:24:00', 'Masisi', 11, 81),
(32, '2022-01-05', '14:22:00', 'KAVUMU', 13, 82),
(33, '2022-01-26', '13:06:00', 'Kavumu', 13, 87),
(34, '2022-01-26', '13:19:00', 'Bunia', 11, 91),
(35, '2022-01-27', '10:30:00', 'Walungu, Mubumbano', 15, 95),
(36, '2022-01-27', '03:24:00', 'KAKAMBA', 16, 96),
(37, '2022-01-25', '16:37:00', 'MUSUSU', 17, 97),
(38, '2022-01-27', '04:39:00', 'KAKAMBA', 16, 98),
(39, '2022-01-26', '10:30:00', 'Walungu, Mubumbano', 15, 100),
(40, '2022-01-27', '10:00:00', 'Walungu, Mubumbano', 18, 102),
(41, '2022-01-25', '17:24:00', 'MUSUSU', 17, 105),
(42, '2022-01-17', '10:30:00', 'Masisi', 19, 111),
(43, '2022-10-17', '11:00:00', 'Masisi', 19, 112),
(44, '2022-01-16', '09:42:00', 'Masisi village XXXX', 19, 114),
(45, '2022-01-18', '09:25:00', 'MUSUSU', 19, 116),
(46, '2022-01-04', '02:02:00', 'MASSISSI', 19, 118),
(47, '2022-01-31', '09:00:00', 'Kalehe', 20, 119),
(48, '2022-02-02', '08:00:00', 'Kabare', 21, 145),
(49, '2022-02-02', '18:00:00', 'Rutshuru', 22, 150),
(50, '2022-02-07', '05:20:00', 'Bunia', 23, 167),
(51, '2022-02-07', '06:00:00', 'Bunia', 23, 168);

-- --------------------------------------------------------

--
-- Structure de la table `keyinformant`
--

CREATE TABLE `keyinformant` (
  `id` int(11) NOT NULL,
  `identite` varchar(200) DEFAULT NULL,
  `contact` varchar(100) NOT NULL,
  `genre` char(1) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `profession` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `niveauId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `keyinformant`
--

INSERT INTO `keyinformant` (`id`, `identite`, `contact`, `genre`, `adresse`, `profession`, `active`, `niveauId`) VALUES
(1, '', '+243889999950', 'M', 'Nyangezi', 'Teacher', 1, 2),
(2, '', '+243894004049', 'F', 'Shabunda', 'Saller', 1, 2),
(3, 'Marc', '+243999004949', 'M', 'Kalehe Centre', 'Pastor', 1, 2),
(4, 'Chef MATATA', '+43553939393', 'M', 'Kavumu', 'Chief of Village', 1, 2),
(5, 'Chef BULA', '+6447843848', 'M', 'Bunia', 'Maire de la ville', 1, 2),
(6, 'Commanda AMULI', '+73747374744', 'M', 'MASISI-RUTSHURU', 'Military Officer', 1, 2),
(7, 'Chef MASUDI', '+277272993', 'M', 'Mubumbano', 'Chief of Village', 1, 2),
(8, 'Mr ALain', '+25353636636', 'M', 'Ruzizi Kamanyola', 'TDR', 1, 2),
(9, 'BADESIRE Alaine', '+536364646747', 'M', 'MUSUSU', 'Directrice Ecole Primaire MUSUSU', 1, 2),
(10, 'Abbe JULES', '+24399988899', 'M', 'Masisi', 'Curé de la paroisse de Masisi', 1, 2),
(11, 'Baogwere Julie', '+24394940404', 'F', 'Goma / Birere', 'Teacher', 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `levelNiveau` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `forValidation` varchar(5) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `niveau`
--

INSERT INTO `niveau` (`id`, `levelNiveau`, `designation`, `forValidation`, `active`) VALUES
(2, 1, 'Level 1', 'no', 1),
(3, 2, 'Level 2', 'no', 1),
(4, 3, 'Level 3', 'yes', 1);

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
--

CREATE TABLE `organisation` (
  `id` int(11) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `color` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `organisation`
--

INSERT INTO `organisation` (`id`, `designation`, `color`, `active`) VALUES
(1, 'CEAD', 'dodgerblue', 1),
(2, 'AMIDECON', 'red', 1),
(3, 'POTA', 'red', 1),
(4, 'KIVU AMKA', 'dodgerblue', 1);

-- --------------------------------------------------------

--
-- Structure de la table `pointfocal`
--

CREATE TABLE `pointfocal` (
  `id` int(11) NOT NULL,
  `identite` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `compteId` int(11) NOT NULL,
  `sensibiliteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pointfocal`
--

INSERT INTO `pointfocal` (`id`, `identite`, `active`, `compteId`, `sensibiliteId`) VALUES
(1, 'Nardy B', 0, 3, 3),
(2, 'Esther H', 1, 3, 2),
(3, 'Caritas Focal Point', 1, 10, 4),
(4, 'PAM Focal point', 1, 13, 6),
(5, 'Caritas 2', 1, 12, 5);

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `dateEnreg` date NOT NULL,
  `designation` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `organisationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`id`, `dateEnreg`, `designation`, `comment`, `active`, `organisationId`) VALUES
(1, '2022-01-20', 'Education pour tous', '', 1, 2),
(2, '2022-01-20', 'Women Capacity Strenthning', 'South-Kivu and North-kivu', 1, 1),
(3, '2022-01-25', 'Umoja ni nguvu', '', 1, 3),
(4, '2022-01-27', 'Food Distribution', '', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `rapportage`
--

CREATE TABLE `rapportage` (
  `id` int(11) NOT NULL,
  `dateHeureEnreg` varchar(30) NOT NULL,
  `subject` text NOT NULL DEFAULT 'Complaint',
  `informationId` int(11) NOT NULL,
  `agentId` int(11) NOT NULL,
  `projectId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rapportage`
--

INSERT INTO `rapportage` (`id`, `dateHeureEnreg`, `subject`, `informationId`, `agentId`, `projectId`) VALUES
(2, '2022-01-21 23:49:13', 'Complaint', 4, 2, 1),
(3, '2022-01-22 00:20:28', 'Complaint', 5, 2, 1),
(4, '2022-01-24 13:10:55', 'Complaint', 13, 2, 2),
(5, '2022-01-25 10:18:30', 'Complaint', 15, 3, 3),
(6, '2022-01-25 12:44:16', 'Complaint', 16, 3, 3),
(7, '2022-01-25 19:58:13', 'Complaint', 20, 3, 3),
(8, '2022-01-26 10:57:23', 'Complaint', 22, 3, 3),
(9, '2022-01-26 11:03:46', 'Complaint', 23, 3, 3),
(10, '2022-01-26 11:04:15', 'Complaint', 24, 5, 3),
(11, '2022-01-26 11:06:43', 'Complaint', 25, 4, 3),
(12, '2022-01-26 11:21:41', 'Complaint', 27, 4, 3),
(13, '2022-01-27 09:25:36', 'Complaint', 35, 3, 4),
(14, '2022-01-27 09:26:36', 'Complaint', 36, 4, 1),
(15, '2022-01-27 09:35:39', 'Complaint', 37, 5, 2),
(16, '2022-01-27 10:04:41', 'Complaint', 40, 3, 4),
(17, '2022-01-27 15:14:46', 'Complaint', 42, 3, 3),
(18, '2022-01-31 08:18:25', 'Abuse', 47, 3, 3),
(19, '2022-02-02 17:13:48', 'Accident on road', 48, 3, 3),
(20, '2022-02-02 17:34:52', 'Attaqeue d;un convoi', 49, 3, 3),
(21, '2022-02-07 19:39:12', 'Demande d\'information', 50, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `remonte`
--

CREATE TABLE `remonte` (
  `id` int(11) NOT NULL,
  `dateHeureEnreg` datetime NOT NULL,
  `emergency` varchar(3) NOT NULL DEFAULT 'no',
  `trust` varchar(9) NOT NULL DEFAULT 'Middle',
  `oldNiveauId` int(11) NOT NULL,
  `newNiveauId` int(11) NOT NULL,
  `agentId` int(11) NOT NULL,
  `rapportageId` int(11) NOT NULL,
  `donneeId` int(11) NOT NULL,
  `sensibiliteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `remonte`
--

INSERT INTO `remonte` (`id`, `dateHeureEnreg`, `emergency`, `trust`, `oldNiveauId`, `newNiveauId`, `agentId`, `rapportageId`, `donneeId`, `sensibiliteId`) VALUES
(3, '2022-01-24 10:16:19', 'no', 'Medium', 2, 3, 3, 2, 19, 1),
(4, '2022-01-24 13:11:03', 'no', 'Medium', 2, 3, 3, 4, 21, 1),
(5, '2022-01-24 15:16:02', 'no', 'Medium', 2, 3, 3, 3, 28, 1),
(6, '2022-01-25 10:19:01', 'no', 'Medium', 2, 3, 3, 5, 46, 1),
(7, '2022-01-25 10:40:09', 'no', 'Medium', 3, 4, 6, 5, 47, 1),
(8, '2022-01-25 12:57:51', 'no', 'Medium', 2, 3, 3, 6, 54, 1),
(9, '2022-01-25 13:04:23', 'no', 'Medium', 3, 4, 6, 6, 56, 1),
(11, '2022-01-26 03:29:28', 'yes', 'High', 2, 3, 3, 7, 63, 1),
(12, '2022-01-26 04:08:54', 'yes', 'Medium', 3, 4, 6, 7, 64, 1),
(13, '2022-01-26 11:12:41', 'no', 'Medium', 2, 3, 3, 11, 73, 1),
(14, '2022-01-26 11:30:06', 'no', 'Medium', 2, 4, 3, 12, 77, 1),
(15, '2022-01-26 11:37:35', 'yes', 'High', 2, 4, 3, 10, 79, 1),
(16, '2022-01-26 11:39:30', 'no', 'Medium', 2, 4, 3, 9, 80, 1),
(17, '2022-01-26 12:03:37', 'yes', 'High', 3, 4, 6, 11, 86, 1),
(20, '2022-01-27 10:12:04', 'no', 'Medium', 2, 3, 3, 13, 103, 1),
(21, '2022-01-27 10:16:51', 'yes', 'High', 2, 4, 3, 14, 104, 1),
(22, '2022-01-27 10:16:51', 'yes', 'High', 2, 3, 3, 14, 104, 1),
(23, '2022-01-27 10:24:41', 'yes', 'High', 2, 4, 3, 15, 106, 1),
(24, '2022-01-27 10:24:41', 'yes', 'High', 2, 3, 3, 15, 106, 1),
(25, '2022-01-27 10:26:18', 'yes', 'High', 4, 4, 0, 14, 107, 1),
(26, '2022-01-27 10:43:22', 'no', 'Medium', 3, 4, 6, 13, 108, 1),
(27, '2022-01-27 15:23:28', 'no', 'Medium', 2, 3, 3, 17, 113, 1),
(28, '2022-01-27 15:56:32', 'no', 'Medium', 3, 4, 6, 17, 115, 1),
(44, '2022-01-31 10:05:26', 'yes', 'Medium', 2, 4, 3, 18, 135, 1),
(49, '2022-02-02 17:36:22', 'yes', 'Medium', 2, 4, 3, 20, 151, 1),
(50, '2022-02-02 17:36:22', 'yes', 'Medium', 2, 3, 3, 20, 151, 1),
(54, '2022-02-04 15:55:26', 'yes', 'Medium', 2, 4, 3, 19, 158, 5),
(55, '2022-02-04 15:55:36', 'yes', 'Medium', 2, 3, 3, 19, 158, 5),
(56, '2022-02-04 15:56:42', 'yes', 'Medium', 2, 4, 3, 19, 159, 5),
(57, '2022-02-04 15:56:49', 'yes', 'Medium', 2, 3, 3, 19, 159, 5),
(58, '2022-02-04 15:58:02', 'yes', 'Medium', 2, 4, 3, 19, 160, 5),
(59, '2022-02-04 15:58:08', 'yes', 'Medium', 2, 3, 3, 19, 160, 5),
(60, '2022-02-07 07:51:21', 'yes', 'High', 3, 4, 6, 19, 161, 5),
(61, '2022-02-07 07:51:30', 'yes', 'High', 3, 4, 6, 19, 161, 5);

-- --------------------------------------------------------

--
-- Structure de la table `sensibilite`
--

CREATE TABLE `sensibilite` (
  `id` int(11) NOT NULL,
  `levelSensibilite` int(11) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `projectId` int(11) NOT NULL,
  `emergency` varchar(5) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sensibilite`
--

INSERT INTO `sensibilite` (`id`, `levelSensibilite`, `designation`, `active`, `projectId`, `emergency`) VALUES
(1, 1, 'Discrimination', 1, 2, 'no'),
(2, 2, 'Abuse', 1, 2, 'no'),
(3, 3, 'Corruption', 1, 2, 'no'),
(4, 1, 'Abuse', 1, 3, 'no'),
(5, 2, 'Reputation de la boite', 1, 3, 'yes'),
(6, 1, 'Corruption', 1, 4, 'no');

-- --------------------------------------------------------

--
-- Structure de la table `soumission`
--

CREATE TABLE `soumission` (
  `id` int(11) NOT NULL,
  `dateHeureEnreg` datetime NOT NULL,
  `emergency` varchar(3) NOT NULL DEFAULT 'no',
  `trust` varchar(9) NOT NULL DEFAULT 'Middle',
  `needFeedback` varchar(5) NOT NULL,
  `sensibiliteId` int(11) NOT NULL,
  `donneeId` int(11) NOT NULL,
  `remonteId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `soumission`
--

INSERT INTO `soumission` (`id`, `dateHeureEnreg`, `emergency`, `trust`, `needFeedback`, `sensibiliteId`, `donneeId`, `remonteId`) VALUES
(1, '2022-01-24 13:15:29', 'no', 'Medium', 'yes', 3, 27, 4),
(2, '2022-01-25 11:05:46', 'no', 'Medium', 'yes', 4, 48, 7),
(3, '2022-01-25 13:25:46', 'no', 'Medium', 'yes', 4, 57, 9),
(4, '2022-01-26 04:37:45', 'yes', 'High', 'yes', 4, 65, 12),
(5, '2022-01-26 11:51:14', 'yes', 'High', 'yes', 4, 83, 15),
(6, '2022-01-26 12:11:10', 'yes', 'High', 'yes', 4, 88, 17),
(7, '2022-01-26 12:23:08', 'yes', 'High', 'yes', 4, 92, 16),
(8, '2022-01-28 08:26:47', 'no', 'Medium', 'yes', 5, 117, 28),
(10, '2022-01-31 11:03:53', 'yes', 'Medium', 'yes', 4, 137, 44),
(11, '2022-01-31 11:05:10', 'yes', 'Medium', 'yes', 4, 138, 44),
(12, '2022-01-31 11:08:39', 'yes', 'Medium', 'yes', 4, 139, 44),
(13, '2022-02-02 17:40:10', 'yes', 'Medium', 'yes', 5, 152, 49),
(16, '2022-02-07 12:27:56', 'yes', 'High', 'yes', 5, 164, 61);

-- --------------------------------------------------------

--
-- Structure de la table `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `identite` varchar(200) DEFAULT NULL,
  `contact` varchar(50) NOT NULL,
  `profession` varchar(200) DEFAULT NULL,
  `statut` varchar(100) DEFAULT NULL,
  `genre` char(1) NOT NULL,
  `adresse` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `source`
--

INSERT INTO `source` (`id`, `identite`, `contact`, `profession`, `statut`, `genre`, `adresse`) VALUES
(1, 'Honore Huko', '+243894004049', 'Teacher', 'Single', 'F', 'Masisi'),
(2, 'Honore Huko', '+243894004049', 'Teacher', 'Single', 'F', 'Masisi'),
(3, 'Baudouin', '+243889999950', 'Teacher', 'Single', 'M', 'Katana'),
(4, 'Honore Huko', '+243889999950', 'Teacher', 'Maried', 'M', 'Kalehe Centre'),
(5, '', '+24399900494', 'Doctor', 'Maried', 'M', 'Burhinyi'),
(6, 'Balola', '+24399990303', 'Saller', 'Single', 'M', 'Mangina'),
(7, '', '+2439988775', 'teacher', 'Single', 'M', 'Walungu Centre'),
(8, '', '+2439894994', 'Pastor', '', 'M', 'Kabare Centre'),
(9, '', '+24388999009', 'Agriprener', '', 'M', 'Idjwi'),
(10, 'Fazili', '0994476166', 'Mlimaji', '', 'M', 'Bunia'),
(11, 'Fazili', '0994476166', 'Mlimaji', '', 'M', 'Bunia'),
(12, '', '0999755912', 'commerçant', '', 'M', 'sake'),
(13, 'SHUKRANI', '0971067039', 'chromeur', 'célibataire', 'M', 'KAVUMU'),
(14, 'KIZITO', '0971067039', 'Enseignant', 'Marié', 'M', 'MASISI'),
(15, 'Sylvain', '0994476166', 'Mlimaji', 'marié', 'M', 'Walungu, Mubumbano'),
(16, 'MASUMBUKO RICHARD', '0971067039', 'chromeur', 'Marié', 'M', 'KAVUMU KAMANYOLA'),
(17, 'MUTWANGU', '0989123456', 'AGRICULTEUR', 'Marié', 'M', 'WALUNGU'),
(18, 'Sylvain', '0994476166', 'Mlimaji', 'marié', 'n', 'Walungu, Mubumbano'),
(19, 'Fazili', '0999900000', 'Cultivateur', 'marié', 'M', 'masisi'),
(20, 'Pascal', '+2439949494', 'Teacher', 'Single', 'M', 'Kalehe'),
(21, '', '+2439996868', 'Pastor', 'Single', 'M', 'Kabare'),
(22, '', '+24378882', 'Teacher', 'Maried', 'F', 'Rutshuru'),
(23, '', '+243778877788', 'Teacher', 'Maried', 'F', 'Bunia');

-- --------------------------------------------------------

--
-- Structure de la table `traitefeedback`
--

CREATE TABLE `traitefeedback` (
  `id` int(11) NOT NULL,
  `dateHeureEnreg` datetime NOT NULL,
  `etat` varchar(50) NOT NULL,
  `commentaire` text DEFAULT NULL,
  `agentId` int(11) NOT NULL,
  `ajusteFeedbackId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `traitefeedback`
--

INSERT INTO `traitefeedback` (`id`, `dateHeureEnreg`, `etat`, `commentaire`, `agentId`, `ajusteFeedbackId`) VALUES
(1, '2022-01-26 09:31:16', 'Keep-Open', 'Les chauffeurs', 3, 7),
(2, '2022-01-27 12:20:42', 'Keep-Open', '3 camions qui étaient au bureau de PAM Kavumu sous la supervision de Mr CHIRUZA KABALA. Question: Est-ce que nous aurons encore nos vivres?', 4, 9),
(3, '2022-01-28 12:43:45', 'Close', 'Ok. Je suis disponible pour recevoir vos appels et vous contacter en cas de besoin. \r\nPour la mere, elle faira parvenir les pieces d\'identites de sa fille au bureau de Caritas Bunia. \r\nL\'administration de Caritas promet d\'extraire l\'agent de Bunia la semaine prochaine.', 6, 10),
(4, '2022-01-31 14:16:29', 'Close', 'Merci. Nous allons bien accueillir votre delegation.', 3, 14),
(5, '2022-02-07 12:37:35', 'Keep-Open', 'L\'hopital choisi est le HG Katoyi', 3, 16);

-- --------------------------------------------------------

--
-- Structure de la table `triangulation`
--

CREATE TABLE `triangulation` (
  `id` int(11) NOT NULL,
  `dateHeureEnreg` varchar(30) NOT NULL,
  `agentId` int(11) NOT NULL,
  `niveauId` int(11) NOT NULL,
  `keyinformantId` int(11) NOT NULL,
  `forInformationId` int(11) NOT NULL,
  `gainInformationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `triangulation`
--

INSERT INTO `triangulation` (`id`, `dateHeureEnreg`, `agentId`, `niveauId`, `keyinformantId`, `forInformationId`, `gainInformationId`) VALUES
(2, '2022-01-22 02:08:06', 2, 2, 3, 5, 12),
(3, '2022-01-24 16:17:58', 2, 2, 3, 13, 14),
(4, '2022-01-25 12:47:38', 3, 2, 3, 16, 17),
(5, '2022-01-25 12:50:35', 3, 2, 2, 16, 18),
(6, '2022-01-25 13:01:55', 6, 3, 1, 16, 19),
(7, '2022-01-25 20:03:39', 3, 2, 3, 20, 21),
(8, '2022-01-26 11:11:42', 4, 2, 4, 25, 26),
(9, '2022-01-26 11:24:40', 5, 2, 6, 24, 28),
(10, '2022-01-26 11:25:15', 4, 2, 6, 27, 29),
(11, '2022-01-26 11:30:08', 3, 2, 5, 23, 30),
(12, '2022-01-26 11:45:52', 7, 4, 5, 23, 31),
(13, '2022-01-26 11:46:37', 6, 3, 6, 25, 32),
(14, '2022-01-26 12:09:06', 7, 4, 6, 25, 33),
(15, '2022-01-26 12:21:36', 7, 4, 3, 23, 34),
(16, '2022-01-27 09:40:45', 4, 2, 8, 36, 38),
(17, '2022-01-27 09:42:57', 3, 2, 7, 35, 39),
(18, '2022-01-27 10:18:01', 5, 2, 9, 37, 41),
(19, '2022-01-27 15:22:38', 3, 2, 6, 42, 43),
(20, '2022-01-27 15:47:09', 6, 3, 9, 42, 44),
(21, '2022-01-28 08:25:25', 8, 4, 10, 42, 45),
(22, '2022-01-28 13:58:18', 6, 3, 10, 42, 46),
(23, '2022-02-07 19:42:11', 3, 2, 5, 50, 51);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compteId` (`compteId`),
  ADD KEY `niveauId` (`niveauId`);

--
-- Index pour la table `ajustefeedback`
--
ALTER TABLE `ajustefeedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agentId` (`agentId`),
  ADD KEY `feedbackId` (`feedbackId`),
  ADD KEY `donneeId` (`donneeId`),
  ADD KEY `niveauId` (`niveauId`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `donnee`
--
ALTER TABLE `donnee`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soumissionId` (`soumissionId`),
  ADD KEY `donneeId` (`donneeId`),
  ADD KEY `pointfocalId` (`pointfocalId`);

--
-- Index pour la table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sourceId` (`sourceId`),
  ADD KEY `donneeId` (`donneeId`);

--
-- Index pour la table `keyinformant`
--
ALTER TABLE `keyinformant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `niveauId` (`niveauId`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pointfocal`
--
ALTER TABLE `pointfocal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compteId` (`compteId`),
  ADD KEY `sensibiliteId` (`sensibiliteId`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisationId` (`organisationId`);

--
-- Index pour la table `rapportage`
--
ALTER TABLE `rapportage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `informationId` (`informationId`),
  ADD KEY `agentId` (`agentId`),
  ADD KEY `organisationId` (`projectId`);

--
-- Index pour la table `remonte`
--
ALTER TABLE `remonte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oldNiveauId` (`oldNiveauId`),
  ADD KEY `newNiveauId` (`newNiveauId`),
  ADD KEY `rapportageId` (`rapportageId`),
  ADD KEY `donneeId` (`donneeId`),
  ADD KEY `agentId` (`agentId`),
  ADD KEY `sensibiliteId` (`sensibiliteId`);

--
-- Index pour la table `sensibilite`
--
ALTER TABLE `sensibilite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organisationId` (`projectId`);

--
-- Index pour la table `soumission`
--
ALTER TABLE `soumission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sensibiliteId` (`sensibiliteId`),
  ADD KEY `donneeId` (`donneeId`),
  ADD KEY `remonteId` (`remonteId`);

--
-- Index pour la table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `traitefeedback`
--
ALTER TABLE `traitefeedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agentId` (`agentId`),
  ADD KEY `ajusteFeedbackId` (`ajusteFeedbackId`);

--
-- Index pour la table `triangulation`
--
ALTER TABLE `triangulation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `agentId` (`agentId`),
  ADD KEY `niveauId` (`niveauId`),
  ADD KEY `keyinformantId` (`keyinformantId`),
  ADD KEY `forInformationId` (`forInformationId`),
  ADD KEY `gainInformationId` (`gainInformationId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `ajustefeedback`
--
ALTER TABLE `ajustefeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `donnee`
--
ALTER TABLE `donnee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT pour la table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `keyinformant`
--
ALTER TABLE `keyinformant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `pointfocal`
--
ALTER TABLE `pointfocal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `rapportage`
--
ALTER TABLE `rapportage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `remonte`
--
ALTER TABLE `remonte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `sensibilite`
--
ALTER TABLE `sensibilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `soumission`
--
ALTER TABLE `soumission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `traitefeedback`
--
ALTER TABLE `traitefeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `triangulation`
--
ALTER TABLE `triangulation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agent`
--
ALTER TABLE `agent`
  ADD CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`compteId`) REFERENCES `compte` (`id`),
  ADD CONSTRAINT `agent_ibfk_2` FOREIGN KEY (`niveauId`) REFERENCES `niveau` (`id`);

--
-- Contraintes pour la table `ajustefeedback`
--
ALTER TABLE `ajustefeedback`
  ADD CONSTRAINT `ajustefeedback_ibfk_1` FOREIGN KEY (`agentId`) REFERENCES `agent` (`id`),
  ADD CONSTRAINT `ajustefeedback_ibfk_2` FOREIGN KEY (`donneeId`) REFERENCES `donnee` (`id`),
  ADD CONSTRAINT `ajustefeedback_ibfk_3` FOREIGN KEY (`feedbackId`) REFERENCES `feedback` (`id`),
  ADD CONSTRAINT `ajustefeedback_ibfk_4` FOREIGN KEY (`niveauId`) REFERENCES `niveau` (`id`);

--
-- Contraintes pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`soumissionId`) REFERENCES `soumission` (`id`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`donneeId`) REFERENCES `donnee` (`id`),
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`pointfocalId`) REFERENCES `pointfocal` (`id`);

--
-- Contraintes pour la table `information`
--
ALTER TABLE `information`
  ADD CONSTRAINT `information_ibfk_1` FOREIGN KEY (`donneeId`) REFERENCES `donnee` (`id`),
  ADD CONSTRAINT `information_ibfk_2` FOREIGN KEY (`sourceId`) REFERENCES `source` (`id`);

--
-- Contraintes pour la table `keyinformant`
--
ALTER TABLE `keyinformant`
  ADD CONSTRAINT `keyinformant_ibfk_1` FOREIGN KEY (`niveauId`) REFERENCES `niveau` (`id`);

--
-- Contraintes pour la table `pointfocal`
--
ALTER TABLE `pointfocal`
  ADD CONSTRAINT `pointfocal_ibfk_1` FOREIGN KEY (`compteId`) REFERENCES `compte` (`id`),
  ADD CONSTRAINT `pointfocal_ibfk_2` FOREIGN KEY (`sensibiliteId`) REFERENCES `sensibilite` (`id`);

--
-- Contraintes pour la table `rapportage`
--
ALTER TABLE `rapportage`
  ADD CONSTRAINT `rapportage_ibfk_1` FOREIGN KEY (`agentId`) REFERENCES `agent` (`id`),
  ADD CONSTRAINT `rapportage_ibfk_2` FOREIGN KEY (`informationId`) REFERENCES `information` (`id`),
  ADD CONSTRAINT `rapportage_ibfk_3` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`);

--
-- Contraintes pour la table `remonte`
--
ALTER TABLE `remonte`
  ADD CONSTRAINT `remonte_ibfk_1` FOREIGN KEY (`oldNiveauId`) REFERENCES `niveau` (`id`),
  ADD CONSTRAINT `remonte_ibfk_2` FOREIGN KEY (`newNiveauId`) REFERENCES `niveau` (`id`),
  ADD CONSTRAINT `remonte_ibfk_3` FOREIGN KEY (`rapportageId`) REFERENCES `rapportage` (`id`),
  ADD CONSTRAINT `remonte_ibfk_4` FOREIGN KEY (`donneeId`) REFERENCES `donnee` (`id`),
  ADD CONSTRAINT `remonte_ibfk_5` FOREIGN KEY (`sensibiliteId`) REFERENCES `sensibilite` (`id`);

--
-- Contraintes pour la table `sensibilite`
--
ALTER TABLE `sensibilite`
  ADD CONSTRAINT `sensibilite_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`);

--
-- Contraintes pour la table `soumission`
--
ALTER TABLE `soumission`
  ADD CONSTRAINT `soumission_ibfk_1` FOREIGN KEY (`sensibiliteId`) REFERENCES `sensibilite` (`id`),
  ADD CONSTRAINT `soumission_ibfk_2` FOREIGN KEY (`donneeId`) REFERENCES `donnee` (`id`),
  ADD CONSTRAINT `soumission_ibfk_3` FOREIGN KEY (`remonteId`) REFERENCES `remonte` (`id`);

--
-- Contraintes pour la table `traitefeedback`
--
ALTER TABLE `traitefeedback`
  ADD CONSTRAINT `traitefeedback_ibfk_1` FOREIGN KEY (`agentId`) REFERENCES `agent` (`id`),
  ADD CONSTRAINT `traitefeedback_ibfk_2` FOREIGN KEY (`ajusteFeedbackId`) REFERENCES `ajustefeedback` (`id`);

--
-- Contraintes pour la table `triangulation`
--
ALTER TABLE `triangulation`
  ADD CONSTRAINT `triangulation_ibfk_1` FOREIGN KEY (`agentId`) REFERENCES `agent` (`id`),
  ADD CONSTRAINT `triangulation_ibfk_2` FOREIGN KEY (`niveauId`) REFERENCES `niveau` (`id`),
  ADD CONSTRAINT `triangulation_ibfk_3` FOREIGN KEY (`keyinformantId`) REFERENCES `keyinformant` (`id`),
  ADD CONSTRAINT `triangulation_ibfk_4` FOREIGN KEY (`forInformationId`) REFERENCES `information` (`id`),
  ADD CONSTRAINT `triangulation_ibfk_5` FOREIGN KEY (`gainInformationId`) REFERENCES `information` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
