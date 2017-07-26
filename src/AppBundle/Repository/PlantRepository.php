<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Area;
use AppBundle\Entity\Plant;

/**
 * @author Muhamad Surya Iksanudin <surya.kejawen@gmail.com>
 */
class PlantRepository extends AbstractRepository
{
    /**
     * @param Area $area
     *
     * @return Plant[]
     */
    public function findPlantByArea(Area $area)
    {
        $qb = $this->getRepository()->createQueryBuilder('p');

        $query = $qb->addSelect('SUM(p.seedlingAmount) AS seedling_total')
            ->addSelect('SUM(p.areaCapacity) AS area_capacity')
            ->addSelect('sc.name AS seed_category')
            ->addSelect('s AS seed')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:SeedCategory', 'sc', 'WITH', 's.seedCategory = sc.id')
            ->where('p.area = :area_id')
            ->groupBy('p.seed')
            ->setParameter('area_id', $area->getId())
            ->getQuery()
        ;

        return $query->getResult();
    }

    /**
     * @return Plant[]
     */
    public function findAllPlants()
    {
        $qb = $this->getRepository()->createQueryBuilder('p');

        $query = $qb->addSelect('SUM(p.areaCapacity) AS seedling_total')
            ->addSelect('p.id AS id')
            ->addSelect('COUNT(p.area) AS area_count')
            ->addSelect('sc.name AS seed_category')
            ->addSelect('s AS seed')
            ->from('AppBundle:Plant', 'p')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:Area', 'a', 'WITH', 'p.area = a.id')
            ->innerJoin('AppBundle:SeedCategory', 'sc', 'WITH', 's.seedCategory = sc.id')
            ->groupBy('p.seed')
            ->getQuery()
        ;

        return $query->getResult();
    }

    /**
     * @param int $limit
     *
     * @return Plant[]
     */
    public function findOldestPlants($limit = 9)
    {
        $qb = $this->getRepository()->createQueryBuilder('p');

        $query = $qb->addSelect('s.name AS seed_name')
            ->addSelect('a.name AS area_name')
            ->addSelect('p.seedlingDate AS seedling_date')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:Area', 'a', 'WITH', 'p.area = a.id')
            ->where('p.action is null')
            ->orWhere("p.action = 'donothing'")
            ->orderBy('p.seedlingDate', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
