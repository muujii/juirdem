<?php

namespace AdminBundle\Controller;


use AdminBundle\Entity\SmallSlider;
use AdminBundle\Form\SmallSliderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SmallSliderController extends Controller
{
    public function smallSliderShowAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $smallSliders = new SmallSlider();

        $smallSliderForm = $this->createForm(SmallSliderType::class, $smallSliders);

        $smallSliderForm->handleRequest($request);

        if ($smallSliderForm->isSubmitted() && $smallSliderForm->isValid()) {
            $smallSliders->setActive(true);
            $em = $this->getDoctrine()->getManager();
            $smallSliders->upload();
            $em->persist($smallSliders);
            $em->flush();
            return $this->redirectToRoute('admin_slider_small_show');
        }
        $smallSlide = $repository = $em->getRepository("AdminBundle:SmallSlider")->findAll();
        return $this->render('AdminBundle:Pages:smallSlider.html.twig', array('form' => $smallSliderForm->createView(), 'smallSlider' => $smallSlide));
    }

    public function smallSliderActiveAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->getMethod() == "POST") {
            $active = $request->get("active");

            $query = $em->createQueryBuilder();
            $q = $query->update("AdminBundle:SmallSlider", 'ss')
                ->set('ss.active', '?1')
                ->where('ss.id= ?2')
                ->setParameter(1, $active)
                ->setParameter(2, $id)
                ->getQuery();
            $result = $q->execute();

            if ($result == 1) {
                return $this->redirectToRoute("admin_slider_small_show");
            }
        }
    }
}