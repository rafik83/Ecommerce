<?php

namespace Ecommerce\EcommerceBundle\Listener;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RedirectionListener {

    public function __construct(ContainerInterface $container, Session $session) {

        $this->session = $session;
        $this->router = $container->get('router');
        $this->securityContext = $container->get('security.context');
    }

    public function onkernelRequest(GetResponseEvent $event) {
        
        
        // $event->getRequest()->attributes->get('_route') : pour recuperer la route courante
        $route = $event->getRequest()->attributes->get('_route');
//        var_dump($route);
//        die();
        
//        if ($route == 'produits') {
////               var_dump($route);
////               die(); 
//            
//            $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
//            }
        
        if ($route == 'livraison' || $route == 'validation') {
            if ($this->session->has('panier')) {

                if (count($this->session->get('panier')) == 0) {
                    $event->setResponse(new RedirectResponse($this->router->generate('panier')));
                }
            }
            if (!is_object($this->securityContext->getToken()->getUser())) {
                $this->session->getFlashBag()->add('notification', 'Vous devez vous identifier');
                $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
            }
        }
       
              
       

//        if($route == 'fos_user_profile_edit'){
//            var_dump($route);
//            die('ici');
        //$event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
//    }
//        if($route != 'produits'&& $route != 'presentation' && $route != 'panier' && $route != 'ajouter' && $route != 'supprimer' && $route != 'livraison'&& $route != 'validation' && $route != 'test_form' && $route != 'categorie_produit' && $route != 'recherche_produit'){
//            
//            $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
//        }

     
    }

}