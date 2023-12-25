<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Service as SabreXmlService;

const FEED_FORMAT='rss';

class RssFeed
{
	/**
	 * Feed title.
	 *
	 * @var string
	 */
	private $title;

	/**
	 * Link to the store.
	 *
	 * @var string
	 */
	private $link;

	/**
	 * Feed description.
	 *
	 * @var string
	 */
	private $description;

	/**
	 * Feed items.
	 *
	 * @var Product[]
	 */
	private $items = [];

	/**
	 * RSS version.
	 *
	 * @var string
	 */
	private $rssVersion = '2.0';

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
	 * Adds product (aka item) to feed.
	 *
	 * @param $product
	 */
	public function addProduct($product)
	{
		$this->addItem($product);
	}

	/**
	 * Adds item to feed.
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
		$xmlStructure = array( 'channel' => array() );

		if ( ! empty( $this->title ) ) {

			 $xmlStructure[ 'channel' ][] = [ 'title' => $this->title ];
		}

		if ( ! empty( $this->link ) ) {

			 $xmlStructure[ 'channel' ][] = [ 'link' => $this->link ];
		}

		if ( ! empty( $this->description ) ) {

			 $xmlStructure[ 'channel' ][] = [ 'description' => $this->description ];
		}

		foreach ( $this->items as $num => $item ) {

			 $xmlStructure[ 'channel' ][] = $item->getXmlStructure();

			unset( $this->items[ $num ] );
		}

		$this->items = [];

		$xmlService = new SabreXmlService();

		$xmlService->namespaceMap[ 'http://base.google.com/ns/1.0' ] = 'g';

		return $xmlService->write( 'rss', new RssElement( $xmlStructure, $this->rssVersion ) );
	}
}
