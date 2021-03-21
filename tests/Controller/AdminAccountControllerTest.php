<?php


namespace App\Tests\Controller;

use App\Repository\AdminRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminAccountControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testShowSignInAdmin()
    {
        $crawler = $this->client->request('GET', '/admin/login');

        $this->assertResponseIsSuccessful();
        $this->assertCount(2, $crawler->filter('input'));
    }

    public function testLogOutAdmin()
    {

        $adminRepository = static::$container->get(AdminRepository::class);
        $testAdmin = $adminRepository->find(18);

        $this->client->loginUser($testAdmin);

        $this->client->request('POST', '/admin/logOut');

        $this->assertResponseRedirects();
    }
}