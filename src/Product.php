<?php

namespace Vitalybaev\GoogleMerchant;

use Vitalybaev\GoogleMerchant\Exception\InvalidArgumentException;
use Vitalybaev\GoogleMerchant\Product\Availability;
use Vitalybaev\GoogleMerchant\Product\Condition;
use Vitalybaev\GoogleMerchant\Product\Schema;
use Vitalybaev\GoogleMerchant\Product\Shipping;

class Product
{
	use \Vitalybaev\GoogleMerchant\HasProperties;

	/**
	 * Sets 'id'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setId($value)
	{
		$this->setAttribute('g:id', $value);
	}

	/**
	 * Sets 'item_group_id'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setItemGroupId($value)
	{
		$this->setAttribute('g:item_group_id', $value);
	}

	/**
	 * Sets 'title'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setTitle($value)
	{
		$this->setAttribute('g:title', $value, true);
	}

	/**
	 * Sets 'description'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setDescription($value)
	{
		$this->setAttribute('g:description', $value, true);
	}

	/**
	 * Sets 'updated'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setUpdated($value)
	{
		if ( 'atom' === $this->format ) {

			$this->setAttribute('updated', $value, false);
		}
	}

	/**
	 * Sets 'link'.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setLink($url)
	{
		$this->setAttribute('g:link', $url, true);
	}

	/**
	 * Sets 'canonical_link'.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setCanonicalLink($url)
	{
		$this->setAttribute('g:canonical_link', $url, true);
	}

	/**
	 * Sets 'mobile_link'.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setMobileLink($url)
	{
		$this->setAttribute('g:mobile_link', $url, true);
	}

	/**
	 * Sets 'image_link'.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setImage($url)
	{
		$this->setAttribute('g:image_link', $url, true);
	}

	/**
	 * Sets 'additional_image_link'.
	 *
	 * @param string $url
	 * @return $this
	 */
	public function setAdditionalImage($url)
	{
		$this->setAttribute('g:additional_image_link', $url, true);
	}

	/**
	 * Adds 'additional_image_link'.
	 *
	 * Use the additional image link [additional_image_link] attribute to provide more images for your product beyond the main
	 * image you provide in the image link [image_link] attribute. Additional images for your product can appear to potential
	 * customers and are commonly used to show a product from different angles or with product staging elements.
	 *
	 * @see https://support.google.com/merchants/answer/6324370
	 * @param string $url
	 * @return $this
	 */
	public function addAdditionalImage($url)
	{
		$this->addAttribute('g:additional_image_link', $url, true);
	}

	/**
	 * Sets 'availability'.
	 *
	 * Use the availability [availability] attribute to tell users and Google whether you have a product in stock.
	 *
	 * @see https://support.google.com/merchants/answer/6324448
	 * @param string $value
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setAvailability($value)
	{
		if ( isset( Schema::MAP['availability'][$value] ) ) {

			$value = Schema::MAP['availability'][$value];
		}

		if ( ! in_array( $value, array( Availability::IN_STOCK, Availability::OUT_OF_STOCK, Availability::PREORDER, Availability::BACKORDER ) ) ) {

			throw new InvalidArgumentException( 'Invalid \'availability\' value = ' . var_export( $value, true ) );
		}

		$this->setAttribute('g:availability', $value, false);
	}

	/**
	 * Sets 'price'.
	 *
	 * Use the price [price] attribute to tell users how much you’re charging for your product. This information is shown to
	 * users.
	 *
	 * @see https://support.google.com/merchants/answer/6324371
	 * @param string $value
	 * @return $this
	 */
	public function setPrice($value)
	{
		$this->setAttribute('g:price', $value, false);
	}

	/**
	 * Sets 'sale_price'.
	 *
	 * Use the sale price [sale_price] attribute to tell customers how much you charge for your product during a sale. During a
	 * sale, your sale price is shown as the current price. If your original price and sale price meet certain requirements,
	 * your original price may show along with the sale price, so people can see the difference between prices.
	 *
	 * @see https://support.google.com/merchants/answer/6324471
	 * @param string $value
	 * @return $this
	 */
	public function setSalePrice($value)
	{
		$this->setAttribute('g:sale_price', $value, false);
	}

	/**
	 * Sets 'sale_price_effective_date'.
	 *
	 * Use the sale price effective date [sale_price_effective_date] attribute to tell us how long you want a specific sale
	 * price to be shown to users. 
	 *
	 * @see https://support.google.com/merchants/answer/6324460
	 * @param string $value
	 * @return $this
	 */
	public function setSalePriceEffectiveDate($value)
	{
		$this->setAttribute('g:sale_price_effective_date', $value, false);
	}

