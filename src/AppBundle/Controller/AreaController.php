<?php
namespace AppBundle\Controller;

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

        return $this->render('area/index.html.twig', array(
            'areas' => $areas
        ));
    }

    /**
        The detail of single area.
    */
    public function showAction($id)
    {
        return $this->render('area/show.html.twig');
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