<?php

namespace Vitalybaev\GoogleMerchant;

use Vitalybaev\GoogleMerchant\Exception\InvalidArgumentException;
use Vitalybaev\GoogleMerchant\Product\Availability;
use Vitalybaev\GoogleMerchant\Product\Condition;
use Vitalybaev\GoogleMerchant\Product\Schema;
use Vitalybaev\GoogleMerchant\Product\Shipping;

class Product
{
	use HasProperties;

	/**
	 * Sets id of product.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setId($value)
	{
		$this->setAttribute('id', $value);
		return $this;
	}

	/**
	 * Sets item group id of product.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setItemGroupId($value)
	{
		$this->setAttribute('item_group_id', $value);
		return $this;
	}

	/**
	 * Sets title of product.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setTitle($value)
	{
		$this->setAttribute('title', $value, true);
		return $this;
	}

	/**
	 * Sets description of product.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setDescription($value)
	{
		$this->setAttribute('description', $value, true);
		return $this;
	}

	/**
	 * Sets link to the product.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setLink($url)
	{
		$this->setAttribute('link', $url, true);
		return $this;
	}

	/**
	 * Sets canonical link to the product.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setCanonicalLink($url)
	{
		$this->setAttribute('canonical_link', $url, true);
		return $this;
	}

	/**
	 * Sets mobile link to the product.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setMobileLink($url)
	{
		$this->setAttribute('mobile_link', $url, true);
		return $this;
	}

	/**
	 * Sets image of the product.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setImage($url)
	{
		$this->setAttribute('image_link', $url, true);
		return $this;
	}

	/**
	 * Sets additional image of the product.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setAdditionalImage($url)
	{
		$this->setAttribute('additional_image_link', $url, true);
		return $this;
	}

	/**
	 * Sets additional image of the product.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function addAdditionalImage($url)
	{
		$this->addAttribute('additional_image_link', $url, true);
		return $this;
	}

	/**
	 * Sets availability of the product.
	 *
	 * Use the availability [availability] attribute to tell users and Google whether you have a product in stock.
	 *
	 * @see https://support.google.com/merchants/answer/6324448.
	 * @param string $value
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setAvailability($value)
	{
		if ( isset( Schema::MAP['availability'][$value] ) )
			$value = Schema::MAP['availability'][$value];

		if ( ! in_array( $value, array( Availability::IN_STOCK, Availability::OUT_OF_STOCK, Availability::PREORDER, Availability::BACKORDER ) ) )
			throw new InvalidArgumentException('Invalid \'availability\' value');

		$this->setAttribute('availability', $value, false);

		return $this;
	}

	/**
	 * Sets price of the product.
	 *
	 * @param string $price
	 * @return $this
	 */
	public function setPrice($price)
	{
		$this->setAttribute('price', $price, false);
		return $this;
	}

	/**
	 * Sets sale price of the product.
	 *
	 * @param string $price
	 * @return $this
	 */
	public function setSalePrice($price)
	{
		$this->setAttribute('sale_price', $price, false);
		return $this;
	}

	/**
	 * Sets sale price effective date of the product.
	 *
	 * @param string $price
	 * @return $this
	 */
	public function setSalePriceEffectiveDate($price)
	{
		$this->setAttribute('sale_price_effective_date', $price, false);
		return $this;
	}

	/**
	 * Sets Google category of the product.
	 *
	 * @param string $category
	 * @return $this
	 */
	public function setGoogleCategory($category)
	{
		$this->setAttribute('google_product_category', $category, false);
		return $this;
	}

	/**
	 * Sets Google product type of the product.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setProductType($value)
	{
		$this->setAttribute('product_type', $value, false);
		return $this;
	}

	/**
	 * Sets brand of the product.
	 *
	 * @param string $brand
	 * @return $this
	 */
	public function setBrand($brand)
	{
		$this->setAttribute('brand', $brand, false);
		return $this;
	}

	/**
	 * Sets GTIN code of the product.
	 *
	 * @param string $gtin
	 * @return $this
	 */
	public function setGtin($gtin)
	{
		$this->setAttribute('gtin', $gtin, false);
		return $this;
	}

	/**
	 * Adds GTIN code of the product.
	 *
	 * @param string $gtin
	 * @return $this
	 */
	public function addGtin($gtin)
	{
		$this->addAttribute('gtin', $gtin, false);
		return $this;
	}

	/**
	 * Sets MPN code of the product.
	 *
	 * @param string $mpn
	 * @return $this
	 */
	public function setMpn($mpn)
	{
		$this->setAttribute('mpn', $mpn, false);
		return $this;
	}

	/**
	 * Sets identifier_exists code of the product.
	 *
	 * Use the identifier exists [identifier_exists] attribute to indicate that unique product identifiers (UPIs) aren’t available
	 * for your product. Unique product identifiers are submitted using the GTIN [gtin], MPN [mpn], and brand [brand] attributes.
	 *
	 * @see https://support.google.com/merchants/answer/6324478.
	 * @param string $value FILTER_VALIDATE_BOOLEAN value.
	 * @return $this
	 */
	public function setIdentifierExists($value)
	{
		$value = filter_var( $value, FILTER_VALIDATE_BOOLEAN ) ? 'yes' : 'no';

		$this->setAttribute('identifier_exists', $value, false);

		return $this;
	}

