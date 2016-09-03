<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Commandes;

class CommandesData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {

        // Produits c un tableau qui va contenir id du table article
        // array('1'=>'2') 1 c id article , 2 et le nombre d'article valider cad a acheter
        // 1 id de article banane, 2 cad on acheter bananne 2 fois
        $commande1 = new Commandes();
        $commande1->setValider(1);
        $commande1->setReference("cd1");
        $commande1->setDate(new \DateTime());
        $commande1->setUtilisateur($this->getReference('user1'));
        $commande1->setProduits(array('0' => array('1' => '2'),
            '1' => array('2' => '1'),
            '2' => array('4' => '5')
        ));
        $manager->persist($commande1);

        $commande2 = new Commandes();
        $commande2->setValider(1);
        $commande2->setReference("cd2");
        $commande2->setDate(new \DateTime());
        $commande2->setUtilisateur($this->getReference('user2'));
        $commande2->setProduits(array('0' => array('1' => '2'),
            '1' => array('2' => '1'),
            '2' => array('4' => '5')
        ));
        $manager->persist($commande2);

        $commande3 = new Commandes();
        $commande3->setValider(1);
        $commande3->setReference("cd3");
        $commande3->setDate(new \DateTime());
        $commande3->setUtilisateur($this->getReference('user3'));
        $commande3->setProduits(array('0' => array('1' => '2'),
            '1' => array('2' => '1'),
            '2' => array('4' => '5')
        ));
        $manager->persist($commande3);

        $commande4 = new Commandes();
        $commande4->setValider(1);
        $commande4->setReference("cd4");
        $commande4->setDate(new \DateTime());
        $commande4->setUtilisateur($this->getReference('user4'));
        $commande4->setProduits(array('0' => array('1' => '2'),
            '1' => array('2' => '1'),
            '2' => array('4' => '5')
        ));
        $manager->persist($commande4);

        $commande5 = new Commandes();
        $commande5->setValider(1);
        $commande5->setReference("cd5");
        $commande5->setDate(new \DateTime());
        $commande5->setUtilisateur($this->getReference('user5'));
        $commande5->setProduits(array('0' => array('1' => '2'),
            '1' => array('2' => '1'),
            '2' => array('4' => '5')
        ));
        $manager->persist($commande5);





        $manager->flush();

        $this->addReference('commande1', $commande1);
        $this->addReference('commande2', $commande2);
        $this->addReference('commande3', $commande3);
        $this->addReference('commande4', $commande4);
        $this->addReference('commande5', $commande5);
    }

    public function getOrder() {
        return 7; // l'ordre dans lequel les fichiers sont chargés
    }

}

