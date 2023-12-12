<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Element\Cdata;

class ProductProperty
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string|double|object
	 */
	private $value;

	/**
	 * @var bool
	 */
	private $isCData = false;

	/**
	 * @var array
	 */
	private static $instances = [];

	/**
	 * ProductProperty constructor.
	 *
	 * @param  string               $name
	 * @param  string|double|object $value
	 * @param  bool                 $isCData
	 * @return object
	 */
	public function __construct( $name, $value, $isCData )
	{
		$this->name    = strtolower( $name );
		$this->value   = $value;
		$this->isCData = $isCData;
	}

	/**
	 * Returns a ProductProperty object referenced by an MD5 of $name, $value, and $isCData.
	 *
	 * @param  string               $name
	 * @param  string|double|object $value
	 * @param  bool                 $isCData
	 * @return object reference
	 */
	public static function &getInstance( $name, $value, $isCData )
	{
		$key = md5( strtolower( $name ) . serialize( $value ) . ( $isCData ? 'true' : 'false' ) );

		if ( ! isset( self::$instances[ $key ] ) ) {

			self::$instances[ $key ] = new self( $name, $value, $isCData );
		}

		return self::$instances[ $key ];
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string|PropertyBag
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @return bool
	 */
	public function isCData()
	{
		return $this->isCData;
	}

	/**
	 * @param $namespace
	 * @return array
	 */
	public function getXmlStructure( $namespace )
	{
		$value = $this->isCData() ? new Cdata( $this->getValue() ) : $this->getValue();
		
		if ( is_object( $value ) && $value instanceof PropertyBag ) {
			return [
				'name'  => $namespace . $this->getName(),
				'value' => $value->getPropertiesXmlStructure( $namespace ),
			];
		}

		return [
			'name'  => $namespace . $this->getName(),
			'value' => $value,
		];
	}
}
