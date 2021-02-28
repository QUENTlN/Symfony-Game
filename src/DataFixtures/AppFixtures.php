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
                    "Histoire", "Géographie"
                ],
                "Divertissement" => [
                    "Cinéma", "Série", "jeux Vidéo"
                ],
                "Sport" => [
                    "Basket", "Foot"
                ]
            ],
            "GuessThe" => [
                "Autre" => [
                    "Film", "Série", "Jeux Vidéo", "Album", "Anime", "Acteur", "Artiste musical"
                ]
            ]
        ];

        $subCategoriesArray = [];

        foreach ($gamesTab as $gameTab => $categoriesTab) {
            $game = new Game();
            $game->setName($gameTab);
            $manager->persist($game);

            foreach ($categoriesTab as $categoryTab => $subCategoriesTab) {
                $category = new Category();
                $category->setLibCategory($categoryTab)
                    ->setGame($game);
                $manager->persist($category);

                foreach ($subCategoriesTab as $subCategoryTab) {
                    $subCategory = new SubCategory();
                    $subCategory->setLibSubCategory($subCategoryTab)
                        ->setCategory($category);
                    $manager->persist($subCategory);
                    $subCategoriesArray[] = $subCategory;
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

            $questionWithText = new QuestionWithText();
            $questionWithText->setText($faker->parse("question n° ".$i))
                ->setPlayer($player)
                ->setSubCategory($subCategory)
                ->setStatus(Question::STATUS["pending"]);


            $answerForQWT = new Answer();
            $answerForQWT->setTextAnswer("réponse n° ".$i);

            $questionWithText->addAnswer($answerForQWT);

            $manager->persist($answerForQWT);
            $manager->persist($questionWithText);

            $questionWithPicture = new QuestionWithPicture();
            $questionWithPicture->setLinkPicture($faker->imageUrl('http://lorempixel.com/640/480/'))
                ->setPlayer($player)
                ->setSubCategory($subCategory)
                ->setStatus(Question::STATUS["pending"]);

            $answerForQWP = new Answer();
            $answerForQWP->setTextAnswer("réponse n° ".$i);

            $questionWithPicture->addAnswer($answerForQWP);

            $manager->persist($answerForQWP);
            $manager->persist($questionWithPicture);


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
