<?php

namespace Vitalybaev\GoogleMerchant;

class Inventory
{
	use HasProperties;

	/**
	 * Sets 'target_customer_id'.
	 *
	 * The merchant ID of this retailer.
	 *
	 * @see https://support.google.com/merchants/answer/7677785
	 * @param string $value
	 * @return $this
	 */
	public function setTargetCustomerId($value)
	{
		$this->setAttribute('target_customer_id', $value);
		return $this;
	}

	/**
	 * Sets 'store_code'.
	 *
	 * The unique store identifier. This value is case sensitive. Use either the store code listed in the retailer's Business
	 * Profile or a point of sales (POS)/inventory data provider internal identifier. Note: If using an internal store code,
	 * provide a mapping to the store address in the store feed.
	 *
	 * @see https://support.google.com/merchants/answer/7677785
	 * @param string $value
	 * @return $this
	 */
	public function setStoreCode($value)
	{
		$this->setAttribute('store_code', $value);
		return $this;
	}

	/**
	 * Sets 'id'.
	 *
	 * The unique identifier of the product. It's recommended that you use the product SKU. Note: If the retailer sells the
	 * same product new and used, they should have different IDs.
	 *
	 * @see https://support.google.com/merchants/answer/7677785
	 * @param string $value
	 * @return $this
	 */
	public function setId($value)
	{
		$this->setAttribute('id', $value);
		return $this;
	}

	/**
	 * Sets 'gtin'.
	 *
	 * The Global Trade Item Number of the product.
	 *
	 * @see https://support.google.com/merchants/answer/7677785
	 * @param string $value
	 * @return $this
	 */
	public function setGtin($value)
	{
		$this->setAttribute('gtin', $value, false);
		return $this;
	}

	/**
	 * Adds 'gtin'.
	 *
	 * The Global Trade Item Number of the product.
	 *
	 * @see https://support.google.com/merchants/answer/7677785
	 * @param string $value
	 * @return $this
	 */
	public function addGtin($value)
	{
		$this->addAttribute('gtin', $value, false);
		return $this;
	}

	/**
	 * Adds 'quantity'.
	 * 
	 * The quantity of the product.
	 *
	 * @see https://support.google.com/merchants/answer/7677785
	 * @param int $value
	 * @return $this
	 */
	public function setQuantity($value)
	{
		$this->setAttribute('quantity', $value, false);
		return $this;
	}

	/**
	 * Sets 'price'.
	 *
	 * The price of the product in local currency.
	 *
	 * @see https://support.google.com/merchants/answer/7677785
	 * @param string $value
	 * @return $this
	 */
	public function setPrice($value)
	{
		$this->setAttribute('price', $value, false);
		return $this;
	}

	/**
	 * Sets 'timestamp'.
	 *
	 * The timestamp of recording the inventory in a specific time zone, as defined by the ISO 8601 standard.
	 *
	 * @see https://support.google.com/merchants/answer/7677785
	 * @param string $value Format: yyyy-mm-ddThh:mm:ss+time zone.
	 * @return $this
	 */
	public function setTimestamp($value)
	{
		$this->setAttribute('timestamp', $value, false);
		return $this;
	}

	/**
	 * @param $namespace
	 * @return array
	 */
	public function getXmlStructure($namespace)
	{
		$xmlStructure = array(
			'item' => $this->getPropertiesXmlStructure($namespace),
		);

		return $xmlStructure;
	}
}
