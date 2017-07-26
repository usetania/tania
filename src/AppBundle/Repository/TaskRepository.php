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
     *
     * @return Task[]
     */
    public function deadlineTasks($limit = 9)
    {
        $qb = $this->getRepository()->createQueryBuilder('t');

        $query = $qb
            ->select('t')
            ->orderBy('t.dueDate', 'ASC')
            ->where('t.isDone = 0')
            ->setMaxResults(5)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
