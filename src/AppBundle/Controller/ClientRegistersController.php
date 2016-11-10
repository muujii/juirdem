<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClientRegister;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientRegistersController extends Controller
{
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $company = $request->get("company");
            $firstname = $request->get("firstname");
            $lastname = $request->get("lastname");
            $email = $request->get("email");
            $password = $request->get("password");
            $re_password = $request->get("re_password");
            $job = $request->get("job");
            $phone = $request->get("phone");

            ob_start(); // Turn on output buffering
            system('ipconfig /all'); //Execute external program to display output
            $mycom = ob_get_contents(); // Capture the output into a variable
            ob_clean(); // Clean (erase) the output buffer
            $findme = "Physical";
            $pmac = strpos($mycom, $findme); // Find the position of Physical text
            $mac = substr($mycom, ($pmac + 36), 17); // Get Physical Address

            if ((!empty($password) && !empty($re_password)) && (strlen($password) == strlen($re_password))) {
                    $clientR = new ClientRegister();
                    $clientR->setCompany($company);
                    $clientR->setFirstname($firstname);
                    $clientR->setLastname($lastname);
                    $clientR->setEmail($email);
                    $clientR->setPassword(md5($password));
                    $clientR->setJob($job);
                    $clientR->setPhone($phone);
                    $clientR->setIsActive(false);
                    $clientR->setAddress($mac);
                    $clientR->setStartDate((new \DateTime())->format('Y-m-d'));
                    $clientR->setEndDate((new \DateTime())->format('Y-m-d'));

                    $em->persist($clientR);
                    $em->flush();

                    return $this->render('default/index.html.twig', array('msgg' => 'Бид таны хүсэлтийг хүлээн авлаа эргэн холбогдох болно. Таньд баярлалаа.'));
            }
        }
    }
}