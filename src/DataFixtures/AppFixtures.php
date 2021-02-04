<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Room;
use App\Entity\RoomSettings;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Room();
            $product->setlinkRoom('&link='.$i);
            $product->setCreatedAt(new \DateTime());
            $product->setFinishedAt('product '.$i);
            $product->setPlayer('product '.$i);
            $product->setIsPrivate(mt_rand(10, 100));
            $product->setRoomSettings(mt_rand(10, 100));
            $product->addGuest(mt_rand(10, 100));
            $manager->persist($product);
        }

        $manager->flush();
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
