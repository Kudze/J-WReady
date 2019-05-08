<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/catalogue/", name="catalogue")
     */
    public function catalogue()
    {
        return $this->render('web/static/home.html.twig');
    }

    /**
     * @Route("/search/", name="search")
     */
    public function search()
    {
        return $this->render('web/static/home.html.twig');
    }
}
