<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 21/02/2018
 * Time: 14:50
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use AppBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TagFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tag = new Tag();
        $tag->setName("PHP");
        $manager->persist($tag);
        $this->setReference("tag_1", $tag);

        $tag = new Tag();
        $tag->setName("Pénélope F");
        $manager->persist($tag);
        $this->setReference("tag_2", $tag);

        $tag = new Tag();
        $tag->setName("Laurent W");
        $manager->persist($tag);
        $this->setReference("tag_3", $tag);

        $tag = new Tag();
        $tag->setName("Javascript");
        $manager->persist($tag);
        $this->setReference("tag_4", $tag);

        $tag = new Tag();
        $tag->setName("Louvre");
        $manager->persist($tag);
        $this->setReference("tag_5", $tag);


        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 20;
    }
}