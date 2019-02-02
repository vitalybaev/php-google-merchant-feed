<?php

class ProductTest extends \PHPUnit\Framework\TestCase
{
    const PRODUCT_NAMESPACE = '{http://base.google.com/ns/1.0}';

    /**
     * Tests setting attribute
     */
    public function testSetAttribute()
    {
        $product = new \Vitalybaev\GoogleMerchant\Product();

        // Set some value
        $product->setAttribute('attr', 'value', false);
        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}attr", "value" => "value"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));

        // Set another value to this attribute
        $product->setAttribute('attr', 'value_new', false);
        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}attr", "value" => "value_new"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));

        // Check for case insensitive
        $product->setAttribute('Attr', 'value_2', false);
        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}attr", "value" => "value_2"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));
    }

    /**
     * Tests adding multiple attributes values.
     */
    public function testAddingAttribute()
    {
        $product = new \Vitalybaev\GoogleMerchant\Product();

        $product->addAttribute('additional_image_link', 'https://example.com/image1.jpg');
        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}additional_image_link", "value" => "https://example.com/image1.jpg"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));

        $product->addAttribute('additional_image_link', 'https://example.com/image2.jpg');
        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}additional_image_link", "value" => "https://example.com/image1.jpg"],
                ['name' => "{http://base.google.com/ns/1.0}additional_image_link", "value" => "https://example.com/image2.jpg"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));

        $product = new \Vitalybaev\GoogleMerchant\Product();
        $product->setAttribute('additional_image_link', 'https://example.com/image1.jpg');
        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}additional_image_link", "value" => "https://example.com/image1.jpg"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));

        $product->addAttribute('additional_image_link', 'https://example.com/image2.jpg');
        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}additional_image_link", "value" => "https://example.com/image1.jpg"],
                ['name' => "{http://base.google.com/ns/1.0}additional_image_link", "value" => "https://example.com/image2.jpg"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));
    }

    /**
     * Tests setting Id to product.
     */
    public function testProductSetsId()
    {
        $product = new \Vitalybaev\GoogleMerchant\Product();
        $product->setId('some_id');

        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}id", "value" => "some_id"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));
    }
}
