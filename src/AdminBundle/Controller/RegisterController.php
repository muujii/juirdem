<?php
namespace AdminBundle\Controller;


use AdminBundle\Entity\Register;
use AdminBundle\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $roles = $repository = $em->getRepository("AdminBundle:Role")->findAll();

        $register = new Register();
        $form = $this->createForm(RegisterType::class, $register);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form['password']->getData();
            $roleId = $form['roleId']->getData();

            $register->setRoleId($roleId->getId());
            $register->setPassword(md5($password));
            $register->setStartdate((new \DateTime())->format('Y-m-d'));
            $register->setEnddate((new \DateTime())->format('Y-m-d'));
            $register->setActive(true);

            $em = $this->getDoctrine()->getManager();
            $register->upload();
            $em->persist($register);
            $em->flush();

            return $this->redirectToRoute('admin_register', array('alert' => 'Амжилттай хадгалагдлаа. Таньд баярлалаа'));
        }
        return $this->render('AdminBundle:Pages:register.html.twig', array('form' => $form->createView(), 'roles' => $roles));
    }

}