<?php

namespace App\Service;

use App\Entity\Post;

/**
 * Service interface for post page.
 */
interface PostPageServiceInterface
{
    public function getPost(int $id): ?Post;
}
