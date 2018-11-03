<?php

use PHPUnit\Framework\TestCase;
use App\Service\Post\PostPage;

class PostPageTest extends TestCase{

	public function testGetPost(){

		$post = new App\Entity\Post();
		$postRepo = $this->getMockBuilder(
			\App\Repository\PostRepositoryInterface::class
		)->disableOriginalConstructor()->getMock();

		$postRepo
			->method("getById")
			->willReturn($post);

		$service = new PostPage($postRepo);

		self::assertEquals($post,$service->getPost(1));

		$postRepo = $this->getMockBuilder(
			\App\Repository\PostRepositoryInterface::class
		)->disableOriginalConstructor()->getMock();

		$postRepo->method("getById")->willReturn(null);

		$service = new PostPage($postRepo);

		self::assertEquals(null,$service->getPost(1));

	}

}