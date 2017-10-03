<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DashboardController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        // query all farms
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        if(empty($fields)) {
            return $this->redirectToRoute('fields_create');
        }

        $activeFarmId = $this->get('session')->get('activeFarm');

        if(empty($activeFarmId)) {
            return $this->redirectToRoute('fields_session', array('id' => $fields[0]->getId()));
        }

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

        // query all devices
        $devices = $em->getRepository('AppBundle:Device')->findByField($activeFarmId);

        return $this->render('dashboard/index.html.twig', array(
            'classActive' => $_route,
            'farms' => $fields,
            'plants' => $plantsWithDaysAgo,
            'totalPlants' => $totalPlants,
            'tasks' => $tasks,
            'totalTask' => $totalTask,
            'areas' => $areas,
            'devices' => $devices
        ));
    }

    /**
     * This method will be accessed via ajax in dashboard
     */
    public function iotAction($id, EntityManagerInterface $em)
    {
        $areaDevice = $em->getRepository('AppBundle:AreasDevices')->findOneByArea($id);

        if(empty($areaDevice)) {
            return new JsonResponse('no data');
        }

        $deviceId = $areaDevice->getDevice()->getId();
        $resourcesDevice = $em->getRepository('AppBundle:ResourcesDevices')->findByDevice($deviceId);
        $resourceJson = array_map(function($resource) {
            $item = array(
                'id' => $resource->getId(),
                'type' => $resource->getResource()->getType(),
                'rid' => $resource->getRid(),
                'unit' => $resource->getUnit()
            );
            return $item;
        }, $resourcesDevice);
        
        return new JsonResponse($resourceJson);
    }
}
