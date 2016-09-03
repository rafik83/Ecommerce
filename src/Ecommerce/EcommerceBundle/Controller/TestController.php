<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ecommerce\EcommerceBundle\Entity\Produits;

use  Ecommerce\EcommerceBundle\Form\testType;
//use Ecommerce\EcommerceBundle\Repository\ProduitsRepository;

class TestController extends Controller
{
    
    
    public function testFormulairAction(){
        
       $form = $this->createForm(new testType());
       
       if($this->get('request')->getMethod()=="POST"){
//           var_dump($this->get('request')->getBaseUrl());
//           var_dump($this->get('request'));
           $form->bind($this->get('request'));// ici pour injecter $this->get('request') dont le formulaire
//           var_dump($form->getData());
//           die('ici on traite le formulaire');
//          echo $form['email']->getData();
//          die();
             $form = $this->createForm(new testType(),array('email'=>'test@dev.fr',''));
       }
      return $this->render('EcommerceBundle:Default:testform.html.twig',array('form'=>$form->createView()));
    }

    public function ajoutAction()
    {
        $em= $this->getDoctrine()->getManager();
        
//        $Produit = new Produits();
//        $Produit->setName('Tomate');
//        $Produit->setDescription('la tomate ce mange');
//        $Produit->setCategorie('legume');
//        $Produit->setDisponible('1');
//        $Produit->setImage('http://www.jefaismoimeme.com/wp-content/uploads/2013/10/tomate.jpg');
//        $Produit->setPrixht('0.99');
//        $Produit->setTva('9.6');
//        $em->persist($Produit);
//        
//        $Produit2 = new Produits();
//        $Produit2->setName('Arico');
//        $Produit2->setDescription('le arico ce mange');
//        $Produit2->setCategorie('legume');
//        $Produit2->setDisponible('1');
//        $Produit2->setImage('http://www.jefaismoimeme.com/wp-content/uploads/2013/10/tomate.jpg');
//        $Produit2->setPrixht('0.95');
//        $Produit2->setTva('9.6');
//        $em->persist($Produit2);
//        
//        
//        $em->flush();
//         die('ici ce pointe');
//         */
        $Produits = $em->getRepository('EcommerceBundle:Produits')->findAll();       
        return $this->render('EcommerceBundle:Default:test.html.twig',array('Produits'=>$Produits));
    }
   
}
