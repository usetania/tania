<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InventoryControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'testuser',
            'PHP_AUTH_PW' => 'test123'
        ));

        $crawler = $client->request('GET', '/inventories');
        
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
