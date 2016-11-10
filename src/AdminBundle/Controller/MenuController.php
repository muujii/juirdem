<?php
namespace AdminBundle\Controller;

use AdminBundle\Entity\Menu;
use AdminBundle\Form\MenuType;
use AdminBundle\Form\SubMenuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
    public function menuAction(Request $request)
    {
        $menu = new Menu();
        $menuForm = $this->createForm(MenuType::class, $menu);
        $menuForm->handleRequest($request);

        $subMenuForm = $this->createForm(SubMenuType::class, $menu);
        $subMenuForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        if ($menuForm->isSubmitted() && $menuForm->isValid()) {
            $menu->setActive(true);

            $em->persist($menu);
            $em->flush();

            return $this->redirectToRoute('admin_menu_show');
        } elseif ($subMenuForm->isSubmitted() && $subMenuForm->isValid()) {
            $parentMenu = $subMenuForm['parentID']->getData();

            $menu->setParentID($parentMenu->getId());
            $menu->setActive(false);

            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();

            return $this->redirectToRoute('admin_menu_show');
        }
        $query = $em->createQuery('SELECT m.id, m.labelMN, m.active FROM AdminBundle:Menu m WHERE m.parentID IS NULL ');
        $parentMenus = $query->getResult();

        $query = $em->createQuery('SELECT m FROM AdminBundle:Menu m WHERE m.parentID IS NOT NULL ');
        $subMenus = $query->getResult();
        return $this->render('AdminBundle:Pages:menu.html.twig', array('form' => $menuForm->createView(), 'subForm' => $subMenuForm->createView(), 'parentMenus' => $parentMenus,
            'subMenus' => $subMenus));
    }

    public function menuUpdateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $active = $request->get("parentActive");

            $query = $em->createQueryBuilder();
            $q = $query->update("AdminBundle:Menu", 'm')
                ->set('m.active', '?1')
                ->where('m.id= ?2')
                ->setParameter(1, $active)
                ->setParameter(2, $id)
                ->getQuery();
            $result = $q->execute();

            if ($result == 1) {
                return $this->redirectToRoute("admin_menu_show");
            }
        }
    }

    public function subMenuUpdateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->getMethod() == "POST") {
            $name = $request->get("name");
            $parent = $request->get("parent");
            $link = $request->get("link");
            $active = $request->get("subActive");

            $query = $em->createQueryBuilder();
            $q = $query->update("AdminBundle:Menu", 'm')
                ->set('m.labelMN', '?1')
                ->set('m.parentID', '?2')
                ->set('m.link', '?3')
                ->set('m.active', '?4')
                ->where('m.id= ?5')
                ->setParameter(1, $name)
                ->setParameter(2, $parent)
                ->setParameter(3, $link)
                ->setParameter(4, $active)
                ->setParameter(5, $id)
                ->getQuery();
            $result = $q->execute();

            if ($result == 1) {
                return $this->redirectToRoute("admin_menu_show");
            }
        }
    }

    public function subMenuShowAction($id)
    {
        $subMenus = new Menu();
        $em = $this->getDoctrine()->getManager();

        $subMenu = $repository = $em->getRepository("AdminBundle:Menu")->find($id);
        $subMenus->setId($subMenu->getId());
        $subMenus->setLabelMN($subMenu->getLabelMN());
        $subMenus->setParentID($subMenu->getParentID());
        $subMenus->setLink($subMenu->getLink());
        $subMenus->setActive($subMenu->getActive());

        $query = $em->createQuery('SELECT m.id, m.labelMN, m.active FROM AdminBundle:Menu m WHERE m.parentID IS NULL AND m.active = TRUE ');
        $parentMenus = $query->getResult();

        return $this->render('AdminBundle:Edits:editSubMenu.html.twig', array('subMenus' => array("subMenu" => $subMenus), "parentMenus" => $parentMenus));
    }
}