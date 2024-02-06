<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserSpaceController extends AbstractController
{
    #[Route('/user/space', name: 'app_user_space')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findBy(['author' => $this->getUser()]);

        return $this->render('user_space/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
