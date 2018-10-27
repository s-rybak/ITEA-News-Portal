<?php

namespace App\Service;

use App\Entity\Category;
use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\PostRepositoryInterface;

/**
 * Class provides data for post list pages
 * @package App\Service
 *
 */

class PostListService implements PostListServiceInterface {

	protected $category_repository;

	public function __construct(CategoryRepositoryInterface $post)
	{
		$this->category_repository = $post;
	}

	public function getPostsByCategory( $categoryId ): Category
	{

		return $this->category_repository->getById($categoryId);

	}
}