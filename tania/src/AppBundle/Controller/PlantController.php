<?php

namespace AppBundle\Controller;

use AppBundle\Data\CategoryMaster;
use AppBundle\Entity\Plant;
use AppBundle\Form\PlantHarvestType;
use AppBundle\Form\PlantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlantController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $plants = $this->container->get('app.repository.plant_repository')->findAllPlants();

        return $this->render('plant/index.html.twig', array(
            'plants' => $plants,
            'classActive' => $_route,
        ));
    }

    /**
     Show the form to add new plant and persist it to the database.
     */
    public function createAction(EntityManagerInterface $em, Request $request, $_route)
    {
        $plant = new Plant();

        $form = $this->createForm(PlantType::class, $plant, [
            'entityManager' => $em,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // validate the area capacity and seed inventory
            $seedsInfo = $em->getRepository('AppBundle:Plant')->findBy(array('seed' => $plant->getSeed()->getId()));
            $areasInfo = $em->getRepository('AppBundle:Plant')->findBy(array('area' => $plant->getArea()->getId()));

            $usedSeed = array_reduce($seedsInfo, function ($carry, $item) {
                return $carry += $item->getSeedlingAmount();
            });

            $usedArea = array_reduce($areasInfo, function ($carry, $item) {
                return $carry += $item->getAreaCapacity();
            });

            $totalSeed = $usedSeed + $plant->getSeedlingAmount();
            $totalArea = $usedArea + $plant->getAreaCapacity();

            if ($totalSeed <= $plant->getSeed()->getQuantity() && $totalArea <= $plant->getArea()->getCapacity()) {
                // save to database here
                $plant = $form->getData();
                $plant->setCreatedAt(new \DateTime('now'));

                $em->persist($plant);
                $em->flush();

                return $this->redirectToRoute('plants');
            } else {
                // give error message
                $this->addFlash('notice', 'The capacity of the area or the quantity of the seed are insufficient.');

                return $this->redirectToRoute('plants_create');
            }
        }

        return $this->render('plant/create.html.twig', array(
            'form' => $form->createView(),
            'classActive' => $_route,
        ));
    }

    /**
     Display the detail of the plant
     */
    public function showAction($id, EntityManagerInterface $em, Request $request, $_route)
    {
        $plants = $em->getRepository('AppBundle:Plant')->findBy(array('seed' => $id));
        
        $plantsWithMeasurementAndDaysAgo = array_map(function($plant) {
            // translate the date time object to "days ago" string
            $seedlingDate = date_create($plant->getSeedlingDate()->format('Y-m-d'));
            $currentDate = date_create(date('Y-m-d'));
            $interval = date_diff($currentDate, $seedlingDate);
            $plant->setSeedlingDate($interval->format('%a'));

            return $plant;
        }, $plants);

        return $this->render('plant/show.html.twig', array(
            'plants' => $plantsWithMeasurementAndDaysAgo,
            'totalArea' => count($plantsWithMeasurementAndDaysAgo),
            'classActive' => $_route,
        ));
    }

    /**
     Harvesting or disposing the plants
     */
    public function harvestAction($id, $_route, EntityManagerInterface $em, Request $request)
    {
        $plant = $em->getRepository('AppBundle:Plant')->find($id);

        $form = $this->createForm(PlantHarvestType::class, $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // when the farmer choose to harvest or dispose his/her plant
            if ($plant->getAction() != 'donothing') {
                if ($plant->getAction() == 'harvest') {
                    // harvest
                    $plant->setHarvestingDate(new \DateTime('now'));
                    $plant->setDisposingDate(null);
                } elseif ($plant->getAction() == 'dispose') {
                    // dispose
                    $plant->setDisposingDate(new \DateTime('now'));
                    $plant->setHarvestingDate(null);
                }

                $plant = $form->getData();
                $plant->setUpdatedAt(new \DateTime('now'));
            } else {
                // do nothing
                $plant->setHarvestingDate(null);
                $plant->setDisposingDate(null);
            }

            // save to database here
            $em->persist($plant);
            $em->flush();

            return $this->redirectToRoute('plants_show', array('id' => $plant->getSeed()->getId()));
        }

        return $this->render('plant/harvest.html.twig', array(
            'classActive' => $_route,
            'form' => $form->createView(),
            'plant' => $plant,
            'seedlingDate' => $plant->getSeedlingDate()->format('d-M-Y'),
        ));
    }

    /**
     Edit the plantation's detail
     */
    public function editAction($id, $_route, EntityManagerInterface $em, Request $request)
    {
        $plant = $em->getRepository('AppBundle:Plant')->find($id);

        $form = $this->createForm(PlantType::class, $plant, [
            'entityManager' => $em,
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // validate the area capacity and seed inventory
            $seedsInfo = $em->getRepository('AppBundle:Plant')->findBy(array('seed' => $plant->getSeed()->getId()));
            $areasInfo = $em->getRepository('AppBundle:Plant')->findBy(array('area' => $plant->getArea()->getId()));

            $usedSeed = array_reduce($seedsInfo, function ($carry, $item) {
                return $carry += $item->getSeedlingAmount();
            });

            $usedArea = array_reduce($areasInfo, function ($carry, $item) {
                return $carry += $item->getAreaCapacity();
            });

            $totalSeed = $usedSeed + $plant->getSeedlingAmount();
            $totalArea = $usedArea + $plant->getAreaCapacity();

            if ($totalSeed <= $plant->getSeed()->getQuantity() && $totalArea <= $plant->getArea()->getCapacity()) {
                // save to database here
                $plant = $form->getData();
                $plant->setUpdatedAt(new \DateTime('now'));

                $em->persist($plant);
                $em->flush();

                return $this->redirectToRoute('plants');
            } else {
                // give error message
                $this->addFlash('notice', 'The capacity of the area or the quantity of the seed are insufficient.');

                return $this->redirectToRoute('plants_edit', array('id' => $id));
            }
        }

        return $this->render('plant/edit.html.twig', array(
            'form' => $form->createView(),
            'plant' => $plant,
            'classActive' => $_route,
        ));
    }
}
