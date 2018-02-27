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

class BillController extends Controller
{

	/**
     * @Route("/bill", name="customer_portal_bundle_list_user")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function listBillAction(Request $request){

        $user = $this->getUser();

        return $this->render('bill/bill.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'user' => $user,
        ]);
    }
}
