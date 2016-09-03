<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Media;


class MediaData extends AbstractFixture implements OrderedFixtureInterface
{
   
    public function load(ObjectManager $manager)
    {
        $media1 = new Media();
        $media1->setAlt('Légume');
        $media1->setPath('http://www.pressade.fr/blog/wp-content/uploads/2011/04/legume.JPG');
        $manager->persist($media1);
        
        
        $media2 = new Media();
        $media2->setAlt('Fruits');
        $media2->setPath('http://ekladata.com/upkEKEUGAhtPDQdiSb3T1SvP4zw.jpg');
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setAlt('Poivron rouge');
        $media3->setPath('http://www.lorand-nature.fr/images/Image/poivron_rouge_001_1403099063.jpg');
        $manager->persist($media3);
        
        $media4 = new Media();
        $media4->setAlt('Piment');
        $media4->setPath('http://mf.imdoc.fr/content/4/7/8/474788/piment-rouge-jpg_recette_cat.jpg');
        $manager->persist($media4);
        
        $media5 = new Media();
        $media5->setAlt('Tomate');
        $media5->setPath('http://www.jefaismoimeme.com/wp-content/uploads/2013/10/tomate.jpg');
        $manager->persist($media5);
        
        $media6 = new Media();
        $media6->setAlt('Poivron vert');
        $media6->setPath('http://p9.storage.canalblog.com/98/13/1044074/80129055_o.jpg');
        $manager->persist($media6);
        
        $media7 = new Media();
        $media7->setAlt('Raisin');
        $media7->setPath('http://www.boitearecettes.com/fruits_legumes/raisins-6.gif');
        $manager->persist($media7);
        
        $media8 = new Media();
        $media8->setAlt('Orange');
        $media8->setPath('http://www.nova-dyn.fr/wp-content/uploads/2013/11/Orange-Novadyn.jpg');
        $manager->persist($media8);
        
        
        $manager->flush();
        
        $this->addReference('media1',$media1);
        $this->addReference('media2',$media2);
        $this->addReference('media3',$media3);
        $this->addReference('media4',$media4);
        $this->addReference('media5',$media5);
        $this->addReference('media6',$media6);
        $this->addReference('media7',$media7);
        $this->addReference('media8',$media8);
    }

   
    public function getOrder()
    {
        return 1; // l'ordre dans lequel les fichiers sont chargés
    }
}

