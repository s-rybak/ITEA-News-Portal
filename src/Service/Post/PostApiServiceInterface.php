<?php

namespace App\Service\Post;

use App\Api\Resource\Post;

/**
 * Interface provrides functionality
 * for api post controller.
 */
interface PostApiServiceInterface
{
    /**
     * Find one post by ID.
     *
     * @param int $id
     *
     * @return Post
     */
    public function findOne(int $id): Post;

    /**
     * Creates new post.
     *
     * @param Post $data
     *
     * @return Post
     */
    public function create(array $data): Post;

    /**
     * Deletes post.
     *
     * @param int $id
     */
    public function delete(int $id);

    /**
     * Returns all posts.
     *
     * @return iterable
     */
    public function all(): iterable;

    /**
     * Update post.
     *
     * @param array $data
     * @param int   $id
     *
     * @return Post
     */
    public function update(array $data, int $id): Post;
}
