<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Login;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function loginAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $email = $request->get("email");
            $password = $request->get("password");
            $adminPassword = md5($password);

            $user = $repository = $em->getRepository("AdminBundle:Login")->findOneBy(array("email" => $email, "password" => $adminPassword));

            if ($user !== null) {
                if ($user->isEnabled() == true) {
                    $sessionAdmin = new Session();
                    $sessionAdmin->set("id", array("id" => $user->getId()));
                    $sessionAdmin->set("name", array("name" => $user->getName()));
                    $sessionAdmin->save();

                    return $this->render("AdminBundle:Default:template.html.twig");
                } else {
                    return $this->render("AdminBundle:Default:index.html.twig", array("name" => "Таны нэвтрэх нэр эсвэл нууц үг буруу байна."));
                }
            } else {
                return $this->render("AdminBundle:Default:index.html.twig", array("name" => "Таны нэвтрэх нэр эсвэл нууц үг буруу байна."));
            }
        }
        return $this->render('AdminBundle:Default:index.html.twig');
    }

    public function logoutAction(Request $request)
    {
        $sessionAdmin = $request->getSession();
        if ($sessionAdmin->has("id")) {
            $sessionAdmin->clear();
            return $this->render('AdminBundle:Default:index.html.twig');
        }
    }
}
