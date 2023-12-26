<?php

namespace Vitalybaev\GoogleMerchant;

abstract class Feed
{
	/**
	 * Feed title.
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * Link to the store.
	 *
	 * @var string
	 */
	protected $link;

	/**
	 * Feed description.
	 *
	 * @var string
	 */
	protected $description;

	/**
	 * Feed items.
	 *
	 * @var Product[]
	 */
	protected $items = [];

	/**
	 * Feed constructor.
	 *
	 * @param string $title
	 * @param string $link
	 * @param string $description
	 */
	public function __construct($title, $link, $description)
	{
		$this->title       = $title;
		$this->link        = $link;
		$this->description = $description;
	}

	/**
	 * Adds product (aka item) to the feed.
	 *
	 * @param $product
	 */
	public function addProduct($product)
	{
		$this->addItem($product);
	}

	/**
	 * Adds item to the feed.
	 *
	 * @param $product
	 */
	public function addItem($item)
	{
		$this->items[] = $item;
	}

	/**
	 * Generate string representation of this feed.
	 *
	 * @return string
	 */
	public function build()
	{
	}
}
