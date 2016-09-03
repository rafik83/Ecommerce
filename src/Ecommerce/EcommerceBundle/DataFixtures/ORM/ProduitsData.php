<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Produits;

class ProduitsData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        $produit2 = new Produits();
        $produit2->setNom('légume');
        $produit2->setReference('P0001');
        $produit2->setDescription("L'importance des légumes dans l'alimentation humaine a varié selon les époques et les cultures. ");
        $produit2->setDisponible('1');
        $produit2->setPrix('1000');
//        $produit2->setQte('4');
        $produit2->setCategorie($this->getReference('categorie1'));
        $produit2->setImage($this->getReference('media1'));
        $produit2->setTva($this->getReference('tva1'));
        $manager->persist($produit2);

        $produit1 = new Produits();
        $produit1->setNom('Fruits');
        $produit1->setReference('P0002');
        $produit1->setDescription("Les fruits sont des aliments importants pour la santé et pour permettre aux plantes à fleurs de protéger leurs graines.");
        $produit1->setDisponible('1');
        $produit1->setPrix('3.500');
//        $produit1->setQte('5');
        $produit1->setCategorie($this->getReference('categorie2'));
        $produit1->setImage($this->getReference('media2'));
        $produit1->setTva($this->getReference('tva2'));
        $manager->persist($produit1);

        $produit3 = new Produits();
        $produit3->setNom('Poivron rouge');
        $produit3->setReference('P0003');
        $produit3->setDescription("Le poivron rouge est un groupe de cultivars de l'espèce Capsicum annuum.");
        $produit3->setDisponible('1');
        $produit3->setPrix('2000');
//        $produit3->setQte('6');
        $produit3->setCategorie($this->getReference('categorie1'));
        $produit3->setImage($this->getReference('media3'));
        $produit3->setTva($this->getReference('tva3'));
        $manager->persist($produit3);

        $produit4 = new Produits();
        $produit4->setNom('Piment');
        $produit4->setReference('P0004');
        $produit4->setDescription("Piment est généralement associé à la saveur du piquant (pimenté).");
        $produit4->setDisponible('0');
        $produit4->setPrix('1.500');
//        $produit4->setQte('7');
        $produit4->setCategorie($this->getReference('categorie2'));
        $produit4->setImage($this->getReference('media4'));
        $produit4->setTva($this->getReference('tva4'));
        $manager->persist($produit4);

        $produit5 = new Produits();
        $produit5->setNom('Tomate');
        $produit5->setReference('P0005');
        $produit5->setDescription("La tomate est une espèce de plantes herbacées de la famille des Solanacées, originaire du nord-ouest de l'Amérique du Sud.");
        $produit5->setDisponible('1');
        $produit5->setPrix('1000');
//        $produit5->setQte('8');
        $produit5->setCategorie($this->getReference('categorie1'));
        $produit5->setImage($this->getReference('media5'));
        $produit5->setTva($this->getReference('tva5'));
        $manager->persist($produit5);

        $produit6 = new Produits();
        $produit6->setNom('Poivron vert');
        $produit6->setReference('P0006');
        $produit6->setDescription("Le poivron vert est un groupe de cultivars de l'espèce Capsicum annuum.");
        $produit6->setDisponible('1');
        $produit6->setPrix('2.300');
//        $produit6->setQte('9');
        $produit6->setCategorie($this->getReference('categorie2'));
        $produit6->setImage($this->getReference('media6'));
        $produit6->setTva($this->getReference('tva6'));
        $manager->persist($produit6);

        $produit7 = new Produits();
        $produit7->setNom('Raisin');
        $produit7->setReference('P0007');
        $produit7->setDescription("Le raisin est le fruit de la Vigne. Le raisin de la vigne cultivée Vitis vinifera est un des fruits les plus cultivés au monde, avec 68 millions de tonnes produites en 2010.");
        $produit7->setDisponible('0');
        $produit7->setPrix('7000');
//        $produit7->setQte('10');
        $produit7->setCategorie($this->getReference('categorie1'));
        $produit7->setImage($this->getReference('media7'));
        $produit7->setTva($this->getReference('tva6'));
        $manager->persist($produit7);

        $produit8 = new Produits();
        $produit8->setNom('Orange');
        $produit8->setReference('P0008');
        $produit8->setDescription("L’orange est un agrume, fruit des orangers, des arbres de différentes espèces de la famille des Rutacées ou d'hybrides de ceux-ci.");
        $produit8->setDisponible('1');
        $produit8->setPrix('4.800');
//        $produit8->setQte('11');
        $produit8->setCategorie($this->getReference('categorie2'));
        $produit8->setImage($this->getReference('media8'));
        $produit8->setTva($this->getReference('tva1'));
        $manager->persist($produit8);


        $manager->flush();

        $this->addReference('produit1', $produit1);
        $this->addReference('produit2', $produit2);
        $this->addReference('produit3', $produit3);
        $this->addReference('produit4', $produit4);
        $this->addReference('produit5', $produit5);
        $this->addReference('produit6', $produit6);
        $this->addReference('produit7', $produit7);
        $this->addReference('produit8', $produit8);
    }

    public function getOrder() {
        return 4; // l'ordre dans lequel les fichiers sont chargés
    }

}

