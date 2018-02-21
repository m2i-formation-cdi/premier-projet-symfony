<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 21/02/2018
 * Time: 12:58
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author->setFirstName("Alfred")
            ->setName("de Musset")
            ->setNationality($this->getReference("nat_fr"));
        $manager->persist($author);
        $this->setReference("author_1", $author);

        $author = new Author();
        $author->setFirstName("Terry")
            ->setName("Pratchet")
            ->setNationality($this->getReference("nat_gb"));
        $manager->persist($author);
        $this->setReference("author_2", $author);

        $author = new Author();
        $author->setFirstName("Miguel")
            ->setName("Cervantes")
            ->setNationality($this->getReference("nat_es"));
        $manager->persist($author);
        $this->setReference("author_3", $author);


        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 10;
    }
}