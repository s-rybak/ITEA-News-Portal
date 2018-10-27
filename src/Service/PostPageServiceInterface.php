<?php

namespace App\Service;

use App\Entity\Post;

/**
 * Service interface for post page
 *
 * @package App\Service
 *
 */

interface PostPageServiceInterface {

	public function getPost(int $id): Post;

}