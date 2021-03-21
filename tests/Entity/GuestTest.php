<?php

namespace App\Tests\Entity;

use App\Entity\Guest;
use PHPUnit\Framework\TestCase;

class GuestTest extends TestCase
{
    public function testGuestCreate()
    {
        $guest = new Guest();
        $guest->setPseudo("PseudoTest");
        $pseudo = $guest->getPseudo();

        $this->assertEquals("PseudoTest", $pseudo);
    }

}