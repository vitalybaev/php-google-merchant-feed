<?php

namespace Vitalybaev\GoogleMerchant;

class RssElement implements \Sabre\Xml\XmlSerializable
{
	private $value;

	/**
	 * Rss version attribute
	 * @var string
	 */
	private $rssVersion;

	/**
	 * RssElement constructor.
	 *
	 * @param $value
	 * @param string $rssVersion
	 */
	public function __construct($value, $rssVersion = '')
	{
		$this->value = $value;

		$this->rssVersion = (string)$rssVersion;
	}

	public function xmlSerialize(\Sabre\Xml\Writer $writer)
	{
		if ($this->rssVersion) {

			$writer->writeAttribute('version', $this->rssVersion);
		}

		$writer->write($this->value);
	}
}
