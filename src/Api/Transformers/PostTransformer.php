<?php

namespace App\Api\Transformers;

use App\Api\Resource\Post;
use App\Entity\Post as PostEntity;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\PostRepositoryInterface;

/**
 * Provide Transformation from post to resource post
 * and from resource post to post.
 */
class PostTransformer implements PostTransformerInterface
{
    private $category_repository;
    private $post_repository;

    public function __construct(
        PostRepositoryInterface $post_repository,
        CategoryRepositoryInterface $category_repository
    ) {
        $this->category_repository = $category_repository;
        $this->post_repository = $post_repository;
    }

    /**
     * @param object $entity
     *
     * @return Post
     */
    public function entityToResource($entity): Post
    {
        $resource = new Post();

        $resource->setId($entity->getId());
        $resource->setTitle($entity->getTitle());
        $resource->setCategory($entity->getCategory()->getTitle());
        $resource->setContent($entity->getBody());
        $resource->setCreatedAt($entity->getCreatedAt());
        $resource->setUpdatedAt($entity->getUpdatedAt());

        return $resource;
    }

    /**
     * @param object $resource
     *
     * @return PostEntity
     *
     * @throws \Exception
     */
    public function resourceToEntity($resource): PostEntity
    {
        $entity = new PostEntity();

        if (0 !== $resource->getId()) {
            $entity = $this->post_repository->getById($resource->getId());

            if (null == $entity) {
                throw new \Exception("Post with id {$resource->getId()} not exists");
            }
        }

        $category = $this->category_repository->getByTitle($resource->getCategory());

        $entity->setTitle($resource->getTitle());
        $entity->setCategory($category);
        $entity->setBody($resource->getContent());
        $entity->setCreatedAt($resource->getCreatedAt());
        $entity->setUpdatedAt($resource->getUpdatedAt());

        return $entity;
    }

    /**
     * Transforms array to resource.
     *
     * @param array $arr
     *
     * @return Post
     */
    public function arrayToResource(array $arr): Post
    {
        $resource = new Post();
        $resource->setId($arr['id'] ?? 0);
        $resource->setTitle($arr['title']);
        $resource->setContent($arr['content']);
        $resource->setCategory($arr['category']);
        $resource->setCreatedAt(new \DateTime($arr['createdAt']));
        $resource->setUpdatedAt(new \DateTime($arr['updatedAt']));

        return $resource;
    }
}
