<?php

namespace App\Service\Post;

use App\Api\Resource\Post;
use App\Api\Transformers\PostTransformerInterface;
use App\Repository\PostRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostApiService implements PostApiServiceInterface
{
    private $post_repository;
    private $post_transformer;

    public function __construct(PostRepositoryInterface $post_repository, PostTransformerInterface $post_transformer)
    {
        $this->post_repository = $post_repository;
        $this->post_transformer = $post_transformer;
    }

    /**
     * Find one post by ID.
     *
     * @param int $id
     *
     * @return Post
     *
     * @throws NotFoundHttpException
     */
    public function findOne(int $id): Post
    {
        $post = $this->post_repository->getById($id);

        if (null === $post) {
            throw new NotFoundHttpException("Post with id {$id} not found");
        }

        return $this->post_transformer->entityToResource($post);
    }

    /**
     * Creates new post.
     *
     * @param array $data
     *
     * @return Post
     */
    public function create(array $data): Post
    {
        $resource = $this->post_transformer->arrayToResource($data);

        $post = $this->post_transformer->resourceToEntity($resource);
        $this->post_repository->save($post);

        return $this->post_transformer->entityToResource($post);
    }

    /**
     * Creates new post.
     *
     * @param array $data
     * @param int   $id
     *
     * @return Post
     */
    public function update(array $data, int $id): Post
    {
        $data['id'] = $id;
        $resource = $this->post_transformer->arrayToResource($data);

        $post = $this->post_transformer->resourceToEntity($resource);
        $this->post_repository->save($post);

        return $this->post_transformer->entityToResource($post);
    }

    /**
     * Deletes post.
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->post_repository->delete($id);
    }

    /**
     * Returns all posts.
     *
     * @return iterable
     */
    public function all(): iterable
    {
        $posts = [];

        foreach ($this->post_repository->getAll() as $post) {
            array_push($posts, $this->post_transformer->entityToResource($post));
        }

        return $posts;
    }
}
