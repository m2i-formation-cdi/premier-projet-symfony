<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 21/02/2018
 * Time: 15:02
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Article;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class ArticleFixtures extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $nbArticles = 50;

        $faker = Factory::create();

        for($i= 1; $i <= $nbArticles; $i++){
            $article = new Article();
            $article->setTitle($faker->text(30))
                ->setAuthor($this->getReference("author_". mt_rand(1,3)))
                ->setCreatedAt($faker->dateTimeThisDecade())
                ->setCategory($this->getReference("category_". mt_rand(1,3)))
                ->setValidated(mt_rand(1,10)>=5);

            $nbTags = mt_rand(1,5);

            while(count($article->getTags()) != $nbTags){
                $tag = $this->getReference("tag_". mt_rand(1,5));
                if(! $article->getTags()->contains($tag)) {
                    $article->addTag($tag);
                }
            }

            $manager->persist($article);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     *
     * @return integer
     */
    public function getOrder()
    {
        return 25;
    }
}