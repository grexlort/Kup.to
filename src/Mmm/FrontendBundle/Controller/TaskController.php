<?php

namespace Mmm\FrontendBundle\Controller;
use Mmm\FrontendBundle\Entity\Task;
use Mmm\FrontendBundle\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Mmm\FrontendBundle\Controller
 * @Route("/task")
 */
class TaskController extends Controller
{

    /**
     * @Route("/", name="_mmm_task_list")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('MmmFrontendBundle:Task');
        return $this->render("MmmFrontendBundle:Task:index.html.twig", array(
            'tasks' => $repository->findAll()
        ));
    }

    /**
     * @Route("/add", name="_mmm_task_add")
     */
    public function addAction(Request $request)
    {
        $task = new Task();

        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush($task);
        }
        return $this->render("MmmFrontendBundle:Task:add.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("{id}", requirements={"id": "\d+"}, name="_mmm_task_edit")
     */
    public function editAction(Request $request, Task $task)
    {
        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush($task);
        }

        return $this->render("MmmFrontendBundle:Task:edit.html.twig", array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", requirements={"id": "\d+"}, name="_mmm_task_delete")
     */
    public function deleteAction(Request $request, Task $task)
    {
        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush($task);
        }

        return $this->render("MmmFrontendBundle:Task:add.html.twig", array(
            'form' => $form->createView()
        ));
    }

}
