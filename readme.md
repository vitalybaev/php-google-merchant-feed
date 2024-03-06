# Google Merchant feed generator for PHP

[![Build Status](https://travis-ci.org/vitalybaev/php-google-merchant-feed.svg?branch=master)](https://travis-ci.org/vitalybaev/php-google-merchant-feed)

## Installation

Install the package through [Composer](http://getcomposer.org/). 

Run the Composer require command from the Terminal:

	composer require vitalybaev/google-merchant-feed

## Example

```php
use Vitalybaev\GoogleMerchant\Feed;
use Vitalybaev\GoogleMerchant\Product;
use Vitalybaev\GoogleMerchant\Product\Shipping;

// Create the feed object.
$feed = new Feed("My awesome store", "https://example.com", "My awesome description");

// Add products to the feed.
foreach ($products as $num => $product) {

	$item = new Product();

	// Set common product properties.
	$item->setId($product->id);
	$item->setTitle($product->title);
	$item->setDescription($product->description);
	$item->setLink($product->getUrl());
	$item->setImage($product->getImage());

	if ($product->isAvailable()) {
		$item->setAvailability('https://schema.org/InStock');
	} else {
		$item->setAvailability('https://schema.org/OutOfStock');
	}

	$item->setPrice($product->price.' USD');
	$item->setGoogleCategory($product->category_name);
	$item->setBrand($product->brand->name);
	$item->setGtin($product->barcode);
	$item->setCondition('https://schema.org/NewCondition');
	$item->setColor($product->color);
	$item->setSize($product->size);

	// Set shipping info.
	$shipping = new Shipping();

	$shipping->setCountry('US');
	$shipping->setRegion('CA, NSW, 03');
	$shipping->setPostalCode('94043');
	$shipping->setLocationId('21137');
	$shipping->setService('UPS Express');
	$shipping->setPrice('1300 USD');
	$item->setShipping($shipping);

	// Set a custom shipping label and weight (optional)
	$item->setShippingLabel('ups-ground');
	$item->setShippingWeight('2.14');

	// Set a custom label (optional)
	$item->setCustomLabel('Some Label 1', 0);
	$item->setCustomLabel('Some Label 2', 1);

	// Save memory.
	unset( $products[ $num ] );

	// Add this product to the feed
	$feed->addItem($item);
}

// Get the complete feed XML, that we can then write to a file or send directly.
$feedXml = $feed->build();
```

## Working with attributes
`Product` class provides several methods for managing various attributes. But it doesn't cover all Google Merchant attributes. In case of nonexistent methods you should use one of the following:

1. `$product->setAttribute($attributeName, $attributeValue, $isCData = false)` - sets attribute. Replaces old attribute if it existed. 
2. `$product->addAttribute($attributeName, $attributeValue, $isCData = false)` - adds one more attribute's value. For example feed can have multiple `additional_image_link` attributes.

## TO-DO
* Cover all Google Merchant feed properties
* More tests
* Your feedback?

## License

```
The MIT License

Copyright (c) 2016 Vitaly Baev. vitalybaev.ru

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```
