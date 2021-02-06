<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Guest;
use App\Entity\Player;
use App\Entity\Room;
use App\Entity\RoomSettings;
use App\Entity\Score;
use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        gc_collect_cycles();

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

        for($i = 0; $i < 1; $i++){
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
                ->setNameProfil("Profil n°1")
                ->setNumberRound(10)
                ->addSubCategory($subCategoriesArray[rand(0,3)])
                ->addSubCategory($subCategoriesArray[rand(4,5)])
                ->addSubCategory($subCategoriesArray[rand(6,8)])
                ->addSubCategory($subCategoriesArray[rand(9,10)])
                ->addSubCategory($subCategoriesArray[rand(11,13)]);
            $manager->persist($roomSettings);

            $room = new Room();
            $room->setRoomSettings($roomSettings)
                ->setHost($player)
                ->setLinkRoom($faker->uuid)
                ->setCreatedAt(new \DateTime())
                ->setIsPrivate(false);
            $manager->persist($room);

            $scoreHost = new Score();
            $scoreHost->setScore(0)
                ->setGuest($player)
                ->setRoom($room);
            $manager->persist($scoreHost);


            for($i = 0; 0 < rand(1,5); $i++){
                $guest = new Guest();
                $guest->setPseudo($faker->userName);
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
