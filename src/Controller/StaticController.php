<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('web/static/home.html.twig');
    }

    /**
     * @Route("/about/", name="about")
     */
    public function about()
    {
        return $this->render('web/static/home.html.twig');
    }

    /**
     * @Route("/tos/", name="tos")
     */
    public function tos()
    {
        return $this->render('web/static/home.html.twig');
    }

    /**
     * @Route("/faq/", name="faq")
     */
    public function faq()
    {
        return $this->render('web/static/home.html.twig');
    }
}
