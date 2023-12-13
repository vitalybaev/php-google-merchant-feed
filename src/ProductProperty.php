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
	private static $values    = [];
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
		$val_key = md5( serialize( $value ) );

		if ( ! isset( self::$values[ $val_key ] ) ) {

			self::$values[ $val_key ] = $value;
		}

		$this->name    = strtolower( $name );
		$this->value   =& self::$values[ $val_key ];
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
		$inst_key = md5( strtolower( $name ) . serialize( $value ) . ( $isCData ? 'true' : 'false' ) );

		if ( ! isset( self::$instances[ $inst_key ] ) ) {

			self::$instances[ $inst_key ] = new self( $name, $value, $isCData );
		}

		return self::$instances[ $inst_key ];
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
