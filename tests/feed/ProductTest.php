<?php

use PHPUnit\Framework\TestCase;
use Vitalybaev\GoogleMerchant\Feed;
use Vitalybaev\GoogleMerchant\Product;
use Vitalybaev\GoogleMerchant\Product\Shipping;

class ProductTest extends TestCase
{
    const PRODUCT_NAMESPACE = '{http://base.google.com/ns/1.0}';

    /**
     * Tests setting attribute
     */
    public function testSetAttribute()
    {
        $product = new Product();

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
        $product = new Product();

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

        $product = new Product();
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
        $product = new Product();
        $product->setId('some_id');

        $this->assertEquals([
            'item' => [
                ['name' => "{http://base.google.com/ns/1.0}id", "value" => "some_id"],
            ],
        ], $product->getXmlStructure(static::PRODUCT_NAMESPACE));
    }

    /**
     * Tests setting Id to product.
     */
    public function testProductShipping()
    {
        $shipping = new Shipping();
        $shipping->setCountry('US');
        $shipping->setRegion('CA, NSW, 03');
        $shipping->setPostalCode('94043');
        $shipping->setLocationId('21137');
        $shipping->setService('UPS Express');
        $shipping->setPrice('1300 USD');

        $product = new Product();
        $product->setShipping($shipping);

        // Create feed object
        $feed = new Feed("My awesome store", "https://example.com", "My awesome description");
        $feed->addProduct($product);

        $feedXml = $feed->build();
        $expectedFeedXml = '<?xml version="1.0"?>
<rss xmlns:g="http://base.google.com/ns/1.0">
 <channel>
  <title>My awesome store</title>
  <link>https://example.com</link>
  <description>My awesome description</description>
  <item>
   <g:shipping>
    <g:country>US</g:country>
    <g:region>CA, NSW, 03</g:region>
    <g:postal_code>94043</g:postal_code>
    <g:location_id>21137</g:location_id>
    <g:service>UPS Express</g:service>
    <g:price>1300 USD</g:price>
   </g:shipping>
  </item>
 </channel>
</rss>
';

        $this->assertEquals($expectedFeedXml, $feedXml);
    }

    /**
     * Tests setting Id to product.
     */
    public function testFeedSetRssVersionFromConstructor()
    {
        $shipping = new Shipping();
        $shipping->setCountry('US');
        $shipping->setRegion('CA, NSW, 03');
        $shipping->setPostalCode('94043');
        $shipping->setLocationId('21137');
        $shipping->setService('UPS Express');
        $shipping->setPrice('1300 USD');

        $product = new Product();
        $product->setShipping($shipping);

        // Create feed object
        $feed = new Feed("My awesome store", "https://example.com", "My awesome description", "2.0");
        $feed->addProduct($product);

        $feedXml = $feed->build();
        $expectedFeedXml = '<?xml version="1.0"?>
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
 <channel>
  <title>My awesome store</title>
  <link>https://example.com</link>
  <description>My awesome description</description>
  <item>
   <g:shipping>
    <g:country>US</g:country>
    <g:region>CA, NSW, 03</g:region>
    <g:postal_code>94043</g:postal_code>
    <g:location_id>21137</g:location_id>
    <g:service>UPS Express</g:service>
    <g:price>1300 USD</g:price>
   </g:shipping>
  </item>
 </channel>
</rss>
';

        $this->assertEquals($expectedFeedXml, $feedXml);
    }

    /**
     * Tests setting Id to product.
     */
    public function testFeedSetRssVersionViaSetter()
    {
        $shipping = new Shipping();
        $shipping->setCountry('US');
        $shipping->setRegion('CA, NSW, 03');
        $shipping->setPostalCode('94043');
        $shipping->setLocationId('21137');
        $shipping->setService('UPS Express');
        $shipping->setPrice('1300 USD');

        $product = new Product();
        $product->setShipping($shipping);

        // Create feed object
        $feed = new Feed("My awesome store", "https://example.com", "My awesome description");
        $feed->setRssVersion("1.0");
        $feed->addProduct($product);

        $feedXml = $feed->build();
        $expectedFeedXml = '<?xml version="1.0"?>
<rss xmlns:g="http://base.google.com/ns/1.0" version="1.0">
 <channel>
  <title>My awesome store</title>
  <link>https://example.com</link>
  <description>My awesome description</description>
  <item>
   <g:shipping>
    <g:country>US</g:country>
    <g:region>CA, NSW, 03</g:region>
    <g:postal_code>94043</g:postal_code>
    <g:location_id>21137</g:location_id>
    <g:service>UPS Express</g:service>
    <g:price>1300 USD</g:price>
   </g:shipping>
  </item>
 </channel>
</rss>
';

        $this->assertEquals($expectedFeedXml, $feedXml);
    }
}
