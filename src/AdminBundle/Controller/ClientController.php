<?php

namespace AdminBundle\Controller;

use AppBundle\Entity\ClientRegister;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    public function clientAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $repository = $em->getRepository("AppBundle:ClientRegister")->findAll();
        return $this->render('AdminBundle:Pages:client.html.twig', array('clients' => $clients));
    }

    public function clientEditShowAction($id)
    {

        $clientEdit = new ClientRegister();
        $em = $this->getDoctrine()->getManager();

        $client = $repository = $em->getRepository("AppBundle:ClientRegister")->find($id);
        $clientEdit->setId($client->getId());
        $clientEdit->setFirstname($client->getFirstname());
        $clientEdit->setLastname($client->getLastname());
        $clientEdit->setEmail($client->getEmail());
        $clientEdit->setPassword($client->getPassword());
        $clientEdit->setCompany($client->getCompany());
        $clientEdit->setJob($client->getJob());
        $clientEdit->setStartDate($client->getStartDate());
        $clientEdit->setAddress($client->getAddress());
        $clientEdit->setPhone($client->getPhone());
        $clientEdit->setIsActive($client->getIsActive());

        return $this->render('AdminBundle:Edits:editClient.html.twig', array('cls' => array("cl" => $clientEdit),));
    }

    public function clientEditAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $active = $request->get("active");

            $query = $em->createQueryBuilder();
            $q = $query->update("AppBundle:ClientRegister", 'c')
                ->set('c.active', '?1')
                ->where('c.id= ?2')
                ->setParameter(1, $active)
                ->setParameter(2, $id)
                ->getQuery();
            $result = $q->execute();

            if ($result == 1) {
                return $this->redirectToRoute("admin_client");
            }
        }
    }

    public function clientDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQueryBuilder();
        $q = $query->delete("AppBundle:ClientRegister", 'c')
            ->where('c.id= ?1')
            ->setParameter(1, $id)
            ->getQuery();
        $result = $q->execute();

        if ($result == 1) {
            return $this->redirectToRoute("admin_client");
        }
    }
}