<?php

namespace Mmm\ApiBundle\Controller;
use Mmm\ApiBundle\Entity\Task;
use Mmm\ApiBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Mmm\ApiBundle\Controller
 */
class TaskController extends Controller
{
    /**
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('MmmApiBundle:Task');

        return array(
            'tasks' => $repository->findAuthorTasks($this->getUser())
        );
    }

    /**
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
