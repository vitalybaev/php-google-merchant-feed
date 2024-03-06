<?php

namespace Vitalybaev\GoogleMerchant\Meta\Product;

class Schema
{
    const MAP = array(
	'availability' => array(
		'https://schema.org/BackOrder'           => 'out of stock',
		'https://schema.org/Discontinued'        => 'out of stock',
		'https://schema.org/InStock'             => 'in stock',
		'https://schema.org/InStoreOnly'         => 'in stock',
		'https://schema.org/LimitedAvailability' => 'in stock',
		'https://schema.org/OnlineOnly'          => 'in stock',
		'https://schema.org/OutOfStock'          => 'out of stock',
		'https://schema.org/PreOrder'            => 'in stock',
		'https://schema.org/PreSale'             => 'in stock',
		'https://schema.org/SoldOut'             => 'out of stock',
	),
    );
}
