<?php

namespace App\Service;

use App\Entity\Category;

/**
 * Interface for post list page.
 */
interface PostListServiceInterface
{
    public function getPostsByCategory($category): Category;
}
