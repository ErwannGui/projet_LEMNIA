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


/**
 * HomePage controller
 * On définit une route de base pour ce controller
 * @Route("HomePage")
 */
class HomePageController extends Controller
{

	/**
     * @Route("/", name="customer_portal_bundle_home_page")
     * On peut définir des droits spécifiques à cette route afin d'en limiter l'accès
     */
    public function homePageAction(Request $request){

		$user = $this->getUser();

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

        $subsok = 0;
        $subspast = 0;
        $soonoff = 0;
        $date = new \DateTime('now');
        $nextdate = date('Y-m-d',strtotime('+12 month',strtotime(date_format($date, 'Y-m-d'))));
        $nextdate2 =  date('Y-m-d',strtotime('+6 month',strtotime(date_format($date, 'Y-m-d'))));
        $costbyyear = 0;$date = new \DateTime('now');
        $costbym = 0;
        $apiKey = "mp70cv82";
        $apiUrl = "https://doli2.lemnia.net/api/index.php/";
        $listSubs = array();
        $param = ["limit" => 1000, "sortfield" => "rowid"];
        $listSubsResult = CallAPI("GET", $apiKey, $apiUrl."subscriptions", $param);
        if (isset($listSubsResult["error"]) && $listSubsResult["error"]["code"] >= "300") {
            $error_sub = true;
        } else {
            foreach ($listSubsResult as $subscriptions) {
                array_push($listSubs, $subscriptions);
                foreach ($listSubs["costm"] as $value) {
                    $costbym += $value;
                }
                foreach ($listSubs["costm"] as $value) {
                    if ($listSubs["date"] > $nextdate){
                        $costbyyear += ($value*12);
                    }
                }
                    if ($listSubs["date"] < $nextdate2 && $listSubs["date"] > $date){
                        $soonoff +=1;
                }
                    if ( $listSubs["date"] < $date ){
                        $subspast += 1;
                    }
                    if ($listSubs["date"] > $nextdate2 ){
                        $subsok +=1;
                    }
            }
        }

        $listOrders = array();
        $param = ["limit" => 1000, "sortfield" => "rowid"];
        $listOrdersResult = CallAPI("GET", $apiKey, $apiUrl."orders", $param);
        if (isset($listOrdersResult["error"]) && $listSubsResult["error"]["code"] >= "300") {
            $error_order = true;
        } else {
            foreach ($listOrdersResult as $orders) {
                array_push($listOrders, $orders);
            }
        }

        return $this->render('homepage/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,'error_sub' => $error_sub, 'listSubs' => $listSubs, "costbym" => $costbym, "costbyyear" =>$costbyyear, 'soonoff' => $soonoff, 'subspast' => $subspast, 'subsok' => $subsok, 'listOrders' => $listOrders, 'error_order' => $error_order
        ]);
    }


    

}
