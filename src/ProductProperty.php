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
	private static $cache_vals = [];
	private static $cache_inst = [];

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
		if ( is_object( $value ) ) {
		
			$val_id = md5( serialize( $value ) );

		} elseif ( is_string( $value ) && strlen( $value ) > 32 ) {

			$val_id = md5( $value );

		} else $val_id = $value;

		if ( ! isset( self::$cache_vals[ $val_id ] ) ) {

			self::$cache_vals[ $val_id ] = $value;
		}

		$this->name    = strtolower( $name );
		$this->value   =& self::$cache_vals[ $val_id ];
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
		$inst_id = md5( strtolower( $name ) . serialize( $value ) . ( $isCData ? 'true' : 'false' ) );

		if ( ! isset( self::$cache_inst[ $inst_id ] ) ) {

			self::$cache_inst[ $inst_id ] = new self( $name, $value, $isCData );
		}

		return self::$cache_inst[ $inst_id ];
	}

	public static function resetCache() {
		
		self::$cache_vals = [];
		self::$cache_inst = [];
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
