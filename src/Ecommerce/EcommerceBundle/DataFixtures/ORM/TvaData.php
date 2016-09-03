<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Tva;

class TvaData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $tva1 = new Tva();
        $tva1->setMultiplicate('0.06');
        $tva1->setNom('TVA 6%');
        $tva1->setValeur('6.18');
        $manager->persist($tva1);

        $tva2 = new Tva();
        $tva2->setMultiplicate('0.1');
        $tva2->setNom('TVA 10%');
        $tva2->setValeur('10.12');
        $manager->persist($tva2);

        $tva3 = new Tva();
        $tva3->setMultiplicate('0.12');
        $tva3->setNom('TVA 12%');
        $tva3->setValeur('12.33');
        $manager->persist($tva3);

        $tva4 = new Tva();
        $tva4->setMultiplicate('0.18');
        $tva4->setNom('TVA 18%');
        $tva4->setValeur('18');
        $manager->persist($tva4);

        $tva5 = new Tva();
        $tva5->setMultiplicate('0.20');
        $tva5->setNom('TVA 20%');
        $tva5->setValeur('20.25');
        $manager->persist($tva5);

        $tva6 = new Tva();
        $tva6->setMultiplicate('0.22');
        $tva6->setNom('TVA 22%');
        $tva6->setValeur('22.36');
        $manager->persist($tva6);

        $manager->flush();

        $this->addReference('tva1', $tva1);
        $this->addReference('tva2', $tva2);
        $this->addReference('tva3', $tva3);
        $this->addReference('tva4', $tva4);
        $this->addReference('tva5', $tva5);
        $this->addReference('tva6', $tva6);
    }

    public function getOrder() {
        return 3; // l'ordre dans lequel les fichiers sont chargés
    }

}

