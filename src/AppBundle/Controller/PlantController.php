<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Plant;
use AppBundle\Form\PlantType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlantController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $qb = $em->createQueryBuilder('p');
        $plantQ = $qb->addSelect('SUM(p.areaCapacity) AS seedling_total')
            ->addSelect('ANY_VALUE(p.id) AS id')
            ->addSelect('COUNT(p.area) AS area_count')
            ->addSelect('ANY_VALUE(sc.name) AS seed_category')
            ->addSelect('s AS seed')
            ->from('AppBundle:Plant', 'p')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:Area', 'a', 'WITH', 'p.area = a.id')
            ->innerJoin('AppBundle:SeedCategory', 'sc', 'WITH', 's.seedCategory = sc.id')
            ->groupBy('p.seed')
            ->getQuery();
        $plants = $plantQ->getResult();

        return $this->render('plant/index.html.twig', array(
            'plants' => $plants,
            'classActive' => $_route
        ));
    }

    /**
        Show the form to add new plant and persist it to the database.
    */
    public function createAction(EntityManagerInterface $em, Request $request, $_route)
    {
        $plant = new Plant();
        
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // validate the area capacity and seed inventory
            $seedsInfo = $em->getRepository('AppBundle:Plant')->findBy(array('seed' => $plant->getSeed()->getId()));
            $areasInfo = $em->getRepository('AppBundle:Plant')->findBy(array('area' => $plant->getArea()->getId()));
            
            $usedSeed = array_reduce($seedsInfo, function($carry, $item) {
                return $carry += $item->getSeedlingAmount();
            });

            $usedArea = array_reduce($areasInfo, function($carry, $item) {
                return $carry += $item->getAreaCapacity();
            });

            $totalSeed = $usedSeed + $plant->getSeedlingAmount();
            $totalArea = $usedArea + $plant->getAreaCapacity();
            
            if($totalSeed <= $plant->getSeed()->getQuantity() && $totalArea <= $plant->getArea()->getCapacity()) {
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
            'classActive' => $_route
        ));
    }

    /**
        Display the detail of the plant
    */
    public function showAction($id, EntityManagerInterface $em, Request $request, $_route)
    {
        $plants = $em->getRepository('AppBundle:Plant')->findBy(array('seed' => $id));
        
        $plantsWithMeasurementAndDaysAgo = array_map(function($plant) {
            // translate the measurement
            if($plant->getArea()->getMeasurementUnit() == 1) {
                $unit = 'Pots/Points';
                $plant->getArea()->setMeasurementUnit($unit);
            } else if($plant->getArea()->getMeasurementUnit() == 2) {
                $unit = 'Trays';
                $plant->getArea()->setMeasurementUnit($unit);
            }

            // translate the date time to days ago
            $seedlingDate = date_create($plant->getSeedlingDate()->format('Y-m-d'));
            $currentDate = date_create(date('Y-m-d'));
            $interval = date_diff($currentDate, $seedlingDate);
            $plant->setSeedlingDate($interval->format('%a'));

            return $plant;
        }, $plants);
        
        return $this->render('plant/show.html.twig', array(
            'plants' => $plantsWithMeasurementAndDaysAgo,
            'totalArea' => count($plantsWithMeasurementAndDaysAgo),
            'classActive' => $_route
        ));
    }
}
