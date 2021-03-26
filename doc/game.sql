-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 25 mars 2021 à 01:17
-- Version du serveur :  5.7.31
-- Version de PHP : 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `game`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_880E0D76F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `roles`, `password`) VALUES
(2, 'admin', '[]', '$2y$10$zsfk5iGqBwRG4cVGg98sQ.jfsCt5eMu51VO9Ai1R5ZiUipslz2.t2');

-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `text_answer` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_DADD4A251E27F6BF` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=922 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `answer`
--

INSERT INTO `answer` (`id`, `question_id`, `text_answer`) VALUES
(466, 161, '9 août 1945'),
(467, 161, '9 aout 1945 '),
(468, 161, 'neuf aout 1945'),
(469, 161, 'neuf août 1945'),
(470, 161, 'neuf aout mille neuf cent quarante cinq'),
(471, 161, 'neuf août mille neuf cent quarante cing'),
(472, 161, '9 août mille neuf cent quarante cing'),
(473, 162, '1989'),
(474, 162, 'mille neuf cent quarante neuf'),
(475, 163, 'Allemagne'),
(476, 163, 'allemagne'),
(477, 164, 'Italienne'),
(478, 164, 'italienne'),
(479, 165, '1991'),
(480, 166, 'Londres'),
(481, 166, 'londres'),
(482, 167, 'deux'),
(483, 167, '2'),
(484, 167, 'Deux'),
(485, 168, 'Française'),
(486, 168, 'francaise'),
(487, 168, 'française'),
(488, 168, 'Francaise'),
(489, 169, '1848'),
(490, 169, 'mille huit cent quarante huit'),
(491, 170, '1618'),
(492, 170, 'mille six cent dix huit'),
(493, 171, 'Louis XVI'),
(494, 171, 'Louis xvi'),
(495, 171, 'Louis 16'),
(496, 171, 'louis 16'),
(497, 171, 'louis XVI'),
(498, 172, 'la pucelle'),
(499, 172, 'la pucelle d\'orléans'),
(500, 172, 'la pucelle d\'Orléans'),
(501, 172, 'la pucelle d\'orléan'),
(502, 172, 'la pucelle d\'Orléan'),
(503, 173, '1962'),
(504, 173, 'mille neuf soixante deux'),
(505, 174, 'Pépin Le Bref'),
(506, 174, 'pepin le bref'),
(507, 174, 'pepin lebref'),
(508, 174, 'pépin le bref'),
(509, 174, 'pépin'),
(510, 175, 'premier siècle'),
(511, 175, 'premier siecle'),
(512, 175, '1 siecle'),
(513, 175, '1 siècle'),
(514, 175, 'Is'),
(515, 176, 'indien'),
(516, 176, 'népalais'),
(517, 176, 'indien et népalais'),
(518, 177, 'guerre sino-japonaise'),
(519, 177, 'guerre sino japonaise'),
(520, 177, 'sino-japonaise'),
(521, 177, 'sino japonaise'),
(522, 177, 'chine contre japon'),
(523, 177, 'japon contre chine'),
(524, 177, 'japon chine'),
(525, 177, 'chine japon'),
(526, 178, 'allemagne'),
(527, 178, 'Allemagne'),
(528, 179, 'tbilissi'),
(529, 180, 'dakar'),
(530, 180, 'Dakar'),
(531, 181, 'la mer noire'),
(532, 181, 'La Mer Noire'),
(533, 181, 'la Mer Noire'),
(534, 182, 'Soudan'),
(535, 182, 'le soudan'),
(536, 182, 'le Soudan'),
(537, 182, 'soudan'),
(538, 182, 'Le Soudan'),
(539, 183, 'non'),
(540, 183, 'Non'),
(541, 184, 'quito'),
(542, 184, 'Quito'),
(543, 185, 'non'),
(544, 185, 'Non'),
(545, 186, 'Birmanie'),
(546, 186, 'birmanie'),
(547, 187, '197'),
(548, 187, 'cent quatre vingt dix sept'),
(549, 188, 'le Nil'),
(550, 188, 'Le Nil'),
(551, 188, 'le nil'),
(552, 189, 'la lituanie\''),
(553, 189, 'la Lituanie'),
(554, 189, 'lituanie'),
(555, 189, 'Lituanie'),
(556, 190, '87'),
(557, 190, 'quatre vingt sept'),
(558, 191, 'Saint-Domingue'),
(559, 191, 'Saint Domingue'),
(560, 191, 'saint-domingue'),
(561, 191, 'saint domingue'),
(562, 192, 'non'),
(563, 192, 'Non'),
(564, 193, 'Mer des Wadden'),
(565, 193, 'mer des wadden'),
(566, 194, 'Phnom Penh'),
(567, 194, 'phnom penh'),
(568, 195, 'Phnom Penh'),
(569, 195, 'phnom penh'),
(570, 196, 'turquie'),
(571, 196, 'Turquie'),
(572, 197, 'Avignon'),
(573, 197, 'avignon'),
(574, 198, 'africain'),
(575, 199, 'Retour vers le futur'),
(576, 199, 'retour vers le futur'),
(577, 199, 'Retour vers le Futur'),
(578, 200, 'les frères lumière'),
(579, 200, 'les frères Lumière'),
(580, 200, 'frères Lumière'),
(581, 200, 'Frères Lumière'),
(582, 200, 'Frères lumière'),
(583, 200, 'frères lumière'),
(584, 201, 'The Kid'),
(585, 201, 'the Kid'),
(586, 201, 'The kid'),
(587, 201, 'the kid'),
(588, 202, 'les visiteurs'),
(589, 202, 'Les visiteurs'),
(590, 202, 'Les Visiteurs'),
(591, 202, 'Les visiteurs'),
(592, 203, 'parasite'),
(593, 204, 'd\'argent'),
(594, 205, '2016'),
(595, 205, 'deux mille seize'),
(596, 206, 'Norma Jean Baker'),
(597, 206, 'Norma'),
(598, 206, 'norma'),
(599, 206, 'norma jean baker'),
(600, 207, 'Sarabi'),
(601, 207, 'sarabi'),
(602, 208, 'retour vers le futur 1'),
(603, 208, 'Retour vers le futur 1'),
(604, 208, 'Retour vers le Futur 1'),
(605, 208, 'Retour vers le Futur'),
(606, 208, 'retour vers le futur'),
(607, 209, 'Roman Polanski'),
(608, 209, 'roman polanski'),
(609, 210, 'the artist'),
(610, 211, 'le seigneur des anneaux'),
(611, 211, 'Le seigneur des anneaux'),
(612, 212, 'Hans Zimmer'),
(613, 213, '7ème'),
(614, 213, '7 ème'),
(615, 213, 'septième'),
(616, 213, 'septieme'),
(617, 213, 'le septieme'),
(618, 213, 'le septième'),
(619, 213, 'sept'),
(620, 213, '7'),
(621, 213, 'Sept'),
(622, 214, 'loup-garou'),
(623, 214, 'Loup-garou'),
(624, 214, 'loup garou'),
(625, 214, 'Loup garou'),
(626, 215, 'La copine de Bambi'),
(627, 215, 'la copine de Bambi'),
(628, 215, 'l\'amie de Bambi'),
(629, 215, 'L\'amie de Bambi'),
(630, 216, '2001'),
(631, 216, 'deux mille un'),
(632, 217, 'La cité de la peur'),
(633, 217, 'la cité de la peur'),
(634, 217, 'la cite de la peur'),
(635, 217, 'La cite de la peur'),
(636, 218, 'roméo'),
(637, 218, 'romeo'),
(638, 219, 'Avatar'),
(639, 219, 'avatar'),
(640, 220, '32'),
(641, 220, 'trente deux'),
(642, 220, 'Trente deux'),
(643, 221, 'The Crown'),
(644, 221, 'the crown'),
(645, 222, 'Le burlesque'),
(646, 222, 'le burlesque'),
(647, 222, 'burlesque'),
(648, 222, 'Burlesque'),
(649, 223, '6'),
(650, 223, 'six'),
(651, 224, 'haine et passion'),
(652, 224, 'guilding light'),
(653, 225, 'Jamie'),
(654, 225, 'jamie'),
(655, 226, 'Forrest Gump'),
(656, 226, 'forrest gump'),
(657, 227, 'Suits : Avocats sur mesure'),
(658, 227, 'Suits Avocats sur mesure'),
(659, 227, 'Suits'),
(660, 227, 'suits'),
(661, 228, 'bugs bunny'),
(662, 228, 'Bugs bunny'),
(663, 228, 'Bugs Bunny'),
(664, 229, 'Alex Drake'),
(665, 229, 'alex drake'),
(666, 229, 'Alex'),
(667, 230, '4'),
(668, 230, 'quatre'),
(669, 230, 'Quatre'),
(670, 231, 'lupin'),
(671, 231, 'Lupin'),
(672, 232, 'The big bang theory'),
(673, 232, 'the big bang theory'),
(674, 232, 'The Big Bang Theory'),
(675, 232, 'big bang theory'),
(676, 232, 'Big ang theory'),
(677, 233, 'lili reinhart'),
(678, 233, 'Lili Reinhart'),
(679, 233, 'Lili reinhart'),
(680, 234, 'Attaque des titans'),
(681, 234, 'attaque des titans'),
(682, 234, 'snk'),
(683, 234, 'shingeki no kyojin'),
(684, 234, 'Shingeki no kyojin'),
(685, 235, 'la casa de papel'),
(686, 235, 'La casa de papel'),
(687, 235, 'casa de papel'),
(688, 236, 'GTO'),
(689, 236, 'Great Teacher Onizuka'),
(690, 236, 'great teacher onizuka'),
(691, 236, 'Great teacher onizuka'),
(692, 237, 'Etats-Unis'),
(693, 237, 'Etats_Unis'),
(694, 237, 'Etats Unis'),
(695, 238, 'Black'),
(696, 238, 'black'),
(697, 239, 'RPG'),
(698, 239, 'rpg'),
(699, 240, 'Cloud'),
(700, 240, 'cloud'),
(701, 241, 'samus'),
(702, 241, 'Samus'),
(703, 242, 'league of legends'),
(704, 242, 'League of legends'),
(705, 243, 'pokemon go'),
(706, 243, 'Pokemon Go'),
(707, 244, 'Minecraft'),
(708, 244, 'minecraft'),
(709, 245, 'Ellie'),
(710, 245, 'ellie'),
(711, 246, 'Luigi\'s mansion'),
(712, 246, 'Luigi\'s mansion 2'),
(713, 246, 'Luigi\'s mansion 3'),
(714, 246, 'Luigi\'s Mansion'),
(715, 246, 'Luigi\'s Mansion 2'),
(716, 246, 'Luigi\'s Mansion 3'),
(717, 246, 'luigi\'s mansion'),
(718, 246, 'luigi\'s mansion 2'),
(719, 246, 'luigi\'s mansion 3'),
(720, 247, 'Lara Croft'),
(721, 247, 'lara croft'),
(722, 248, 'un raton laveur'),
(723, 248, 'raton laveur'),
(724, 248, 'Un raton laveur'),
(725, 248, 'Raton laveur'),
(726, 249, 'Grand Theft Auto'),
(727, 249, 'grand theft auto'),
(728, 250, 'Kirby'),
(729, 250, 'kirby'),
(730, 251, 'Ubisoft'),
(731, 251, 'ubisoft'),
(732, 252, 'Nintendo Entertainment System'),
(733, 252, 'nintendo entertainment system'),
(734, 253, 'hérisson'),
(735, 253, 'Hérisson'),
(736, 253, 'un hérisson'),
(737, 253, 'Un hérisson'),
(738, 254, 'wild rift'),
(739, 254, 'Wild Rift'),
(740, 254, 'Wild rift'),
(741, 255, 'The Last Guardian'),
(742, 255, 'the last guardian'),
(743, 256, 'Mario Kart 8 Deluxe'),
(744, 256, 'mario kart 8 deluxe'),
(745, 256, 'Mario kart 8 deluxe'),
(746, 257, '1977'),
(747, 257, 'mille neuf cent soixante dix sept'),
(748, 258, 'luigi'),
(749, 259, 'triple-double'),
(750, 259, 'triple double'),
(751, 259, 'Triple-double'),
(752, 259, 'Triple double'),
(753, 260, 'Goggles'),
(754, 260, 'goggles'),
(755, 260, 'des Goggles'),
(756, 260, 'des goggles'),
(757, 261, '3'),
(758, 261, '3 fois'),
(759, 261, 'trois'),
(760, 261, 'Trois'),
(761, 262, 'Earvin'),
(762, 262, 'earvin'),
(763, 263, 'le marcher'),
(764, 263, 'marcher'),
(765, 263, 'Marcher'),
(766, 263, 'Le marcher'),
(767, 264, 'Phoenix'),
(768, 264, 'phoenix'),
(769, 265, 'Lakers de Los Angeles'),
(770, 265, 'lakers de los angeles'),
(771, 266, 'Detroit'),
(772, 266, 'detroit'),
(773, 267, 'Dribble'),
(774, 267, 'dribble'),
(775, 268, 'Larry Johnson'),
(776, 268, 'larry johnson'),
(777, 268, 'Larry johnson'),
(778, 269, '11'),
(779, 269, 'onze'),
(780, 270, 'Indiana'),
(781, 270, 'indiana'),
(782, 271, 'Turbo'),
(783, 271, 'turbo'),
(784, 272, 'Nets de Brooklyn'),
(785, 272, 'nets de brooklyn'),
(786, 273, 'Cross-over'),
(787, 273, 'cross over'),
(788, 273, 'Cross over'),
(789, 273, 'cross-over'),
(790, 274, 'Bill Laimbeer'),
(791, 274, 'bill laimbeer'),
(792, 274, 'Bill laimbeer'),
(793, 275, '4-2'),
(794, 275, '4 2'),
(795, 275, '4/2'),
(796, 275, '4_2'),
(797, 275, 'quatre à deux'),
(798, 275, 'quatre a deux'),
(799, 276, 'warriors de golden state'),
(800, 276, 'Warriors de Golden State'),
(801, 277, 'Interception'),
(802, 277, 'interception'),
(803, 277, 'Interception'),
(804, 277, 'Arbitre'),
(805, 278, 'bulls de chicago'),
(806, 278, 'bulls'),
(807, 278, 'chicago bulls'),
(808, 279, 'les anglais'),
(809, 279, 'Les Anglais'),
(810, 279, 'Les anglais'),
(811, 279, 'les Anglais'),
(812, 279, 'l\'Angleterre'),
(813, 279, 'l\'angleterre'),
(814, 279, 'Angleterre'),
(815, 279, 'angleterre'),
(816, 280, 'Didier Deschamps'),
(817, 280, 'didier deschamps'),
(818, 281, '120 minutes'),
(819, 281, '120'),
(820, 282, 'Zinédine Zidane'),
(821, 282, 'Zinedine Zidane'),
(822, 282, 'Zizou'),
(823, 283, 'l\'arbitre'),
(824, 283, 'L\'arbitre'),
(825, 283, 'arbitre'),
(826, 283, 'Arbitre'),
(827, 284, '6'),
(828, 284, 'sixième'),
(829, 284, '6ème'),
(830, 284, '6 ème'),
(831, 285, 'Atlético Nacional'),
(832, 285, 'Atletico Nacional'),
(833, 285, 'atletico nacional'),
(834, 286, 'Les protège-tibias'),
(835, 286, 'Les protège tibias'),
(836, 286, 'les protège-tibias'),
(837, 286, 'les protège tibias'),
(838, 286, 'protège-tibias'),
(839, 286, 'protège tibias'),
(840, 286, 'protege-tibias'),
(841, 286, 'protege tibias'),
(842, 287, 'IN INF Clairefontaine'),
(843, 287, 'in inf Clairefontaine'),
(844, 288, '2017'),
(845, 288, 'deux mille dix sept'),
(846, 289, '3'),
(847, 289, 'trois'),
(848, 290, 'Nike'),
(849, 290, 'nike'),
(850, 291, 'L’Olympique de Marseille'),
(851, 291, 'l’olympique de marseille'),
(852, 291, 'Le Paris Saint-Germain'),
(853, 291, 'le Paris Saint-Germain'),
(854, 291, 'Paris Saint-Germain'),
(855, 291, 'Paris Saint Germain'),
(856, 291, 'paris saint-germain'),
(857, 291, 'paris saint germain'),
(858, 291, 'paris saint germain'),
(859, 291, 'paris saint germain'),
(860, 292, 'de bondy'),
(861, 292, 'bondy'),
(862, 293, 'La FFF'),
(863, 293, 'la FFF'),
(864, 293, 'FFF'),
(865, 293, 'Fédération française de football'),
(866, 293, 'fédération française de football'),
(867, 293, 'fédération française de football'),
(868, 293, 'Fédération française de foot'),
(869, 293, 'fédération française de foot'),
(870, 294, 'Le Brésil'),
(871, 294, 'le brésil'),
(872, 294, 'Brésil'),
(873, 294, 'brésil'),
(874, 295, 'de bondy'),
(875, 295, 'bondy'),
(876, 296, 'Noël Le Graët'),
(877, 296, 'noël le graët'),
(878, 296, 'Noel Le Graet'),
(879, 296, 'noel le graet'),
(880, 297, 'Une mise au vert'),
(881, 297, 'une mise au vert'),
(882, 298, 'La Marseillaise'),
(883, 298, 'la marseillaise'),
(884, 298, 'la Marseillaise'),
(885, 299, 'Aimé Jacquet'),
(886, 299, 'aimé jacquet'),
(887, 299, 'Aimé jacquet'),
(888, 300, 'a star is born'),
(889, 300, 'A star is born'),
(890, 301, 'titanic'),
(891, 302, 'docteur house'),
(892, 302, 'doctor house'),
(893, 303, 'Les mystérieuses cités d\'or'),
(894, 303, 'les mystérieuses cités d\'or'),
(895, 304, 'psych enqueteur malgré lui'),
(896, 304, 'Psych enqueteur malgré lui'),
(897, 304, 'psych enqueteur malgre lui'),
(898, 304, 'Psych enqueteur malgre lui'),
(899, 305, 'legend of zelda breath of the wild'),
(900, 305, 'Legend of zelda breath of the wild'),
(901, 306, 'super mario odyssey'),
(902, 306, 'Super mario odyssey'),
(903, 306, 'Super Mario Odyssey'),
(904, 307, 'chromatica'),
(905, 308, 'du phoenix aux étoiles'),
(906, 308, 'Du phoenix aux étoiles'),
(907, 308, 'du phoenix aux etoiles'),
(908, 308, 'Du phoenix aux etoiles'),
(909, 309, 'Le conte de la princesse Kaguya'),
(910, 309, 'le conte de la princesse kaguya'),
(911, 309, 'Kaguya-hime no monogatari'),
(912, 309, 'Kaguya-hime'),
(913, 310, 'akira'),
(914, 311, 'johnny depp'),
(915, 312, 'Jean Paul Rouve'),
(916, 312, 'jean-paul-rouve'),
(917, 312, 'Jean-paul-rouve'),
(918, 313, 'blackpink'),
(919, 314, 'Jimi Hendrix'),
(920, 314, 'jimi hendrix'),
(921, 314, 'Jimi hendrix');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) NOT NULL,
  `lib_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C1E48FD905` (`game_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `game_id`, `lib_category`) VALUES
