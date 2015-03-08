<?php

namespace Mmm\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TaskController extends Controller
{
    /**
     * @Route("/tasks")
     */
    public function showTasksAction() {

        return $this->render("MmmFrontendBundle:Task:index.html.twig");
    }
}
