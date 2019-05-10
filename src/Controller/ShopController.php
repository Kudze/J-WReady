<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ProductTagRepository;
use App\Form\CatalogueFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/catalogue/", name="catalogue")
     */
    public function catalogue(Request $request, ProductTagRepository $productTagRepository, ProductRepository $productRepository)
    {
        $data = [];
        foreach($productTagRepository->findAll() as $tag)
            $data[$tag->getId()] = true;

        $form = $this->createForm(CatalogueFilter::class, $data);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
            $data = $form->getData();

        //Paging could be added, but its not necceseary at this point in time.
        $productData = $productRepository->findBy(
            [
                "tag" => $data
            ]
        );

        return $this->render(
            'web/shop/catalogue.html.twig',
            [
                'form' => $form->createView(),
                'products' => $productData
            ]
        );
    }

    /**
     * @Route("/search/", name="search")
     */
    public function search()
    {
        return $this->render('web/static/home.html.twig');
    }
}
