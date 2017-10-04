<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Session;

class PlantControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'testuser',
            'PHP_AUTH_PW' => 'test123'
        ));

        $container = $client->getContainer();
        $container->get('session')->set('activeFarm', 1);

        $crawler = $client->request('GET', '/plants');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
