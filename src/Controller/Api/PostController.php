<?php

namespace App\Controller\Api;

use App\Service\Post\PostApiServiceInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api controller
 * for post entity.
 */
class PostController extends FOSRestController
{
    private $service;

    public function __construct(PostApiServiceInterface $api_service)
    {
        $this->service = $api_service;
    }

    /**
     * Creates new post.
     *
     * @param Request $request
     *
     * @return View
     *
     * @Rest\Post("/api/post")
     */
    public function postPost(Request $request): View
    {
        $post = $this->service->create($request->request->get('data'));

        return $this->view($post, Response::HTTP_CREATED);
    }

    /**
     * @return View
     *
     * @Rest\Get("/api/post/all")
     */
    public function getAllPosts(): View
    {
        return $this->view($this->service->all(), Response::HTTP_OK);
    }

    /**
     * Gets needed post by ID.
     *
     * @param int $id
     *
     * @return View
     *
     * @Rest\Get("/api/post/{id}")
     */
    public function getPost(int $id): View
    {
        $post = $this->service->findOne($id);

        return $this->view($post, Response::HTTP_OK);
    }

    /**
     * Updates post data.
     *
     * @param Request $request
     *
     * @return View
     *
     * @Rest\Patch("/api/post/{id}")
     */
    public function patchPost(int $id, Request $request): View
    {
        $post = $this->service->update($request->request->get('data'), $id);

        return $this->view($post, Response::HTTP_CREATED);
    }

    /**
     * Deletes post.
     *
     * @param int $id
     *
     * @return View
     *
     * @Rest\Delete("/api/post/{id}")
     */
    public function deletePost(int $id): View
    {
        $this->service->delete($id);

        return $this->view([], Response::HTTP_NO_CONTENT);
    }
}
