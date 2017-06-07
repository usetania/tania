<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Seed;
use AppBundle\Form\SeedType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class InventoryController extends Controller
{
    public function indexAction(EntityManagerInterface $em)
    {
        $seeds = $em->getRepository('AppBundle:Seed')->findAll();

        return $this->render('inventory/index.html.twig', array(
            'seeds' => $seeds
        ));
    }

    public function seedCreateAction(Request $request, EntityManagerInterface $em)
    {
        $seed = new Seed();

        $form = $this->createForm(SeedType::class, $seed);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $seed = $form->getData();

            // save to database here
            $seed->setCreatedAt(new \DateTime('now'));

            $em->persist($seed);
            $em->flush();

            return $this->redirectToRoute('inventories');
        }

        return $this->render('seed/create.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
