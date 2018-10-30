<?php
/**
 * Created by PhpStorm.
 * User: sergej
 * Date: 10/26/18
 * Time: 8:42 PM.
 */

namespace App\Repository;

use App\Entity\Post;

interface PostRepositoryInterface
{
    /**
     * Update or create post.
     *
     * @param Post $post
     */
    public function save(Post $post): void;

    /**
     * Save array of posts.
     *
     * @param iterable $post
     */
    public function saveAll(iterable $post): void;

    /**
     * Get latest post.
     *
     * @param int $count
     *
     * @return iterable
     */
    public function getLatest(int $count): iterable;

    /**
     * Get post by id.
     *
     * @param int $id
     *
     * @return Post|null
     */
    public function getById(int $id): ?Post;

    /**
     * Get post by category.
     *
     * @param int $id
     *
     * @return iterable
     */
    public function getByCategory(int $id): iterable;

    /**
     * Removes post by id.
     *
     * @param int $id
     */
    public function delete(int $id): void;

    /**
     * Get all posts.
     *
     * @return iterable
     */
    public function getAll(): iterable;
}
