<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Seed;
use AppBundle\Form\SeedType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class InventoryController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $seeds = $em->getRepository('AppBundle:Seed')->findAll();

        return $this->render('inventory/index.html.twig', array(
            'seeds' => $seeds,
            'classActive' => $_route,
        ));
    }

    public function seedCreateAction(Request $request, EntityManagerInterface $em, $_route)
    {
        $seed = new Seed();

        $form = $this->createForm(SeedType::class, $seed);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seed = $form->getData();

            // save to database here
            $seed->setCreatedAt(new \DateTime('now'));

            $em->persist($seed);
            $em->flush();

            return $this->redirectToRoute('inventories');
        }

        return $this->render('seed/create.html.twig', array(
            'form' => $form->createView(),
            'classActive' => $_route,
        ));
    }

    public function seedEditAction($id, $_route, Request $request, EntityManagerInterface $em)
    {
        $seed = $em->getRepository('AppBundle:Seed')->find($id);

        $form = $this->createForm(SeedType::class, $seed);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $seed = $form->getData();

            // save to database here
            $seed->setUpdatedAt(new \DateTime('now'));

            $em->persist($seed);
            $em->flush();

            return $this->redirectToRoute('inventories');
        }

        return $this->render('seed/edit.html.twig', array(
            'form' => $form->createView(),
            'seed' => $seed,
            'classActive' => $_route,
        ));
    }
}
