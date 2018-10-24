<?php
/**
 * Created by PhpStorm.
 * User: sergej
 * Date: 10/22/18
 * Time: 8:00 PM
 */

namespace App\Service;

use App\DTO\HomePage;

final class DatabaseHomePage implements HomePageServiceInterface {

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
}