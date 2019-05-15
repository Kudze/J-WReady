<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    /**
     * @Route("/auth/register/", name="register")
     */
    public function register()
    {
        return $this->render('web/static/register.html.twig');
    }

    /**
     * @Route("/auth/login/", name="login")
     */
    public function login()
    {
        return $this->render('web/auth/login.html.twig');
    }
}
