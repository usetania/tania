<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Task;

/**
 * @author Muhamad Surya Iksanudin <surya.kejawen@gmail.com>
 */
class TaskRepository extends AbstractRepository
{
    /**
     * @param int $limit
     * @param int $farmId
     *
     * @return Task[]
     */
    public function deadlineTasks($farmId, $limit = 9)
    {
        $qb = $this->getRepository()->createQueryBuilder('t');

        $query = $qb
            ->select('t')
            ->orderBy('t.dueDate', 'ASC')
            ->where('t.isDone = 0')
            ->andWhere('t.field = '.$farmId)
            ->setMaxResults(5)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * @param int $farmId
     *
     * @return int
     */
    public function countByFarm($farmId)
    {
        $qb = $this->getRepository()->createQueryBuilder('t');

        $qb->select($qb->expr()->count('t'))
            ->where('t.field = '.$farmId);
        
        $query = $qb->getQuery();
        
        return $query->getSingleScalarResult();
    }
}
