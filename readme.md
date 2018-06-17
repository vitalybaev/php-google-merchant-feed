# Google Merchant feed generator for PHP

## Example

```php
use Vitalybaev\GoogleMerchant\Feed;
use Vitalybaev\GoogleMerchant\Product;
use Vitalybaev\GoogleMerchant\Product\Availability;

// Create feed object
$feed = new Feed("My awesome store", "https://example.com", "My awesome description");

// Put products to the feed ($products - some data from database for example)
foreach ($products as $product) {
    $item = new Product();
    
    // Set common product properties
    $item->setId($product->id);
    $item->setTitle($product->title);
    $item->setDescription($product->description);
    $item->setLink($product->getUrl());
    $item->setImage($product->getImage());
    if ($product->isAvailable()) {
        $feedProduct->setAvailability(Availability::IN_STOCK);
    } else {
        $feedProduct->setAvailability(Availability::OUT_OF_STOCK);
    }
    $item->setPrice("{$product->price} USD");
    $item->setGoogleCategory($product->category_name);
    $item->setBrand($product->brand->name);
    $item->setGtin($product->barcode);
    $item->setCondition('new');
    
    // Some additional properties
    $item->setColor($product->color);
    $item->setSize($product->size);

    // Add this product to the feed
    $feed->addProduct($item);
}

// Here we get complete XML of the feed, that we could write to file or send directly
$feedXml = $feed->build();

```

## TO-DO
* Cover all Google Merchant feed properties
* Write tests

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