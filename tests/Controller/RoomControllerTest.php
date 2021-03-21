<?php


namespace App\Tests\Controller;


use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoomControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testCreateRoomPublic()
    {
        $playerRepository = static::$container->get(PlayerRepository::class);
        $testPlayer = $playerRepository->find(493);

        $this->client->loginUser($testPlayer);

        $this->client->request('GET', '/create_room/public');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label','Nom du salon');

    }
    public function testCreateRoomPrivate()
    {

        $playerRepository = static::$container->get(PlayerRepository::class);
        $testPlayer = $playerRepository->find(493);

        $this->client->loginUser($testPlayer);

        $this->client->request('GET', '/create_room/private');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label','Nom du salon');

    }

}