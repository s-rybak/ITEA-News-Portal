<?php

namespace App\Repository;


use App\Entity\Category;

interface CategoryRepositoryInterface {

	public function fundAllCategories(): iterable;
	public function getById($id):Category;

}