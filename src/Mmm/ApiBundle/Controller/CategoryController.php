<?php

namespace Mmm\ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\View\View;
use Mmm\ApiBundle\Entity\Category;
use Mmm\ApiBundle\Form\CategoryType;

/**
 * Class CategoryController
 * @package Mmm\ApiBundle\Controller
 */
class CategoryController extends FOSRestController
{
    /**
     * @ApiDoc(
     *      description="Get category for logged user",
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
     *          200="Success",
     *          400={
     *              "Validation errors"
     *          }
     *      }
     *  )
     */
    public function getCategoryAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('MmmApiBundle:Category');

        $view = View::create([
            $repository->findAll()
        ]);

        return $this->handleView($view);
    }

    /**
     */
    public function postCategoryAction(Request $request)
    {
        $category = new Category();

        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        $category->setCreatedBy($this->getUser());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush($category);
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Security("user == category.getCreatedBy()")
     */
    public function putCategoryAction(Request $request, Category $category)
    {
        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush($category);
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Security("user == category.getCreatedBy()")
     */
    public function deleteCategoryAction(Request $request, Category $category)
    {
        $form = $this->createForm(new CategoryType(), $category);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($category);
            $em->flush($category);
        }

        return array(
            'form' => $form->createView()
        );
    }


}
