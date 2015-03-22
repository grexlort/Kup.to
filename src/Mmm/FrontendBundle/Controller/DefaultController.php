<?php

namespace Mmm\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 * @package Mmm\FrontendBundle\Controller
 *
 * @Template()
 */
class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return array();
    }
}
