<?php

namespace Lemnia\CustomerPortalBundle\Controller;

use Lemnia\CustomerPortalBundle\Entity\CarteBancaire;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserController extends Controller
{

    /**
     * @Route("/users", name="customer_portal_bundle_listuser")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function listUserAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('LemniaUserBundle:User')->findAll();

        /*La possibilité de se connecter à un utilisateur en tant qu'admin est à déployer. Il faut pour cela ajouter une verification de variable (boolean admin true ou false) au chargement des pages avec les fonctions __construct*/

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
            ->add('signature',HiddenType::class)
            ->getForm();

        $formSepa->handleRequest($request);

        if ($formSepa->isSubmitted() && $formSepa->isValid()) {
            $iban = $formSepa->get('iban')->getData();
            $bic = $formSepa->get('bic')->getData();
            $date = new \DateTime('now');
            $signature = $formSepa->get('signature')->getData();


            $sepa->setIban($iban);
            $sepa->setBic($bic);
            $sepa->setDateSignature($date);
            $sepa->setUserId($user);
            $sepa->setSignature($signature);

            $em->flush();
        }


        $formCarteBancaire = $this -> createFormBuilder()
            ->add('type', ChoiceType::class, array(
                'choices' => array(
                    'Visa' => 'Visa',
                    'MasterCard' => 'MasterCard'
                )
            ))
            ->add('numeroCarte', NumberType::class,array(
                'attr' => array(
                    'placeholder' => 'numéro de la carte',
                    'style' => 'margin-left:20px; color:white'
                )
            ))
            ->add('dateExpiration', DateTimeType::class, array(
                'attr'=>array(
                    'style'=>'width:150px; margin-right:20px; color:white'
                ),
                'label' => 'Date d\'expiration: '
            ))
            ->add('pictogramme', NumberType::class, array(
                'attr'=>array(
                    'style'=>'width:150px; color:white',
                    'placeholder'=>'Pictogramme'
                )
            ))
            ->getForm();
        $formCarteBancaire->handleRequest($request);

        if ($formCarteBancaire->isSubmitted() && $formCarteBancaire->isValid()) {
            $type = $formCarteBancaire->get('type')->getData();
            $numeroCarte = $formCarteBancaire->get('numeroCarte')->getData();
            $date = $formCarteBancaire->get('dateExpiration')->getData();
            $pictogramme = $formCarteBancaire->get('pictogramme')->getData();

            $addCarteBancaire = new CarteBancaire();
            if (($type == "Visa" && substr($numeroCarte,0,1) == "4") or ($type == "MasterCard" && substr($numeroCarte,0,1) == "5")){
                $addCarteBancaire->setType($type);
                $addCarteBancaire->setNumeroCarte($numeroCarte);
                $addCarteBancaire->setDateExpiration($date);
                $addCarteBancaire->setPictogramme($pictogramme);
                $addCarteBancaire->setUserId($user);

            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($addCarteBancaire);
            $em->flush();

        }
        $i = 0;


        return $this->render('users/user.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'user' => $user,'formInfoPerso'=>$formInfoPerso->createView(), 'sepa'=>$sepa, 'formSepa'=>$formSepa->createView(), 'initial'=>$initial, 'formCarteBancaire'=>$formCarteBancaire->createView(),'carteBancaires'=>$carteBancaire,'i'=>$i,
        ]);
    }
    /**
     * @Route("/user?id={id}", name="customer_portal_bundle_user_delete")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function deleteUserCreditCardAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $id = $request->query->get('id');
        $carteBancaire = $this->getDoctrine()
            ->getRepository('LemniaCustomerPortalBundle:CarteBancaire')
            ->find($id);
        $em->remove($carteBancaire);
        $em->flush();
        return $this->redirectToRoute('lemnia_customer_portal_user');
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
