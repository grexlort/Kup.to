<?php

namespace Mmm\ApiBundle\Controller;

use FOS\RestBundle\Request\ParamFetcher;
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
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 * @package Mmm\ApiBundle\Controller
 *
 * @RouteResource("Place")
 */
class TaskController extends Controller
{
    /**
     * Get tasks for logged user
     *
     * @Security("place.isAuthor(user)")
     *
     * @QueryParam(name="offset", description="Offset", default="0")
     * @QueryParam(name="limit", description="Limit", default="20")
     *
     * @ApiDoc(
     *      description="Get task for logged user",
     *      statusCodes={
     *          200="Success"
     *      }
     *  )
     */
    public function getTasksAction(ParamFetcher $paramFetcher, Place $place)
    {
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');

        $tasks = $this->getDoctrine()
            ->getRepository('MmmApiBundle:Task')
            ->findAuthorTasksByPlace($place, $this->getUser(), $offset, $limit)
        ;

        return View::create($tasks);
    }

    /**
     * Create task
     *
     * @Security("place.isAuthor(user)")
     *
     * @ApiDoc(
     *      description="Create task",
     *      input="Mmm\ApiBundle\Form\TaskType",
     *      statusCodes={
     *          201="Success",
     *          400="Validation errors"
     *      }
     *  )
     */
    public function postTasksAction(Request $request, Place $place)
    {
        return $this->processTaskForm($request, $place);
    }

    /**
     * Create task
     *
     * @Security("task.isAuthor(user)")
     *
     * @ApiDoc(
     *      description="Create place",
     *      input="Mmm\ApiBundle\Form\PlaceType",
     *      statusCodes={
     *          201="Success",
     *          400="Validation errors"
     *      }
     *  )
     */
    public function patchTasksAction(Request $request, Place $place, Task $task)
    {
        return $this->processTaskForm($request, $place, $task);
    }

    /**
     * Update place
     *
     * @Security("task.isAuthor(user)")
     *
     * @ApiDoc(
     *      description="Update place",
     *      input="Mmm\ApiBundle\Form\PlaceType",
     *      statusCodes={
     *          200="Success",
     *          400="Validation errors"
     *      }
     *  )
     */
    public function deleteTasksAction(Request $request, Place $place, Task $task)
    {
        return $this->processTaskForm($request, $place, 'PATCH');
    }

    protected function processTaskForm(Request $request, Place $place, Task $task = null, $method = 'POST')
    {
        $form = $this->createForm(new TaskType(), $task, array(
            'method' => $method
        ));

        if ($form->handleRequest($request)->isValid()) {
            $status = Response::HTTP_OK;

            if (null === $task) {
                $task = $form->getData();
                $status = Response::HTTP_CREATED;
                $task->setPlace($place);
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($task);
            $em->flush($task);

            return View::create($task, $status);
        }

        return View::create($form, Response::HTTP_BAD_REQUEST);
    }
}
