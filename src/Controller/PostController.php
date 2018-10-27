<?php

namespace App\Controller;

use App\Repository\PostRepositoryInterface;
use App\Service\PostListServiceInterface;
use App\Service\PostPageServiceInterface;
use Complex\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Post controller.
 *
 * @author Sergey R <qwe@qwe.com>
 */
class PostController extends AbstractController {

	/**
	 * Post page.
	 *
	 * @param $id
	 * @param PostRepositoryInterface $service
	 *
	 * @return Response
	 */
	public function index( $id, PostPageServiceInterface $service ): Response
	{

		return $this->render( 'post/index.html.twig', [
			'post' => $service->getPost( $id )
		] );

	}

	public function categoryPosts($id, PostListServiceInterface $list_service ): Response
	{

		return $this->render( 'post/category.html.twig', [
			'category' => $list_service->getPostsByCategory( $id )
		] );
	}
}
