<?php

namespace Vitalybaev\GoogleMerchant;

class PropertyBag
{
	use \Vitalybaev\GoogleMerchant\HasProperties;

	/**
	 * Property name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 * @return PropertyBag
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}
}
