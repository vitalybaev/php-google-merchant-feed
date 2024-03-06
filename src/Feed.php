<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Service as SabreXmlService;

class Feed
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
	 * Feed format.
	 *
	 * @var string
	 */
	private $format;

	/**
	 * RSS version.
	 *
	 * @var string
	 */
	private $rssVersion = '2.0';

	/**
	 * Feed items.
	 *
	 * @var Product[]
	 */
	private $items = [];

	/**
	 * Feed constructor.
	 *
	 * @param string $title
	 * @param string $link
	 * @param string $description
	 */
	public function __construct($title, $link, $description, $format = 'rss')
	{
		$this->title       = $title;
		$this->link        = $link;
		$this->description = $description;
		$this->format      = $format;
	}

	/**
	 * Get the feed format.
	 */
	public function getFormat()
	{
		return $this->format;
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
		if ( 'atom' === $this->format ) {

			return $this->build_atom();

		} else return $this->build_rss();
	}

	private function build_atom()
	{
		$xmlStructure = array();

		if ( ! empty( $this->title ) ) {

			$xmlStructure[] = [ 'title' => $this->title ];
		}

		if ( ! empty( $this->link ) ) {

			$xmlStructure[] = [ 'link' => $this->link ];
		}

		if ( ! empty( $this->description ) ) {

			$xmlStructure[] = [ 'description' => $this->description ];
		}

		$xmlStructure[] = [ 'updated' => date( 'c' ) ];

		foreach ( $this->items as $num => $item ) {

			$xmlStructure[] = $item->getXmlStructure();

			unset( $this->items[ $num ] );
		}

		$this->items = [];

		$xmlService = new SabreXmlService();

		$xmlService->namespaceMap[ 'http://www.w3.org/2005/Atom' ]   = '';
		$xmlService->namespaceMap[ 'http://base.google.com/ns/1.0' ] = 'g';

		return $xmlService->write( 'feed', new RssElement( $xmlStructure ) );
	}

	private function build_rss()
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
