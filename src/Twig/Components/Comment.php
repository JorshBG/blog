<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Comment
{

    public \App\Entity\Comment $comment;
    public bool $isLoved;


    public function mount(): void
    {
//        $this->
        $this->isLoved = true;
    }


}