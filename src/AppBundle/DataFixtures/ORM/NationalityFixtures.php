<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Nationality;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NationalityFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $entity = new Nationality();
        $entity->setName("Française");
        $manager->persist($entity);
        $this->setReference("nat_fr", $entity);

        $entity = new Nationality();
        $entity->setName("Anglaise");
        $manager->persist($entity);
        $this->setReference("nat_gb", $entity);

        $entity = new Nationality();
        $entity->setName("Espagnole");
        $manager->persist($entity);
        $this->setReference("nat_es", $entity);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }
}