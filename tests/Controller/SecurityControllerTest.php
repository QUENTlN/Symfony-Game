<?php


namespace App\Tests\Controller;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{


    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testShowSignIn()
    {

        $crawler = $this->client->request('GET', '/sign_in');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('a','Magma');

        $this->assertCount(6, $crawler->filter('a'));
        $this->assertCount(2, $crawler->filter('input'));

    }

    public function testShowSignUp()
    {

        $crawler = $this->client->request('GET', '/sign_up');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('a','Magma');

        $this->assertCount(5, $crawler->filter('input'));
    }

    public function testLogOutPlayer()
    {


        $playerRepository = static::$container->get(PlayerRepository::class);
        $testPlayer = $playerRepository->find(493);

        $this->client->loginUser($testPlayer);

        $this->client->request('POST', '/log_out');

        $this->assertResponseRedirects();

    }


}