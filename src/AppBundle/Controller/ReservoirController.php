<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reservoir;
use AppBundle\Form\ReservoirType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservoirController extends Controller
{
    public function indexAction(EntityManagerInterface $em, Request $request, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');

        $reservoir = new Reservoir();
        $reservoirs = $em->getRepository('AppBundle:Reservoir')->findByField($activeFarmId);

        $form = $this->createForm(ReservoirType::class, $reservoir);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservoir = $form->getData();

            // save to database here
            $reservoir->setCreatedAt(new \DateTime('now'));

            $em->persist($reservoir);
            $em->flush();

            return $this->redirectToRoute('reservoirs');
        }

        // for the right bar menu
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('reservoir/index.html.twig', array(
            'form' => $form->createView(),
            'reservoirs' => $reservoirs,
            'classActive' => $_route,
            'farms' => $fields
        ));
    }

    public function showAction($id, $_route, EntityManagerInterface $em, Request $request)
    {
        $reservoir = $em->getRepository('AppBundle:Reservoir')->find($id);

        $form = $this->createForm(ReservoirType::class, $reservoir);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservoir = $form->getData();

            // save to database here
            $reservoir->setUpdatedAt(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute('reservoirs');
        }

        // for the right bar menu
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('reservoir/show.html.twig', array(
            'form' => $form->createView(),
            'reservoir' => $reservoir,
            'classActive' => $_route,
            'farms' => $fields
        ));
    }
}
