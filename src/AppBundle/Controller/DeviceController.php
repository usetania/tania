<?php
namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeviceController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('device/index.html.twig', array(
            'farms' => $fields,
            'classActive' => $_route
        ));
    }

    public function createAction(EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('device/create.html.twig', array(
            'farms' => $fields,
            'classActive' => $_route
        ));
    }

    public function resourcesAction(EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('device/resources.html.twig', array(
            'farms' => $fields,
            'classActive' => $_route
        ));
    }
}