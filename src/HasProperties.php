<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Element\Cdata;

trait HasProperties
{
	/**
	 * Feed format.
	 *
	 * @var string
	 */
	private $format;

	/**
	 * Attributes
	 *
	 * @var ProductProperty[]
	 */
	private $attributes = [];

	public function __construct($format = 'rss')
	{
		$this->format = $format;
	}

	/**
	 * Sets attribute. If attribute is already exist, it would be overwritten.
	 *
	 * @param string $name
	 * @param string $value
	 * @param bool   $isCData
	 *
	 * @return self
	 */
	public function setAttribute( $name, $value, $isCData = false )
	{
		$productProperty =& ProductProperty::getInstance( $name, $value, $isCData );

		$attributeName = strtolower( $name );

		$this->attributes[ $attributeName ] = $productProperty;
	}

	/**
	 * Adds attribute. Doesn't overwrite previous attributes.
	 *
	 * @param      $name
	 * @param      $value
	 * @param bool $isCData
	 *
	 * @return self
	 */
	public function addAttribute( $name, $value, $isCData = false )
	{
		$productProperty =& ProductProperty::getInstance( $name, $value, $isCData );

		$attributeName = strtolower( $name );

		if ( ! isset( $this->attributes[ $attributeName ] ) ) {

			$this->attributes[ $attributeName ] = [];

		} elseif ( ! is_array( $this->attributes[ $attributeName ] ) ) {

			$this->attributes[ $attributeName ] = [ $this->attributes[ $attributeName ] ];
		}

		$this->attributes[ $attributeName ][] = $productProperty;
	}


        /**
	 * @param $namespace
	 * @return array
	 */
	/**
	 * Returns structure of properties
	 *
	 * @return array
	 */
	public function getPropertiesXmlStructure()
	{
		$result = [];

		foreach ( $this->attributes as $attributeItem ) {

			if ( is_object( $attributeItem ) && $attributeItem instanceof PropertyBag ) {

				$result[] = [
				    'name'  => $attributeItem->getName(),
				    'value' => $attributeItem->getValue()->getPropertiesXmlStructure(),
				];

			} else {

				$items = is_array( $attributeItem ) ? $attributeItem : [ $attributeItem ];

				foreach ( $items as $item ) {

					$result[] = $item->getXmlStructure();
				}
			}
		}

		return $result;
	}

	public function getXmlStructure()
	{
		if ( 'atom' === $this->format ) {

			return array( 'entry' => $this->getPropertiesXmlStructure() );

		} else return array( 'item' => $this->getPropertiesXmlStructure() );
	}

	/**
	 * @return PropertyBag
	 */
	public function getPropertyBag()
	{
		$propertyBag = new PropertyBag();

		foreach ( $this->attributes as $attributeItem ) {

			$attributes = is_array( $attributeItem ) ? $attributeItem : [ $attributeItem ];

			foreach ( $attributes as $attribute ) {

				$value = $attribute->isCData() ? new Cdata( $attribute->getValue() ) : $attribute->getValue();

				$propertyBag->addAttribute( $attribute->getName(), $value, $attribute->isCData() );
			}
		}

		return $propertyBag;
	}
}
