<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StaticController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ProductRepository $productRepository)
    {
        return $this->render('web/static/home.html.twig', ['products' => $productRepository->getFirstX(8)]);
    }

    /**
     * @Route("/about/", name="about")
     */
    public function about()
    {
        return $this->render('web/static/about.html.twig');
    }

    /**
     * @Route("/tos/", name="tos")
     */
    public function tos()
    {
        return $this->render('web/static/tos.html.twig');
    }

    /**
     * @Route("/faq/", name="faq")
     */
    public function faq()
    {
        return $this->render('web/static/faq.html.twig');
    }
}
