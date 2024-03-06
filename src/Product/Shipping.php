<?php

namespace Vitalybaev\GoogleMerchant\Product;

/**
 * Describes product's specific shipping rules
 *
 * @see https://support.google.com/merchants/answer/6324484
 */
class Shipping
{
	use \Vitalybaev\GoogleMerchant\HasProperties;

	/**
	 * Sets shipping country.
	 *
	 * @param string $countryCode ISO 3166-1 country code
	 *
	 * @return $this
	 */
	public function setCountry($countryCode)
	{
		$this->setAttribute('g:country', $countryCode, false);
	}

	/**
	 * Sets shipping country.
	 *
	 * @param string $region
	 *
	 * @return $this
	 */
	public function setRegion($region)
	{
		$this->setAttribute('g:region', $region, false);
	}

	/**
	 * Sets shipping postal code.
	 *
	 * @param string $postalCode
	 *
	 * @return $this
	 */
	public function setPostalCode($postalCode)
	{
		$this->setAttribute('g:postal_code', $postalCode, false);
	}

	/**
	 * Sets shipping location id.
	 *
	 * @param string $locationId
	 *
	 * @return $this
	 */
	public function setLocationId($locationId)
	{
		$this->setAttribute('g:location_id', $locationId, false);
	}

	/**
	 * Sets shipping location group name.
	 *
	 * @param string $locationGroupName
	 *
	 * @return $this
	 */
	public function setLocationGroupName($locationGroupName)
	{
		$this->setAttribute('g:location_group_name', $locationGroupName, false);
	}

	/**
	 * Sets shipping service.
	 *
	 * @param string $service
	 *
	 * @return $this
	 */
	public function setService($service)
	{
		$this->setAttribute('g:service', $service, false);
	}

	/**
	 * Sets shipping price.
	 *
	 * @param string $price
	 *
	 * @return $this
	 */
	public function setPrice($price)
	{
		$this->setAttribute('g:price', $price, false);
	}
}
