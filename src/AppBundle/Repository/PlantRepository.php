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

        $query = $qb
            ->select('
                   SUM(p.seedlingAmount) AS seedling_total,
                   SUM(p.areaCapacity) AS area_capacity,
                   sc.name AS seed_category,
                   s AS seed
            ')
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
     * @param int $farmId
     * @return Plant[]
     */
    public function findAllPlants($farmId)
    {
        $qb = $this->getRepository()->createQueryBuilder('p');

        $query = $qb
            ->select('
                SUM(p.areaCapacity) AS seedling_total,
                p.id AS id,
                COUNT(p.area) AS area_count,
                sc.name AS seed_category,
                s AS seed
            ')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:Area', 'a', 'WITH', 'p.area = a.id')
            ->innerJoin('AppBundle:SeedCategory', 'sc', 'WITH', 's.seedCategory = sc.id')
            ->where('a.field = '.$farmId)
            ->groupBy('p.seed')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Count total crops inside a particular farm
     *
     * @param int $farmId
     * @return int
     */
    public function countByFarm($farmId)
    {
        $qb = $this->getRepository()->createQueryBuilder('p');
        
        $qb->select('COUNT (p) AS total_crops')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:Area', 'a', 'WITH', 'p.area = a.id')
            ->where('a.field = '.$farmId)
            ->groupBy('p.seed')
            ->getQuery();
        
        $query = $qb->getQuery()->getOneOrNullResult();

        return (int) $query['total_crops'];
    }

    /**
     * @param int $farmId
     * @param int $limit
     *
     * @return Plant[]
     */
    public function findOldestPlants($farmId, $limit = 9)
    {
        $qb = $this->getRepository()->createQueryBuilder('p');

        $query = $qb
            ->select('
                s.name AS seed_name,
                a.name AS area_name,
                p.seedlingDate AS seedling_date,
                p.areaCapacity AS area_capacity
            ')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:Area', 'a', 'WITH', 'p.area = a.id')
            ->where("(p.action is null OR p.action = 'donothing') AND a.field = ".$farmId)
            ->orderBy('p.seedlingDate', 'ASC')
            ->setMaxResults(5)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
