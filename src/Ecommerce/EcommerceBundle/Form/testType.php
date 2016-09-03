<?php

namespace Ecommerce\EcommerceBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class testType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('email','email',array('required'=>false))
                ->add('nom')
                ->add('prenom')
//                ->add('sexe','choice',array('choices'=>array('0'=>'homme',
//                                                              '1'=>'femme',
//                                                               '2'=>'autre')))
                ->add('sexe','choice',array('choices'=>array('0'=>'homme',
                                                              '1'=>'femme',
                                                               '2'=>'autre'),'preferred_choices'=>array('1','0'),'expanded'=>false))
                ->add('contenu','textarea')
//                 ->add('pays','country','preferred_choices'=>array('1','0'))
                 ->add('pays','country')
                 ->add('utilisateurs','entity',array('class'=>'Utilisateurs\UtilisateursBundle\Entity\Utilisateur'))
                ->add('date','date')
                ->add('envoyer','submit')
                
                ;
    }

    public function getName() {
        return 'ecommerce_ecommerceBundle_test';
    }

}

?>
