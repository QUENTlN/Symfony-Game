<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Guest;
use App\Entity\Player;
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
        $faker = Factory::create();

        $gamesTab = [
            "\App\Entity\Quiz" => [
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
            "\App\Entity\GuessThe" => [
                "Autre" => [
                    "Film", "Série", "Jeux Vidéo", "Album", "Anime", "Acteur", "Artiste musical"
                ]
            ]
        ];

        $subCategoriesArray = [];

        foreach ($gamesTab as $gameTab => $categoriesTab){
            $game = new $gameTab;
            $manager->persist($game);

            foreach ($categoriesTab as $categoryTab => $subCategoriesTab){
                $category = new Category();
                $category->setLibCategory($categoryTab)
                    ->setGame($game);
                $manager->persist($category);

                foreach ($subCategoriesTab as $subCategoryTab){
                    $subCategory = new SubCategory();
                    $subCategory->setLibSubCategory($subCategoryTab)
                        ->setCategory($category);
                    $manager->persist($subCategory);
                    $subCategoriesArray[] = $subCategory;
                }
            }
        }

        $admin = new Player();
        $admin->setPseudo("admin")
            ->setIsAdmin(true)
            ->setLogin("admin@test.fr")
            ->setPassword("azerty");
        $manager->persist($admin);

        $manager->flush();

        for($i = 0; $i < 10; $i++){
            $player = new Player();
            $player->setPseudo($faker->userName)
                ->setLogin($faker->email)
                ->setPassword("azerty")
                ->setIsAdmin(false);
            $manager->persist($player);

            $roomSettings = new RoomSettings();
            $roomSettings->setCreatedAt(new \DateTime())
                ->setNbMaxPlayer(10)
                ->setShowScore(false)
                ->setIdPlayer($player)
                ->setOneAnswerOnly(true)
                ->setNameProfil("Profil n°1 de".$player->getPseudo())
                ->setNumberRound(10);


            $categoriesSelec = [];
            for ($j = 0; $j < 5; $j++){
                $rand = rand(0,sizeof($subCategoriesArray)-1);
                $cat = $subCategoriesArray[$rand];
                $categoriesSelec[] = $cat;
                $roomSettings->addSubCategory($cat);
            }
            $manager->persist($roomSettings);

            $room = new Room();
            $room->setRoomSettings($roomSettings)
                ->setHost($player)
                ->setLinkRoom($faker->uuid)
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


            for($j = 0; $j < 10; $j++){
                $guest = new Guest();
                $guest->setPseudo("guest".$j);
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
