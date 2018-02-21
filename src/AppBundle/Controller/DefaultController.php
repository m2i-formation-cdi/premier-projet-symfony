<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/test")
     */
    public function testAction(){
        return new Response("test");
    }

    /**
     * @Route(  "/hello/{age}/{name}/{firstName}", name="hellopage",
     *          defaults={"firstName"="toto", "name"="le héro"},
     *          requirements={"age"="\d{1,3}"}
     * )
     */
    public function hello($firstName, $name, $age){
        return $this->render(
            "default/hello.html.twig", [
            "name" => $name, "firstName"=> $firstName, "age" => $age,
                "message"=> "Symfony c'est super",
                "now" => new \DateTime()
        ]);
    }

    /**
     * @Route("/fruits", name="fruitpage")
     */
    public function fruitsAction(){
        $fruits = ["Poires", "Pommes", "Oranges"];

        $food = [
            ["name" => "Pomme", "type" => "fruit", "edible" => true],
            ["name" => "Radis", "type" => "légume", "edible" => true],
            ["name" => "Chromium", "type" => "métal", "edible" => false],
            ["name" => "Canard", "type" => "viande", "edible" => true],
            ["name" => "Kebab", "type" => "plat", "edible" => false],
        ];
        return $this->render("default/fruits.html.twig",
            ["fruitList" => $fruits, "foodList" => $food]);
    }

    /**
     * @Route("/new-contact", name="new_contactpage")
     */
    public function newContactAction(){
        $contact = new Contact();
        $contact->setName("Hugo")
            ->setFirstName("Victor")
            ->setEmail("v.hugo@miserables2.com")
            ->setDateOfBirth(new \DateTime("1802-05-12"));
        //Récupération du gestionnaire d'entité
        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();

        return $this->render("default/new-contact.html.twig", ["contact"=>$contact]);
    }

    /**
     * @Route("/add-article")
     */
    public function addArticlesAction(){
        $em = $this->getDoctrine()->getManager();

        $em->persist(new Article("Symfony 5 arrive", "dev", true));
        $em->persist(new Article("La nouvelle gaffe de Trump", "politique", false));
        $em->persist(new Article("Les sorties de la semaine", "cinéma", true));
        $em->persist(new Article("Doctrine et Symfony", "dev", true));
        $em->persist(new Article("Cours de Macron économie", "politique", false));
        $em->persist(new Article("AngularJs vs ReactJS round 1", "dev", true));

        $em->flush();

        return new Response("articles chargés");
    }

    /**
     * @Route("/article-list/page-{page}/{categoryName}",
     *     defaults={"categoryName"="all", "page"=1}, requirements={"page"="\d+"},
     *     name="article_list")
     */
    public function showArticlesAction($categoryName, $page){
        $repository = $this->getDoctrine()->getRepository("AppBundle:Article");

        $nbArticlePerPage = 10;

        if($categoryName == 'all'){
            $articleList = $repository->findBy([],['category' => 'ASC']);
        } else {
            $categoryRepository = $this->getDoctrine()->getRepository("AppBundle:Category");
            $category = $categoryRepository->findByName($categoryName);
            $articleList = $repository->findByCategory($category, ['category' => 'ASC']);
        }

        $nbArticles = count($articleList);
        $nbPages = ceil($nbArticles / $nbArticlePerPage);
        $offset = $nbArticlePerPage * ($page-1);

        $articleList = array_slice($articleList, $offset, $nbArticlePerPage);

        return $this->render("default/article-list.html.twig", [
                "articleList" => $articleList,
                "nbPages" => $nbPages,
                "currentPage" => $page,
                "category"=> $categoryName
            ]
        );
    }

    /**
     * @Route("/article-delete/{id}", requirements={"id"="\d+"}, name="article_delete")
     */
    public function deleteArticleAction($id){
        //Récupération de l'article à supprimer
        $repository = $this->getDoctrine()->getRepository("AppBundle:Article");
        $article = $repository->findOneById($id);

        //Suppression de l'entité
        $em = $this->getDoctrine()->getManager();

        $em->remove($article);

        $em->flush();

        return $this->redirect("/article-list");

    }

    /**
     * @Route("/article-details/{id}", name="article_details", requirements={"id"="\d+"})
     */
    public function articleDetailsAction(Article $article){
        return $this->render("default/article-details.html.twig", ["article" => $article]);
    }
}
