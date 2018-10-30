<?php

namespace App\Api\Transformers;

use App\Api\Resource\Post;
use App\Entity\Post as PostEntity;

/**
 * Interface of transformer class
 * which implements transform logic
 * from resource to entity and vice versa.
 */
interface PostTransformerInterface
{
    public function arrayToResource(array $arr): Post;

    public function entityToResource(PostEntity $entity): Post;

    public function resourceToEntity(Post $resource): PostEntity;
}
