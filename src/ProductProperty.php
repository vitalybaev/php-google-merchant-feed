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
     * @var string
     */
    private $value;

    /**
     * @var bool
     */
    private $isCData = false;

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
     * @return string|PropertyBag
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
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
        $value = $this->isCData() ? new Cdata($this->getValue()) : $this->getValue();

        return [
            'name' => $namespace . $this->getName(),
            'value' => $value,
        ];
    }
}
