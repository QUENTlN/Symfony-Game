<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Player;

class GameFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $player = new player();
        $player->setLogin("Superman")
               ->setPassword(password_hash("Wonderwoman", PASSWORD_BCRYPT))
               ->setIsAdmin(true);
        
        $manager->persist($player);
        $manager->flush();
    }
}
