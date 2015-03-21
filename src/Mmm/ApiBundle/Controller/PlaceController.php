<?php

namespace Mmm\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use Mmm\ApiBundle\Entity\Place;
use Mmm\ApiBundle\Form\PlaceType;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\QueryParam;

/**
 * Class PlaceController
 * @package Mmm\ApiBundle\Controller
 */
class PlaceController extends FOSRestController
{
    /**
     * Get places for logged user
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
    public function getPlacesAction(ParamFetcher $paramFetcher)
    {
        $offset = (int) $paramFetcher->get('offset');
        $limit = (int) $paramFetcher->get('limit');

        $places = $this->getDoctrine()
            ->getRepository('MmmApiBundle:Place')
            ->findAuthorCategories($this->getUser(), $offset, $limit)
        ;

        return View::create($places);
    }

    /**
     * Create place
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
    public function postPlacesAction(Request $request)
    {
        return $this->processPlaceForm($request);
    }

    /**
     * Update place
     *
     * @Security("user == place.getCreatedBy()")
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
    public function patchPlaceAction(Request $request, Place $place)
    {
        $this->processPlaceForm($request, $place, 'PATH');
    }

    /**
     * Delete place
     *
     * @Security("user == place.getCreatedBy()")
     *
     * @ApiDoc(
     *      description="Delete place",
     *      statusCodes={
     *          205="Success"
     *      }
     *  )
     */
    public function deletePlaceAction(Request $request, Place $place)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($place);
        $em->flush($place);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }

    protected function processPlaceForm(Request $request, Place $place = null, $method = 'POST')
    {
        $form = $this->createForm($place, $place, array(
            'method' => $method
        ));

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($place);
            $em->flush($place);

            $status = null === $place ? Response::HTTP_CREATED : Response::HTTP_OK;
            return View::create($form, $status);
        }

        return View::create($form, Response::HTTP_BAD_REQUEST);
    }
}
