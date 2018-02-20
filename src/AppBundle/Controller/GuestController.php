<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class GuestController extends Controller
{
    /**
     * @Route("/article-list")
     */
    public function articleListAction()
    {
        return $this->render('Guest/article_list.html.twig', array(
            // ...
        ));
    }

}
