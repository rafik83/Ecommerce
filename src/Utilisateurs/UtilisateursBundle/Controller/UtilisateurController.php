<?php

namespace Utilisateurs\UtilisateursBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UtilisateurController extends Controller {

    public function factureAction() {
        $em = $this->getDoctrine()->getManager();
        $factures = $em->getRepository('EcommerceBundle:Commandes')->byFacture($this->getUser());
        return $this->render('UtilisateursBundle:Default:facture/layout/facture.html.twig', array('factures' => $factures));
    }

    public function facturePDFAction($id) {
        $em = $this->getDoctrine()->getManager();
        $facture = $em->getRepository('EcommerceBundle:Commandes')->findOneBy(array('valider' => 1,
            'id' => $id));
        if (!$facture) {
            $this->get('session')->getFlashBag()->add('error', 'une erreur est survenue');
            $this->redirect($this->generateUrl('facture'));
        }
        $html = $this->renderView('UtilisateursBundle:Default:facture/layout/facturePDF.html.twig', array('facture' => $facture));
        $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');
           //var_dump($response);
         //die('Response');
        /**
         * protected 'title' => string '' (length=0)
          protected 'subject' => string '' (length=0)
          protected 'author' => string '' (length=0)
          protected 'keywords' => string '' (length=0) keywords ??
         */
        $html2pdf->pdf->SetTitle('Facture ' . $facture->getReference());
        $html2pdf->pdf->SetSubject('Facture Silabe-Developpement');
        $html2pdf->pdf->SetAuthor('Silabe-Developpement');
        $html2pdf->pdf->SetKeywords('facture , silabe developpement');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);
        $html2pdf->Output('Facture.pdf');
        $response = new Response();
        $response->headers->set('Content-type', 'application/pdf');
        return $response;
    }

    public function BenjaminCatelainPdf() {

        //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $html = $this->renderView('testPdfBundle:Default:index.html.twig', array('name' => $name));

        //on instancie la classe Html2Pdf_Html2Pdf en lui passant en paramètre
        //le sens de la page "portrait" => p ou "paysage" => l
        //le format A4,A5...
        //la langue du document fr,en,it...
        $html2pdf = new \Html2Pdf_Html2Pdf('P', 'A4', 'fr');

        //SetDisplayMode définit la manière dont le document PDF va être affiché par l’utilisateur
        //fullpage : affiche la page entière sur l'écran
        //fullwidth : utilise la largeur maximum de la fenêtre
        //real : utilise la taille réelle
        $html2pdf->pdf->SetDisplayMode('real');

        //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
        $html2pdf->writeHTML($html);

        //Output envoit le document PDF au navigateur internet avec un nom spécifique qui aura un rapport avec le contenu à convertir (exemple : Facture, Règlement…)
        $html2pdf->Output('Facture.pdf');


        return new Response();
    }

}
