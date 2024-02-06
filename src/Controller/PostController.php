<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/post', name: 'app_post')]
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }

    #[Route('/post/{id}')]
    public function show(Post $post, Request $request): Response
    {

        $previousUri = $request->headers->get('referer');

        $created = $post->getCreated()->format('d/m/Y');
        $updated = $post->getUpdated() ? $post->getUpdated()->format('d/m/Y') : false;
        $comments = $post->getComments();
        $categories = $post->getCategories();

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'created' => $created,
            'updated' => $updated,
            'comments' => $comments,
            'categories' => $categories,
            'previousUri' => $previousUri,
        ]);
    }
}