	/**
	 * Sets 'google_product_category'.
	 *
	 * @param string $category
	 * @return $this
	 */
	public function setGoogleCategory($category)
	{
		$this->setAttribute('g:google_product_category', $category, false);
	}

	/**
	 * Sets 'product_type'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setProductType($value)
	{
		$this->setAttribute('g:product_type', $value, false);
	}

	/**
	 * Sets 'brand'.
	 *
	 * Use the brand [brand] attribute to indicate the product's brand name. The brand is used to help identify your product
	 * and will be shown to customers. The brand should be clearly visible as an integral part of the packaging or label, and
	 * not artificially added in the product image.
	 *
	 * @see https://support.google.com/merchants/answer/6324351
	 * @param string $value
	 * @return $this
	 */
	public function setBrand($value)
	{
		$this->setAttribute('g:brand', $value, false);
	}

	/**
	 * Sets 'gtin'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setGtin($value)
	{
		$this->setAttribute('g:gtin', $value, false);
	}

	/**
	 * Adds 'gtin'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function addGtin($value)
	{
		$this->addAttribute('g:gtin', $value, false);
	}

	/**
	 * Sets 'mpn'.
	 *
	 * @param string $value
	 * @return $this
	 */
	public function setMpn($value)
	{
		$this->setAttribute('g:mpn', $value, false);
	}

	/**
	 * Sets 'identifier_exists'.
	 *
	 * Use the identifier exists [identifier_exists] attribute to indicate that unique product identifiers (UPIs) aren’t available
	 * for your product. Unique product identifiers are submitted using the GTIN [gtin], MPN [mpn], and brand [brand] attributes.
	 *
	 * @see https://support.google.com/merchants/answer/6324478
	 * @param string $value FILTER_VALIDATE_BOOLEAN value.
	 * @return $this
	 */
	public function setIdentifierExists($value)
	{
		$value = filter_var( $value, FILTER_VALIDATE_BOOLEAN ) ? 'yes' : 'no';

		$this->setAttribute('g:identifier_exists', $value, false);
	}

	/**
	 * Sets 'condition'.
	 *
	 * Use the condition [condition] attribute to tell potential customers about the condition of the product you're selling. It’s
	 * important to set this value correctly since it is used to refine search results.
	 *
	 * @see https://support.google.com/merchants/answer/6324469
	 * @param string $value A Schema offer item condition URL or condition string.
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setCondition($value)
	{
		if ( isset( Schema::MAP['condition'][$value] ) ) {

			$value = Schema::MAP['condition'][$value];
		}

		if ( ! in_array( $value, array( Condition::NEW_PRODUCT, Condition::REFURBISHED, Condition::USED ) ) ) {

			throw new InvalidArgumentException( 'Invalid \'condition\' value = ' . var_export( $value, true ) );
		}

		$this->setAttribute('g:condition', $value, false);
	}

	/**
	 * Sets 'adult'.
	 *
	 * Use the adult [adult] attribute to indicate that individual products are for adults only because they contain adult content
	 * such as nudity, sexually suggestive content, or are intended to enhance sexual activity.
	 *
	 * @see https://support.google.com/merchants/answer/6324508
	 * @param mixed $value A Schema adult oriented enumeration URL or FILTER_VALIDATE_BOOLEAN value.
	 * @return $this
	 */
	public function setAdult($value)
	{
		if ( isset( Schema::MAP['adult'][$value] ) )
			$value = Schema::MAP['adult'][$value];

		// FILTER_VALIDATE_BOOLEAN returns true for '1', 'true', 'on' and 'yes'. Returns false otherwise. 
		$this->setAttribute('g:adult', filter_var( $value, FILTER_VALIDATE_BOOLEAN ) ? 'yes' : 'no', false);
	}

	/**
	 * Sets 'color'.
	 *
	 * Use the color [color] attribute to describe your product’s color. This information helps create accurate filters, which
	 * customers can use to narrow search results. If your product has variants that vary by color, use this attribute to
	 * provide that information.
	 *
	 * @see https://support.google.com/merchants/answer/6324487
	 * @param string $color
	 * @return $this
	 */
	public function setColor($color)
	{
		$this->setAttribute('g:color', $color, false);
	}

	/**
	 * Sets 'material'.
	 *
	 * Use the material [material] attribute to describe the main fabric or material that your product is made of. This
	 * information helps create accurate filters, which customers can use to narrow search results. If your product has
	 * variants that vary by material, then provide that information through this attribute.
	 *
	 * @see https://support.google.com/merchants/answer/6324410
	 * @param string $material
	 * @return $this
	 */
	public function setMaterial($material)
	{
		$this->setAttribute('g:material', $material, false);
	}

