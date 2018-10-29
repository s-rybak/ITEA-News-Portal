<?php

namespace App\Service;

use App\DTO\HomePage;
use App\Repository\CategoryRepositoryInterface;

/**
 * Service provides fake data for home page.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 */
final class FakeHomePage implements HomePageServiceInterface
{
    private $category_repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->category_repository = $repository;
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
        return $this->category_repository->fundAllCategories();
    }

    public function getLatestPost(): iterable
    {
        return [];
    }
}
