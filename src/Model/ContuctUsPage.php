<?php

namespace App\Model;

/**
 * Contac us DTO
 *
 * @package App\Model
 *
 * @author Sergey R <qwe@qwe.com>
 */
final class ContuctUsPage {

	private $phone;
	private $email;
	private $address;

	public function __construct(
		string $phone,
		string $email,
		string $address
	)
	{
		$this->phone = $phone;
		$this->email = $email;
		$this->address = $address;
	}

	/**
	 * @return string Company phone number
	 */
	public function getPhone(): string
	{
		return $this->phone;
	}

	/**
	 * @return string Company email address
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @return string Company address
	 */
	public function getAddress(): string
	{
		return $this->address;
	}


}