(5, 3, 'Culture'),
(6, 3, 'Divertissement'),
(7, 3, 'Sport'),
(8, 4, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210324234222', '2021-03-24 23:42:53', 7519);

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

DROP TABLE IF EXISTS `game`;
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id`, `name`) VALUES
(3, 'Quiz'),
(4, 'GuessThe');

-- --------------------------------------------------------

--
-- Structure de la table `guest`
--

DROP TABLE IF EXISTS `guest`;
CREATE TABLE IF NOT EXISTS `guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `guest`
--

INSERT INTO `guest` (`id`, `pseudo`, `type`) VALUES
(43, 'lacroix.alphonse', 'player'),
(44, 'adelaide76', 'player'),
(45, 'moderateur', 'player'),
(46, 'guest0', 'guest'),
(47, 'guest1', 'guest'),
(48, 'guest2', 'guest'),
(49, 'guest0', 'guest'),
(50, 'guest1', 'guest'),
(51, 'guest2', 'guest'),
(52, 'guest3', 'guest'),
(53, 'guest4', 'guest'),
(54, 'guest5', 'guest'),
(55, 'guest6', 'guest'),
(56, 'guest0', 'guest'),
(57, 'guest1', 'guest'),
(58, 'guest2', 'guest'),
(59, 'guest0', 'guest'),
(60, 'guest1', 'guest'),
(61, 'guest2', 'guest'),
(62, 'guest3', 'guest'),
(63, 'guest0', 'guest'),
(64, 'guest1', 'guest'),
(65, 'guest2', 'guest'),
(66, 'guest0', 'guest'),
(67, 'guest0', 'guest'),
(68, 'guest1', 'guest'),
(69, 'guest2', 'guest'),
(70, 'guest3', 'guest'),
(71, 'guest4', 'guest'),
(72, 'guest0', 'guest'),
(73, 'guest1', 'guest'),
(74, 'guest2', 'guest'),
(75, 'guest3', 'guest'),
(76, 'guest4', 'guest'),
(77, 'guest0', 'guest'),
(78, 'guest1', 'guest'),
(79, 'guest2', 'guest'),
(80, 'guest3', 'guest'),
(81, 'xverdier', 'player'),
(82, 'matthieu79', 'player'),
(83, 'bertrand40', 'player'),
(84, 'theophile.traore', 'player'),
(85, 'anouk06', 'player'),
(86, 'joseph.colette', 'player'),
(87, 'luc.pereira', 'player'),
(88, 'maury.jerome', 'player'),
(89, 'fouquet.dominique', 'player'),
(90, 'olivie.marchal', 'player');

-- --------------------------------------------------------

--
-- Structure de la table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `id` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `player`
--

INSERT INTO `player` (`id`, `login`, `password`, `is_admin`) VALUES
(43, 'gabriel.lacroix@free.fr', '$2y$10$cCMsh4LjUNtz.9sjJPvfVOUi44qaEFZCw7YK53FGEcb3DtBsab42i', 0),
(44, 'marcelle31@tele2.fr', '$2y$10$lxFSzunDL5KAjghlen2KC.hIh.9PVNLjTy4fa3eiNiv0FuY8HXx3q', 0),
(45, 'moderateur@test.fr', '$2y$10$bN10rWfiPlOlzfBfGxTmW.x7x88ERpacvEui5HrguOki87drgKz12', 1),
(81, 'marcel55@guillaume.com', '$2y$10$HnL1FqktRMHKPVpUj3bb5O2VW5YIIw7gbc.p35q.OWoV5jGmod81C', 0),
(82, 'vincent.mercier@barthelemy.com', '$2y$10$Z2eObQm4EJI4WbsFc.Un5u61.K.oyjffBK.XexjKcVwE7/XkGanCy', 0),
(83, 'potier.alfred@yahoo.fr', '$2y$10$NnBpkRaWplQjtdnYzWl6Hu76E5xNXWxbUxGD7Bk.z3agl2bYDH4HS', 0),
(84, 'vpierre@hotmail.fr', '$2y$10$RBGqmAKrSBVpgchY0Ba38.7c59RWOkcVfc0Sn3GQOeupC/oC9mrjK', 0),
(85, 'guillet.rene@adam.fr', '$2y$10$5.cEhNGtbnRnLuB7XYjok.baWkC0avK8NWD81RAZJaa4bRoHGAjC2', 0),
(86, 'costa.patrick@denis.com', '$2y$10$rdNhP1KUnVS1.lFCAi9uAOoIf3GG57/QVBFBeaq.QTW7Y2jYz13oi', 0),
(87, 'auguste.meunier@voila.fr', '$2y$10$PbCFZo3peIJZcF/NfjwSN.0wnpytC64.2KT63Tx1xMEyH.G8seIi6', 0),
(88, 'theophile.morel@bouygtel.fr', '$2y$10$gSWAlZ8gckDjb7xeBIO7JO2jAJgqOYZ9JzqUqUTyWcWPu8A5osbDG', 0),
(89, 'jacob.emmanuel@noos.fr', '$2y$10$3G/ZIiiVAp7yPLDLXvmKqucPlq57VNPFVdcCNQpt4RNHu63pdHyuW', 0),
(90, 'alves.benoit@brunel.com', '$2y$10$KjQCYgWjAJOWQ5FP6r1JmeejjWCBHWYIXoReGi7StT4J26FmJCRM2', 0);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E99E6F5DF` (`player_id`),
  KEY `IDX_B6F7494EF7BFE87C` (`sub_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=315 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `player_id`, `sub_category_id`, `status`, `type`) VALUES
