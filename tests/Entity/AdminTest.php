<?php


namespace App\Tests\Entity;

use App\Entity\Admin;
use PHPUnit\Framework\TestCase;


class AdminTest extends TestCase
{

    public function testAdminCreate()
    {
        $admin = new Admin();
        $admin->setUsername("admin");
        $username = $admin->getUsername();
        $roles = $admin->getRoles();
        $admin->setPassword("azerty");

        $this->assertEquals("admin", $username);
        $this->assertEquals(['ROLE_ADMIN'], $roles);
        $this->assertEquals("azerty", $admin->getPassword());
    }

}