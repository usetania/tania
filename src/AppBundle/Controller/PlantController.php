<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PlantController extends Controller
{
    public function indexAction()
    {
        return $this->render('plant/index.html.twig');
    }
}
