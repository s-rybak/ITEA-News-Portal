<?php

namespace App\Service;

use App\Entity\Post;
use App\Repository\PostRepositoryInterface;

/**
 * Class provides data for post page.
 */
class PostPage implements PostPageServiceInterface
{
    protected $post_repository;

    public function __construct(PostRepositoryInterface $post)
    {
        $this->post_repository = $post;
    }

    public function getPost(int $id): ?Post
    {
        return $this->post_repository->getById($id);
    }
}
