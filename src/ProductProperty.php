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
	private static $cache     = [];

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
		$this->name    =& self::getCache( strtolower( $name ) );
		$this->value   =& self::getCache( $value );
		$this->isCData = $isCData;
	}

	/**
	 * Returns a cached ProductProperty object referenced by an MD5 of $name, $value, and $isCData.
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

			$value = $value->getPropertiesXmlStructure( $namespace );
		}

		$xmlStruc = [];

		$xmlStruc[ 'name' ]  =& self::getCache( $namespace . $this->getName() );
		$xmlStruc[ 'value' ] =& self::getCache( $value );

		return $xmlStruc;
	}

	public function resetCache()
	{
		self::$instances = [];
		self::$cache     = [];
	}

	/**
	 * @param  string|double|array $value
	 * @return $value reference
	 */
	private function &getCache( $value )
	{
		if ( is_string( $value ) ) {
		
			$key = strlen( $value ) > 32 ? md5( $value ) : $value;

		} else $key = md5( serialize( $value ) );

		if ( ! isset( self::$cache[ $key ] ) ) {

			self::$cache[ $key ] = $value;
		}

		return self::$cache[ $key ];
	}
}
