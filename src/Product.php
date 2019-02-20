<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Element\Cdata;
use Vitalybaev\GoogleMerchant\Exception\InvalidArgumentException;
use Vitalybaev\GoogleMerchant\Product\Availability\Availability;
use Vitalybaev\GoogleMerchant\Product\Condition;

class Product
{
    /**
     * Product's attributes
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
     * @return $this
     */
    public function setAttribute($name, $value, $isCData = false)
    {
        $productProperty = new ProductProperty($name, $value, $isCData);
        $this->attributes[strtolower($name)] = $productProperty;

        return $this;
    }

    /**
     * Adds attribute. Doesn't overwrite previous attributes.
     *
     * @param      $name
     * @param      $value
     * @param bool $isCData
     *
     * @return Product
     */
    public function addAttribute($name, $value, $isCData = false)
    {
        $productProperty = new ProductProperty($name, $value, $isCData);
        $attributeName = strtolower($name);
        if (!isset($this->attributes[$attributeName])) {
            $this->attributes[$attributeName] = [$productProperty];
            return $this;
        }

        if (!is_array($this->attributes[$attributeName])) {
            $this->attributes[$attributeName] = [$this->attributes[$attributeName], $productProperty];
            return $this;
        }

        $this->attributes[$attributeName][] = $productProperty;
        return $this;
    }

    /**
     * Sets id of product.
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->setAttribute('id', $id);
        return $this;
    }

    /**
     * Sets title of product.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->setAttribute('title', $title, true);
        return $this;
    }

    /**
     * Sets description of product.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setDescription($title)
    {
        $this->setAttribute('description', $title, true);
        return $this;
    }

    /**
     * Sets link to the product.
     *
     * @param string $link
     *
     * @return $this
     */
    public function setLink($link)
    {
        $this->setAttribute('link', $link, true);
        return $this;
    }

    /**
     * Sets mobile link to the product.
     *
     * @param string $link
     *
     * @return $this
     */
    public function setMobileLink($link)
    {
        $this->setAttribute('mobile_link', $link, true);
        return $this;
    }

    /**
     * Sets image of the product.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setImage($imageUrl)
    {
        $this->setAttribute('image_link', $imageUrl, true);
        return $this;
    }

    /**
     * Sets additional image of the product.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setAdditionalImage($imageUrl)
    {
        $this->setAttribute('additional_image_link', $imageUrl, true);
        return $this;
    }

    /**
     * Sets additional image of the product.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function addAdditionalImage($imageUrl)
    {
        $this->addAttribute('additional_image_link', $imageUrl, true);
        return $this;
    }

    /**
     * Sets availability of the product.
     *
     * @param string $availability
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setAvailability($availability)
    {
        if (!in_array($availability, [
            Availability::IN_STOCK, Availability::OUT_OF_STOCK, Availability::PREORDER,
        ])) {
            throw new InvalidArgumentException("Invalid availability property");
        }
        $this->setAttribute('availability', $availability, false);
        return $this;
    }

    /**
     * Sets price of the product.
     *
     * @param string $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->setAttribute('price', $price, false);
        return $this;
    }

    /**
     * Sets sale price of the product.
     *
     * @param string $price
     *
     * @return $this
     */
    public function setSalePrice($price)
    {
        $this->setAttribute('sale_price', $price, false);
        return $this;
    }

    /**
     * Sets Google category of the product.
     *
     * @param string $category
     *
     * @return $this
     */
    public function setGoogleCategory($category)
    {
        $this->setAttribute('google_product_category', $category, false);
        return $this;
    }

    /**
     * Sets Google product_type of the product.
     *
     * @param string product_type
     *
     * @return $this
     */
    public function setProductType($product_type)
    {
        $this->setAttribute('product_type', $product_type, false);
        return $this;
    }

    /**
     * Sets brand of the product.
     *
     * @param string $brand
     *
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->setAttribute('brand', $brand, false);
        return $this;
    }

    /**
     * Sets GTIN code of the product.
     *
     * @param string $gtin
     *
     * @return $this
     */
    public function setGtin($gtin)
    {
        $this->setAttribute('gtin', $gtin, false);
        return $this;
    }

    /**
     * Sets MPN code of the product.
     *
     * @param string $mpn
     *
     * @return $this
     */
    public function setMpn($mpn)
    {
        $this->setAttribute('mpn', $mpn, false);
        return $this;
    }

    /**
     * Sets identifier_exists code of the product. (yes / no)
     *
     * @param string $identifierExists
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setIdentifierExists($identifierExists)
    {
        $identifierExists = strtolower($identifierExists);
        if (!in_array($identifierExists, ['yes', 'no'])) {
            throw new InvalidArgumentException("identifier_exists property should be one of 'yes' or 'no'");
        }
        $this->setAttribute('identifier_exists', $identifierExists, false);
        return $this;
    }

    /**
     * Sets condition of the product. `new`, `refurbished` or `used` are valid
     *
     * @param string $condition
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setCondition($condition)
    {
        if (!in_array($condition, [
            'new', 'refurbished', 'used',
        ])) {
            throw new InvalidArgumentException("Invalid condition property");
        }
        $this->setAttribute('condition', $condition, false);
        return $this;
    }

    /**
     * Sets adult of the product.
     *
     * @param bool $adult
     *
     * @return $this
     */
    public function setAdult($adult)
    {
        $this->setAttribute('adult', $adult ? 'yes' : 'no', false);
        return $this;
    }

    /**
     * Sets color of the product.
     *
     * @param string $color
     *
     * @return $this
     */
    public function setColor($color)
    {
        $this->setAttribute('color', $color, false);
        return $this;
    }

    /**
     * Sets material of the product.
     *
     * @param string $material
     *
     * @return $this
     */
    public function setMaterial($material)
    {
        $this->setAttribute('material', $material, false);
        return $this;
    }

    /**
     * Sets size of the product.
     *
     * @param string $size
     *
     * @return $this
     */
    public function setSize($size)
    {
        $this->setAttribute('size', $size, false);
        return $this;
    }

    /**
     * @param $namespace
     *
     * @return array
     */
    public function getXmlStructure($namespace)
    {
        $xmlStructure = array(
            'item' => array(),
        );

        foreach ($this->attributes as $attributeItem) {
            $attributes = is_array($attributeItem) ? $attributeItem : [$attributeItem];
            foreach ($attributes as $attribute) {
                $value = $attribute->isCData() ? new Cdata($attribute->getValue()) : $attribute->getValue();
                $xmlStructure['item'][] = [
                    'name' => $namespace . $attribute->getName(),
                    'value' => $value,
                ];
            }
        }

        return $xmlStructure;
    }
}
