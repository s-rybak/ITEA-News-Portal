<?php
namespace App\Service;

use App\Entity\Category;

/**
 * Interface for post list page
 * @package App\Service
 *
 */

interface PostListServiceInterface {

	public function getPostsByCategory($category):Category;

}