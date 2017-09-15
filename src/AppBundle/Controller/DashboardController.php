<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');

        // query all farms
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        // query all areas under current farm
        $areas = $em->getRepository('AppBundle:Area')->findByField($activeFarmId);
        
        // query 5 oldest plants
        $plants = $this->container->get('app.repository.plant_repository')->findOldestPlants($activeFarmId, 5);
        $totalPlants = $this->container->get('app.repository.plant_repository')->countByFarm($activeFarmId);
        
        $plantsWithDaysAgo = array_map(function ($plant) {
            // translate the date time to days ago
            $seedlingDate = date_create($plant['seedling_date']->format('Y-m-d'));
            $currentDate = date_create(date('Y-m-d'));
            $interval = date_diff($currentDate, $seedlingDate);
            $plant['seedling_date'] = $interval->format('%a');

            return $plant;
        }, $plants);

        // query 5 nearest deadline for certain tasks
        $tasks = $this->container->get('app.repository.task_repository')->deadlineTasks($activeFarmId, 5);
        $totalTask = $this->container->get('app.repository.task_repository')->countByFarm($activeFarmId);

        return $this->render('dashboard/index.html.twig', array(
            'classActive' => $_route,
            'farms' => $fields,
            'plants' => $plantsWithDaysAgo,
            'totalPlants' => $totalPlants,
            'tasks' => $tasks,
            'totalTask' => $totalTask,
            'areas' => $areas
        ));
    }
}
