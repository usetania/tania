<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class PlantControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'testuser',
            'PHP_AUTH_PW' => 'test123'
        ));

        $container = $client->getContainer();
        $session = new Session(new MockFileSessionStorage());

        $session->set('activeFarm', 1);
        $container->set('session', $session);

        $crawler = $client->request('GET', '/plants');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
