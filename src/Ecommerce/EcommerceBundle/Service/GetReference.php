<?php

namespace Ecommerce\EcommerceBundle\Service;
use Symfony\Component\Security\Core\SecurityContextInterface;

class GetReference{
    
    
    public function __construct($securitycontext,$entitymanager) {
        $this->em= $entitymanager;
        $this->SecurityContext= $securitycontext;
    }
    public function reference(){
        
        $reference = $this->em->getRepository('EcommerceBundle:Commandes')->findOneBy(array('valider'=>1),
                                                                                      array('id'=>'DESC'),1,1);
        

        
        /**
         * findOneBy : cad on veut un seul element a retourner
         * array('id'=>'DES') cad je veut me retourner le dernier element
         * les deux dernier 1 c'est une convention dont findOneBy
         */
        if(!$reference)
            return 1;
        else
            return $reference->getReference() + 1;
           
    }
}
