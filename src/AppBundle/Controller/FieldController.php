<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Field;
use AppBundle\Form\FieldType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FieldController extends Controller
{
    /**
     The root of field controller.
     */
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('field/index.html.twig', array(
            'fields' => $fields,
            'classActive' => $_route,
        ));
    }

    /**
     This method will render the new field submission form and handle the submission.
     */
    public function createAction(Request $request, EntityManagerInterface $em, $_route)
    {
        $field = new Field();

        $form = $this->createForm(FieldType::class, $field);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $field = $form->getData();

            // save to database here
            $field->setCreatedAt(new \DateTime('now'));

            $em->persist($field);
            $em->flush();

            return $this->redirectToRoute('fields');
        }

        return $this->render('field/add.html.twig', array(
            'form' => $form->createView(),
            'classActive' => $_route,
        ));
    }

    /**
     and handle the data update when necessary.
     */
    public function showAction($id, EntityManagerInterface $em, Request $request, $_route)
    {
        $field = $em->getRepository('AppBundle:Field')->find($id);

        $form = $this->createForm(FieldType::class, $field);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $field = $form->getData();

            // save to database here
            $field->setUpdatedAt(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute('fields');
        }

        return $this->render('field/show.html.twig', array(
            'form' => $form->createView(),
            'classActive' => $_route,
            'lat' => $field->getLat(),
            'lng' => $field->getLng(),
        ));
    }

    /**
        Set the current active farm for this session
    */
    public function sessionAction($id)
    {
        $this->get('session')->set('activeFarm', $id);
        return $this->redirectToRoute('dashboard');
    }
}
