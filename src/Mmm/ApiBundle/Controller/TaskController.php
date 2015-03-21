<?php

namespace Mmm\ApiBundle\Controller;
use Mmm\ApiBundle\Entity\Task;
use Mmm\ApiBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Mmm\ApiBundle\Controller
 * @Route("/task")
 * @Template()
 */
class TaskController extends Controller
{
    /**
     * @Route("/", name="_mmm_task_list")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('MmmApiBundle:Task');

        return array(
            'tasks' => $repository->findAuthorTasks($this->getUser())
        );
    }

    /**
     * @Route("/add", name="_mmm_task_add")
     */
    public function addAction(Request $request)
    {
        $task = new Task();

        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($request);

        $task->setCreatedBy($this->getUser());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush($task);
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"}, name="_mmm_task_edit")
     * @Security("user == task.getCreatedBy()")
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

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}/delete", requirements={"id": "\d+"}, name="_mmm_task_delete")
     * @Security("user == task.getCreatedBy()")
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

        return array(
            'form' => $form->createView()
        );
    }

}
