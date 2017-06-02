<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AreaController extends Controller
{
    public function indexAction()
    {
        return $this->render('area/index.html.twig');
    }

    public function showAction($id)
    {
        return $this->render('area/show.html.twig');
    }

    public function addAction()
    {
        return $this->render('area/add.html.twig');
    }
}