	/**
	 * Sets condition of the product.
	 *
	 * Use the condition [condition] attribute to tell potential customers about the condition of the product you're selling. It’s
	 * important to set this value correctly since it is used to refine search results.
	 *
	 * @see https://support.google.com/merchants/answer/6324469.
	 * @param string $value A Schema offer item condition URL or condition string.
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setCondition($value)
	{
		if ( isset( Schema::MAP['condition'][$value] ) )
			$value = Schema::MAP['condition'][$value];

		if ( ! in_array( $value, array( Condition::NEW_PRODUCT, Condition::REFURBISHED, Condition::USED ) ) )
			throw new InvalidArgumentException('Invalid \'condition\' value');

		$this->setAttribute('condition', $value, false);

		return $this;
	}

	/**
	 * Sets adult of the product.
	 *
	 * Use the adult [adult] attribute to indicate that individual products are for adults only because they contain adult content
	 * such as nudity, sexually suggestive content, or are intended to enhance sexual activity.
	 *
	 * @see https://support.google.com/merchants/answer/6324508.
	 * @param mixed $value A Schema adult oriented enumeration URL or FILTER_VALIDATE_BOOLEAN value.
	 * @return $this
	 */
	public function setAdult($value)
	{
		if ( isset( Schema::MAP['adult'][$value] ) )
			$value = Schema::MAP['adult'][$value];

		// FILTER_VALIDATE_BOOLEAN returns true for '1', 'true', 'on' and 'yes'. Returns false otherwise. 
		$this->setAttribute('adult', filter_var( $value, FILTER_VALIDATE_BOOLEAN ) ? 'yes' : 'no', false);

		return $this;
	}

	/**
	 * Sets color of the product.
	 *
	 * @param string $color
	 * @return $this
	 */
	public function setColor($color)
	{
		$this->setAttribute('color', $color, false);
		return $this;
	}

	/**
	 * Sets material of the product.
	 *
	 * @param string $material
	 * @return $this
	 */
	public function setMaterial($material)
	{
		$this->setAttribute('material', $material, false);
		return $this;
	}

	/**
	 * Sets pattern of the product.
	 *
	 * @param string $pattern
	 * @return $this
	 */
	public function setPattern($pattern)
	{
		$this->setAttribute('pattern', $pattern, false);
		return $this;
	}

	/**
	 * Sets size of the product.
	 *
	 * @param string $size
	 * @return $this
	 */
	public function setSize($size)
	{
		$this->setAttribute('size', $size, false);
		return $this;
	}

	/**
	 * Adds size type of the product.
	 *
	 * Use the size type [size_type] attribute to describe the cut of your product. This information helps create accurate
	 * filters, which customers can use to narrow search results.
	 *
	 * These are the supported values for this attribute:
	 *
	 *	Regular [regular]
	 *	Petite [petite]
	 *	Plus [plus]
	 *	Tall [tall]
	 *	Big [big]
	 *	Maternity [maternity]
	 *
	 * @see https://support.google.com/merchants/answer/6324497.
	 * @param string $value
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function addSizeType($value)
	{
		if ( isset( Schema::MAP['size_type'][$value] ) )
			$value = Schema::MAP['size_type'][$value];

		if ( ! in_array( $value, array( 'regular', 'petite', 'plus', 'tall', 'big', 'maternity' ) ) )
			throw new InvalidArgumentException('Invalid \'size_type\' value');

		$this->addAttribute('size_type', $value, false);

		return $this;
	}

	/**
	 * Sets size system of the product.
	 *
	 * With the size system [size_system] attribute you can explain which country’s sizing system your product uses. This
	 * information helps create accurate filters that customers can use to narrow search results. The sizing system you submit
	 * will affect search, filtering, and how variants are shown.
	 *
	 * @see https://support.google.com/merchants/answer/6324502.
	 * @param string $value
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setSizeSystem($value)
	{
		if ( isset( Schema::MAP['size_system'][$value] ) )
			$value = Schema::MAP['size_system'][$value];

		if ( ! in_array( $value, array( 'AU', 'BR', 'CN', 'DE', 'EU', 'FR', 'IT', 'JP', 'MEX', 'UK', 'US' ) ) )
			throw new InvalidArgumentException('Invalid \'size_system\' value');

		$this->setAttribute('size_system', $value, false);

		return $this;
	}

	/**
	 * Sets gender of the product.
	 *
	 * @param string $gender
	 * @return $this
	 */
	public function setGender($gender)
	{
		$this->setAttribute('gender', $gender, false);
		return $this;
	}

