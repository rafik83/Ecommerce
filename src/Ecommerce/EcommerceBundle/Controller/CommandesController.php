<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Security\Core\Util\SecureRandom;
use Ecommerce\EcommerceBundle\Entity\UtilisateursAdress;
use Ecommerce\EcommerceBundle\Entity\Produits;
use Ecommerce\EcommerceBundle\Entity\Commandes;

class CommandesController extends Controller {

    public function Commande() {
        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $generater = $this->container->get('security.secure_random');
        $TotalHT = 0;
        $MontantTVA = 0;
        $TotalTTC = 0;
        $panier = $session->get('panier');
        $adresse = $session->get('adresse');
        $commande = array();
        $produits = $em->getRepository('EcommerceBundle:Produits')->findArray(array_keys($panier));
        $livraison = $em->getRepository('EcommerceBundle:UtilisateursAdress')->find($adresse['livraison']);
        $facturation = $em->getRepository('EcommerceBundle:UtilisateursAdress')->find($adresse['facturation']);
        foreach ($produits as $produit) {
            $TauxRemise = 0;
            $TauxTVA = 0;
            $MTFodec = 0;
            $HTLigne = 0;
            $MTRemiseLigne = 0;
            $NetHTLigne = 0;
            $MTFodec = 0;
            $Assiette = 0;
            $MTTVALigne = 0;
            $TTCLigne = 0;
            $TauxTVA = round($produit->getTva()->getMultiplicate(), 2);
            $HTLigne = round(($produit->getPrix() * $panier[$produit->getId()]), 3);
            $MTRemiseLigne = round($HTLigne * ($TauxRemise / 100), 3);
            $NetHTLigne = round(($HTLigne - $MTRemiseLigne), 3);
            $MTFodec = ($NetHTLigne * 0);
            $Assiette = round(($NetHTLigne + $MTFodec), 3);
            $MTTVALigne = round($Assiette * $TauxTVA, 3);
            $TTCLigne = round($Assiette + $MTTVALigne, 3);
            $TotalHT+= $HTLigne;
            $MontantTVA+= $MTTVALigne;
            $TotalTTC+= $TTCLigne;
            $commande['produit'][$produit->getId()] = array('id' => $produit->getId(), 'reference' => $produit->getReference(),
                'designation' => $produit->getNom(), 'quantiter' => $panier[$produit->getId()],
                'prixunitaire' => round($produit->getPrix(), 3), 'tauxtva' => ($produit->getTva()->getMultiplicate()) * 100,
                'montanthtligne' => $HTLigne, 'montanttvaligne' => $MTTVALigne, 'montantttcligne' => $TTCLigne);
        }
        $commande['livraison'] = array('nom' => $livraison->getNom(),
            'prenom' => $livraison->getPrenom(),
            'adresse' => $livraison->getAdress(),
            'telephone' => $livraison->getTelephone(),
            'cp' => $livraison->getCp(),
            'pays' => $livraison->getPays(),
            'ville' => $livraison->getVille(),
            'complement' => $livraison->getComplement());

        $commande['facturation'] = array('nom' => $facturation->getNom(),
            'prenom' => $facturation->getPrenom(),
            'adresse' => $facturation->getAdress(),
            'telephone' => $facturation->getTelephone(),
            'cp' => $facturation->getCp(),
            'pays' => $facturation->getPays(),
            'ville' => $facturation->getVille(),
            'complement' => $facturation->getComplement());



        $commande['TotalHT'] = round($TotalHT, 3);
        $commande['MONTANTTVA'] = round($MontantTVA, 3);
        $commande['TotalTTC'] = round($TotalTTC, 3);
        $commande['token'] = bin2hex($generater->nextBytes(20));

        return $commande;
    }

    public function prepareCommandeAction() {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        if (!$session->has('commande'))
            $commande = new Commandes();
        else
            $commande = $em->getRepository('EcommerceBundle:Commandes')->find($session->get('commande'));

        $commande->setDate(new \DateTime());
        $commande->setUtilisateur($this->container->get('security.context')->getToken()->getUser());
        $commande->setReference(0);
        $commande->setValider(0);
        $commande->setCommande($this->Commande());
        if (!$session->has('commande')) {
            $em->persist($commande);
            $session->set('commande', $commande);
        }
        $em->flush(); // si la commande existe deja on persiste pas, on va ecraser les anciens donner pour les mettre a jour
        return new Response($commande->getId()); // ici on va retourner une reponse
    }

    /*
     * 
     *  cette méthode Remplace api banque
     */

    public function validationCommandeAction($id) {

        $em = $this->getDoctrine()->getManager();
        $session = $this->getRequest()->getSession();
        $commande = $em->getRepository('EcommerceBundle:Commandes')->find($id);
        if (!$commande || $commande->getValider() == 1)
            throw $this->createNotFoundException('la commande n\'existe pas');



        if ($this->getRequest()->getMethod() == "POST") {
            $date = $this->getRequest()->request->get('date');
            $prixttc = $this->getRequest()->request->get('prixttc');
            $token = $this->getRequest()->request->get('token');
            $commande->setReference($this->container->get('setNewReference')->reference()); //  un Service
            $commande->setValider(1);
             //  $commande->setDate($date); ici j'ai  trouver une erreur lor de modification du date(voir sf1.4)
            /**
             * $this->container->get('setNewReference') : pour recuperer le nom du service crer qui s'apelle setNewreference;
             * 
             * $this->container->get('setNewReference')->get('reference'): pour recuperer la methode reference 
             */
            
            $em->flush();
            $session->remove('panier');
            $session->remove('adresse');
            $session->remove('commande');
            $this->get('session')->getFlashBag()->add('success', 'Votre Commande est validée avec success');
            return $this->redirect($this->generateUrl('facture'));
        }
    }

}
