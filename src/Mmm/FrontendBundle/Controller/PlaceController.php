<?php

namespace Mmm\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PlaceController extends Controller
{
    /**
     * @Route("/", name="_mmm_frontend_place_dashboard")
     */
    public function dashboardAction()
    {
        return $this->render('MmmFrontendBundle:Place:dashboard.html.twig');
    }

    /**
     * @Route("/{id}", name="_mmm_frontend_place_places")
     */
    public function placesAction()
    {
        return $this->render('MmmFrontendBundle:Place:places.html.twig');
    }


}
