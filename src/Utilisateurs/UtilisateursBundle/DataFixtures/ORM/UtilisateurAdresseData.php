<?php

namespace Utilisateurs\UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\UtilisateursAdress;

class TvaData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $utilisateursAdress1 = new UtilisateursAdress();
        $utilisateursAdress1->setNom("turki");
        $utilisateursAdress1->setPrenom("rafik");
        $utilisateursAdress1->setTelephone("tel1");
        $utilisateursAdress1->setAdress("adresse1");
        $utilisateursAdress1->setCp("3021");
        $utilisateursAdress1->setPays("tunisie");
        $utilisateursAdress1->setVille("sfax");
        $utilisateursAdress1->setComplement("complement1");
        $utilisateursAdress1->setUtilisateur($this->getReference('user1'));
        $manager->persist($utilisateursAdress1);

        $utilisateursAdress2 = new UtilisateursAdress();
        $utilisateursAdress2->setNom("turki");
        $utilisateursAdress2->setPrenom("houssem");
        $utilisateursAdress2->setTelephone("tel2");
        $utilisateursAdress2->setAdress("adresse2");
        $utilisateursAdress2->setCp("3021");
        $utilisateursAdress2->setPays("tunisie");
        $utilisateursAdress2->setVille("sfax");
        $utilisateursAdress2->setComplement("complement2");
        $utilisateursAdress2->setUtilisateur($this->getReference('user2'));
        $manager->persist($utilisateursAdress2);

        $utilisateursAdress3 = new UtilisateursAdress();
        $utilisateursAdress3->setNom("turki");
        $utilisateursAdress3->setPrenom("ramzi");
        $utilisateursAdress3->setTelephone("tel3");
        $utilisateursAdress3->setAdress("adresse3");
        $utilisateursAdress3->setCp("3021");
        $utilisateursAdress3->setPays("tunisie");
        $utilisateursAdress3->setVille("sfax");
        $utilisateursAdress3->setComplement("complement3");
        $utilisateursAdress3->setUtilisateur($this->getReference('user3'));
        $manager->persist($utilisateursAdress3);

        $utilisateursAdress4 = new UtilisateursAdress();
        $utilisateursAdress4->setNom("boudabous");
        $utilisateursAdress4->setPrenom("bilel");
        $utilisateursAdress4->setTelephone("tel4");
        $utilisateursAdress4->setAdress("adresse4");
        $utilisateursAdress4->setCp("3025");
        $utilisateursAdress4->setPays("tunisie");
        $utilisateursAdress4->setVille("sfax");
        $utilisateursAdress4->setComplement("complement4");
        $utilisateursAdress4->setUtilisateur($this->getReference('user4'));
        $manager->persist($utilisateursAdress4);

        $utilisateursAdress5 = new UtilisateursAdress();
        $utilisateursAdress5->setNom("mnif");
        $utilisateursAdress5->setPrenom("akram");
        $utilisateursAdress5->setTelephone("tel5");
        $utilisateursAdress5->setAdress("adresse5");
        $utilisateursAdress5->setCp("3026");
        $utilisateursAdress5->setPays("tunisie");
        $utilisateursAdress5->setVille("sfax");
        $utilisateursAdress5->setComplement("complement5");
        $utilisateursAdress5->setUtilisateur($this->getReference('user5'));
        $manager->persist($utilisateursAdress5);



        $manager->flush();

        $this->addReference('utilisateursAdress1', $utilisateursAdress1);
        $this->addReference('utilisateursAdress2', $utilisateursAdress2);
        $this->addReference('utilisateursAdress3', $utilisateursAdress3);
        $this->addReference('utilisateursAdress4', $utilisateursAdress4);
        $this->addReference('utilisateursAdress5', $utilisateursAdress5);
    }

    public function getOrder() {
        return 6; // l'ordre dans lequel les fichiers sont chargés
    }

}