(161, 43, 15, 'accepted', 'questionWithText'),
(162, 43, 15, 'accepted', 'questionWithText'),
(163, 43, 15, 'accepted', 'questionWithText'),
(164, 43, 15, 'accepted', 'questionWithText'),
(165, 43, 15, 'accepted', 'questionWithText'),
(166, 43, 15, 'accepted', 'questionWithText'),
(167, 43, 15, 'accepted', 'questionWithText'),
(168, 43, 15, 'accepted', 'questionWithText'),
(169, 43, 15, 'accepted', 'questionWithText'),
(170, 43, 15, 'accepted', 'questionWithText'),
(171, 43, 15, 'accepted', 'questionWithText'),
(172, 43, 15, 'accepted', 'questionWithText'),
(173, 43, 15, 'accepted', 'questionWithText'),
(174, 43, 15, 'accepted', 'questionWithText'),
(175, 43, 15, 'accepted', 'questionWithText'),
(176, 43, 15, 'accepted', 'questionWithText'),
(177, 43, 15, 'accepted', 'questionWithText'),
(178, 43, 15, 'accepted', 'questionWithText'),
(179, 43, 16, 'accepted', 'questionWithText'),
(180, 43, 16, 'accepted', 'questionWithText'),
(181, 43, 16, 'accepted', 'questionWithText'),
(182, 43, 16, 'accepted', 'questionWithText'),
(183, 43, 16, 'accepted', 'questionWithText'),
(184, 43, 16, 'accepted', 'questionWithText'),
(185, 43, 16, 'accepted', 'questionWithText'),
(186, 43, 16, 'accepted', 'questionWithText'),
(187, 43, 16, 'accepted', 'questionWithText'),
(188, 43, 16, 'accepted', 'questionWithText'),
(189, 43, 16, 'accepted', 'questionWithText'),
(190, 43, 16, 'accepted', 'questionWithText'),
(191, 43, 16, 'accepted', 'questionWithText'),
(192, 43, 16, 'accepted', 'questionWithText'),
(193, 43, 16, 'accepted', 'questionWithText'),
(194, 43, 16, 'accepted', 'questionWithText'),
(195, 43, 16, 'accepted', 'questionWithText'),
(196, 43, 16, 'accepted', 'questionWithText'),
(197, 43, 16, 'accepted', 'questionWithText'),
(198, 43, 16, 'accepted', 'questionWithText'),
(199, 43, 17, 'accepted', 'questionWithText'),
(200, 43, 17, 'accepted', 'questionWithText'),
(201, 43, 17, 'accepted', 'questionWithText'),
(202, 43, 17, 'accepted', 'questionWithText'),
(203, 43, 17, 'accepted', 'questionWithText'),
(204, 43, 17, 'accepted', 'questionWithText'),
(205, 43, 17, 'accepted', 'questionWithText'),
(206, 43, 17, 'accepted', 'questionWithText'),
(207, 43, 17, 'accepted', 'questionWithText'),
(208, 43, 17, 'accepted', 'questionWithText'),
(209, 43, 17, 'accepted', 'questionWithText'),
(210, 43, 17, 'accepted', 'questionWithText'),
(211, 43, 17, 'accepted', 'questionWithText'),
(212, 43, 17, 'accepted', 'questionWithText'),
(213, 43, 17, 'accepted', 'questionWithText'),
(214, 43, 17, 'accepted', 'questionWithText'),
(215, 43, 17, 'accepted', 'questionWithText'),
(216, 43, 17, 'accepted', 'questionWithText'),
(217, 43, 17, 'accepted', 'questionWithText'),
(218, 43, 17, 'accepted', 'questionWithText'),
(219, 43, 18, 'accepted', 'questionWithText'),
(220, 43, 18, 'accepted', 'questionWithText'),
(221, 43, 18, 'accepted', 'questionWithText'),
(222, 43, 18, 'accepted', 'questionWithText'),
(223, 43, 18, 'accepted', 'questionWithText'),
(224, 43, 18, 'accepted', 'questionWithText'),
(225, 43, 18, 'accepted', 'questionWithText'),
(226, 43, 18, 'accepted', 'questionWithText'),
(227, 43, 18, 'accepted', 'questionWithText'),
(228, 43, 18, 'accepted', 'questionWithText'),
(229, 43, 18, 'accepted', 'questionWithText'),
(230, 43, 18, 'accepted', 'questionWithText'),
(231, 43, 18, 'accepted', 'questionWithText'),
(232, 43, 18, 'accepted', 'questionWithText'),
(233, 43, 18, 'accepted', 'questionWithText'),
(234, 43, 18, 'accepted', 'questionWithText'),
(235, 43, 18, 'accepted', 'questionWithText'),
(236, 43, 18, 'accepted', 'questionWithText'),
(237, 43, 18, 'accepted', 'questionWithText'),
(238, 43, 18, 'accepted', 'questionWithText'),
(239, 43, 19, 'accepted', 'questionWithText'),
(240, 43, 19, 'accepted', 'questionWithText'),
(241, 43, 19, 'accepted', 'questionWithText'),
(242, 43, 19, 'accepted', 'questionWithText'),
(243, 43, 19, 'accepted', 'questionWithText'),
(244, 43, 19, 'accepted', 'questionWithText'),
(245, 43, 19, 'accepted', 'questionWithText'),
(246, 43, 19, 'accepted', 'questionWithText'),
(247, 43, 19, 'accepted', 'questionWithText'),
(248, 43, 19, 'accepted', 'questionWithText'),
(249, 43, 19, 'accepted', 'questionWithText'),
(250, 43, 19, 'accepted', 'questionWithText'),
(251, 43, 19, 'accepted', 'questionWithText'),
(252, 43, 19, 'accepted', 'questionWithText'),
(253, 43, 19, 'accepted', 'questionWithText'),
(254, 43, 19, 'accepted', 'questionWithText'),
(255, 43, 19, 'accepted', 'questionWithText'),
(256, 43, 19, 'accepted', 'questionWithText'),
(257, 43, 19, 'accepted', 'questionWithText'),
(258, 43, 19, 'accepted', 'questionWithText'),
(259, 43, 20, 'accepted', 'questionWithText'),
(260, 43, 20, 'accepted', 'questionWithText'),
(261, 43, 20, 'accepted', 'questionWithText'),
(262, 43, 20, 'accepted', 'questionWithText'),
(263, 43, 20, 'accepted', 'questionWithText'),
(264, 43, 20, 'accepted', 'questionWithText'),
(265, 43, 20, 'accepted', 'questionWithText'),
(266, 43, 20, 'accepted', 'questionWithText'),
(267, 43, 20, 'accepted', 'questionWithText'),
(268, 43, 20, 'accepted', 'questionWithText'),
(269, 43, 20, 'accepted', 'questionWithText'),
(270, 43, 20, 'accepted', 'questionWithText'),
(271, 43, 20, 'accepted', 'questionWithText'),
(272, 43, 20, 'accepted', 'questionWithText'),
(273, 43, 20, 'accepted', 'questionWithText'),
(274, 43, 20, 'accepted', 'questionWithText'),
(275, 43, 20, 'accepted', 'questionWithText'),
(276, 43, 20, 'accepted', 'questionWithText'),
(277, 43, 20, 'accepted', 'questionWithText'),
(278, 43, 20, 'accepted', 'questionWithText'),
(279, 43, 21, 'accepted', 'questionWithText'),
(280, 43, 21, 'accepted', 'questionWithText'),
(281, 43, 21, 'accepted', 'questionWithText'),
(282, 43, 21, 'accepted', 'questionWithText'),
(283, 43, 21, 'accepted', 'questionWithText'),
(284, 43, 21, 'accepted', 'questionWithText'),
(285, 43, 21, 'accepted', 'questionWithText'),
(286, 43, 21, 'accepted', 'questionWithText'),
(287, 43, 21, 'accepted', 'questionWithText'),
(288, 43, 21, 'accepted', 'questionWithText'),
(289, 43, 21, 'accepted', 'questionWithText'),
(290, 43, 21, 'accepted', 'questionWithText'),
(291, 43, 21, 'accepted', 'questionWithText'),
(292, 43, 21, 'accepted', 'questionWithText'),
(293, 43, 21, 'accepted', 'questionWithText'),
(294, 43, 21, 'accepted', 'questionWithText'),
(295, 43, 21, 'accepted', 'questionWithText'),
(296, 43, 21, 'accepted', 'questionWithText'),
(297, 43, 21, 'accepted', 'questionWithText'),
(298, 43, 21, 'accepted', 'questionWithText'),
(299, 43, 21, 'accepted', 'questionWithText'),
(300, 44, 22, 'accepted', 'questionWithPicture'),
(301, 44, 22, 'accepted', 'questionWithPicture'),
(302, 44, 23, 'accepted', 'questionWithPicture'),
(303, 44, 23, 'accepted', 'questionWithPicture'),
(304, 44, 23, 'accepted', 'questionWithPicture'),
(305, 44, 24, 'accepted', 'questionWithPicture'),
(306, 44, 24, 'accepted', 'questionWithPicture'),
(307, 44, 25, 'accepted', 'questionWithPicture'),
(308, 44, 25, 'accepted', 'questionWithPicture'),
(309, 44, 26, 'accepted', 'questionWithPicture'),
(310, 44, 26, 'accepted', 'questionWithPicture'),
(311, 44, 27, 'accepted', 'questionWithPicture'),
(312, 44, 27, 'accepted', 'questionWithPicture'),
(313, 44, 28, 'accepted', 'questionWithPicture'),
(314, 44, 28, 'accepted', 'questionWithPicture');

