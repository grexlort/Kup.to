<?php

namespace Mmm\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use Mmm\ApiBundle\Entity\Place;
use Mmm\ApiBundle\Form\PlaceType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PlaceController
 * @package Mmm\ApiBundle\Controller
 */
class PlaceController extends FOSRestController
{
    /**
     * @ApiDoc(
     *      description="Get places for logged user",
     *      parameters={
     *          {
     *              "name"="offset",
     *              "dataType"="integer",
     *              "required"=false
     *          },
     *          {
     *              "name"="limit",
     *              "dataType"="integer",
     *              "required"=false
     *          }
     *      },
     *      statusCodes={
     *          200="Success"
     *      }
     *  )
     */
    public function getPlaceAction(Request $request)
    {
        $offset = (int) $request->get('offset', 0);
        $limit = (int) $request->get('limit', 20);

        $places = $this->getDoctrine()
            ->getRepository('MmmApiBundle:Place')
            ->findAuthorCategories($this->getUser(), $offset, $limit)
        ;

        $view = View::create($places);

        return $this->handleView($view);
    }

    /**
     * @ApiDoc(
     *      description="Create place",
     *      input="Mmm\ApiBundle\Form\PlaceType",
     *      statusCodes={
     *          200="Success",
     *          400="Validation errors"
     *      }
     *  )
     */
    public function postPlaceAction(Request $request)
    {
        $place = new Place();

        $form = $this->createForm(new PlaceType(), $place);
        $form->handleRequest($request);

        $place->setCreatedBy($this->getUser());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($place);
            $em->flush($place);

            $view = View::create($place);

            return $this->handleView($view);
        }

        $view = View::create($form, Response::HTTP_BAD_REQUEST);

        return $this->handleView($view);
    }

    /**
     * @Security("user == place.getCreatedBy()")
     */
    public function putPlaceAction(Request $request, Place $place)
    {
        $form = $this->createForm(new PlaceType(), $place);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($place);
            $em->flush($place);
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Security("user == place.getCreatedBy()")
     */
    public function deletePlaceAction(Request $request, Place $place)
    {
        $form = $this->createForm(new PlaceType(), $place);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($place);
            $em->flush($place);
        }

        return array(
            'form' => $form->createView()
        );
    }


}