	/**
	 * Sets age group of the product.
	 *
	 * Use the age group [age_group] attribute to set the demographic that your product is designed for. When you use this
	 * attribute, your product can appear in results that are filtered by age. For example, results can be filtered by "Women"
	 * instead of "Girls".
	 *
	 * @see https://support.google.com/merchants/answer/6324463.
	 * @param string $value
	 * @return $this
	 */
	public function setAgeGroup($value)
	{
		if ( ! in_array( $value, array( 'newborn', 'infant', 'toddler', 'kids', 'adult' ) ) )
			throw new InvalidArgumentException('Invalid \'age_group\' value');

		$this->setAttribute('age_group', $value, false);
		return $this;
	}

	/**
	 * Sets energy efficiency class of the product.
	 *
	 * Use the energy efficiency class [energy_efficiency_class] attribute to tell customers how your product rates on a given
	 * energy efficiency range. When using this attribute, you will also need to set a minimum energy efficiency class
	 * [min_energy_efficiency_class] value and a maximum energy efficiency class [max_energy_efficiency_class] value.
	 *
	 * @see https://support.google.com/merchants/answer/7562785.
	 * @param string $value
	 * @return $this
	 */
	public function setEnergyEfficiencyClass($value)
	{
		$this->setAttribute('energy_efficiency_class', $this->sanitizeEnergyEfficiencyClass( $value ), false);
		return $this;
	}

	/**
	 * Sets min energy efficiency class of the product.
	 *
	 * @see https://support.google.com/merchants/answer/7562785.
	 * @param string $value
	 * @return $this
	 */
	public function setMinEnergyEfficiencyClass($value)
	{
		$this->setAttribute('min_energy_efficiency_class', $this->sanitizeEnergyEfficiencyClass( $value ), false);
		return $this;
	}

	/**
	 * Sets max energy efficiency class of the product.
	 *
	 * @see https://support.google.com/merchants/answer/7562785.
	 * @param string $value
	 * @return $this
	 */
	public function setMaxEnergyEfficiencyClass($value)
	{
		$this->setAttribute('max_energy_efficiency_class', $this->sanitizeEnergyEfficiencyClass( $value ), false);
		return $this;
	}

	/**
	 * Sanitizes the energy efficiency class of the product.
	 *
	 * @param string $value
	 * @return $value
	 * @throws InvalidArgumentException
	 */
	protected function sanitizeEnergyEfficiencyClass($value) {

		if ( isset( Schema::MAP['energy_efficiency_class'][$value] ) )
			$value = Schema::MAP['energy_efficiency_class'][$value];

		if ( ! in_array( $value, array( 'A+++', 'A++', 'A+', 'A', 'B', 'C', 'D', 'E', 'F', 'G' ) ) )
			throw new InvalidArgumentException('Invalid \'energy_efficiency_class\' value');

		return $value;
	}

	/**
	 * Add product length.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setProductLength($value)
	{
		$this->setAttribute('product_length', $value, false);
		return $this;
	}

	/**
	 * Add product width.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setProductWidth($value)
	{
		$this->setAttribute('product_width', $value, false);
		return $this;
	}

	/**
	 * Add product height.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setProductHeight($value)
	{
		$this->setAttribute('product_height', $value, false);
		return $this;
	}

	/**
	 * Add product weight.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setProductWeight($value)
	{
		$this->setAttribute('product_weight', $value, false);
		return $this;
	}

	/**
	 * Sets shipping of the product.
	 *
	 * @param Shipping $shipping
	 * @return $this
	 */
	public function setShipping($shipping)
	{
		$propertyBag = $shipping->getPropertyBag()->setName('shipping');
		$this->setAttribute('shipping', $propertyBag);
		return $this;
	}

	/**
	 * Adds shipping of the product.
	 * 
	 * @param Shipping $shipping
	 * @return $this
	 */
	public function addShipping($shipping)
	{
		$propertyBag = $shipping->getPropertyBag()->setName('shipping');
		$this->addAttribute('shipping', $propertyBag);
		return $this;
	}

	/**
	 * Add shipping label
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setShippingLabel($value)
	{
		$this->setAttribute('shipping_label', $value, false);
		return $this;
	}

	/**
	 * Add shipping length.
	 * 
	 * @see https://support.google.com/merchants/answer/6324498
	 * @param string $value
	 * @return $this
	 */
	public function setShippingLength($value)
	{
		$this->setAttribute('shipping_length', $value, false);
		return $this;
	}

	/**
	 * Add shipping width.
	 * 
	 * @see https://support.google.com/merchants/answer/6324498
	 * @param string $value
	 * @return $this
	 */
	public function setShippingWidth($value)
	{
		$this->setAttribute('shipping_width', $value, false);
		return $this;
	}

	/**
	 * Add shipping height.
	 * 
	 * @see https://support.google.com/merchants/answer/6324498
	 * @param string $value
	 * @return $this
	 */
	public function setShippingHeight($value)
	{
		$this->setAttribute('shipping_height', $value, false);
		return $this;
	}

	/**
	 * Add shipping weight.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setShippingWeight($value)
	{
		$this->setAttribute('shipping_weight', $value, false);
		return $this;
	}

	/**
	 * Set a custom label.
	 * 
	 * @param string $value
	 * @param integer $pos
	 * @return $this
	 */
	public function setCustomLabel($value, $pos)
	{
		$this->setAttribute('custom_label_' . $pos, $value, false);
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
