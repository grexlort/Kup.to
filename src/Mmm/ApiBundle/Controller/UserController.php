<?php

namespace Mmm\ApiBundle\Controller;

use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Mmm\ApiBundle\Entity\Task;
use Mmm\ApiBundle\Entity\User;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller implements ClassResourceInterface
{
    /**
     * Assign user to task
     *
     * @ApiDoc(
     *      description="Assignee user to task",
     *      statusCodes={
     *          200="Success"
     *      }
     *  )
     */
    public function linkTaskAction(User $user, Task $task)
    {
        $user->addAssignedTask($user);

        $em = $this->getDoctrine()->getManager();

        $em->persist($task);
        $em->flush($task);

        return View::create($task, Response::HTTP_OK);
    }

    /**
     * Unassign user from task
     *
     * @ApiDoc(
     *      description="Unassign user from task",
     *      statusCodes={
     *          200="Success"
     *      }
     *  )
     */
    public function unlinkTaskAction(User $user, Task $task)
    {
        $user->removeAssignedTask($user);

        $em = $this->getDoctrine()->getManager();

        $em->persist($task);
        $em->flush($task);

        return View::create($task, Response::HTTP_OK);
    }
}