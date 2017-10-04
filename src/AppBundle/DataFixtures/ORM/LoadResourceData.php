<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Resource;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadResourceData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $resource = new Resource();
        $resource->setType('Temperature');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Humidity');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Light');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Nutrition');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Moisture');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('pH');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('On/Off State');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Custom');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $manager->flush();
    }
}