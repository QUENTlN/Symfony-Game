<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testHomePage()
    {
        $this->client->request('POST', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('a','Magma');
        $this->assertSelectorTextContains('h2','Jouer dans un salon publique');
    }
}