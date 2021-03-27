<?php


namespace App\Tests\Controller;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuestionControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testShowQuestion()
    {

        $playerRepository = static::$container->get(PlayerRepository::class);
        $testPlayer = $playerRepository->find(493);

        $this->client->loginUser($testPlayer);

        $this->client->request('GET', '/show_Question');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('th','Game');
    }
}