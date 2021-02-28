<?php

namespace Vitalybaev\GoogleMerchant;

class RssElement implements \Sabre\Xml\XmlSerializable
{

    private $value;
    private $rss_version;

    public function __construct($value, $rss_version = 2)
    {
        $this->value = $value;
        $this->rss_version = (string)$rss_version;
    }

    public function xmlSerialize(\Sabre\Xml\Writer $writer)
    {
        $writer->writeAttribute('version', $this->rss_version);
        $writer->write($this->value);
    }
}