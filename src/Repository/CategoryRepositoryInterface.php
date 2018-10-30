<?php

namespace App\Repository;

use App\Entity\Category;

interface CategoryRepositoryInterface
{
    public function foundAllCategories(): iterable;

    public function getById(int $id): ?Category;

    public function getByTitle(string $id): ?Category;
}
