<?php

namespace Vitalybaev\GoogleMerchant\Meta;

use Vitalybaev\GoogleMerchant\Product as GoogleProduct;
use Vitalybaev\GoogleMerchant\Meta\Availability;
use Vitalybaev\GoogleMerchant\Meta\Schema;

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
		// Maybe map https://schema.org/ItemAvailability URL.
		if ( isset( Schema::MAP['availability'][$value] ) )
			$value = Schema::MAP['availability'][$value];
			
		if ( ! in_array( $value, array( Availability::IN_STOCK, Availability::OUT_OF_STOCK ) ) )
			throw new InvalidArgumentException('Invalid \'availability\' value');

	    $this->setAttribute('availability', $value, false);

	    return $this;
	}

	/**
	 * Adds brand of the product.
	 *
	 * @param string $brand
	 * @return $this
	 */
	public function addBrand($brand)
	{
		$this->addAttribute('brand', $brand, false);
		return $this;
	}
}