-- --------------------------------------------------------

--
-- Structure de la table `question_with_picture`
--

DROP TABLE IF EXISTS `question_with_picture`;
CREATE TABLE IF NOT EXISTS `question_with_picture` (
  `id` int(11) NOT NULL,
  `link_picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `question_with_picture`
--

INSERT INTO `question_with_picture` (`id`, `link_picture`) VALUES
(300, 'astar.jpg'),
(301, 'titanic.jpg'),
(302, 'DrHouse.jpg'),
(303, 'citedor.jpg'),
(304, 'psych.jpg'),
(305, 'zelda.jpg'),
(306, 'super-mario-odyssey.jpg'),
(307, 'chromatica.jpg'),
(308, 'Du-Phoenix-aux-etoiles.jpg'),
(309, 'kaguya.jpg'),
(310, '44cafe894c519dc4595f2c4c47a6997c.jpg'),
(311, 'JD.jpg'),
(312, 'jean-paul-rouve.jpg'),
(313, 'Blackpink-la-pop-coreenne-a-l-assaut-du-monde.jpg'),
(314, 'hendrix.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `question_with_text`
--

DROP TABLE IF EXISTS `question_with_text`;
CREATE TABLE IF NOT EXISTS `question_with_text` (
  `id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `question_with_text`
--

INSERT INTO `question_with_text` (`id`, `text`) VALUES
(161, 'Quelle est la date à laquelle à eu lieu le bombardement de Nagasaki ?'),
(162, 'En quelle année a eu lieu la chute du mur de Berlin ?'),
(163, 'De quel pays Adolf Hitler a-t-il été le chancelier ?'),
(164, 'Quelle était la nationalité de Benito Mussolini ?'),
(165, 'En quelle année l\'URSS a-t-elle éclatée ?'),
(166, 'Dans quelle ville fut pronocé l\'appel du 18 juin ?'),
(167, 'Combien de septennats a fait François Mitterrand ?'),
(168, 'Quelle était la nationalité de Charles de Gaulle ?'),
(169, 'En quelle année fut l\'abolition définitive de l\'esclavage en France ?'),
(170, 'En quelle année a début la guerre de 30 ans ?'),
(171, 'Quel roi fut décapité ?'),
(172, 'Quel est le surnom de Jeanne d\'Arc ?'),
(173, 'En quelle année, la guerre d’Algérie a-t-elle pris fin ?'),
(174, 'Qui est le père de Charlemagne ?'),
(175, 'Quelle est le siècle d\'apparition du christiannisme ?'),
(176, 'De quel origine est Siddharta Gautama, le chef spirituel qui donna naissance au Bouddhisme ?'),
(177, 'Quel conflict militaire oriental a duré de 1937 à 1945 ? ?'),
(178, 'Entre 1945 et 1946, dans quel pays s\'est déroulé le fameux procès de Nuremberg ?'),
(179, 'Quelle est la capitale de la Géorgie ?'),
(180, 'Quelle est la capitale du Sénégal ?'),
(181, 'Quelle est la mer qui se situe juste au Sud de l\'Ukraine ?'),
(182, 'Quel est le pays qui a la plus grande superficie entre le Soudan et le Kenya ?'),
(183, 'La Palestine est-il un pays ?'),
(184, 'Quelle est la capitale de l\'Equateur ?'),
(185, 'La Micronésie est-il un pays ?'),
(186, 'Naypyidaw est la capitale de... ?'),
(187, 'Combien de pays existe officiellement ?'),
(188, 'Quel est le plus long fleuve du monde ?'),
(189, 'Quel pays se situe le plus au Sud entre l\'Estonie, la Lettonie et la Lituanie ?'),
(190, 'Combien de mers existent-ils au monde ?'),
(191, 'Quelle est la capitale de la République Dominicaine ?'),
(192, 'L\'océanie est-il un continent ?'),
(193, 'Quelle est la mer ayant la surperficie la plus petite au monde ?'),
(194, 'Quelle est la capitale du Cambodge ?'),
(195, 'Quelle est le pays  du Cambodge ?'),
(196, 'Dans quel pays se situe le mont ararat ?'),
(197, 'Quel est la ville la plus au Sud de la France entre l\'Avignon et Alès ?'),
(198, 'Dans quelle continent se situe les îles Canaries'),
(199, 'Dans quel film peut-on entendre: \'QUI C\'EST QUE TU TRAITES DE BANANE ? BANANE!\' '),
(200, ' \'L\'Arrivée d\'un train en gare de La Ciotat\' : qui sont les réalisateurs de ce film datant de 1895 ? '),
(201, 'Quel est le premier film de Charlie Chaplin qui a dépassé la durée d\'une heure ?'),
(202, 'Dans quel film peut-on entendre:\'Je trépasse si je faibli\' ? '),
(203, 'Quelle fut le meilleur film 2020 ?'),
(204, 'Edward aux mains... ?'),
(205, 'En quelle année Léonardo Dicaprio a eu son premier oscar ?'),
(206, 'Quel est le véritable nom de Marylin Monroe ?'),
(207, 'Quel est le nom de la mère de Simba dans \'Le roi Lion\''),
(208, 'Dans quel film peut-on entendre: \'T\'es sourd mc flan espèce de crème anglaise\' ? '),
(209, 'Qui a réalisé Oliver Twist ?'),
(210, 'Pour quel film muet a joué Jean Dujardin ?'),
(211, 'De quel film est tiré la phrase \'Un Anneau pour les gouverner tous, \r\n                        un Anneau pour les trouver, Un Anneau pour les amener tous et dans les ténèbres les lier\' ?'),
(212, 'Qui est le compositeur de la musique du \'Roi Lion\' de 1994 ?'),
(213, 'Le combientième art est le cinéma ?'),
(214, 'Dans la saga Twilight, Jacob Black était un humain et un...?'),
(215, 'Qui est Féline dans Bambi?'),
(216, 'En quelle année sorti le premier film de Harry Potther?'),
(217, 'Dans quel film peut-on entendre: \'Vous voulez un whisky ? Juste un doigt. \r\n                        Vous voulez pas un whisky d\'abord? \' '),
(218, 'Quelle rôle à jouer Leonardo Dicaprio dans Roméo et Juliette (1996)?'),
(219, 'Je suis bleu, j\'habite à Pandora et je vole sur le grand Leonopteryx. \r\n                        Quel est le film dans lequel je joue ?'),
(220, 'Combien la série les Simpsons compte-elle de saison ?'),
(221, 'Comment s\'appelle la série dramatique crée par Peter Morgan qui conte l\'histoire de la reine Elizabeth II?'),
(222, 'Dans quel registre littéraire joue Charlie Chaplin ?'),
(223, 'Combien de saisons \'Le Prince de Bel-Air compte-til\' ?'),
(224, 'Quelle est la série longue de l\'histoire ?'),
(225, 'Quel est le nom du dernier frère de Malcolm ?'),
(226, 'Quel est le meilleur film de tous les temps ?'),
(227, 'Dans quel série Meghan Markle joue-t-elle le rôle de Rachel Zane Ross ?'),
(228, 'Qui dit \'Quoi de neuf docteur\'?'),
(229, 'Qui est A (Pretty Little Liars) ?'),
(230, 'Combien d\'enfants ont la famille Kyle (ma famille d\'abord)?'),
(231, 'Dans quel film Omar Sy joue-t-il le rôle d\'Assane Diop ?'),
(232, 'De quelle série provient cette réplique: \'Pierre, feuille, ciseaux, lézard, spoke\'?'),
(233, 'Qui joue le rôle de Elizabeth Betty Cooper dans Riverdale ?'),
(234, 'Dans quelle animé la mère du protagonniste se fait dévorer par un Titan?'),
(235, 'D\'où provient la réplique \'Dès qu\'il y aura du sang versé, on ne sera plus robin des bois, mais une bande de crétins\' ?'),
(236, 'D\'où provient la réplique \'Mon nom est Eikichi Onizuka 22 ans célibataire et libre comme l\'air\' ?'),
(237, 'Quelle est le pays d\'origine de Scooby-Doo?'),
(238, 'Orange is the new...'),
(239, 'Quel est l\'accronyme correspondant au jeux vidéo de rôle?'),
(240, 'Comment s\'appelle le protagoniste de Final Fantasy ?'),
(241, 'Comment s\'appelle l\'héroïne des jeux Metroid ?'),
(242, 'D\'où vient l\'abréviation LOL ?'),
(243, 'Quel est le nom du jeu vidéo Pokemon qui offre une réalité augmentée ?'),
(244, 'Dans quel jeu le joueur peut il être plongé dans un monde de blocs ?'),
(245, 'Quel est le nom du protagoniste féminin du jeu \'The Last Of Us\'?'),
(246, 'Dans quel jeux vidéo Luigi visite un manoir?'),
(247, 'Comment s\'appelle l\'aventurière qui hérite de la mystérieuse horloge de son père, recherché par l\'organisation secrète les Illuminati ?'),
(248, 'Quel animal est Sly Cooper ?'),
(249, 'De quels mots proviennent l\'acronyme GTA'),
(250, 'Je suis une petite boule rose originaire de la planète Popstar et qui aspire ses ennemis pour copier leurs pouvoirs. Qui suis-je?'),
(251, 'Quel est l\'entreprise à l\'origine d\'Assassin\'s Creed ?'),
(252, 'Que signifie le sigle NES ?'),
(253, 'Quel animal représente Sonic ?'),
(254, 'Comment s\'appelle la version mobile de League Of Legends ?'),
(255, 'Dans quel jeu apparaît Trico, le grand aigle mangeur d\'hommes ?'),
(256, 'Quel est le jeu le plus vendu sur Switch ?'),
(257, 'En quelle année Nintendo lance-elle sa première console de jeux vidéo ?'),
(258, 'Qui est le frère de Mario ?'),
(259, 'Comment appelle-t-on le fait de comptabiliser au moins dix unités dans trois catégories statistiques différentes lors d\'un match ?'),
(260, 'Comment appelle-t-on les lunettes de protection conçues spécialement pour la pratique du basket-ball ?'),
(261, 'Combien de fois Larry Bird a t-il été MVP de la saison ?'),
(262, 'Quel est le vrai prénom de Magic Johnson ?'),
(263, 'Comment appelle-t-on la violation que commet le joueur qui possède le ballon prend plus de deux appuis sans dribbler.?'),
(264, 'Quelle équipe joue dans l\'America West Arena ?'),
(265, 'Dans quelle équipe joue Lebron James ?'),
(266, 'Quelle est la dernière équipe de l\'Est avant Chicago à avoir remporté‚ le titre NBA ?'),
(267, 'Comment appelle-t-on l\'action de faire rebondir la balle sur le terrain avec une main pour se déplacer. ?'),
(268, 'Qui a été élu Rookie de l\'année en 1992 ?'),
(269, 'Quel numéro portait Isiah Thomas?'),
(270, 'Bobby Knight est le célèbre coach d\'une équipe universitaire. Laquelle ?'),
(271, 'La mascotte des Houston Rockets s\'appelle... ?'),
(272, 'Dans quel équipe joue Kevin Durant?'),
(273, 'Quel est le nom de l\'action variante au dribble et qui est accompagnée d\'un changement de main dans le but de passer un adversaire direct ?'),
(274, 'Quel joueur avait la réputation d\'être le plus détesté‚ de la NBA ?'),
(275, 'Quel a été le résultat de la finale 1992 gagnée par les Bulls contre les Blazers ?'),
(276, 'Dans quel club joue Stephen Curry ?'),
(277, 'Quelle est le nom de l\'action de prendre le ballon à l\'adversaire, soit de ses mains (sans commettre de faute), soit en attrapant une passe de celui-ci ?'),
(278, 'Dans quel club jouait Michael Jordan ?'),
(279, 'Qui a inventé le foot ?'),
(280, 'Qui est l\'entraineur du Real de l\'équipe de France de foot 2020-2021 ?'),
(281, 'Combien de temps dure un match de foot avec prolongation ?'),
(282, 'Qui est l\'entraineur du Real de Madrid 2020-2021 ?'),
(283, 'Qui est l\'officiel qui fait respecter les règles ?'),
(284, 'Combien de ballon d\'or a remporté Lionel Messi ?'),
(285, 'Dans quelle équipe appartient Andrés Escobar Saldarriaga ?'),
(286, 'Quelle est la seule protection obligatoire pour un footballeur ?'),
(287, 'Quel est l’équipementier actuel de l’Équipe de France ?'),
(288, 'En quelle année Neymar est-il rentré dans le PSG ?'),
(289, 'Combien de temps l\'équipe qui attaque a-t-elle le droit de rester dans la raquette ?'),
(290, 'Dans quel centre de préformation Blaise Matuidi a-t-il été formé ?'),
(291, 'Quel club détient le record de victoires en Coupe de France ?'),
(292, 'Quel est le nom du sélectionneur de l’Équipe de France depuis juillet 2012 ?'),
(293, 'Qui dirige les arbitres français ?'),
(294, 'Contre quel pays la France a-t-elle gagné en finale de la Coupe du monde 1998 ?'),
(295, 'De quelle ville vient Kiliane Mbappe ?'),
(296, 'Quel dirigeant de la FFF a créé le Tournoi de France féminin ?'),
(297, 'Que font les équipes professionnelles la veille d’un match ?'),
(298, 'Quelle chanson les joueurs chantent-ils avant chaque match de l’Équipe de France ?'),
(299, 'Qui était l’entraîneur de l’Équipe de France lors de la victoire en Coupe du monde 1998 ?');

-- --------------------------------------------------------

--
-- Structure de la table `reset_password_request`
--

DROP TABLE IF EXISTS `reset_password_request`;
CREATE TABLE IF NOT EXISTS `reset_password_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_7CE748AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_settings_id` int(11) DEFAULT NULL,
  `host_id` int(11) NOT NULL,
  `name` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `started_at` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_729F519B4DA136B7` (`room_settings_id`),
  KEY `IDX_729F519B1FB8D185` (`host_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `room`
--

INSERT INTO `room` (`id`, `room_settings_id`, `host_id`, `name`, `created_at`, `started_at`, `finished_at`, `is_private`) VALUES
(12, 12, 81, 'Salon de xverdier', '2021-03-25 01:14:23', NULL, NULL, 0),
(13, 13, 82, 'Salon de matthieu79', '2021-03-25 01:14:23', NULL, NULL, 0),
(14, 14, 83, 'Salon de bertrand40', '2021-03-25 01:14:23', NULL, NULL, 0),
(15, 15, 84, 'Salon de theophile.traore', '2021-03-25 01:14:23', NULL, NULL, 0),
(16, 16, 85, 'Salon de anouk06', '2021-03-25 01:14:23', NULL, NULL, 0),
(17, 17, 86, 'Salon de joseph.colette', '2021-03-25 01:14:23', NULL, NULL, 0),
(18, 18, 87, 'Salon de luc.pereira', '2021-03-25 01:14:23', NULL, NULL, 0),
(19, 19, 88, 'Salon de maury.jerome', '2021-03-25 01:14:24', NULL, NULL, 0),
(20, 20, 89, 'Salon de fouquet.dominique', '2021-03-25 01:14:24', NULL, NULL, 0),
(21, 21, 90, 'Salon de olivie.marchal', '2021-03-25 01:14:24', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `room_settings`
--

DROP TABLE IF EXISTS `room_settings`;
CREATE TABLE IF NOT EXISTS `room_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_player_id` int(11) DEFAULT NULL,
  `nb_max_player` int(11) NOT NULL,
  `show_score` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `one_answer_only` tinyint(1) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `name_profil` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number_round` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45A3600119D349F8` (`id_player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `room_settings`
--

INSERT INTO `room_settings` (`id`, `id_player_id`, `nb_max_player`, `show_score`, `created_at`, `one_answer_only`, `deleted_at`, `name_profil`, `number_round`) VALUES
(12, 81, 10, 0, '2021-03-25 01:14:23', 1, NULL, 'Profil n°1 dexverdier', 10),
(13, 82, 10, 0, '2021-03-25 01:14:23', 1, NULL, 'Profil n°1 dematthieu79', 10),
(14, 83, 10, 0, '2021-03-25 01:14:23', 1, NULL, 'Profil n°1 debertrand40', 10),
(15, 84, 10, 0, '2021-03-25 01:14:23', 1, NULL, 'Profil n°1 detheophile.traore', 10),
(16, 85, 10, 0, '2021-03-25 01:14:23', 1, NULL, 'Profil n°1 deanouk06', 10),
(17, 86, 10, 0, '2021-03-25 01:14:23', 1, NULL, 'Profil n°1 dejoseph.colette', 10),
(18, 87, 10, 0, '2021-03-25 01:14:23', 1, NULL, 'Profil n°1 deluc.pereira', 10),
(19, 88, 10, 0, '2021-03-25 01:14:24', 1, NULL, 'Profil n°1 demaury.jerome', 10),
(20, 89, 10, 0, '2021-03-25 01:14:24', 1, NULL, 'Profil n°1 defouquet.dominique', 10),
(21, 90, 10, 0, '2021-03-25 01:14:24', 1, NULL, 'Profil n°1 deolivie.marchal', 10);

-- --------------------------------------------------------

--
-- Structure de la table `room_settings_game`
--

DROP TABLE IF EXISTS `room_settings_game`;
CREATE TABLE IF NOT EXISTS `room_settings_game` (
  `room_settings_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  PRIMARY KEY (`room_settings_id`,`game_id`),
  KEY `IDX_2E78C75D4DA136B7` (`room_settings_id`),
  KEY `IDX_2E78C75DE48FD905` (`game_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `round`
--

DROP TABLE IF EXISTS `round`;
CREATE TABLE IF NOT EXISTS `round` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `index_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C5EEEA3454177093` (`room_id`),
  KEY `IDX_C5EEEA341E27F6BF` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

DROP TABLE IF EXISTS `score`;
CREATE TABLE IF NOT EXISTS `score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_329937519A4AA658` (`guest_id`),
  KEY `IDX_3299375154177093` (`room_id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `score`
--

INSERT INTO `score` (`id`, `guest_id`, `room_id`, `score`) VALUES
(41, 81, 12, 0),
(42, 46, 12, 0),
(43, 47, 12, 0),
(44, 48, 12, 0),
(45, 82, 13, 0),
(46, 49, 13, 0),
(47, 50, 13, 0),
(48, 51, 13, 0),
(49, 52, 13, 0),
(50, 53, 13, 0),
(51, 54, 13, 0),
(52, 55, 13, 0),
(53, 83, 14, 0),
(54, 56, 14, 0),
(55, 57, 14, 0),
(56, 58, 14, 0),
(57, 84, 15, 0),
(58, 59, 15, 0),
(59, 60, 15, 0),
(60, 61, 15, 0),
(61, 62, 15, 0),
(62, 85, 16, 0),
(63, 63, 16, 0),
(64, 64, 16, 0),
(65, 65, 16, 0),
(66, 86, 17, 0),
(67, 66, 17, 0),
(68, 87, 18, 0),
(69, 88, 19, 0),
(70, 67, 19, 0),
(71, 68, 19, 0),
(72, 69, 19, 0),
(73, 70, 19, 0),
(74, 71, 19, 0),
(75, 89, 20, 0),
(76, 72, 20, 0),
(77, 73, 20, 0),
(78, 74, 20, 0),
(79, 75, 20, 0),
(80, 76, 20, 0),
(81, 90, 21, 0),
(82, 77, 21, 0),
(83, 78, 21, 0),
(84, 79, 21, 0),
(85, 80, 21, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `lib_sub_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BCE3F79812469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `lib_sub_category`) VALUES
(15, 5, 'Histoire'),
(16, 5, 'Géographie'),
(17, 6, 'Cinéma'),
(18, 6, 'Série'),
(19, 6, 'jeux Vidéo'),
(20, 7, 'Basket'),
(21, 7, 'Foot'),
(22, 8, 'Film'),
(23, 8, 'Série'),
(24, 8, 'Jeux Vidéo'),
(25, 8, 'Album'),
(26, 8, 'Anime'),
(27, 8, 'Acteur'),
(28, 8, 'Artiste musical');

-- --------------------------------------------------------

--
-- Structure de la table `sub_category_room_settings`
--

DROP TABLE IF EXISTS `sub_category_room_settings`;
CREATE TABLE IF NOT EXISTS `sub_category_room_settings` (
  `sub_category_id` int(11) NOT NULL,
  `room_settings_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_category_id`,`room_settings_id`),
  KEY `IDX_311C8F00F7BFE87C` (`sub_category_id`),
  KEY `IDX_311C8F004DA136B7` (`room_settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sub_category_room_settings`
--

INSERT INTO `sub_category_room_settings` (`sub_category_id`, `room_settings_id`) VALUES
(15, 14),
(15, 17),
(16, 14),
(16, 16),
(16, 17),
(16, 19),
(16, 21),
(17, 13),
(18, 17),
(18, 18),
(19, 20),
(20, 12),
(20, 13),
(20, 16),
(20, 20),
(20, 21),
(21, 13),
(21, 16),
(21, 17),
(21, 19),
(21, 20),
(22, 14),
(22, 15),
(22, 16),
(22, 20),
(23, 15),
(23, 19),
(24, 12),
(24, 18),
(24, 19),
(24, 21),
(25, 12),
(25, 13),
(25, 15),
(25, 18),
(26, 15),
(26, 18),
(26, 19),
(26, 20),
(27, 15),
(27, 16),
(28, 12),
(28, 14),
(28, 17);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `FK_DADD4A251E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `FK_64C19C1E48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`);

--
-- Contraintes pour la table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `FK_98197A65BF396750` FOREIGN KEY (`id`) REFERENCES `guest` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E99E6F5DF` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`),
  ADD CONSTRAINT `FK_B6F7494EF7BFE87C` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`);

--
-- Contraintes pour la table `question_with_picture`
--
ALTER TABLE `question_with_picture`
  ADD CONSTRAINT `FK_8CDC8A28BF396750` FOREIGN KEY (`id`) REFERENCES `question` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `question_with_text`
--
ALTER TABLE `question_with_text`
  ADD CONSTRAINT `FK_E8B61C77BF396750` FOREIGN KEY (`id`) REFERENCES `question` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `player` (`id`);

--
-- Contraintes pour la table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_729F519B1FB8D185` FOREIGN KEY (`host_id`) REFERENCES `player` (`id`),
  ADD CONSTRAINT `FK_729F519B4DA136B7` FOREIGN KEY (`room_settings_id`) REFERENCES `room_settings` (`id`);

--
-- Contraintes pour la table `room_settings`
--
ALTER TABLE `room_settings`
  ADD CONSTRAINT `FK_45A3600119D349F8` FOREIGN KEY (`id_player_id`) REFERENCES `player` (`id`);

--
-- Contraintes pour la table `room_settings_game`
--
ALTER TABLE `room_settings_game`
  ADD CONSTRAINT `FK_2E78C75D4DA136B7` FOREIGN KEY (`room_settings_id`) REFERENCES `room_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2E78C75DE48FD905` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `round`
--
ALTER TABLE `round`
  ADD CONSTRAINT `FK_C5EEEA341E27F6BF` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `FK_C5EEEA3454177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`);

--
-- Contraintes pour la table `score`
--
ALTER TABLE `score`
  ADD CONSTRAINT `FK_3299375154177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `FK_329937519A4AA658` FOREIGN KEY (`guest_id`) REFERENCES `guest` (`id`);

--
-- Contraintes pour la table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `FK_BCE3F79812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `sub_category_room_settings`
--
ALTER TABLE `sub_category_room_settings`
  ADD CONSTRAINT `FK_311C8F004DA136B7` FOREIGN KEY (`room_settings_id`) REFERENCES `room_settings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_311C8F00F7BFE87C` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
