<?php

namespace Vitalybaev\GoogleMerchant;

use Sabre\Xml\Service as SabreXmlService;

class RssFeed extends Feed
{
	/**
	 * RSS version.
	 *
	 * @var string
	 */
	private $rssVersion = '2.0';

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
