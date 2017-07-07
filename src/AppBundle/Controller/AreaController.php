<?php
namespace AppBundle\Controller;

use AppBundle\Data\CategoryMaster;
use AppBundle\DoctrineExtensions\Utils\AnyValue;
use AppBundle\Entity\Area;
use AppBundle\Form\AreaType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AreaController extends Controller
{
    /**
        The root of area routes.
    */
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $areas = $em->getRepository('AppBundle:Area')->findAll();
        
        $growingMethodNames = array_map(function($item) {
            $growingMethodName = CategoryMaster::growingMethods();
            return $growingMethodName[$item->getGrowingMethod()];
        }, $areas);

        $measurementUnits = array_map(function($item) {
            $unit = CategoryMaster::areaUnits();
            return $unit[$item->getMeasurementUnit()];
        }, $areas);
        
        return $this->render('area/index.html.twig', array(
            'areas' => $areas,
            'growingMethods' => $growingMethodNames,
            'measurementUnits' => $measurementUnits,
            'classActive' => $_route
        ));
    }

    /**
        The detail of single area.
    */
    public function showAction($id, EntityManagerInterface $em, Request $request, $_route)
    {
        $area = $em->getRepository('AppBundle:Area')->find($id);
        
        // counting total varieties
        $qb = $em->createQueryBuilder('p');
        $plantQ = $qb->addSelect('SUM(p.seedlingAmount) AS seedling_total')
            ->addSelect('SUM(p.areaCapacity) AS area_capacity')
            ->addSelect('ANY_VALUE(sc.name) AS seed_category')
            ->addSelect('s AS seed')
            ->from('AppBundle:Plant', 'p')
            ->innerJoin('AppBundle:Seed', 's', 'WITH', 'p.seed = s.id')
            ->innerJoin('AppBundle:SeedCategory', 'sc', 'WITH', 's.seedCategory = sc.id')
            ->where('p.area = :area_id')
            ->groupBy('p.seed')
            ->setParameter('area_id', $id)
            ->getQuery();
        $plants = $plantQ->getResult();
        
        // get growing method name from the master or categories
        $growingMethodName = CategoryMaster::growingMethods()[$area->getGrowingMethod()];

        return $this->render('area/show.html.twig', array(
            'area' => $area,
            'growingMethod' => $growingMethodName,
            'plants' => $plants,
            'total_varieties' => count($plants),
            'current_capacities' => array_reduce($plants, function($carry, $item) {
                return $carry += $item['area_capacity'];
            }),
            'classActive' => $_route
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

        if($form->isSubmitted() && $form->isValid()) {
            $area = $form->getData();

            // save to database here
            $area->setCreatedAt(new \DateTime('now'));

            $em->persist($area);
            $em->flush();

            return $this->redirectToRoute('areas');
        }

        return $this->render('area/create.html.twig', array(
            'form' => $form->createView(),
            'classActive' => $_route
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

        if($form->isSubmitted() && $form->isValid()) {
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
            'classActive' => $_route
        ));
    }
}