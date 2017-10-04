<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    public function indexAction(EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');

        $tasks = $em->getRepository('AppBundle:Task')->findByField($activeFarmId);

        // for the right bar menu
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('task/index.html.twig', array(
            'tasks' => $tasks,
            'classActive' => $_route,
            'farms' => $fields
        ));
    }

    public function createAction(Request $request, EntityManagerInterface $em, $_route)
    {
        $activeFarmId = $this->get('session')->get('activeFarm');

        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            // save to database here
            $field = $em->getRepository('AppBundle:Field')->findOneById($activeFarmId);
            $task->setField($field);
            $task->setCreatedAt(new \DateTime('now'));

            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('tasks');
        }

        // for the right bar menu
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('task/create.html.twig', array(
            'form' => $form->createView(),
            'classActive' => $_route,
            'farms' => $fields
        ));
    }

    public function showAction($id, Request $request, EntityManagerInterface $em, $_route)
    {
        $task = $em->getRepository('AppBundle:Task')->find($id);

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            // save to database here
            $task->setUpdatedAt(new \DateTime('now'));

            $em->flush();

            return $this->redirectToRoute('tasks');
        }

        // for the right bar menu
        $fields = $em->getRepository('AppBundle:Field')->findAll();

        return $this->render('task/show.html.twig', array(
            'form' => $form->createView(),
            'classActive' => $_route,
            'farms' => $fields
        ));
    }
}
