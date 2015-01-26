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
 * Parse HTML using CSS selectors
 *
 * Class HtmlParser
 * @package Scraper\Format
 */
class HtmlParser extends ParserAbstract {
    /**
     * Return DOMNodeList from CSS selector
     *
     * @param $string
     * @return \DOMNodeList
     */
    public function query($string) {
        $xpathQuery = CssSelector::toXPath($string);

        $xpath = new \DOMXPath($this->data);

        return $xpath->query($xpathQuery);
    }

    /**
     * @param $data
     */
    public function __construct($data) {
        $this->data = new \DOMDocument();
        @$this->data->loadHTML($data);
    }

} 