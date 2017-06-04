<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Field;
use AppBundle\Form\FieldType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FieldController extends Controller
{
    /**
        The root of field controller.
    */
    public function indexAction(EntityManagerInterface $em)
    {
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('field/index.html.twig', array(
            'fields' => $fields
        ));
    }

    /**
        This method will render the new field submission form and handle the submission.
    */
    public function createAction(Request $request, EntityManagerInterface $em)
    {
        $field = new Field();

        $form = $this->createForm(FieldType::class, $field);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $field = $form->getData();

            // save to database here
            $field->setCreatedAt(new \DateTime('now'));

            $em->persist($field);
            $em->flush();

            return $this->redirectToRoute('fields');
        }

        return $this->render('field/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
        This method will render the detail of the field form
        and handle the data update when necessary.
    */
    public function showAction($id, EntityManagerInterface $em, Request $request)
    {
        $field = $em->getRepository('AppBundle:Field')->find($id);

        $form = $this->createForm(FieldType::class, $field);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $field = $form->getData();

            // save to database here
            $field->setUpdatedAt(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute('fields');
        }

        return $this->render('field/show.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
