<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 1/25/15
 * Time: 2:28 AM
 */

namespace Scraper\Format;
use Symfony\Component\CssSelector\CssSelector;

/**
 * Parse XML with CSS selectors
 *
 * Class XmlParser
 * @package Scraper\Format
 */
class XmlParser extends ParserAbstract {
    /**
     * Return DOMNodeList from CSS selector
     *
     * @param $string
     * @return \DOMNodeList
     */
    public function query($string) {
        CssSelector::disableHtmlExtension();
        $xpathQuery = CssSelector::toXPath($string);

        $xpath = new \DOMXPath($this->data);

        return $xpath->query($xpathQuery);
    }

    /**
     * @param $data
     */
    public function __construct($data) {
        $this->data = new \DOMDocument();
        $this->data->loadXML($data);
    }

} 