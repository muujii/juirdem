<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Register;
use AdminBundle\Form\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{

    public function profileAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $repository = $em->getRepository("AdminBundle:Register")->find($id);
        $profile = new Register();
        $profile->setId($user->getId());
        $profile->setName($user->getName());
        $profile->setEmail($user->getEmail());
        $profile->setPassword($user->getPassword());
        $profile->setPhone($user->getPhone());
        $profile->setPath($user->getPath());

        return $this->render('AdminBundle:Pages:profile.html.twig', array('profiles' => array("profile" => $profile),));

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function profileEditAction($id, Request $request)
    {


        if ($request->getMethod() == "POST") {
            $name = $request->get("name");
            $email = $request->get("email");
            $phone = $request->get("phone");

            $new_psw = $request->get("new_psw");
            $new_rePsw = $request->get("new_rePsw");
            if (!empty($new_psw) && !empty($new_rePsw)) {
                if (strlen($new_psw) == strlen($new_rePsw)) {
                    $em = $this->getDoctrine()->getManager();
                    $query = $em->createQueryBuilder();
                    $q = $query->update("AdminBundle:Register", 'r')
                        ->set('r.name', '?1')
                        ->set('r.email', '?2')
                        ->set('r.phone', '?3')
                        ->set('r.password', '?4')
                        ->where('r.id= ?5')
                        ->setParameter(1, $name)
                        ->setParameter(2, $email)
                        ->setParameter(3, $phone)
                        ->setParameter(4, md5($new_psw))
                        ->setParameter(5, $id)
                        ->getQuery();
                    $result = $q->execute();

                    if ($result == 1) {
                        return $this->redirectToRoute("admin_profile", array('id' => $id, 'success' => 'Засварласан мэдээлэл амжилттай хадгалагдлаа. Таньд баярлалаа'));
                    } else {
                        return $this->redirectToRoute("admin_profile", array('id' => $id,  'error' => 'Та оруулсан мэдээллээ дахин шалгана уу!!!'));
                    }
                } else {
                    return $this->redirectToRoute("admin_profile", array('id' => $id, 'error' => 'Та нууц үгээ шалгаж үзээд дахин хадгална уу!!!'));
                }
            } else {
                $em = $this->getDoctrine()->getManager();
                $register = new Register();
                $query = $em->createQueryBuilder();
                $q = $query->update("AdminBundle:Register", 'r')
                    ->set('r.name', '?1')
                    ->set('r.email', '?2')
                    ->set('r.phone', '?3')
                    ->set('r.path', '?4')
                    ->where('r.id= ?5')
                    ->setParameter(1, $name)
                    ->setParameter(2, $email)
                    ->setParameter(3, $phone)
                    ->setParameter(4, $fileName)
                    ->setParameter(5, $id)
                    ->getQuery();
                $result = $q->execute();

                if ($result == 1) {
                    return $this->redirectToRoute("admin_profile", array('id' => $id));
                } else {
                    return $this->redirectToRoute("admin_profile", array('id' => $id));
                }
            }
        }
    }
}