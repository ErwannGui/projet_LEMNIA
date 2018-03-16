<?php

namespace Lemnia\CustomerPortalBundle\Controller;

use Lemnia\CustomerPortalBundle\Entity\CarteBancaire;
use Lemnia\UserBundle\LemniaUserBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Lemnia\UserBundle\Entity\User;
use Lemnia\CustomerPortalBundle\Entity\Sepa;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class UserController extends Controller
{

    /**
     * @Route("/users", name="customer_portal_bundle_listuser")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function listUserAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('LemniaUserBundle:User')->findAll();

        return $this->render('users/users.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'users' => $users,
        ]);
    }

    /**
     * @Route("/user", name="customer_portal_bundle_user")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function userAction(Request $request){
        $em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$userId = $user->getId();

        $initial = substr($user->getFirstName(),0,1) . substr($user->getLastname(),0,1);
		$sepa = $this->getDoctrine()
            ->getRepository('LemniaCustomerPortalBundle:Sepa')
            ->findOneBy(array("userId"=>$userId));

		$carteBancaire = $this->getDoctrine()
            ->getRepository(CarteBancaire::class)
            ->findBy(array("userId"=>$userId));

        $formInfoPerso = $this -> createFormBuilder()
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('socity', TextType::class)
            ->add('job', TextType::class)
            ->add('pays', TextType::class)
            ->add('ville', TextType::class)
            ->add('cPostal', NumberType::class)
            ->add('adresse', TextType::class)
            ->add('telephone',NumberType::class)
            ->add('email', EmailType::class)
            ->getForm();

        $request = Request::createFromGlobals();
        $formInfoPerso->handleRequest($request);
        if ($formInfoPerso->isSubmitted() && $formInfoPerso->isValid()) {
            $firstName = $formInfoPerso->get('firstname')->getData();
            $lastname = $formInfoPerso->get('lastname')->getData();
            $socity = $formInfoPerso->get('socity')->getData();
            $job = $formInfoPerso->get('job')->getData();
            $pays = $formInfoPerso->get('pays')->getData();
            $ville = $formInfoPerso->get('ville')->getData();
            $codePostal = $formInfoPerso->get('cPostal')->getData();
            $adresse = $formInfoPerso->get('adresse')->getData();
            $tel = $formInfoPerso->get('telephone')->getData();
            $email = $formInfoPerso->get('email')->getData();

            $user->setFirstName($firstName);
            $user->setLastName($lastname);
            $user->setSocity($socity);
            $user->setJob($job);
            $user->setEmail($email);
            $user->setPhoneNumber($tel);
            $user->setNation($pays);
            $user->setCity($ville);
            $user->setCodePostal($codePostal);
            $user->setAdresse($adresse);

            $em->flush();
        }
        $formSepa = $this -> createFormBuilder()
            ->add('iban', TextType::class)
            ->add('bic', NumberType::class)
            ->getForm();

//
//        $data_uri = "data:img/png;base64,iVBORw0K...";
//        $encoded_image = explode(",", $data_uri)[1];
//        $decoded_image = base64_decode($encoded_image);
//        file_put_contents("signature.png", $decoded_image);

        $formSepa->handleRequest($request);
        $userUpdate = $em->getRepository('LemniaUserBundle:User')->find($userId);
        if ($formSepa->isSubmitted() && $formSepa->isValid()) {
            $iban = $formSepa->get('iban')->getData();
            $bic = $formSepa->get('bic')->getData();
            $date = new \DateTime('now');


            $sepa->setIban($iban);
            $sepa->setBic($bic);
            $sepa->setDateSignature($date);
            $sepa->setUserId($user);

            $em->flush();
        }


        $formCarteBancaire = $this -> createFormBuilder()
            ->add('type', TextType::class)
            ->add('numeroCarte', NumberType::class)
            ->add('dateExpiration', DateType::class)
            ->add('pictogramme', NumberType::class)
            ->getForm();

        $formCarteBancaire->handleRequest($request);
        if ($formCarteBancaire->isSubmitted() && $formCarteBancaire->isValid()) {
            $type = $formCarteBancaire->get('type')->getData();
            $numeroCarte = $formCarteBancaire->get('numeroCarte')->getData();
            $date = $formCarteBancaire->get('dateExpiration')->getData();
            $pictogramme = $formCarteBancaire->get('pictogramme')->getData();

            $addCarteBancaire = new CarteBancaire();

            $addCarteBancaire->setType($type);
            $addCarteBancaire->setNumeroCarte($numeroCarte);
            $addCarteBancaire->setDateExpiration($date);
            $addCarteBancaire->setPictogramme($pictogramme);

            $em->flush();
        }


        return $this->render('users/user.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'user' => $user,'formInfoPerso'=>$formInfoPerso->createView(), 'sepa'=>$sepa, 'formSepa'=>$formSepa->createView(), 'initial'=>$initial, 'formCarteBancaire'=>$formCarteBancaire->createView(),'carteBancaires'=>$carteBancaire,
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

    public function contactsAction(Request $request){


        return $this->render('users/contacts.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
