<?php

namespace Utilisateurs\UtilisateursBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use symfony\Component\DependencyInjection\ContainerAwareInterface;
use symfony\Component\DependencyInjection\ContainerInterface;
use Utilisateurs\UtilisateursBundle\Entity\Utilisateur;

class UtilisateurData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

//    class UtilisateurData extends AbstractFixture implements OrderedFixtureInterface
    //$user->setSalt(md5(uniqid()));
    public function load(ObjectManager $manager) {

        $user1 = new Utilisateur();
        $user1->setUsername('rafik');
        $user1->setEmail('rafik@gmail.com');
        $user1->setEnabled(1);
        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($user1);
        $user1->setPassword($encoder->encodePassword('rafik', $user1->getSalt()));
        $manager->persist($user1);

        $user2 = new Utilisateur();
        $user2->setUsername('houssem');
        $user2->setEmail('houssem@gmail.com');
        $user2->setEnabled(1);
        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($user2);
        $user2->setPassword($encoder->encodePassword('houssem', $user2->getSalt()));
        $manager->persist($user2);

        $user3 = new Utilisateur();
        $user3->setUsername('ramzi');
        $user3->setEmail('ramzi@gmail.com');
        $user3->setEnabled(1);
        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($user3);
        $user3->setPassword($encoder->encodePassword('ramzi', $user3->getSalt()));
        $manager->persist($user3);

        $user4 = new Utilisateur();
        $user4->setUsername('bilel');
        $user4->setEmail('bilel@gmail.com');
        $user4->setEnabled(0);
        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($user4);
        $user4->setPassword($encoder->encodePassword('bilel', $user4->getSalt()));
        $manager->persist($user4);

        $user5 = new Utilisateur();
        $user5->setUsername('akram');
        $user5->setEmail('akram@gmail.com');
        $user5->setEnabled(1);
        $encoder = $this->container
                ->get('security.encoder_factory')
                ->getEncoder($user5);
        $user5->setPassword($encoder->encodePassword('akram', $user5->getSalt()));
        $manager->persist($user5);






        $manager->flush();
        $this->addReference('user1', $user1);
        $this->addReference('user2', $user2);
        $this->addReference('user3', $user3);
        $this->addReference('user4', $user4);
        $this->addReference('user5', $user5);
    }

    public function getOrder() {
        return 5; // l'ordre dans lequel les fichiers sont chargés
    }

}

