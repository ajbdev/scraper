<?php
namespace Scraper\Format;

/**
 * Abstract class for parser
 *
 * Class ParserAbstract
 * @package Scraper\Format
 */
abstract class ParserAbstract {
    /**
     * @var mixed
     */
    protected $data;

    /**
     * @param $data string
     */
    abstract public function __construct($data);

    /**
     * @param $string
     * @return mixed
     */
    abstract public function query($string);

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
} 