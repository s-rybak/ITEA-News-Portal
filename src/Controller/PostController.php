<?php

namespace App\Controller;

use App\Repository\PostRepositoryInterface;
use App\Service\Post\PostListServiceInterface;
use App\Service\Post\PostPageServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Post controller.
 *
 * @author Sergey R <qwe@qwe.com>
 */
class PostController extends AbstractController
{
    /**
     * Post page.
     *
     * @param $id
     * @param PostRepositoryInterface $service
     *
     * @return Response
     */
    public function index($id, PostPageServiceInterface $service): Response
    {
        $post = $service->getPost($id);

        if (null === $post) {
            throw new NotFoundHttpException("Post with id {$id} not found");
        }

        return $this->render('post/index.html.twig', [
            'post' => $post,
        ]);
    }

    public function categoryPosts($id, PostListServiceInterface $list_service): Response
    {
        $category = $list_service->getPostsByCategory($id);

        if (null === $category) {
            throw new NotFoundHttpException("Category with id {$id} not found");
        }

        return $this->render('post/category.html.twig', [
            'category' => $category,
        ]);
    }
}
