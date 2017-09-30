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
        $resource->setDataType('float');
        $resource->setUnit('celcius,fahrenheit');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Humidity');
        $resource->setDataType('float');
        $resource->setUnit('%');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Light');
        $resource->setDataType('float');
        $resource->setUnit('lux');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Nutrition');
        $resource->setDataType('float');
        $resource->setUnit('us/cm');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Moisture');
        $resource->setDataType('integer');
        $resource->setUnit('%');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('pH');
        $resource->setDataType('float');
        $resource->setUnit('none');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('On/Off State');
        $resource->setDataType('boolean');
        $resource->setUnit('none');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $resource = new Resource();
        $resource->setType('Custom');
        $resource->setDataType('float,boolean,integer,string');
        $resource->setUnit('none');
        $resource->setCreatedAt(new \DateTime('now'));
        $manager->persist($resource);

        $manager->flush();
    }
}