<?php

namespace App\Twig\Components;

use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent]
final class NavLink
{
    public string $route;
    public string $label;
    public bool $active = false;

//    Check if the route is the current route to make $active = true
    #[PostMount]
    public function checkActiveRoute(): void
    {
        $this->active = $this->route == $_SERVER['REQUEST_URI'];
    }
}
