<?php

namespace Ecommerce\EcommerceBundle\Twig\Extension ;

class TvaExtension extends \Twig_Extension{
    
    public function getFilters() {
      
        return array(new \Twig_SimpleFilter('tva',array($this,'CalculeTva')) ) ;
    }
    
    public  function CalculeTva($prixHT,$tva){
        
        return round(($prixHT /$tva),3) ;
    }
    
    public function getName() {
        
        return 'tva_extension';
    }
}
