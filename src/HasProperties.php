<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Element\Cdata;

trait HasProperties
{
	/**
	 * Attributes
	 *
	 * @var ProductProperty[]
	 */
	private $attributes = [];

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
		$productProperty = ProductProperty::getInstance( $name, $value, $isCData );

		$attributeName = strtolower( $name );

		$this->attributes[ $attributeName ] = $productProperty;

		return $this;
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
		$productProperty = ProductProperty::getInstance( $name, $value, $isCData );

		$attributeName = strtolower( $name );

		if ( ! isset( $this->attributes[ $attributeName ] ) ) {

			$this->attributes[ $attributeName ] = [];

		} elseif ( ! is_array( $this->attributes[ $attributeName ] ) ) {

			$this->attributes[ $attributeName ] = [ $this->attributes[ $attributeName ] ];
		}

		$this->attributes[ $attributeName ][] = $productProperty;

		return $this;
	}

	/**
	 * Returns structure of properties
	 *
	 * @param $namespace
	 *
	 * @return array
	 */
	public function getPropertiesXmlStructure( $namespace )
	{
		$result = [];

		foreach ( $this->attributes as $attributeItem ) {

			if ( is_object( $attributeItem ) && $attributeItem->getValue() instanceof PropertyBag ) {

				$result[] = [
				    'name'  => $namespace . $attributeItem->getName(),
				    'value' => $attributeItem->getValue()->getPropertiesXmlStructure( $namespace ),
				];

				continue;
			}

			$attributes = is_array( $attributeItem ) ? $attributeItem : [ $attributeItem ];

			/** @var ProductProperty $attribute */
			foreach ( $attributes as $attribute ) {

				$result[] = $attribute->getXmlStructure( $namespace );
			}
		}

		return $result;
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
