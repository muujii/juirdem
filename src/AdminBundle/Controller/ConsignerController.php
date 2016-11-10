<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Consigner;
use AdminBundle\Form\ConsignerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ConsignerController extends Controller
{
    public function consignerAction(Request $request)
    {
        $consigner = new Consigner();
        $form = $this->createForm(ConsignerType::class, $consigner);

        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $consigner->setDates((new \DateTime())->format('Y-m-d'));
            $consigner->setActive(true);
            $em->persist($consigner);
            $em->flush();

            return $this->redirectToRoute('admin_consigner');
        } else {
            $consigners = $repository = $em->getRepository("AdminBundle:Consigner")->findAll();

            return $this->render('AdminBundle:Pages:consigner.html.twig', array('form' => $form->createView(), 'consigners' => $consigners));
        }
    }

    public function consignerEditShowAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $consEdit = $repository = $em->getRepository("AdminBundle:Consigner")->find($id);
        $consignerEdit = new Consigner();

        $consignerEdit->setId($consEdit->getId());
        $consignerEdit->setCompany($consEdit->getCompany());
        $consignerEdit->setDates($consEdit->getDates());
        $consignerEdit->setActive($consEdit->getActive());
        $consignerEdit->setName($consEdit->getName());
        $consignerEdit->setRegister($consEdit->getRegister());
        $consignerEdit->setEmail($consEdit->getEmail());
        $consignerEdit->setPhone($consEdit->getPhone());
        $consignerEdit->setAddress($consEdit->getAddress());
        $consignerEdit->setType($consEdit->getType());
        $consignerEdit->setVat($consEdit->getVat());

        return $this->render('AdminBundle:Edits:editConsigner.html.twig', array('cons' => array("con" => $consignerEdit),));
    }

    public function consignerEditAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $company = $request->get("company");
            $register = $request->get("register");
            $name = $request->get("name");
            $email = $request->get("email");
            $phone = $request->get("phone");
            $address = $request->get("address");
            $type = $request->get("type");
            $vat = $request->get("vat");

            $query = $em->createQueryBuilder();
            $q = $query->update("AdminBundle:Consigner", 'c')
                ->set('c.company', '?1')
                ->set('c.register', '?2')
                ->set('c.name', '?3')
                ->set('c.email', '?4')
                ->set('c.phone', '?5')
                ->set('c.address', '?6')
                ->set('c.type', '?7')
                ->set('c.vat', '?8')
                ->where('c.id= ?9')
                ->setParameter(1, $company)
                ->setParameter(2, $register)
                ->setParameter(3, $name)
                ->setParameter(4, $email)
                ->setParameter(5, $phone)
                ->setParameter(6, $address)
                ->setParameter(7, $type)
                ->setParameter(8, $vat)
                ->setParameter(9, $id)
                ->getQuery();
            $result = $q->execute();

            if ($result == 1) {
                return $this->redirectToRoute("admin_consigner");
            }
        }
    }

    public function consignerDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder();
        $q = $query->delete("AdminBundle:Consigner", 'c')
            ->where('c.id= ?1')
            ->setParameter(1, $id)
            ->getQuery();
        $result = $q->execute();

        if ($result == 1) {
            return $this->redirectToRoute("admin_consigner");
        }
    }
}