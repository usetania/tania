<?php
namespace AppBundle\Controller;

use AppBundle\Data\CategoryMaster;
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
    public function indexAction(EntityManagerInterface $em)
    {
        $areas = $em->getRepository('AppBundle:Area')->findAll();
        
        $growingMethodNames = array_map(function($item) {
            $growingMethodName = CategoryMaster::growingMethods();
            return $growingMethodName[$item->getGrowingMethod()];
        }, $areas);
        
        return $this->render('area/index.html.twig', array(
            'areas' => $areas,
            'growingMethods' => $growingMethodNames
        ));
    }

    /**
        The detail of single area.
    */
    public function showAction($id, EntityManagerInterface $em, Request $request)
    {
        $area = $em->getRepository('AppBundle:Area')->find($id);
        $plants = $em->getRepository('AppBundle:Plant')->findBy(array('area' => $id));
        
        // counting total varieties
        $qb = $em->createQueryBuilder();
        $plantQ = $qb->select(array('SUM(p.seedlingAmount) AS seedling_total', 'SUM(p.areaCapacity) AS area_capacity'))
            ->from('AppBundle:Plant', 'p')
            ->where('p.area = :area_id')
            ->groupBy('p.seed')
            ->setParameter('area_id', $id)
            ->getQuery();
        $sumVarieties = $plantQ->getResult();

        // get growing method name from the master or categories
        $growingMethodName = CategoryMaster::growingMethods()[$area->getGrowingMethod()];

        // generate seed's image path
        $paths = array_map(function($plant) {
            $fileName = $plant->getSeed()->getImage()->getName();
            if(null == $fileName) {
                return null;
            } else {
                $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
                return $helper->asset($plant->getSeed(), 'imageFile');
            }
        }, $plants);

        return $this->render('area/show.html.twig', array(
            'area' => $area,
            'growingMethod' => $growingMethodName,
            'plants' => $plants,
            'images' => $paths,
            'total_varieties' => count($sumVarieties),
            'current_capacities' => array_reduce($sumVarieties, function($carry, $item) {
                return $carry += $item['area_capacity'];
            })
        ));
    }

    /**
        Show the form to add new area and persist it to the database.
    */
    public function createAction(EntityManagerInterface $em, Request $request)
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
            'form' => $form->createView()
        ));
    }
}