<?php

namespace AppBundle\Controller;

use AppBundle\Data\CategoryMaster;
use AppBundle\Entity\Area;
use AppBundle\Form\AreaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AreaController extends Controller
{
    /**
     The root of area routes.
     */
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');

        $areas = $em->getRepository('AppBundle:Area')->findByField($activeFarmId);

        $growingMethodNames = array_map(function ($item) {
            $growingMethodName = CategoryMaster::growingMethods();

            return $growingMethodName[$item->getGrowingMethod()];
        }, $areas);

        $measurementUnits = array_map(function ($item) {
            $unit = CategoryMaster::areaUnits();

            return $unit[$item->getMeasurementUnit()];
        }, $areas);

        return $this->render('area/index.html.twig', array(
            'areas' => $areas,
            'growingMethods' => $growingMethodNames,
            'measurementUnits' => $measurementUnits,
            'classActive' => $_route,
        ));
    }

    /**
     The detail of single area.
     */
    public function showAction($id, EntityManagerInterface $em, Request $request, $_route)
    {
        $area = $em->getRepository('AppBundle:Area')->find($id);
        if (!$area) {
            throw new NotFoundHttpException(sprintf('Area with id %s is not found.', $id));
        }

        $plants = $this->container->get('app.repository.plant_repository')->findPlantByArea($area);

        // get growing method name from the master or categories
        $growingMethodName = CategoryMaster::growingMethods()[$area->getGrowingMethod()];

        return $this->render('area/show.html.twig', array(
            'area' => $area,
            'growingMethod' => $growingMethodName,
            'plants' => $plants,
            'total_varieties' => count($plants),
            'current_capacities' => array_reduce($plants, function ($carry, $item) {
                return $carry += $item['area_capacity'];
            }),
            'classActive' => $_route,
        ));
    }

    /**
     Show the form to add new area and persist it to the database.
     */
    public function createAction(EntityManagerInterface $em, Request $request, $_route)
    {
        $area = new Area();

        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $area = $form->getData();

            // save to database here
            $area->setCreatedAt(new \DateTime('now'));

            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('areas');
        }

        return $this->render('area/create.html.twig', array(
            'form' => $form->createView(),
            'classActive' => $_route,
        ));
    }

    /**
     Editing the detail of the area
     */
    public function editAction($id, $_route, EntityManagerInterface $em, Request $request)
    {
        $area = $em->getRepository('AppBundle:Area')->find($id);

        $form = $this->createForm(AreaType::class, $area);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $area = $form->getData();

            // save to database here
            $area->setUpdatedAt(new \DateTime('now'));

            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('areas_show', array('id' => $id));
        }

        return $this->render('area/edit.html.twig', array(
            'form' => $form->createView(),
            'area' => $area,
            'classActive' => $_route,
        ));
    }
}
