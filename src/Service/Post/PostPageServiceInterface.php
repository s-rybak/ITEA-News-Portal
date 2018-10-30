<?php

namespace App\Service\Post;

use App\Entity\Post;

/**
 * Service interface for post page.
 */
interface PostPageServiceInterface
{
    public function getPost(int $id): ?Post;
}
