<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment', name: 'app_comment')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CommentController.php',
        ]);
    }

    #[Route('/comment/{comment_id}/love/{user_id}', name: 'app_love_comment')]
    public function love(
        #[MapEntity(expr: 'repository.find(comment_id)')]
        Comment $comment,
        #[MapEntity(expr: 'repository.find(user_id)')]
        User    $user,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {

        $comment->addLove($user);

        $entityManager->flush();

        return $this->json([
            'message' => 'Comment love successful',
        ]);


    }
}
