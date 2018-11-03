<?php

use PHPUnit\Framework\TestCase;
use App\Service\Post\PostListService;

class PostListServiceTest extends TestCase{

	public function testGetPostsByCategory(){

		$category = new App\Entity\Category();
		$categoryRepo = $this->getMockBuilder(
			\App\Repository\CategoryRepositoryInterface::class
		)->disableOriginalConstructor()->getMock();

		$categoryRepo
			->method("getById")
			->willReturn($category);

		$service = new PostListService($categoryRepo);

		self::assertEquals($category,$service->getPostsByCategory(1));

		$categoryRepo = $this->getMockBuilder(
			\App\Repository\CategoryRepositoryInterface::class
		)->disableOriginalConstructor()->getMock();

		$categoryRepo->method("getById")->willReturn(null);

		$service = new PostListService($categoryRepo);

		self::assertEquals(null,$service->getPostsByCategory(1));

	}

}