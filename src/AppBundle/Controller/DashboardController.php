<?php
namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        // query all farms
        $fields = $em->getRepository('AppBundle:Field')->findAll();
        $fieldLocations = array_map(function($location) {
            return array($location->getLat(), $location->getLng());
        }, $fields);

        // query 5 oldest plants
        $plantQb = $em->createQueryBuilder('p');
        $plantQ = $plantQb->addSelect('s.name AS seed_name')
            ->addSelect('a.name AS area_name')
            ->addSelect('p.seedlingDate AS seedling_date')
            ->from('AppBundle:Plant', 'p')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:Area', 'a', 'WITH', 'p.area = a.id')
            ->where("p.action is null")
            ->orWhere("p.action = 'donothing'")
            ->orderBy('p.seedlingDate', 'ASC')
            ->setMaxResults(5)
            ->getQuery();
        $plants = $plantQ->getResult();
        
        $plantsWithDaysAgo = array_map(function($plant) {
           // translate the date time to days ago
            $seedlingDate = date_create($plant['seedling_date']->format('Y-m-d'));
            $currentDate = date_create(date('Y-m-d'));
            $interval = date_diff($currentDate, $seedlingDate);
            $plant['seedling_date'] = $interval->format('%a');

            return $plant;
        }, $plants);

        // query 5 nearest deadline for certain tasks
        $taskQb = $em->createQueryBuilder('t');
        $taskQ = $taskQb->select('t')
            ->from('AppBundle:Task', 't')
            ->orderBy('t.dueDate', 'ASC')
            ->where('t.isDone = 0')
            ->setMaxResults(5)
            ->getQuery();
        $tasks = $taskQ->getResult();
        
        $tasksWithFormattedDate = array_map(function($task) {
            $dueDate = $task->getDueDate()->format('d-M-Y H:i');
            $task->setDueDate($dueDate);
            return $task;
        }, $tasks);

        return $this->render('dashboard/index.html.twig', array(
            'classActive' => $_route,
            'farmLocations' => json_encode($fieldLocations),
            'plants' => $plantsWithDaysAgo,
            'tasks' => $tasksWithFormattedDate
        ));
    }
}
