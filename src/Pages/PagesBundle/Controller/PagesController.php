<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller {

    public function menuAction() {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('PagesBundle:Pages')->findAll();
        return $this->render('PagesBundle:Default:Pages/moduleused/menu.html.twig', array('pages' => $pages));
    }

    public function pageAction($id) {
        //var_dump($id); il va afficher le contenue désirer
//        die(); il ne complette pas a l instruction suivante
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('PagesBundle:Pages')->find($id);
        if(!$page){
             throw $this->createNotFoundException('la page n \'existe pas.') ;
        }
        return $this->render('PagesBundle:Default:Pages/layout/pages.html.twig',array('page'=>$page));
    }

}
