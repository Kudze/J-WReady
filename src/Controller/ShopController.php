<?php

namespace App\Controller;

use App\Form\CatalogueSearch;
use App\Repository\ProductRepository;
use App\Repository\ProductTagRepository;
use App\Form\CatalogueFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    private function handleCatalogue(Request $request, ProductTagRepository $productTagRepository, ProductRepository $productRepository, string $dataView)
    {
        $data = [];
        foreach ($productTagRepository->findAll() as $tag)
            $data[$tag->getId()] = true;

        $form = $this->createForm(CatalogueFilter::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
            $data = $form->getData();

        $tData = [];
        foreach ($data as $tag => $enabled) {
            if ($enabled)
                array_push($tData, $tag);
        }

        //Paging could be added, but its not necceseary at this point in time.
        $productData = [];
        if ($tData !== [])
            $productData = $productRepository->findByTags($tData);

        return $this->render(
            'web/shop/catalogue.html.twig',
            [
                'form' => $form->createView(),
                'products' => $productData,
                'data' => $dataView
            ]
        );
    }

    /**
     * @Route("/catalogue_table/", name="catalogue")
     */
    public function catalogue(Request $request, ProductTagRepository $productTagRepository, ProductRepository $productRepository)
    {
        return $this->handleCatalogue($request, $productTagRepository, $productRepository, 'table');
    }

    /**
     * @Route("/catalogue_list/", name="catalogueList")
     */
    public function catalogueList(Request $request, ProductTagRepository $productTagRepository, ProductRepository $productRepository)
    {
        return $this->handleCatalogue($request, $productTagRepository, $productRepository, 'list');
    }

    private function handleSearch(Request $request, ProductRepository $productRepository, string $dataView)
    {
        $data = [];
        $form = $this->createForm(CatalogueSearch::class, $data);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
            $data = $form->getData();

        //Paging could be added, but its not necceseary at this point in time.
        $productData = [];
        if ($data !== [])
            $productData = $productRepository->search($data["query"]);

        return $this->render(
            'web/shop/search.html.twig',
            [
                'form' => $form->createView(),
                'products' => $productData,
                'data' => $dataView
            ]
        );
    }

    /**
     * @Route("/search_table/", name="search")
     */
    public function search(Request $request, ProductRepository $productRepository)
    {
        return $this->handleSearch($request, $productRepository, 'table');
    }

    /**
     * @Route("/search_list/", name="searchList")
     */
    public function searchList(Request $request, ProductRepository $productRepository)
    {
        return $this->handleSearch($request, $productRepository, 'list');
    }

    /**
     * @Route("/item/{id}", name="view_item", requirements={"id"="\d+"})
     */
    public function view($id, ProductRepository $productRepository)
    {
        $product = $productRepository->find($id);

        if ($product === null)
            return $this->redirectToRoute("catalogue");

        return $this->render(
            'web/shop/view_item.html.twig',
            [
                "product" => $product
            ]
        );
    }
}
