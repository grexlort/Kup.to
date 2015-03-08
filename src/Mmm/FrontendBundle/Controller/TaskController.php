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
 * @Template()
 */
class TaskController extends Controller
{

    /**
     * @Route("/", name="_aaa_task_list")
     */
    public function indexAction()
    {
        return $this->render("MmmFrontendBundle:Task:index.html.twig");
    }

    /**
     * @Route("/add", name="_aaa_task_add")
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

        return array(
            'form' => $form->createView()
        );
    }

}
