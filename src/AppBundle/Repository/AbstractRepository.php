<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @author Muhamad Surya Iksanudin <surya.kejawen@gmail.com>
 */
abstract class AbstractRepository
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var string
     */
    private $class;

    /**
     * @param EntityManager $entityManager
     * @param string        $class
     */
    public function __construct(EntityManager $entityManager, $class)
    {
        $this->manager = $entityManager;
        $this->class = $class;
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository()
    {
        return $this->manager->getRepository($this->class);
    }
}
