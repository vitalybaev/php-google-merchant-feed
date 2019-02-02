<?php

namespace Vitalybaev\GoogleMerchant;

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
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
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
    public function setIsCData(bool $isCData)
    {
        $this->isCData = $isCData;
    }
}
