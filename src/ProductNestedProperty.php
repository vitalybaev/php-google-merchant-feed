<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Element\Cdata;

class ProductNestedProperty
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $value;

    /**
     * @var bool
     */
    private $isCData = FALSE;

    /**
     * ProductProperty constructor.
     *
     * @param      $name
     * @param      $value
     * @param bool $isCData
     */
    public function __construct($name, $value, $isCData)
    {
        $this->name = strtolower($name);
        $this->value = $value;
        $this->isCData = $isCData;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array|PropertyBag
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param array $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function isCData()
    {
        return $this->isCData;
    }

    /**
     * @param bool $isCData
     */
    public function setIsCData($isCData)
    {
        $this->isCData = $isCData;
    }

    /**
     * @param $namespace
     *
     * @return array
     */
    public function getXmlStructure($namespace)
    {
        $isCData = $this->isCData();
        $childProperties = [];
        foreach ($this->getValue() as $nestedPropertyName => $nestedPropertyValues) {
            foreach ($nestedPropertyValues as $nestedPropertyValue) {
                if ($isCData) {
                    $nestedPropertyValue = new Cdata($nestedPropertyValue);
                }
                $childProperties[] = [
                  'name' => $namespace . $nestedPropertyName,
                  'value' => $nestedPropertyValue
                ];
            }
        }

        return [
          'name' => $namespace . $this->getName(),
          'value' => $childProperties,
        ];
    }
}
