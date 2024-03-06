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
	 * @return array
	 */
	public function getXmlStructure()
	{
		$value = $this->isCData() ? new Cdata( $this->getValue() ) : $this->getValue();

		if ( is_object( $value ) && $value instanceof PropertyBag ) {

			$value = $value->getPropertiesXmlStructure();
		}

		$xmlStruc = [];

		$xmlStruc[ 'name' ]  =& self::getCache( $this->getName() );
		$xmlStruc[ 'value' ] =& self::getCache( $value );

		return $xmlStruc;
	}

	public static function resetCache()
	{
		self::$instances = [];
		self::$cache     = [];
	}

	/**
	 * @param  string|double|array $value
	 * @return $value reference
	 */
	private static function &getCache( $value )
	{
		/**
		 * The associative array key can only be a string or integer. The value can be any type. 
		 *
		 * Strings containing valid decimal ints, unless the number is preceded by a + sign, will be cast to the int type.
		 * E.g. the key "8" will actually be stored under 8. On the other hand "08" will not be cast, as it isn't a valid
		 * decimal integer.
		 *
		 * Floats are also cast to ints, which means that the fractional part will be truncated. E.g. the key 8.7 will
		 * actually be stored under 8.
		 *
		 * Bools are cast to ints, too, i.e. the key true will actually be stored under 1 and the key false under 0.
		 *
		 * Null will be cast to the empty string, i.e. the key null will actually be stored under "".
		 *
		 * Arrays and objects can not be used as keys. Doing so will result in a warning: Illegal offset type.
		 *
		 * @see https://www.php.net/manual/en/language.types.array.php
		 */
		if ( is_string( $value ) ) {

			$key = strlen( $value ) > 32 || is_numeric( $value ) ? md5( $value ) : $value;

		} elseif ( is_int( $value ) ) {

			$key = $value;

		} else $key = md5( serialize( $value ) );

		if ( ! isset( self::$cache[ $key ] ) ) {

			self::$cache[ $key ] = $value;
		}

		return self::$cache[ $key ];
	}
}
