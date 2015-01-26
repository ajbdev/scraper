<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 1/25/15
 * Time: 2:28 AM
 */

namespace Scraper\Format;

use Peekmo\JsonPath\JsonStore;

/**
 * Parse JSON via JSONPath - an XPath like syntax
 * http://goessner.net/articles/JsonPath/
 *
 * Class JsonParser
 * @package Scraper\Format
 */
class JsonParser extends ParserAbstract {
    /**
     * Parse JSON with JSONPath string
     *
     * @param $string
     * @return array
     */
    public function query($string) {
        return $this->data->get($string);
    }

    /**
     * @param $data
     */
    public function __construct($data) {
        $this->data = new JsonStore($data);
    }
} 