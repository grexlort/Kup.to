<?php

namespace Mmm\ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use Mmm\ApiBundle\Entity\Place;
use Mmm\ApiBundle\Form\PlaceType;

/**
 * Class PlaceController
 * @package Mmm\ApiBundle\Controller
 */
class PlaceController extends Controller
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
        $offset = $paramFetcher->get('offset');
        $limit = $paramFetcher->get('limit');

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
     * @Security("place.isAuthor(user)")
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
     * @Security("place.isAuthor(user)")
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
        $form = $this->createForm(new PlaceType(), $place, array(
            'method' => $method
        ));

        if ($form->handleRequest($request)->isValid()) {
            $status = null === $place ? Response::HTTP_CREATED : Response::HTTP_OK;

            $em = $this->getDoctrine()->getManager();

            $place = $place ?: $form->getData();
            $em->persist($place);
            $em->flush($place);

            return View::create($place, $status);
        }

        return View::create($form, Response::HTTP_BAD_REQUEST);
    }
}
