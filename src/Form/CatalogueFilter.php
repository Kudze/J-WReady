<?php

namespace App\Form;

use App\Repository\ProductTagRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatalogueFilter extends AbstractType
{
    private $productTagRepository;

    public function __construct(ProductTagRepository $productTagRepository)
    {
        $this->productTagRepository = $productTagRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        foreach ($this->productTagRepository->findAll() as $tag)
            $builder->add(
                    $tag->getId(), CheckboxType::class, ['required' => false, 'label' => $tag->getTitle()]
            );

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}