<?php

namespace Mmm\FrontendBundle\Controller;

use Mmm\FrontendBundle\Entity\Category;
use Mmm\FrontendBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CategoryController
 * @package Mmm\FrontendBundle\Controller
 * @Route("/category")
 * @Template()
 */
class CategoryController extends Controller
{
    /**
     * @Route("/", name="_mmm_category_list")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository('MmmFrontendBundle:Category');
        
        return array(
            'categories' => $repository->findAll()
        );
    }

    /**
     * @Route("/add", name="_mmm_category_add")
     */
    public function addAction(Request $request)
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
     * @Route("/{id}", requirements={"id": "\d+"}, name="_mmm_category_edit")
     * @Security("user == category.getCreatedBy()")
     */
    public function editAction(Request $request, Category $category)
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
     * @Route("/{id}/delete", requirements={"id": "\d+"}, name="_mmm_category_delete")
     * @Security("user == category.getCreatedBy()")
     */
    public function deleteAction(Request $request, Category $category)
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
