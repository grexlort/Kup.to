<?php

namespace Mmm\ApiBundle\Controller;

use FOS\RestBundle\View\View;
use Mmm\ApiBundle\Entity\Place;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Mmm\ApiBundle\Entity\Task;
use Mmm\ApiBundle\Form\TaskType;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * Class UserController
 * @package Mmm\ApiBundle\Controller
 *
 * @RouteResource("Place")
 */
class TaskController extends Controller
{
    /**
     * Get task for logged user
     *
     * @QueryParam(name="offset", description="Offset", default="0")
     * @QueryParam(name="limit", description="Limit", default="20")
     *
     * @ApiDoc(
     *      description="Get places for logged user",
     *      statusCodes={
     *          200="Success"
     *      }
     *  )
     */
    public function getPlaceAction(Place $place)
    {
        $tasks = $this->getDoctrine()
            ->getRepository('MmmApiBundle:Task')
            ->findAuthorTasksByPlace($place, $this->getUser())
        ;

        return View::create($tasks);
    }

    /**
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

    /**
     * @Security("task.isAuthor(user)")
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
     * @Security("task.isAuthor(user)")
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
