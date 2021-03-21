<?php


namespace App\Tests\Controller;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoomSettingsControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testCreateRoomSettings()
    {

        $playerRepository = static::$container->get(PlayerRepository::class);
        $testPlayer = $playerRepository->find(493);

        $this->client->loginUser($testPlayer);

        $this->client->request('GET', '/room_settings/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label','Nom du profil');
    }

    public function testEditRoomSettings()
    {

        $playerRepository = static::$container->get(PlayerRepository::class);
        $testPlayer = $playerRepository->find(493);

        $this->client->loginUser($testPlayer);

        $this->client->request('GET', '/room_settings/139/edit');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('label','Nom du profil');
    }
}