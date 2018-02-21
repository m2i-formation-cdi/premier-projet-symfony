<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 21/02/2018
 * Time: 14:50
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("Dev");
        $manager->persist($category);
        $this->setReference("category_1", $category);

        $category = new Category();
        $category->setName("Politique");
        $manager->persist($category);
        $this->setReference("category_2", $category);

        $category = new Category();
        $category->setName("Art");
        $manager->persist($category);
        $this->setReference("category_3", $category);

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 15;
    }
}