<?php

namespace App\Service;

use App\Model\ContuctUsPage;

/**
 * Service provides fake data for contact us page.
 *
 * @author Sergey R <qwe@qwe.com>
 */

final class FakeContuctUsPage implements  ContactUsServiceInterface {

	/**
	 * {@inheritdoc}
	 */
	public function getData(): ContuctUsPage {

		$faker = \Faker\Factory::create();

		return new ContuctUsPage(
			$faker->tollFreePhoneNumber,
			$faker->companyEmail,
			$faker->address
		);

	}
}