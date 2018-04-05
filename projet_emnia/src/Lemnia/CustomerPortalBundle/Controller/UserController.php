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
            ->add('firstname', TextType::class, array(
                'attr'=>array(
                    'placeholder'=>'prenom'
                )
            ))
            ->add('lastname', TextType::class, array(
                'attr'=>array(
                    'placeholder'=>'nom'
                )
            ))
            ->add('socity', TextType::class, array(
                'attr'=>array(
                    'placeholder'=>'société'
                )
            ))
            ->add('job', TextType::class, array(
                'attr'=>array(
                    'placeholder'=>'job'
                )
            ))
            ->add('pays', TextType::class, array(
                'attr'=>array(
                    'placeholder'=>'pays'
                )
            ))
            ->add('ville', TextType::class, array(
                'attr'=>array(
                    'placeholder'=>'ville'
                )
            ))
            ->add('cPostal', NumberType::class, array(
                'attr'=>array(
                    'placeholder'=>'code Postal'
                )
            ))
            ->add('adresse', TextType::class, array(
                'attr'=>array(
                    'placeholder'=>'adresse'
                )
            ))
            ->add('telephone',NumberType::class, array(
                'attr'=>array(
                    'placeholder'=>'telephone'
                )
            ))
            ->add('email', EmailType::class, array(
                'attr'=>array(
                    'placeholder'=>'email'
                )
            ))
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

        $formConnexion = $this -> createFormBuilder()
            ->add('pseudo',TextType::class)
            -> getForm();

        $formConnexion->handleRequest($request);

        if ($formConnexion->isSubmitted() && $formConnexion->isValid()){
            $pseudo = $formConnexion->get('pseudo')->getData();

            $user->setUsername($pseudo);
            $em->flush();
        }

        $formSepa = $this -> createFormBuilder()
            ->add('iban', TextType::class, array(
                'attr'=>array(
                    'placeholder'=>'IBAN'
                )
            ))
            ->add('bic', NumberType::class, array(
                'attr'=>array(
                    'placeholder'=>'BIC'
                )
            ))
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
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'user' => $user,'formInfoPerso'=>$formInfoPerso->createView(), 'sepa'=>$sepa, 'formSepa'=>$formSepa->createView(), 'initial'=>$initial, 'formCarteBancaire'=>$formCarteBancaire->createView(),'carteBancaires'=>$carteBancaire,'i'=>$i,'formConnexion'=>$formConnexion->createView(),
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

        function CallAPI($method, $apikey, $url, $data = false){
            $curl = curl_init();
            $httpheader = ['DOLAPIKEY: '.$apikey];
         
            switch ($method)
            {
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, 1);
                    $httpheader[] = "Content-Type:application/json";
         
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         
                    break;
                case "PUT":
         
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                    $httpheader[] = "Content-Type:application/json";
         
                    if ($data)
                        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         
                    break;
                default:
                    if ($data)
                        $url = sprintf("%s?%s", $url, http_build_query($data));
            }
         
            // Optional Authentication:
            //    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            //    curl_setopt($curl, CURLOPT_USERPWD, "username:password");
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
         
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);
         
            $result = curl_exec($curl);
         
            curl_close($curl);
         
            return json_decode($result, true);
        }
    
        $apiKey = "mp70cv82";
        $apiUrl = "https://doli2.lemnia.net/api/index.php/";
        $listContacts = array();
        $param = ["limit" => 1000, "sortfield" => "rowid"];
        $listContactsResult = CallAPI("GET", $apiKey, $apiUrl."contacts", $param);
        if (isset($listContactsResult["error"]) && $listContactsResult["error"]["code"] >= "300") {
        	$error = true;
        } else {
            foreach ($listContactsResult as $contatcs) {
                array_push($listContacts, $contacts);
            }
        }
       
		 return $this->render('users/contacts.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'listContacts' => $listContacts, 'error' => $error
        ]);
    }

    
}
