<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Ecommerce\EcommerceBundle\Entity\UtilisateursAdress;
use Ecommerce\EcommerceBundle\Form\UtilisateursAdressType;

class PanierController extends Controller {

    public function menuAction() {

        $session = $this->getRequest()->getSession();
        if (!$session->has('panier'))
            $articles = 0;
        else
            $articles = count($session->get('panier'));

        return $this->render('EcommerceBundle:Default:Panier/modulesUsed/panier.html.twig', array('articles' => $articles));
    }

    public function supprimerAction($id) {

        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');
        if (array_key_exists($id, $panier)) {

            unset($panier[$id]);
            $this->get('session')->getFlashBag()->add('success', 'Article supprimer avec succés');
        }
        $session->set('panier', $panier);
        return $this->redirect($this->generateUrl('panier'));
    }

    public function ajouterAction($id) {
        // $this->getRequest()->query : je fait celle ci lorsque j'ai une formulaire envoyer en get
        // $this->getRequest()->query : je fait celle ci lorsque j'ai une formulaire envoyer en POST
//        var_dump($this->getRequest()->query);
//        die();
        $session = $this->getRequest()->getSession();
//          $session->remove('panier');
        if (!$session->has('panier'))
            $session->set('panier', array()); // ic on declare notre variable de session panier
        $panier = $session->get('panier');

        if (array_key_exists($id, $panier)) {
            if ($this->getRequest()->query->get('qte') != null) {
                $panier[$id] = $this->getRequest()->query->get('qte');
                $this->get('session')->getFlashBag()->add('success', 'Article modifier avec success');
                $session->set('panier', $panier);
                //die('entre lorsque qte modifier dont panier');
                // exemple : array (size=1)
                  // 81 => string '3' (length=1)
            }
        } else {
            if ($this->getRequest()->query->get('qte') != null) {
//                $panier[$id] = $this->getRequest()->query->get('qte');
                $panier[$id] = $this->getRequest()->query->get('qte');
                //die('requette venant du vue presentation');
            } else {
                $panier[$id] = '1';
                //die('requette venant du vue produit');
            }
            $this->get('session')->getFlashBag()->add('success', 'Article ajoutée avec success');
        }
        $session->set('panier', $panier);
        return $this->redirect($this->generateUrl('panier'));
    }

    public function panierAction() {

        $session = $this->getRequest()->getSession();
//         $session->remove('panier');
        if (!$session->has('panier')) {
            $session->set('panier', array());
        }
        $panier = $session->get('panier');
//        var_dump($session->get('panier'));
//        die();
        $keys = array_keys($panier);
        $em = $this->getDoctrine()->getManager();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findArray($keys);
        $session->set('panier', $panier);
        return $this->render('EcommerceBundle:Default:Panier/panier.html.twig', array('produits' => $produits, 'panier' => $panier));
    }

    public function livraisonadresseSuppressionAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EcommerceBundle:UtilisateursAdress')->find($id);
        if (!$entity || $this->container->get('security.context')->getToken()->getuser() != $entity->getutilisateur()) {
            return $this->redirect($this->generateUrl('livraison'));
        }
        $em->remove($entity);
        $em->flush();
        return $this->redirect($this->generateUrl('livraison'));
    }

    public function livraisonAction() {

        $session = $this->getRequest()->getSession();
        $panier = $session->get('panier');
        $utilisateur = $this->container->get('security.context')->getToken()->getUser();
        $entity = new UtilisateursAdress();
        $form = $this->createForm(new UtilisateursAdressType(), $entity);
        $form->handleRequest($this->getRequest());
//        $form->handleRequest($this->get('request'));
        if ($this->get('request')->getMethod() == "POST") {
            if ($form->isValid()) {
                // $this->get('request') car j'ai envoyer la formulaire en POST
                $em = $this->getDoctrine()->getManager();
                $entity->setUtilisateur($utilisateur);
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('livraison'));
            }
        }
        return $this->render('EcommerceBundle:Default:Panier/livraison.html.twig', array('form' => $form->createView(), 'utilisateur' => $utilisateur));
    }

    public function SetLivraisonOnSession() {



        $session = $this->getRequest()->getSession();
        // ici c pas la peinne de faire if($session->has('panier') parce qu'il n'aarive a la livraison ou la validation que lorsque le panier contient aux moin un produit
        if (!$session->has('adresse'))
            $adresse = $session->set('adresse', array());
        if ($this->getRequest()->getMethod() == "POST") {

            if ($this->getRequest()->request->get('livraison') != null && $this->getRequest()->request->get('facturation') != null) {
                $adresse['livraison'] = $this->getRequest()->request->get('livraison');
                $adresse['facturation'] = $this->getRequest()->request->get('facturation');
                $session->set('adresse', $adresse);
            } else {
                $this->redirect($this->generateUrl('validation'));
            }
        }
    }

    public function validationAction() {
        if ($this->getRequest()->getMethod() == "POST")
            $this->SetLivraisonOnSession();
        /*
         * $session = $this->getRequest()->getSession();
         $panier = $session->get('panier');
         * **/
         
        $em = $this->getDoctrine()->getManager();
        $preparecommande = $this->forward('EcommerceBundle:Commandes:prepareCommande');
        // ici il va faire un forward et appelle et execute la methode prepareCommande
        $commande = $em->getRepository('EcommerceBundle:Commandes')->find($preparecommande->getContent());
        // on va recuperer le retour du Response qui est l'id du commande en cours ( Gest Current Response content )
       
        /*
        if ($session->has('adresse')) {
            $adresse = $session->get('adresse');
            $keys = array_keys($panier);
            $produits = $em->getRepository('EcommerceBundle:Produits')->findArray($keys);
            $livraison = $em->getRepository('EcommerceBundle:UtilisateursAdress')->find($adresse['livraison']);
            $facturation = $em->getRepository('EcommerceBundle:UtilisateursAdress')->find($adresse['facturation']);
            return $this->render('EcommerceBundle:Default:Panier/validation.html.twig', array('produits' => $produits,
                        'livraison' => $livraison,
                        'facturation' => $facturation,
                        'panier' => $panier));
        } else {
            throw new\Exeption('Vous devez ajouter une adresse de livraison');
        }
         * */
          return $this->render('EcommerceBundle:Default:Panier/validationcommande.html.twig', array('commande' => $commande));
    }

}
