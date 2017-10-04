<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Setting;
use AppBundle\Form\SettingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SettingsController extends Controller
{
    public function indexAction(EntityManagerInterface $em, Request $request, $_route)
    {
        $mqtt = $em->getRepository('AppBundle:Setting')->findBy(array('key' => array('mqtt_host', 'mqtt_port')));

        $form = $this->createForm(SettingType::class, array('mqttHost' => $mqtt[0]->getValue(), 'mqttPort' => $mqtt[1]->getValue()));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // save to database
            $mqttHost = $em->getRepository('AppBundle:Setting')->findOneBy(array('key' => 'mqtt_host'));
            $mqttHost->setValue($data['mqttHost']);
            $mqttHost->setUpdatedAt(new \DateTime('now'));
            $em->persist($mqttHost);

            $mqttPort = $em->getRepository('AppBundle:Setting')->findOneBy(array('key' => 'mqtt_port'));
            $mqttPort->setValue($data['mqttPort']);
            $mqttPort->setUpdatedAt(new \DateTime('now'));
            $em->persist($mqttPort);

            $em->flush();

            return $this->redirectToRoute('settings');
        }

        // for the right bar menu
        $fields = $em->getRepository('AppBundle:Field')->findAll();
        
        return $this->render('settings/index.html.twig', array(
            'classActive' => $_route,
            'farms' => $fields,
            'form' => $form->createView()
        ));
    }
}