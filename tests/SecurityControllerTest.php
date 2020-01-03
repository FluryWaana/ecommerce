<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginOK()
    {
        // Création d'un client web
        $client = static::createClient();

        $crawler = $client->request('get', '/login');
        $form = $crawler->selectButton('submit')->form();
        $form['email']    = 'axel@email.com';
        $form['password'] = '123456';
        $crawler = $client->submit($form);

        $this->assertResponseIsSuccessful();

    }

    public function LoginNOK(){}
}
