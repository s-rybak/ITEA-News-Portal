<?php

use PHPUnit\Framework\TestCase;
use App\Service\Post\PostApiService;

class ApiPostServiceTest extends TestCase {

	private $service;

	protected function setUp() {

		$postRepos = $this->getPostRepository();

		$postTransformer = $this->getPostTransformer();

		$this->service = new PostApiService( $postRepos, $postTransformer );

	}

	public function testInstanceOf() {

		self::assertInstanceOf( \App\Service\Post\PostApiServiceInterface::class, $this->service );

	}

	public function testFindOne() {

		$postRepo      = $this->getPostRepository();
		$postTransform = $this->getPostTransformer();
		$post          = new \App\Entity\Post();
		$postRes       = new \App\Api\Resource\Post();

		$postRepo->expects( self::once() )
		         ->method( "getById" )
		         ->willReturn( $post );

		$postTransform->expects( self::once() )
		              ->method( "entityToResource" )
		              ->willReturn( $postRes );

		$service = new PostApiService( $postRepo, $postTransform );

		$actual = $service->findOne( 1 );

		self::assertEquals( $postRes, $actual );

	}

	public function testCreate() {

		$postRepo      = $this->getPostRepository();
		$postTransform = $this->getPostTransformer();
		$post          = new \App\Entity\Post();
		$postRes       = new \App\Api\Resource\Post();
		$newPostArray  = [
			"id"=>1,
			'title'=>"Lorem",
			'content'=>"Lorem ipsum",
			'category'=>"IT",
			'createdAt'=>"now",
			'updatedAt'=>"now",
		];

		$postRes->setId($newPostArray['id']);
		$postRes->setTitle($newPostArray['title']);
		$postRes->setContent($newPostArray['content']);
		$postRes->setCategory($newPostArray['category']);
		$postRes->setCreatedAt(new \DateTime($newPostArray['createdAt']));
		$postRes->setUpdatedAt(new \DateTime($newPostArray['updatedAt']));

		$postRepo->expects( self::never() )
		         ->method( "getById" )
		         ->willReturn( $post );

		$postTransform->expects( self::once() )
		              ->method( "entityToResource" )
		              ->willReturn( $postRes );

		$service = new PostApiService( $postRepo, $postTransform );

		$actual = $service->create( $newPostArray );

		self::assertEquals( $postRes, $actual );

	}

	public function testUpdate() {

		$postRepo      = $this->getPostRepository();
		$postTransform = $this->getPostTransformer();
		$post          = new \App\Entity\Post();
		$postRes       = new \App\Api\Resource\Post();
		$newPostArray  = [
			"id"=>1,
			'title'=>"Lorem",
			'content'=>"Lorem ipsum",
			'category'=>"IT",
			'createdAt'=>"now",
			'updatedAt'=>"now",
		];

		$postRes->setId($newPostArray['id']);
		$postRes->setTitle($newPostArray['title']);
		$postRes->setContent($newPostArray['content']);
		$postRes->setCategory($newPostArray['category']);
		$postRes->setCreatedAt(new \DateTime($newPostArray['createdAt']));
		$postRes->setUpdatedAt(new \DateTime($newPostArray['updatedAt']));

		$postRepo->expects( self::never() )
		         ->method( "getById" )
		         ->willReturn( $post );

		$postTransform->expects( self::once() )
		              ->method( "entityToResource" )
		              ->willReturn( $postRes );

		$service = new PostApiService( $postRepo, $postTransform );

		$actual = $service->update( $newPostArray, 1 );

		self::assertEquals( $postRes, $actual );

	}

	public function testDelete() {

		$service = new PostApiService( $this->getPostRepository(), $this->getPostTransformer() );

		self::assertNull( $service->delete( 1 ) );

	}

	public function testAll() {

		$postRepo      = $this->getPostRepository();
		$postTransform = $this->getPostTransformer();
		$posts          = [new \App\Entity\Post()];
		$postsRes       = new \App\Api\Resource\Post();

		$postRepo->expects( self::once() )
		         ->method( "getAll" )
		         ->willReturn( $posts );

		$postTransform->expects( self::once() )
		              ->method( "entityToResource" )
		              ->willReturn( $postsRes );

		$service = new PostApiService( $postRepo, $postTransform );

		self::assertEquals( [$postsRes], $service->all( ) );

	}

	public function getPostRepository() {
		return $this->getMockBuilder(
			\App\Repository\PostRepositoryInterface::class
		)->disableOriginalConstructor()->getMock();
	}

	public function getPostTransformer() {
		return $this->getMockBuilder(
			\App\Api\Transformers\PostTransformerInterface::class
		)->getMock();
	}

}