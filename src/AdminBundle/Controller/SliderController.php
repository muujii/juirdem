<?php

namespace AdminBundle\Controller;

use AdminBundle\Entity\Slider;
use AdminBundle\Form\SliderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SliderController extends Controller
{
    public function slideUploadAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $slider = new Slider();
        $slideForm = $this->createForm(SliderType::class, $slider);

        $slideForm->handleRequest($request);

        if ($slideForm->isSubmitted() && $slideForm->isValid()) {
            $slider->setActive(true);
            $em = $this->getDoctrine()->getManager();
            $slider->upload();
            $em->persist($slider);
            $em->flush();
            return $this->redirectToRoute('admin_slider_show');
        }
        $slide = $repository = $em->getRepository("AdminBundle:Slider")->findAll();
        return $this->render('AdminBundle:Pages:slider.html.twig', array('form' => $slideForm->createView(), 'slider' => $slide));
    }

    public function slideActiveAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->getMethod() == "POST") {
            $active = $request->get("active");

            $query = $em->createQueryBuilder();
            $q = $query->update("AdminBundle:Slider", 's')
                ->set('s.active', '?1')
                ->where('s.id= ?2')
                ->setParameter(1, $active)
                ->setParameter(2, $id)
                ->getQuery();
            $result = $q->execute();

            if ($result == 1) {
                return $this->redirectToRoute("admin_slider_show");
            }
        }
    }
}