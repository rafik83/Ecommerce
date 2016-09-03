<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Categories;


class CategoriesData extends AbstractFixture implements OrderedFixtureInterface
{
   
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categories();
        $categorie1->setNom('Légume');
        $categorie1->setImage($this->getReference('media1'));
        $manager->persist($categorie1);
        
        $categorie2 = new Categories();
        $categorie2->setNom('Fruits');
        $categorie2->setImage($this->getReference('media2'));
        $manager->persist($categorie2);
        
//        $categorie3 = new Categories();
//        $categorie3->setNom('Poivron rouge');
//        $categorie3->setImage($this->getReference('media3'));
//        $manager->persist($categorie3);
//        
//        $categorie4 = new Categories();
//        $categorie4->setNom('Piment');
//        $categorie4->setImage($this->getReference('media4'));
//        $manager->persist($categorie4);
//        
//        $categorie5 = new Categories();
//        $categorie5->setNom('Tomate');
//        $categorie5->setImage($this->getReference('media5'));
//        $manager->persist($categorie5);
//        
//        $categorie6 = new Categories();
//        $categorie6->setNom('Poivron vert');
//        $categorie6->setImage($this->getReference('media6'));
//        $manager->persist($categorie6);
//        
//        $categorie7 = new Categories();
//        $categorie7->setNom('Raisin');
//        $categorie7->setImage($this->getReference('media7'));
//        $manager->persist($categorie7);
//        
//        $categorie8 = new Categories();
//        $categorie8->setNom('Orange');
//        $categorie8->setImage($this->getReference('media8'));
//        $manager->persist($categorie8);

        
        $manager->flush();
        
        $this->addReference('categorie1',$categorie1);
        $this->addReference('categorie2',$categorie2);
//        $this->addReference('categorie3',$categorie3);
//        $this->addReference('categorie4',$categorie4);
//        $this->addReference('categorie5',$categorie5);
//        $this->addReference('categorie6',$categorie6);
//        $this->addReference('categorie7',$categorie7);
//        $this->addReference('categorie8',$categorie8);
    }

   
    public function getOrder()
    {
        return 2; // l'ordre dans lequel les fichiers sont chargés
    }
}

