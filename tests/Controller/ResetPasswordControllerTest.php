<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResetPasswordControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp(): void
    {
        $this->client = static::createClient();
    }

    public function testRequestPassword()
    {
        $this->client->request('GET', '/forgot_password_request');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('small','Nous');
    }
}