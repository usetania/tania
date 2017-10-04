<?php
namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\SeedCategory;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSeedCategory implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category = new SeedCategory();
        $category->setName('Leafy Greens');
        $category->setSlug('leafy-greens');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Flowers');
        $category->setSlug('flowers');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Fruits');
        $category->setSlug('fruits');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Herbs');
        $category->setSlug('herbs');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Staple Foods');
        $category->setSlug('staple-foods');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Other');
        $category->setSlug('other');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $manager->flush();
    }
}