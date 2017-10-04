<?php
namespace AppBundle\Controller;

use AppBundle\Data\CategoryMaster;
use AppBundle\Entity\Device;
use AppBundle\Entity\AreasDevices;
use AppBundle\Entity\ResourcesDevices;
use AppBundle\Form\DeviceType;
use AppBundle\Form\AreaDeviceType;
use AppBundle\Form\ResourceDeviceType;
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
        $devices = $em->getRepository('AppBundle:Device')->findByField($activeFarmId);
        
        return $this->render('device/index.html.twig', array(
            'farms' => $fields,
            'devices' => $devices,
            'classActive' => $_route
        ));
    }

    public function showAction($id, EntityManagerInterface $em, $_route)
    {
        $fields = $em->getRepository('AppBundle:Field')->findAll();
        $device = $em->getRepository('AppBundle:Device')->findOneById($id);
        $areasDevices = $em->getRepository('AppBundle:AreasDevices')->findByDevice($id);
        $resourcesDevices = $em->getRepository('AppBundle:ResourcesDevices')->findByDevice($id);
        
        // CHange the device type id with device type name for user displaying purpose
        $deviceTypeNames = CategoryMaster::deviceType();
        $device->setDeviceType($deviceTypeNames[$device->getDeviceType()]);
        
        return $this->render('device/show.html.twig', array(
            'farms' => $fields,
            'device' => $device,
            'areasDevices' => $areasDevices,
            'resourcesDevices' => $resourcesDevices,
            'classActive' => $_route
        ));
    }

    public function deleteAction($id, EntityManagerInterface $em)
    {
        $device = $em->getRepository('AppBundle:Device')->findOneById($id);
        
        $em->remove($device);
        $em->flush();

        return $this->redirectToRoute('devices');
    }

    public function createAction(Request $request, EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        $device = new Device();
        $form = $this->createForm(DeviceType::class, $device);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $device = $form->getData();
            
            // save to database here
            $field = $em->getRepository('AppBundle:Field')->findOneById((int) $activeFarmId);
            $device->setField($field);
            $device->setCreatedAt(new \DateTime('now'));

            $em->persist($device);
            $em->flush();

            return $this->redirectToRoute('devices');
        }

        return $this->render('device/create.html.twig', array(
            'farms' => $fields,
            'classActive' => $_route,
            'form' => $form->createView()
        ));
    }

    public function resourcesAction($id, Request $request, EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');
        $fields = $em->getRepository('AppBundle:Field')->findAll();
        $device = $em->getRepository('AppBundle:Device')->findOneById($id);
        $resourcesDevices = $em->getRepository('AppBundle:ResourcesDevices')->findByDevice($id);

        $resourceDevice = new ResourcesDevices();

        $form = $this->createForm(ResourceDeviceType::class, $resourceDevice);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $resourceDevice = $form->getData();
            
            // save to database here
            $resourceDevice->setDevice($device);
            $resourceDevice->setCreatedAt(new \DateTime('now'));
            
            $em->persist($resourceDevice);
            $em->flush();

            return $this->redirectToRoute('devices_resources', array('id' => $id));
        }

        return $this->render('device/resources.html.twig', array(
            'farms' => $fields,
            'form' => $form->createView(),
            'classActive' => $_route,
            'device' => $device,
            'resourcesDevices' => $resourcesDevices
        ));
    }

    function resourcesDeleteAction($id, Request $request, EntityManagerInterface $em)
    {
        $resourceId = $request->get('resource_id');
        $resourceDevices = $em->getRepository('AppBundle:ResourcesDevices')->findOneBy(array('device' => $id, 'resource' => $resourceId));
        
        $em->remove($resourceDevices);
        $em->flush();

        return $this->redirectToRoute('devices_resources', array('id' => $id));
    }

    public function areasAction($id, Request $request, EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');
        $fields = $em->getRepository('AppBundle:Field')->findAll();
        $device = $em->getRepository('AppBundle:Device')->findOneById($id);
        $areasDevices = $em->getRepository('AppBundle:AreasDevices')->findByDevice($id);

        $areaDevice = new AreasDevices();

        $form = $this->createForm(AreaDeviceType::class, $areaDevice);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $areaDevice = $form->getData();
            
            // save to database here
            $areaDevice->setDevice($device);
            $areaDevice->setCreatedAt(new \DateTime('now'));
            
            $em->persist($areaDevice);
            $em->flush();

            return $this->redirectToRoute('devices_areas', array('id' => $id));
        }
        
        return $this->render('device/areas.html.twig', array(
            'farms' => $fields,
            'form' => $form->createView(),
            'device' => $device,
            'areasDevices' => $areasDevices,
            'classActive' => $_route
        ));
    }

    function areasDeleteAction($id, Request $request, EntityManagerInterface $em)
    {
        $areaId = $request->get('area_id');
        $areaDevices = $em->getRepository('AppBundle:AreasDevices')->findOneBy(array('device' => $id, 'area' => $areaId));
        
        $em->remove($areaDevices);
        $em->flush();

        return $this->redirectToRoute('devices_areas', array('id' => $id));
    }
}