<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Form\RechercheType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Ecommerce\EcommerceBundle\Entity\Categories;
use Ecommerce\EcommerceBundle\Entity\Produits;


class ProduitsController extends Controller {

    public function getProduitsByCategorieAction(Categories $categorie = null) {
        // cic grace au param converter du symfony2, dont le menu du 
        // categorie  j'ai envoier idcategorie, mais dont le parametrage j ai forcer
        // pour q'il soit un objet categorie et nn seullement id

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('EcommerceBundle:Produits')->byCategorie($categorie);

        $paginator = $this->get('knp_paginator');
        $produits = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 3/* limit per page */
        );

        if (!$produits) {
            throw $this->createNotFoundException('le produit n \'existe pas.');
        }
        return $this->render('EcommerceBundle:Default:Produits/layout/produits.html.twig', array('produits' => $produits));
    }

    public function searcheAction() {

        $form = $this->createForm(new RechercheType());
        if ($this->get('request')->getMethod() == "POST") {
            //$form->bind($this->getRequest()->request);
            //$vv = $form['recherche']->getData();
//             $vv = array();
//            $vv = $this->getRequest()->request;
            $ll = "Fruits";
//            $tab = array(2);
            $em = $this->getDoctrine()->getManager();
            $produit = $em->getRepository('EcommerceBundle:Produits')->bynom($ll);
//            $tab[0] = $produit;
//             return $this->redirect($this->generateUrl('presentation'));
//            foreach ($produit as $key => $value) {
//                $tab[$key]= $value ;
//            }
            var_dump($produit);
            die('ici');
           
             return $this->render('EcommerceBundle:Default:Produits/layout/presentation.html.twig', array('produit' => $produit));
        }
        return $this->render('EcommerceBundle:Default:Recherche/moduleUsed/searche.html.twig', array('form' => $form->createView()));
    }

    public function produitsAction() {
        $session = $this->getRequest()->getSession();
        if ($session->has('panier')) {
            $panier = $session->get('panier');
        } else {
            $panier = false;
        }
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('EcommerceBundle:Produits')->findBy(array('disponible' => 1));



        $paginator = $this->get('knp_paginator');
        $produits = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1)/* page number */, 3/* limit per page */
        );



        return $this->render('EcommerceBundle:Default:Produits/layout/produits.html.twig', array('produits' => $produits, 'panier' => $panier));
    }

    public function presentationAction($id) {
        $session = $this->getRequest()->getSession();
        if ($session->has('panier')) {
            $panier = $session->get('panier');
        } else {
            $panier = false;
        }
        $em = $this->getDoctrine()->getManager();
        $produit = $em->getRepository('EcommerceBundle:Produits')->find($id);
//        var_dump($produit);
//        die();
        if (!$produit) {
            throw $this->createNotFoundException('le produit n \'existe pas.');
        }
        return $this->render('EcommerceBundle:Default:Produits/layout/presentation.html.twig', array('produit' => $produit, 'panier' => $panier));
    }

}
