<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Answer;
use App\Entity\Category;
use App\Entity\Game;
use App\Entity\Guest;
use App\Entity\Player;
use App\Entity\Question;
use App\Entity\QuestionWithPicture;
use App\Entity\QuestionWithText;
use App\Entity\Room;
use App\Entity\RoomSettings;
use App\Entity\Round;
use App\Entity\Score;
use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");

        $gamesTab = [
            "Quiz" => [
                "Culture" => [
                    "Histoire" => [
                        "Quelle est la date à laquelle à eu lieu le bombardement de Nagasaki ?" => [
                            "9 août 1945", "9 aout 1945 ", "neuf aout 1945", "neuf août 1945", "neuf aout mille neuf cent quarante cinq", "neuf août mille neuf cent quarante cing", "9 août mille neuf cent quarante cing"
                        ],
                        "En quelle année a eu lieu la chute du mur de Berlin ?" => [
                            "1989", "mille neuf cent quarante neuf"
                        ],
                        "De quel pays Adolf Hitler a-t-il été le chancelier ?" => [
                            "Allemagne", "allemagne"
                        ],
                        "Quelle était la nationalité de Benito Mussolini ?" => [
                            "Italienne", "italienne"
                        ],
                        "En quelle année l'URSS a-t-elle éclatée ?" => [
                            "1991"
                        ],
                        "Dans quelle ville fut pronocé l'appel du 18 juin ?" => [
                            "Londres", "londres"
                        ],
                        "Combien de septennats a fait François Mitterrand ?" => [
                            "deux", "2", "Deux"
                        ],
                        "Quelle était la nationalité de Charles de Gaulle ?" => [
                            "Française", "francaise", "française", "Francaise"
                        ],
                        "En quelle année fut l'abolition définitive de l'esclavage en France ?" => [
                            "1848", "mille huit cent quarante huit"
                        ],
                        "En quelle année a début la guerre de 30 ans ?" => [
                            "1618", "mille six cent dix huit"
                        ],
                        "Quel roi fut décapité ?" => [
                            "Louis XVI", "Louis xvi", "Louis 16", "louis 16", "louis XVI"
                        ],
                        "Quel est le surnom de Jeanne d'Arc ?" => [
                            "la pucelle", "la pucelle d'orléans", "la pucelle d'Orléans", "la pucelle d'orléan",
                            "la pucelle d'Orléan"
                        ],
                        "En quelle année, la guerre d’Algérie a-t-elle pris fin ?" => [
                            "1962", "mille neuf soixante deux"
                        ],
                        "Qui est le père de Charlemagne ?" => [
                            "Pépin Le Bref", "pepin le bref", "pepin lebref", "pépin le bref", "pépin"
                        ],
                        "Quelle est le siècle d'apparition du christiannisme ?" => [
                            "premier siècle", "premier siecle", "1 siecle", "1 siècle", "Is"
                        ],
                        "De quel origine est Siddharta Gautama, le chef spirituel qui donna naissance au Bouddhisme ?" => [
                            "indien", "népalais", "indien et népalais"
                        ],
                        "Quel conflict militaire oriental a duré de 1937 à 1945 ? ?" =>[
                            "guerre sino-japonaise", "guerre sino japonaise", "sino-japonaise", "sino japonaise",
                            "chine contre japon", "japon contre chine", "japon chine", "chine japon"
                        ],
                        "Entre 1945 et 1946, dans quel pays s'est déroulé le fameux procès de Nuremberg ?" =>[
                            "allemagne", "Allemagne"
                        ]
                    ],
                    "Géographie" => [
                        "Quelle est la capitale de la Géorgie ?" => [
                            "tbilissi"
                        ],
                        "Quelle est la capitale du Sénégal ?" => [
                            "dakar", "Dakar"
                        ],
                        "Quelle est la mer qui se situe juste au Sud de l'Ukraine ?" => [
                            "la mer noire", "La Mer Noire", "la Mer Noire"
                        ],
                        "Quel est le pays qui a la plus grande superficie entre le Soudan et le Kenya ?" => [
                            "Soudan", "le soudan", "le Soudan", "soudan", "Le Soudan"
                        ],
                        "La Palestine est-il un pays ?" => [
                            "non", "Non"
                        ],
                        "Quelle est la capitale de l'Equateur ?" => [
                            "quito", "Quito"
                        ],
                        "La Micronésie est-il un pays ?" => [
                            "non", "Non"
                        ],
                        "Naypyidaw est la capitale de... ?" => [
                            "Birmanie", "birmanie"
                        ],
                        "Combien de pays existe officiellement ?" => [
                            "197", "cent quatre vingt dix sept"
                        ],
                        "Quel est le plus long fleuve du monde ?" => [
                            "le Nil", "Le Nil", "le nil"
                        ],
                        "Quel pays se situe le plus au Sud entre l'Estonie, la Lettonie et la Lituanie ?" => [
                            "la lituanie'", "la Lituanie", "lituanie", "Lituanie"
                        ],
                        "Combien de mers existent-ils au monde ?" => [
                            "87", "quatre vingt sept"
                        ],
                        "Quelle est la capitale de la République Dominicaine ?" => [
                            "Saint-Domingue", "Saint Domingue", "saint-domingue", "saint domingue"
                        ],
                        "L'océanie est-il un continent ?" => [
                            "non", "Non"
                        ],
                        "Quelle est la mer ayant la surperficie la plus petite au monde ?" => [
                            "Mer des Wadden", "mer des wadden",
                        ],
                        "Quelle est la capitale du Cambodge ?" => [
                            "Phnom Penh", "phnom penh",
                        ],
                        "Quelle est le pays  du Cambodge ?" => [
                            "Phnom Penh", "phnom penh",
                        ],
                        "Dans quel pays se situe le mont ararat ?" => [
                            "turquie", "Turquie"
                        ],
                        "Quel est la ville la plus au Sud de la France entre l'Avignon et Alès ?" => [
                            "Avignon", "avignon"
                        ],
                        "Dans quelle continent se situe les îles Canaries" => [
                            "africain"
                        ]
                    ]
                ],
                "Divertissement" => [
                    "Cinéma" => [
                        "Dans quel film peut-on entendre: 'QUI C'EST QUE TU TRAITES DE BANANE ? BANANE!' " => [
                            "Retour vers le futur", "retour vers le futur", "Retour vers le Futur",
                        ],
                        " 'L'Arrivée d'un train en gare de La Ciotat' : qui sont les réalisateurs de ce film datant de 1895 ? " => [
                            "les frères lumière", "les frères Lumière", "frères Lumière", "Frères Lumière", "Frères lumière", "frères lumière"
                        ],
                        "Quel est le premier film de Charlie Chaplin qui a dépassé la durée d'une heure ?" => [
                            "The Kid", "the Kid", "The kid", "the kid"
                        ],
                        "Dans quel film peut-on entendre:'Je trépasse si je faibli' ? " => [
                            "les visiteurs", "Les visiteurs", "Les Visiteurs", "Les visiteurs"
                        ],
                        "Quelle fut le meilleur film 2020 ?" => [
                            "parasite"
                        ],
                        "Edward aux mains... ?" => [
                            "d'argent"
                        ],
                        "En quelle année Léonardo Dicaprio a eu son premier oscar ?" => [
                            "2016", "deux mille seize"
                        ],
                        "Quel est le véritable nom de Marylin Monroe ?" => [
                            "Norma Jean Baker", "Norma", "norma", "norma jean baker"
                        ],
                        "Quel est le nom de la mère de Simba dans 'Le roi Lion'" => [
                            "Sarabi", "sarabi"
                        ],
                        "Dans quel film peut-on entendre: 'T'es sourd mc flan espèce de crème anglaise' ? " => [
                            "retour vers le futur 1", "Retour vers le futur 1", "Retour vers le Futur 1" ,
                            "Retour vers le Futur", "retour vers le futur"
                        ],
                        "Qui a réalisé Oliver Twist ?" => [
                            "Roman Polanski", "roman polanski"
                        ],
                        "Pour quel film muet a joué Jean Dujardin ?" => [
                            "the artist"
                        ],
                        "De quel film est tiré la phrase 'Un Anneau pour les gouverner tous, 
                        un Anneau pour les trouver, Un Anneau pour les amener tous et dans les ténèbres les lier' ?" => [
                            "le seigneur des anneaux", "Le seigneur des anneaux"
                        ],
                        "Qui est le compositeur de la musique du 'Roi Lion' de 1994 ?" => [
                            "Hans Zimmer"
                        ],
                        "Le combientième art est le cinéma ?" => [
                            "7ème", "7 ème", "septième", "septieme", "le septieme", "le septième", "sept", "7", "Sept"
                        ],
                        "Dans la saga Twilight, Jacob Black était un humain et un...?" => [
                            "loup-garou", "Loup-garou", "loup garou", "Loup garou"
                        ],
                        "Qui est Féline dans Bambi?" => [
                            "La copine de Bambi", "la copine de Bambi", "l'amie de Bambi", "L'amie de Bambi"
                        ],
                        "En quelle année sorti le premier film de Harry Potther?" => [
                            "2001", "deux mille un"
                        ],
                        "Dans quel film peut-on entendre: 'Vous voulez un whisky ? Juste un doigt. 
                        Vous voulez pas un whisky d'abord? ' " => [
                            "La cité de la peur", "la cité de la peur", "la cite de la peur", "La cite de la peur"
                        ],
                        "Quelle rôle à jouer Leonardo Dicaprio dans Roméo et Juliette (1996)?" => [
                            "roméo", "romeo"
                        ]
                    ], "Série" => [
                        "Je suis bleu, j'habite à Pandora et je vole sur le grand Leonopteryx. 
                        Quel est le film dans lequel je joue ?" => [
                            "Avatar", "avatar"
                        ],
                        "Combien la série les Simpsons compte-elle de saison ?" => [
                            "32", "trente deux", "Trente deux"
                        ],
                        "Comment s'appelle la série dramatique crée par Peter Morgan qui conte l'histoire de la reine Elizabeth II?" => [
                            "The Crown", "the crown"
                        ],
                        "Dans quel registre littéraire joue Charlie Chaplin ?" => [
                            "Le burlesque", "le burlesque", "burlesque", "Burlesque"
                        ],
                        "Combien de saisons 'Le Prince de Bel-Air compte-til' ?" => [
                            "6", "six"
                        ],
                        "Quelle est la série longue de l'histoire ?" => [
                            "haine et passion", "guilding light"
                        ],
                        "Quel est le nom du dernier frère de Malcolm ?" => [
                            "Jamie", "jamie"
                        ],
                        "Quel est le meilleur film de tous les temps ?" => [
                            "Forrest Gump", "forrest gump"
                        ],
                        "Dans quel série Meghan Markle joue-t-elle le rôle de Rachel Zane Ross ?" => [
                            "Suits : Avocats sur mesure", "Suits Avocats sur mesure", "Suits", "suits"
                        ],
                        "Qui dit 'Quoi de neuf docteur'?" => [
                            "bugs bunny", "Bugs bunny", "Bugs Bunny"
                        ],
                        "Qui est A (Pretty Little Liars) ?" => [
                            "Alex Drake", "alex drake", "Alex"
                        ],
                        "Combien d'enfants ont la famille Kyle (ma famille d'abord)?" => [
                            "4", "quatre", "Quatre"
                        ],
                        "Dans quel film Omar Sy joue-t-il le rôle d'Assane Diop ?" => [
                            "lupin", "Lupin"
                        ],
                        "De quelle série provient cette réplique: 'Pierre, feuille, ciseaux, lézard, spoke'?" => [
                            "The big bang theory", "the big bang theory", "The Big Bang Theory",
                            "big bang theory", "Big ang theory",
                        ],
                        "Qui joue le rôle de Elizabeth Betty Cooper dans Riverdale ?" => [
                            "lili reinhart", "Lili Reinhart", "Lili reinhart"
                        ],
                        "Dans quelle animé la mère du protagonniste se fait dévorer par un Titan?" => [
                            "Attaque des titans", "attaque des titans", "snk",
                            "shingeki no kyojin", "Shingeki no kyojin"
                        ],
                        "D'où provient la réplique 'Dès qu'il y aura du sang versé, on ne sera plus robin des bois, mais une bande de crétins' ?" => [
                            "la casa de papel", "La casa de papel", "casa de papel"
                        ],
                        "D'où provient la réplique 'Mon nom est Eikichi Onizuka 22 ans célibataire et libre comme l'air' ?" => [
                            "GTO", "Great Teacher Onizuka", "great teacher onizuka", "Great teacher onizuka"
                        ],
                        "Quelle est le pays d'origine de Scooby-Doo?" => [
                            "Etats-Unis", "Etats_Unis", "Etats Unis"
                        ],
                        "Orange is the new..." => [
                            "Black", "black"
                        ]

                    ],
                    "jeux Vidéo" => [
                        "Quel est l'accronyme correspondant au jeux vidéo de rôle?" => [
                            "RPG", "rpg"
                        ],
                        "Comment s'appelle le protagoniste de Final Fantasy ?" => [
                            "Cloud", "cloud"
                        ],
                        "Comment s'appelle l'héroïne des jeux Metroid ?" => [
                            "samus", "Samus"
                        ],
                        "D'où vient l'abréviation LOL ?" => [
                            "league of legends", "League of legends"
                        ],
                        "Quel est le nom du jeu vidéo Pokemon qui offre une réalité augmentée ?" => [
                            "pokemon go", "Pokemon Go"
                        ],
                        "Dans quel jeu le joueur peut il être plongé dans un monde de blocs ?" => [
                            "Minecraft", "minecraft"
                        ],
                        "Quel est le nom du protagoniste féminin du jeu 'The Last Of Us'?" => [
                            "Ellie", "ellie"
                        ],
                        "Dans quel jeux vidéo Luigi visite un manoir?" => [
                            "Luigi's mansion", "Luigi's mansion 2", "Luigi's mansion 3",
                            "Luigi's Mansion", "Luigi's Mansion 2", "Luigi's Mansion 3",
                            "luigi's mansion", "luigi's mansion 2", "luigi's mansion 3",
                        ],
                        "Comment s'appelle l'aventurière qui hérite de la mystérieuse horloge de son père, recherché par l'organisation secrète les Illuminati ?" => [
                            "Lara Croft", "lara croft"
                        ],
                        "Quel animal est Sly Cooper ?" => [
                            "un raton laveur", "raton laveur", "Un raton laveur", "Raton laveur"
                        ],
                        "De quels mots proviennent l'acronyme GTA" => [
                            "Grand Theft Auto", "grand theft auto"
                        ],
                        "Je suis une petite boule rose originaire de la planète Popstar et qui aspire ses ennemis pour copier leurs pouvoirs. Qui suis-je?" => [
                            "Kirby", "kirby"
                        ],
                        "Quel est l'entreprise à l'origine d'Assassin's Creed ?" => [
                            "Ubisoft", "ubisoft"
                        ],
                        "Que signifie le sigle NES ?" => [
                            "Nintendo Entertainment System", "nintendo entertainment system"
                        ],
                        "Quel animal représente Sonic ?" => [
                            "hérisson", "Hérisson", "un hérisson", "Un hérisson"
                        ],
                        "Comment s'appelle la version mobile de League Of Legends ?" => [
                            "wild rift", "Wild Rift", "Wild rift"
                        ],
                        "Dans quel jeu apparaît Trico, le grand aigle mangeur d'hommes ?" => [
                            "The Last Guardian", "the last guardian"
                        ],
                        "Quel est le jeu le plus vendu sur Switch ?" => [
                            "Mario Kart 8 Deluxe", "mario kart 8 deluxe", "Mario kart 8 deluxe"
                        ],
                        "En quelle année Nintendo lance-elle sa première console de jeux vidéo ?" => [
                            "1977", "mille neuf cent soixante dix sept"
                        ],
                        "Qui est le frère de Mario ?" => [
                            "luigi"
                        ]
                    ]
                ],
                "Sport" => [
                    "Basket" => [
                        "Comment appelle-t-on le fait de comptabiliser au moins dix unités dans trois catégories statistiques différentes lors d'un match ?" => [
                            "triple-double", "triple double", "Triple-double", "Triple double"
                        ],
                        "Comment appelle-t-on les lunettes de protection conçues spécialement pour la pratique du basket-ball ?" => [
                            "Goggles", "goggles", "des Goggles", "des goggles"
                        ],
                        "Combien de fois Larry Bird a t-il été MVP de la saison ?" => [
                            "3", "3 fois", "trois", "Trois"
                        ],
                        "Quel est le vrai prénom de Magic Johnson ?" => [
                            "Earvin", "earvin"
                        ],
                        "Comment appelle-t-on la violation que commet le joueur qui possède le ballon prend plus de deux appuis sans dribbler.?" => [
                            "le marcher", "marcher", "Marcher", "Le marcher"
                        ],
                        "Quelle équipe joue dans l'America West Arena ?" => [
                            "Phoenix", "phoenix"
                        ],
                        "Dans quelle équipe joue Lebron James ?" => [
                            "Lakers de Los Angeles", "lakers de los angeles"
                        ],
                        "Quelle est la dernière équipe de l'Est avant Chicago à avoir remporté‚ le titre NBA ?" => [
                            "Detroit", "detroit"
                        ],
                        "Comment appelle-t-on l'action de faire rebondir la balle sur le terrain avec une main pour se déplacer. ?" => [
                            "Dribble", "dribble"
                        ],
                        "Qui a été élu Rookie de l'année en 1992 ?" => [
                            "Larry Johnson", "larry johnson", "Larry johnson"
                        ],
                        "Quel numéro portait Isiah Thomas?" => [
                            "11", "onze"
                        ],
                        "Bobby Knight est le célèbre coach d'une équipe universitaire. Laquelle ?" => [
                            "Indiana", "indiana"
                        ],
                        "La mascotte des Houston Rockets s'appelle... ?" => [
                            "Turbo", "turbo"
                        ],
                        "Dans quel équipe joue Kevin Durant?" => [
                            "Nets de Brooklyn", "nets de brooklyn"
                        ],
                        "Quel est le nom de l'action variante au dribble et qui est accompagnée d'un changement de main dans le but de passer un adversaire direct ?" => [
                            "Cross-over", "cross over", "Cross over", "cross-over"
                        ],
                        "Quel joueur avait la réputation d'être le plus détesté‚ de la NBA ?" => [
                            "Bill Laimbeer", "bill laimbeer", "Bill laimbeer"
                        ],
                        "Quel a été le résultat de la finale 1992 gagnée par les Bulls contre les Blazers ?" => [
                            "4-2", "4 2", "4/2", "4_2", "quatre à deux", "quatre a deux"
                        ],
                        "Dans quel club joue Stephen Curry ?" => [
                            "warriors de golden state", "Warriors de Golden State"
                        ],
                        "Quelle est le nom de l'action de prendre le ballon à l'adversaire, soit de ses mains (sans commettre de faute), soit en attrapant une passe de celui-ci ?" => [
                            "Interception", "interception", "Interception", "Arbitre"
                        ],
                        "Dans quel club jouait Michael Jordan ?" => [
                            "bulls de chicago", "bulls", "chicago bulls"
                        ]
                    ],
                    "Foot" => [
                        "Qui a inventé le foot ?" => [
                            "les anglais", "Les Anglais", "Les anglais", "les Anglais",
                            "l'Angleterre", "l'angleterre", "Angleterre", "angleterre"
                        ],
                        "Qui est l'entraineur du Real de l'équipe de France de foot 2020-2021 ?" => [
                            "Didier Deschamps", "didier deschamps"
                        ],
                        "Combien de temps dure un match avec prolongation ?" => [
                            "Zizou", "Zinédine Zidane", "Zinedine Zidane",
                        ],
                        "Qui est l'entraineur du Real de Madrid 2020-2021 ?" => [
                            "Zizou", "Zinédine Zidane", "Zinedine Zidane",
                        ],
                        "Qui est l'officiel qui fait respecter les règles ?" => [
                            "l'arbitre", "L'arbitre", "arbitre", "Arbitre"
                        ],
                        "Combien de ballon d'or a remporté Lionel Messi ?" => [
                            "6", "sixième", "6ème", "6 ème"
                        ],
                        "Dans quelle équipe appartient Andrés Escobar Saldarriaga ?" => [
                            "Atlético Nacional", "Atletico Nacional",
                            "atletico nacional"
                        ],
                        "Quelle est la seule protection obligatoire pour un footballeur ?" => [
                            "Les protège-tibias", "Les protège tibias",
                            "les protège-tibias", "les protège tibias",
                            "protège-tibias", "protège tibias",
                            "protege-tibias", "protege tibias",
                        ],
                        "Quel est l’équipementier actuel de l’Équipe de France ?" => [
                            "IN INF Clairefontaine", "in inf Clairefontaine"
                        ],
                        "En quelle année Neymar est-il rentré dans le PSG ?" => [
                            "2017", "deux mille dix sept"
                        ],
                        "Combien de temps l'équipe qui attaque a-t-elle le droit de rester dans la raquette ?" => [
                            "3", "trois"
                        ],
                        "Dans quel centre de préformation Blaise Matuidi a-t-il été formé ?" => [
                            "Nike", "nike"
                        ],
                        "Quel club détient le record de victoires en Coupe de France ?" => [
                            "L’Olympique de Marseille", "l’olympique de marseille",
                            "Le Paris Saint-Germain", "le Paris Saint-Germain",
                            "Paris Saint-Germain", "Paris Saint Germain",
                            "paris saint-germain", "paris saint germain",
                            "paris saint germain", "paris saint germain",
                        ],
                        "Quel est le nom du sélectionneur de l’Équipe de France depuis juillet 2012 ?" => [
                            "de bondy", "bondy"
                        ],
                        "Qui dirige les arbitres français ?" => [
                            "La FFF", "la FFF", "FFF", "Fédération française de football",
                            "fédération française de football", "fédération française de football",
                            "Fédération française de foot", "fédération française de foot",
                        ],
                        "Contre quel pays la France a-t-elle gagné en finale de la Coupe du monde 1998 ?" => [
                            "Le Brésil", "le brésil", "Brésil", "brésil"
                        ],
                        "De quelle ville vient Kiliane Mbappe ?" => [
                            "de bondy", "bondy"
                        ],
                        "Quel dirigeant de la FFF a créé le Tournoi de France féminin ?" => [
                            "Noël Le Graët", "noël le graët", "Noel Le Graet", "noel le graet"
                        ],
                        "Que font les équipes professionnelles la veille d’un match ?" => [
                            "Une mise au vert", "une mise au vert"
                        ],
                        "Quelle chanson les joueurs chantent-ils avant chaque match de l’Équipe de France ?" => [
                            "La Marseillaise", "la marseillaise","la Marseillaise"
                        ],
                        "Qui était l’entraîneur de l’Équipe de France lors de la victoire en Coupe du monde 1998 ?" => [
                            "Aimé Jacquet", "aimé jacquet","Aimé jacquet"
                        ]
                    ]
                ],
            ],
            "GuessThe" => [
                "Autre" => [
                    "Film" => [
                        "astar.jpg" => [
                            "a star is born", "A star is born",
                        ],
                        "titanic.jpg" => [
                            "titanic"
                        ]
                    ],
                    "Série" => [
                        "DrHouse.jpg" => [
                            "docteur house", "doctor house"
                        ],
                        "citedor.jpg" =>[
                            "Les mystérieuses cités d'or", "les mystérieuses cités d'or",
                        ],
                        "psych.jpg" => [
                            "psych enqueteur malgré lui", "Psych enqueteur malgré lui",
                            "psych enqueteur malgre lui", "Psych enqueteur malgre lui"
                        ]
                    ],
                    "Jeux Vidéo" => [
                        "zelda.jpg" => [
                            "legend of zelda breath of the wild", "Legend of zelda breath of the wild",
                        ],
                        "super-mario-odyssey.jpg" => [
                            "super mario odyssey", "Super mario odyssey", "Super Mario Odyssey"
                        ]
                    ],
                    "Album" => [
                        "chromatica.jpg" => [
                            "chromatica"
                        ],
                        "Du-Phoenix-aux-etoiles.jpg" => [
                            "du phoenix aux étoiles", "Du phoenix aux étoiles",
                            "du phoenix aux etoiles", "Du phoenix aux etoiles",
                        ]
                    ],
                    "Anime" => [
                        "kaguya.jpg" => [
                            "Le conte de la princesse Kaguya", "le conte de la princesse kaguya",
                            "Kaguya-hime no monogatari", "Kaguya-hime"
                        ],
                        "44cafe894c519dc4595f2c4c47a6997c.jpg" => [
                            "akira"
                        ]
                    ],
                    "Acteur" => [
                        "JD.jpg" => [
                            "johnny depp"
                        ],
                        "jean-paul-rouve.jpg" => [
                            "Jean Paul Rouve", "jean-paul-rouve",
                            "Jean-paul-rouve"
                        ]
                    ],
                    "Artiste musical" => [
                        "Blackpink-la-pop-coreenne-a-l-assaut-du-monde.jpg" => [
                            "blackpink"
                        ],
                        "hendrix.jpg" => [
                            "Jimi Hendrix", "jimi hendrix", "Jimi hendrix"
                        ]
                    ]
                ]
            ]
        ];

        $subCategoriesArray = [];

        foreach ($gamesTab as $gameTab => $categoriesTab) {
            $game = new Game();
            $game->setName($gameTab);
            $manager->persist($game);

            $player = new Player();
            $player->setPseudo($faker->userName)
                ->setLogin($faker->email)
                ->setPassword(password_hash("azerty", PASSWORD_BCRYPT))
                ->setIsAdmin(false);
            $manager->persist($player);

            foreach ($categoriesTab as $categoryTab => $subCategoriesTab) {
                $category = new Category();
                $category->setLibCategory($categoryTab)
                    ->setGame($game);
                $manager->persist($category);

                foreach ($subCategoriesTab as $subCategoryTab => $questionsTab) {
                    $subCategory = new SubCategory();
                    $subCategory->setLibSubCategory($subCategoryTab)
                        ->setCategory($category);
                    $manager->persist($subCategory);
                    $subCategoriesArray[] = $subCategory;

                    foreach ($questionsTab as $questionTab => $answersTab) {
                        if ($gameTab == "Quiz") {
                            $question = new QuestionWithText();
                            $question->setText($questionTab)
                                ->setPlayer($player)
                                ->setSubCategory($subCategory)
                                ->setStatus(Question::STATUS["accepted"]);
                        }else{
                            $question = new QuestionWithPicture();
                            $question->setLinkPicture($questionTab)
                                ->setPlayer($player)
                                ->setSubCategory($subCategory)
                                ->setStatus(Question::STATUS["accepted"]);
                        }
                        foreach ($answersTab as $answerTab) {
                            $answer = new Answer();
                            $answer->setTextAnswer($answerTab);
                            $question->addAnswer($answer);

                            $manager->persist($answer);
                            $manager->persist($question);
                        }

                    }

                }
            }
        }

        $admin = new Admin();
        $admin->setPassword(password_hash("admin", PASSWORD_BCRYPT))
            ->setUsername("admin");
        $manager->persist($admin);

        $moderateur = new Player();
        $moderateur->setPseudo("moderateur")
            ->setLogin("moderateur@test.fr")
            ->setPassword(password_hash("azerty", PASSWORD_BCRYPT));
        $manager->persist($moderateur);
        $moderateur->setIsAdmin(true);
        $manager->persist($moderateur);

        $manager->flush();

        for ($i = 0; $i < 10; $i++) {
            $player = new Player();
            $player->setPseudo($faker->userName)
                ->setLogin($faker->email)
                ->setPassword(password_hash("azerty", PASSWORD_BCRYPT))
                ->setIsAdmin(false);
            $manager->persist($player);


            $roomSettings = new RoomSettings();
            $roomSettings->setCreatedAt(new \DateTime())
                ->setNbMaxPlayer(10)
                ->setShowScore(false)
                ->setIdPlayer($player)
                ->setOneAnswerOnly(true)
                ->setNameProfil("Profil n°1 de" . $player->getPseudo())
                ->setNumberRound(10);


            $categoriesSelec = [];
            for ($j = 0; $j < 5; $j++) {
                $rand = rand(0, sizeof($subCategoriesArray) - 1);
                $cat = $subCategoriesArray[$rand];
                $categoriesSelec[] = $cat;
                $roomSettings->addSubCategory($cat);
            }
            $manager->persist($roomSettings);

            $room = new Room();
            $room->setRoomSettings($roomSettings)
                ->setHost($player)
                ->setName("Salon de " . $player->getPseudo())
                ->setCreatedAt(new \DateTime())
                ->setIsPrivate(false);
            $manager->persist($room);


            $scoreHost = new Score();
            $scoreHost->setScore(0)
                ->setGuest($player)
                ->setRoom($room);
            $manager->persist($scoreHost);


            for ($j = 0; $j < $faker->numberBetween(0, 9); $j++) {
                $guest = new Guest();
                $guest->setPseudo("guest" . $j);
                $manager->persist($guest);

                $score = new Score();
                $score->setScore(0)
                    ->setRoom($room)
                    ->setGuest($guest);
                $manager->persist($score);
            }
        }

        $manager->flush();

    }
}
