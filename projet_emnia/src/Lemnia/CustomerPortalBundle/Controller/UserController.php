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

class UserController extends Controller
{

    /**
     * @Route("/users", name="customer_portal_bundle_listuser")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function listUserAction(Request $request){

        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('LemniaUserBundle:User')->findAll();

        return $this->render('users/users.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'users' => $users, 'user' => $user, 
        ]);
    }

    /**
     * @Route("/user", name="customer_portal_bundle_user")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function userAction(Request $request){

		$user = $this->getUser();

        return $this->render('users/user.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'user' => $user,
        ]);
    }

    /**
     * @Route("/users/edit/{id}", name="customer_portal_bundle_edituser")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function editUserAction(Request $request){

        /*$user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('LemniaUserBundle:User')->findAll();

        return $this->render('users/users.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'users' => $users, 'user' => $user, 
        ]);*/

        return $this->redirectToRoute('lemnia_customer_portal_listuser');
    }
}
