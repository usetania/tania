<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Reservoir;
use AppBundle\Form\ReservoirType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ReservoirController extends Controller
{
    public function indexAction(EntityManagerInterface $em, Request $request, $_route)
    {
        $reservoir = new Reservoir();
        $reservoirs = $em->getRepository('AppBundle:Reservoir')->findAll();

        $form = $this->createForm(ReservoirType::class, $reservoir);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $reservoir = $form->getData();

            // save to database here
            $reservoir->setCreatedAt(new \DateTime('now'));

            $em->persist($reservoir);
            $em->flush();

            return $this->redirectToRoute('reservoirs');
        }

        return $this->render('reservoir/index.html.twig', array(
            'form' => $form->createView(),
            'reservoirs' => $reservoirs,
            'classActive' => $_route
        ));
    }

    public function showAction($id, $_route, EntityManagerInterface $em, Request $request)
    {
        $reservoir = $em->getRepository('AppBundle:Reservoir')->find($id);

        $form = $this->createForm(ReservoirType::class, $reservoir);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $reservoir = $form->getData();

            // save to database here
            $reservoir->setUpdatedAt(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute('reservoirs');
        }

        return $this->render('reservoir/show.html.twig', array(
            'form' => $form->createView(),
            'reservoir' => $reservoir,
            'classActive' => $_route
        ));
    }
}