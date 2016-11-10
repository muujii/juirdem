<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ClientSlider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Entity\ClientRegister;
use AppBundle\Form\ClientRegisterType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
		//try{
		// 1) form байгуулна.
        $client = new ClientRegister();
		$form = $this->createForm(ClientRegisterType::class, $client);
		
		// 2) Form оос илгээж байгаа мэдээллийг боловсруулна. Зөвхөн submit хийсэн үед ажиллана. 
		$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Хэрэглэгчийн оруулсан нууц үгийг encode хийнэ. 
            $password = $this->get('security.password_encoder')
                ->encodePassword($client, $client->getPassword());
            $client->setPassword($password);

            // 4) Мэдээллийг бааз руу хадгална.
			$client->setIsActive(false);
			ob_start();
            system('ipconfig /all'); 
            $mycom = ob_get_contents(); 
            ob_clean(); 
            $findme = "Physical";
            $pmac = strpos($mycom, $findme); 
            $mac = substr($mycom, ($pmac + 36), 17); 
            $client->setAddress($mac);
            $client->setStartDate((new \DateTime())->format('Y-m-d'));
            $client->setEndDate((new \DateTime())->format('Y-m-d'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
			}
			$this->addFlash("notice", "Бид таны хүсэлтийг хүлээн авлаа эргэн холбогдох болно. Таньд баярлалаа.");
		return $this->render('default/index.html.twig', array('form'=>$form->createView()));
		//}
		//catch(Exception $e){
		//	echo $e;
		//}
    }

	/**
     * @Route("/login", name="userpage")
     */
    public function loginAction(Request $request)
    {
	    $user = new ClientRegister();
		$form = $this->createForm(ClientRegisterType::class, $user);
		
        if ($request->getMethod() == "POST") {
            $email = $request->get("email");
           // $client->setPassword($password);
            $password = $request->get("password");
			$em = $this->getDoctrine()->getManager();
            ob_start(); // Turn on output buffering
            system('ipconfig /all'); //Execute external program to display output
            $mycom = ob_get_contents(); // Capture the output into a variable
            ob_clean(); // Clean (erase) the output buffer
            $findme = "Physical";
            $pmac = strpos($mycom, $findme); // Find the position of Physical text
            $mac = substr($mycom, ($pmac + 36), 17); // Get Physical Address

            $client = $repository = $em->getRepository("AppBundle:ClientLogin")->findOneBy(array("email" => $email, "password" => md5($password)));

            if ($client !== null) {
                if (($client->getEmail() === $email) && ($client->getPassword() === md5($password))) {
                    if ($client->getIsActive() === true) {
                        if ($client->getAddress() === $mac) {
                            $sessionClient = new Session();
                            $sessionClient->set("id", array("id" => $client->getId()));
                            $sessionClient->set("name", array("name" => $client->getLastName()));
                            $sessionClient->save();

                            $query = $em->createQueryBuilder();

                            $q = $query->select('c')
                                ->from("AppBundle:ClientSlider", 'c')
                                ->where('c.active= ?1')
                                ->setParameter(1, '1')
                                ->getQuery();
                            $result = $q->execute();

                            $q = $query->select('ss')
                                ->from("AppBundle:ClientSmallSlider", 'ss')
                                ->where('ss.active= ?1')
                                ->setParameter(1, '1')
                                ->getQuery();
                            $small_result = $q->execute();

                            $query = $em->createQuery('SELECT m.id, m.labelMN FROM AdminBundle:Menu m WHERE m.parentID IS NULL AND m.active = TRUE ');
                            $parentMenus = $query->getResult();

                            $query = $em->createQuery('SELECT m FROM AdminBundle:Menu m WHERE m.parentID IS NOT NULL ');
                            $subMenus = $query->getResult();

                            return $this->render("default/template.html.twig", array('slider' => $result, "smallSlider" => $small_result, "parentMenus" => $parentMenus, "subMenus" => $subMenus));
                        } else {
							$this->addFlash("notice", "Та энэ компьютерээс нэвтрэх эрхгүй байна.");
                            return $this->render("default/index.html.twig", array('form'=>$form->createView()));
                        }
                    } else {
					$this->addFlash("notice", "Таны нэвтрэх эрх идэвхгүй байна..");
                            return $this->render("default/index.html.twig", array('form'=>$form->createView()));
                       
                    }
                } else {
				$this->addFlash("notice", "Таны нэр эсвэл нууц үг буруу байна.");
                            return $this->render("default/index.html.twig", array('form'=>$form->createView()));
                    
                }
            } else {
				$this->addFlash("notice", "Таны нэр эсвэл нууц үг буруу байна.".md5($password));
                            return $this->render("default/index.html.twig", array('form'=>$form->createView()));
                
            }
        }
    }

    public function logoutAction(Request $request)
    {
        $sessionClient = $request->getSession();
        if ($sessionClient->has("id")) {
            $sessionClient->clear();
            return $this->render('default/index.html.twig');
        }
    }

    /**
     * @Route("/home3", name="home3")
     */
    public function productsAction(Request $request)
    {
        return $this->render('pages/products.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/home4", name="home4")
     */
    public function productAction(Request $request)
    {
        return $this->render('pages/product.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR,
        ]);
    }
}
