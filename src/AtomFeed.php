<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Service as SabreXmlService;

const ATOM_FEED = true;

class AtomFeed
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
}
