<?php
/**
 * Created by PhpStorm.
 * User: sergej
 * Date: 10/22/18
 * Time: 8:00 PM.
 */

namespace App\Service;

use App\DTO\HomePage;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\PostRepositoryInterface;

final class DatabaseHomePage implements HomePageServiceInterface
{
    private $category_repository;
    private $post_repository;

    public function __construct(CategoryRepositoryInterface $repository, PostRepositoryInterface $post)
    {
        $this->category_repository = $repository;
        $this->post_repository = $post;
    }

    /**
     * {@inheritdoc}
     */
    public function getData(): HomePage
    {
        $faker = \Faker\Factory::create();

        return new HomePage(
            'News Portal',
            $faker->words(20, true),
            'Read News',
            'Suggest news'
        );
    }

    public function getCategories(): iterable
    {
        return $this->category_repository->foundAllCategories();
    }

    public function getLatestPost(): iterable
    {
        return $this->post_repository->getLatest(3);
    }
}
