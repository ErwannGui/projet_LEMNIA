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

        $listBills = array();
        $param = ["limit" => 1000, "sortfield" => "rowid"];
        $listBillsResult = CallAPI("GET", $apiKey, $apiUrl."invoices", $param);

        if (isset($listBillsResult["error"]) && $listBillsResult["error"]["code"] >= "300") {
            $error = true;
        } else {
            foreach ($listBillsResult as $bill) {
                array_push($listBills, $bill);
            }
        }

        $user = $this->getUser();

        return $this->render('bill/bill.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR, 'error' => $error, 'listBills' => $listBills
        ]);
    }
}
