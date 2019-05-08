<?php

namespace App\Twig;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class HeaderUtil extends AbstractExtension
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('activeHeaderCheck', [$this, 'checkIfRouteIsActive']),
        ];
    }

    public function checkIfRouteIsActive($route)
    {
        if($this->requestStack->getCurrentRequest()->get('_route') == $route)
            return "active";

        return "";
    }
}