<?php

namespace App\Tests\Entity;

use App\Entity\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    public function testPlayerCreate()
    {
        $player = new Player();
        $player->setLogin("test@gmail.com");
        $player->setIsAdmin(false);
        $isAdmin = $player->getIsAdmin();
        $mail = $player->getLogin();
        $role = $player->getRoles();
        $username = $player->getUsername();

        $this->assertEquals(['ROLE_USER'], $role);
        $this->assertEquals(false,$isAdmin);
        $this->assertEquals("test@gmail.com",$mail);
        $this->assertEquals("test@gmail.com", $username);
    }
}