	/**
	 * Sets 'pattern'.
	 *
	 * Use the pattern [pattern] attribute to describe the pattern or graphic print on your product. For example, a T-shirt
	 * might have a logo of a sports team, and so you might submit bears or tigers. This information helps create accurate
	 * filters, which customers can use to narrow search results. If your product has variants that vary by pattern, then
	 * provide that information through this attribute.
	 *
	 * @see https://support.google.com/merchants/answer/6324483
	 * @param string $pattern
	 * @return $this
	 */
	public function setPattern($pattern)
	{
		$this->setAttribute('g:pattern', $pattern, false);
	}

	/**
	 * Sets 'size'.
	 *
	 * Use the size [size] attribute to describe the standardized size of your product. When you use this attribute, your
	 * product can appear in results that are filtered by size. The size you submit will also affect how your product variants
	 * are shown.
	 *
	 * @see https://support.google.com/merchants/answer/6324492
	 * @param string $size
	 * @return $this
	 */
	public function setSize($size)
	{
		$this->setAttribute('g:size', $size, false);
	}

	/**
	 * Adds 'size_type'.
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
	 * @see https://support.google.com/merchants/answer/6324497
	 * @param string $value
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function addSizeType($value)
	{
		if ( isset( Schema::MAP['size_type'][$value] ) ) {

			$value = Schema::MAP['size_type'][$value];
		}

		if ( ! in_array( $value, array( 'regular', 'petite', 'plus', 'tall', 'big', 'maternity' ) ) ) {

			throw new InvalidArgumentException( 'Invalid \'size_type\' value = ' . var_export( $value, true ) );
		}

		$this->addAttribute('g:size_type', $value, false);
	}

	/**
	 * Sets 'size_system'.
	 *
	 * With the size system [size_system] attribute you can explain which country’s sizing system your product uses. This
	 * information helps create accurate filters that customers can use to narrow search results. The sizing system you submit
	 * will affect search, filtering, and how variants are shown.
	 *
	 * @see https://support.google.com/merchants/answer/6324502
	 * @param string $value
	 * @return $this
	 * @throws InvalidArgumentException
	 */
	public function setSizeSystem($value)
	{
		if ( isset( Schema::MAP['size_system'][$value] ) ) {

			$value = Schema::MAP['size_system'][$value];
		}

		if ( ! in_array( $value, array( 'AU', 'BR', 'CN', 'DE', 'EU', 'FR', 'IT', 'JP', 'MEX', 'UK', 'US' ) ) ) {

			throw new InvalidArgumentException( 'Invalid \'size_system\' value = ' . var_export( $value, true ) );
		}

		$this->setAttribute('g:size_system', $value, false);
	}

	/**
	 * Sets 'gender'.
	 *
	 * Specify the gender your product is designed for using the gender [gender] attribute. When you provide this information,
	 * potential customers can accurately filter products by gender to help narrow their search. Keep in mind that we use the
	 * gender information together with the values you provide for the size [size] and age group [age_group] attributes to
	 * standardize the sizes that are shown to users.
	 *
	 * @see https://support.google.com/merchants/answer/6324479
	 * @param string $gender
	 * @return $this
	 */
	public function setGender($gender)
	{
		$this->setAttribute('g:gender', $gender, false);
	}

	/**
	 * Sets 'age_group'.
	 *
	 * Use the age group [age_group] attribute to set the demographic that your product is designed for. When you use this
	 * attribute, your product can appear in results that are filtered by age. For example, results can be filtered by "Women"
	 * instead of "Girls".
	 *
	 * @see https://support.google.com/merchants/answer/6324463
	 * @param string $value
	 * @return $this
	 */
	public function setAgeGroup($value)
	{
		if ( ! in_array( $value, array( 'newborn', 'infant', 'toddler', 'kids', 'adult' ) ) ) {

			throw new InvalidArgumentException( 'Invalid \'age_group\' value = ' . var_export( $value, true ) );
		}

		$this->setAttribute('g:age_group', $value, false);
	}

