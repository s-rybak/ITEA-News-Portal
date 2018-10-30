<?php

namespace App\Service\Post;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepositoryInterface;

/**
 * Class provides data for post list pages.
 */
class PostListService implements PostListServiceInterface
{
    protected $category_repository;

    public function __construct(CategoryRepositoryInterface $post)
    {
        $this->category_repository = $post;
    }

    public function getPostsByCategory($categoryId): ?Category
    {
        return $this->category_repository->getById($categoryId);
    }
}
