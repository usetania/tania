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
        $category->setName('Herb');
        $category->setSlug('herb');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Vegetable');
        $category->setSlug('vegetable');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Sprout/Microgreens');
        $category->setSlug('sprout-microgreens');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Fruit');
        $category->setSlug('fruit');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Tubber');
        $category->setSlug('tubber');
        $category->setCreatedAt(new \DateTime('now'));
        $manager->persist($category);

        $category = new SeedCategory();
        $category->setName('Flower');
        $category->setSlug('flower');
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