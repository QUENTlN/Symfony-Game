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
                        ]
                    ],
                    "Géographie" => [
                        "Quelle est la capitale de la Géorgie ?" => [
                            "tbilissi"
                        ],
                        "Dans quelle continent se situe les îles Canaries" => [
                            "africain"
                        ]
                    ]
                ],
                "Divertissement" => [
                    "Cinéma" => [
                        "Quelle fut le meilleur film 2020 ?" => [
                            "parasite"
                        ],
                        "Quelle rôle à jouer Leonardo Dicaprio dans Roméo et Juliette (1996)?" => [
                            "roméo", "romeo"
                        ]
                    ], "Série" => [
                        "Quelle est la série longue de l'histoire ?" => [
                            "haine et passion", "guilding light"
                        ],
                        "Pour quel film muet a joué Jean Dujardin ?" => [
                            "the artist"
                        ]
                    ],
                    "jeux Vidéo" => [
                        "D'où vient l'abréviation LOL ?" => [
                            "league of legends"
                        ],
                        "Qui est le frère de Mario ?" => [
                            "luigi"
                        ]
                    ]
                ],
                "Sport" => [
                    "Basket" => [
                        "De quelle couleur est le ballon de basketball ?" => [
                            "orange"
                        ],
                        "Dans quel club jouait Michael Jordan ?" => [
                            "bulls de chicago", "bulls", "chicago bulls"
                        ]
                    ],
                    "Foot" => [
                        "De quelle ville vient Mbappe ?" => [
                            "de bondy", "bondy"
                        ]
                    ]
                ],
            ],
            "GuessThe" => [
                "Autre" => [
                    "Film" => [
                        "titanic.jpg" => [
                            "titanic"
                        ]
                    ],
                    "Série" => [
                        "DrHouse.jpg" => [
                            "docteur house", "doctor house"
                        ]
                    ],
                    "Jeux Vidéo" => [
                        "super-mario-odyssey.jpg" => [
                            "super-mario-odyssey.jpg"
                        ]
                    ],
                    "Album" => [
                        "chromatica.jpg" => [
                            "chromatica"
                        ]
                    ],
                    "Anime" => [
                        "44cafe894c519dc4595f2c4c47a6997c.jpg" => [
                            "akira"
                        ]
                    ],
                    "Acteur" => [
                        "JD.jpg" => [
                            "johnny depp"
                        ]
                    ],
                    "Artiste musical" => [
                        "Blackpink-la-pop-coreenne-a-l-assaut-du-monde.jpg" => [
                            "blackpink"
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
                        $question = new QuestionWithText();
                        $question->setText($questionTab)
                            ->setPlayer($player)
                            ->setSubCategory($subCategory)
                            ->setStatus(Question::STATUS["pending"]);

                        foreach ($answersTab as $answerTab) {
                            $answer = new Answer();
                            $answer->setTextAnswer($answerTab);
                            $question->addAnswer($answer);

                            $manager->persist($answer);
                            $manager->persist($question);
                        }

                    }

                    /*
                    $questionWithText = new QuestionWithText();
                    $questionWithText->setText($faker->parse("question"))
                        ->setPlayer($player)
                        ->setSubCategory($subCategory)
                        ->setStatus(Question::STATUS["pending"]);


                    $answerForQWT = new Answer();
                    $answerForQWT->setTextAnswer("réponse");

                    $questionWithText->addAnswer($answerForQWT);

                    $manager->persist($answerForQWT);
                    $manager->persist($questionWithText);

                    $questionWithPicture = new QuestionWithPicture();
                    $questionWithPicture->setLinkPicture($faker->imageUrl('http://lorempixel.com/640/480/'))
                        ->setPlayer($player)
                        ->setSubCategory($subCategory)
                        ->setStatus(Question::STATUS["pending"]);

                    $answerForQWP = new Answer();
                    $answerForQWP->setTextAnswer("réponse");

                    $questionWithPicture->addAnswer($answerForQWP);

                    $manager->persist($answerForQWP);
                    $manager->persist($questionWithPicture);
                    */


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

//            for ($j = 0; $j < 10; $j++){
//                $round = new Round();
//                $round->setRoom($room)
//                    ->setIndexOrder($j + 1)
//
//            }

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
