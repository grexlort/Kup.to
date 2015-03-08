<?php

namespace Mmm\FrontendBundle\Controller;
use Mmm\FrontendBundle\Entity\User;
use Mmm\FrontendBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserController
 * @package Mmm\FrontendBundle\Controller
 * @Route("/user")
 * @Template())
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="_aaa_user_list")
     */
    public function indexAction()
    {

    }

    /**
     * @Route("/add", name="_aaa_user_add")
     */
    public function addAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush($user);
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"}, name="_aaa_user_edit")
     */
    public function editAction(Request $request, User $user)
    {
        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush($user);
        }

        return array(
            'form' => $form->createView()
        );
    }
}
