<?php

namespace Lemnia\CustomerPortalBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lemnia\UserBundle\Entity\User;

class DefaultController extends Controller
{
	/**
     * @Route("/", name="customer_portal_bundle_home_page")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function homePageAction(Request $request){

		/*$user = $this->getUser()->getId();*/

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('LemniaUserBundle:User')->findAll();

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'users' => $users,
        ]);
    }

    /**
     * @Route("/users", name="customer_portal_bundle_list_user")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function listUserAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('LemniaUserBundle:User')->findAll();

        return $this->render('default/users.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'users' => $users,
        ]);
    }

}
    /*@Security("has_role('ROLE_HELPER')")*/