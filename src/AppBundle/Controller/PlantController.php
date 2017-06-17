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
    public function indexAction(EntityManagerInterface $em)
    {
        $plants = $em->getRepository('AppBundle:Plant')->findAll();
        return $this->render('plant/index.html.twig', array(
            'plants' => $plants
        ));
    }

    /**
        Show the form to add new plant and persist it to the database.
    */
    public function createAction(EntityManagerInterface $em, Request $request)
    {
        $plant = new Plant();
        
        $form = $this->createForm(PlantType::class, $plant);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // subtract area capacity and seed inventory
            

            // save to database here
            $plant = $form->getData();
            $plant->setCreatedAt(new \DateTime('now'));

            $em->persist($plant);
            $em->flush();

            return $this->redirectToRoute('plants');
        }

        return $this->render('plant/create.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
        Display the detail of the plant
    */
    public function showAction($id, EntityManagerInterface $em, Request $request)
    {
        return $this->render('plant/show.html.twig');
    }
}
