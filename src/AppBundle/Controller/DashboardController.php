<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller
{
    public function indexAction($_route)
    {
        return $this->render('dashboard/index.html.twig', array(
            'classActive' => $_route
        ));
    }
}
