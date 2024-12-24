<?php

namespace Vitalybaev\GoogleMerchant;

class RssElement implements \Sabre\Xml\XmlSerializable
{
	private $value;
	private $rssVersion;

	public function __construct($value, $rssVersion = '')
	{
		$this->value = $value;

		$this->rssVersion = (string)$rssVersion;
	}

	public function xmlSerialize(\Sabre\Xml\Writer $writer): void
	{
		if ($this->rssVersion) {

			$writer->writeAttribute('version', $this->rssVersion);
		}

		$writer->write($this->value);
	}
}
