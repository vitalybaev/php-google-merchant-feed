<?php

namespace Vitalybaev\GoogleMerchant\Meta;

use Vitalybaev\GoogleMerchant\Product as GoogleProduct;
use Vitalybaev\GoogleMerchant\Meta\Product\Availability;
use Vitalybaev\GoogleMerchant\Meta\Product\Schema;

/*
 * Extends the Product class to create a Facebook and Instagram Commerce Manager Catalog Feed.
 */
class Product extends GoogleProduct
{
	/**
	 * Sets availability of the product.
	 *
	 * The current availability of the item. Supported values: in stock, out of stock. Out of stock items don't appear in ads,
	 * which prevents advertising items that aren't available. They do still appear in shops on Facebook and Instagram, but are
	 * marked as sold out.
	 *
	 * @param string $value
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setAvailability($value)
	{
		if ( isset( Schema::MAP['availability'][$value] ) )
			$value = Schema::MAP['availability'][$value];

		if ( ! in_array( $value, array( Availability::IN_STOCK, Availability::OUT_OF_STOCK ) ) )
			throw new InvalidArgumentException('Invalid \'availability\' value');

	    $this->setAttribute('g:availability', $value, false);
	}

	/**
	 * Adds brand of the product.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function addBrand($value)
	{
		$this->addAttribute('g:brand', $value, false);
	}

	/**
	 * Sets age group of the product.
	 *
	 * The age group the item is targeted towards.
	 *
	 * @see https://developers.facebook.com/docs/marketing-api/catalog/reference/
	 * @param string $value
	 * @return $this
	 */
	public function setAgeGroup($value)
	{
		if ( ! in_array( $value, array( 'adult', 'all ages', 'teen', 'kids', 'toddler', 'infant', 'newborn' ) ) )
			throw new InvalidArgumentException('Invalid \'age_group\' value');

		$this->setAttribute('g:age_group', $value, false);
	}
}