	/**
	 * Sets 'energy_efficiency_class'.
	 *
	 * Use the energy efficiency class [energy_efficiency_class] attribute to tell customers how your product rates on a given
	 * energy efficiency range. When using this attribute, you will also need to set a minimum energy efficiency class
	 * [min_energy_efficiency_class] value and a maximum energy efficiency class [max_energy_efficiency_class] value.
	 *
	 * @see https://support.google.com/merchants/answer/7562785
	 * @param string $value
	 * @return $this
	 */
	public function setEnergyEfficiencyClass($value)
	{
		$this->setAttribute('g:energy_efficiency_class', $this->sanitizeEnergyEfficiencyClass( $value ), false);
	}

	/**
	 * Sets 'min_energy_efficiency_class'.
	 *
	 * @see https://support.google.com/merchants/answer/7562785
	 * @param string $value
	 * @return $this
	 */
	public function setMinEnergyEfficiencyClass($value)
	{
		$this->setAttribute('g:min_energy_efficiency_class', $this->sanitizeEnergyEfficiencyClass( $value ), false);
	}

	/**
	 * Sets 'max_energy_efficiency_class'.
	 *
	 * @see https://support.google.com/merchants/answer/7562785
	 * @param string $value
	 * @return $this
	 */
	public function setMaxEnergyEfficiencyClass($value)
	{
		$this->setAttribute('g:max_energy_efficiency_class', $this->sanitizeEnergyEfficiencyClass( $value ), false);
	}

	/**
	 * Sanitizes the energy efficiency class of the product.
	 *
	 * @param string $value
	 * @return $value
	 * @throws InvalidArgumentException
	 */
	protected function sanitizeEnergyEfficiencyClass($value) {

		if ( isset( Schema::MAP['energy_efficiency_class'][$value] ) ) {

			$value = Schema::MAP['energy_efficiency_class'][$value];
		}

		if ( ! in_array( $value, array( 'A+++', 'A++', 'A+', 'A', 'B', 'C', 'D', 'E', 'F', 'G' ) ) ) {

			throw new InvalidArgumentException( 'Invalid \'energy_efficiency_class\' value = ' . var_export( $value, true ) );
		}

		return $value;
	}

	/**
	 * Sets 'product_length'.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setProductLength($value)
	{
		$this->setAttribute('g:product_length', $value, false);
	}

	/**
	 * Sets 'product_width'.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setProductWidth($value)
	{
		$this->setAttribute('g:product_width', $value, false);
	}

	/**
	 * Sets 'product_height'.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setProductHeight($value)
	{
		$this->setAttribute('g:product_height', $value, false);
	}

	/**
	 * Sets 'product_weight'.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setProductWeight($value)
	{
		$this->setAttribute('g:product_weight', $value, false);
	}

	/**
	 * Sets 'shipping'.
	 *
	 * @param Shipping $shipping
	 * @return $this
	 */
	public function setShipping($shipping)
	{
		$propertyBag = $shipping->getPropertyBag()->setName('shipping');

		$this->setAttribute('g:shipping', $propertyBag);
	}

	/**
	 * Adds 'shipping'.
	 * 
	 * @param Shipping $shipping
	 * @return $this
	 */
	public function addShipping($shipping)
	{
		$propertyBag = $shipping->getPropertyBag()->setName('shipping');

		$this->addAttribute('g:shipping', $propertyBag);
	}

	/**
	 * Sets 'shipping_label'.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setShippingLabel($value)
	{
		$this->setAttribute('g:shipping_label', $value, false);
	}

	/**
	 * Sets 'shipping_length'.
	 * 
	 * @see https://support.google.com/merchants/answer/6324498
	 * @param string $value
	 * @return $this
	 */
	public function setShippingLength($value)
	{
		$this->setAttribute('g:shipping_length', $value, false);
	}

	/**
	 * Sets 'shipping_width'.
	 * 
	 * @see https://support.google.com/merchants/answer/6324498
	 * @param string $value
	 * @return $this
	 */
	public function setShippingWidth($value)
	{
		$this->setAttribute('g:shipping_width', $value, false);
	}

	/**
	 * Sets 'shipping_height'.
	 * 
	 * @see https://support.google.com/merchants/answer/6324498
	 * @param string $value
	 * @return $this
	 */
	public function setShippingHeight($value)
	{
		$this->setAttribute('g:shipping_height', $value, false);
	}

	/**
	 * Sets 'shipping_weight'.
	 * 
	 * @param string $value
	 * @return $this
	 */
	public function setShippingWeight($value)
	{
		$this->setAttribute('g:shipping_weight', $value, false);
	}

	/**
	 * Sets a custom label.
	 * 
	 * @param string $value
	 * @param integer $pos
	 * @return $this
	 */
	public function setCustomLabel($value, $pos)
	{
		$this->setAttribute('g:custom_label_' . $pos, $value, false);
	}
}
