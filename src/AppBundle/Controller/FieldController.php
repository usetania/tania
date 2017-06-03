<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Field;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FieldController extends Controller
{
    public function indexAction()
    {
        return $this->render('field/index.html.twig');
    }

    public function createActon(EntityManagerInterface $em)
    {
        
    }
}
