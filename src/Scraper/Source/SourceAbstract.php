<?php
namespace Scraper\Source;

use Scraper\Format;

/**
 * Abstract class for Source
 *
 * Class SourceAbstract
 * @package Scraper\Source
 */
abstract class SourceAbstract {
    /**
     * @var string
     */
    protected $uri;
    /**
     * @var mixed
     */
    protected $client = null;
    /**
     * @var Scraper\Format\ParserAbstract
     */
    protected $parser = null;
    /**
     * @var string
     */
    protected $rawData = null;
    /**
     * @var array
     */
    protected $extensionMap = array(
        'com'       =>  'html'
    );
    /**
     * @var array
     */
    protected $mimeTypeMap = array(
        'application/json'      =>  'json',
        'text/html'             =>  'html',
    );
    /**
     * @var string
     */
    protected $format;
    /**
     * @var string
     */
    protected $mimeType;

    /**
     * @param $uri string
     */
    public function __construct($uri) {
        $this->uri = $uri;
    }

    /**
     * Create client for source
     *
     * @return mixed
     */
    abstract protected function createClient();

    /**
     * Fetch data for source
     *
     * @return mixed
     */
    abstract public function get();

    /**
     * @return mixed
     */
    public function getClient() {
        if ($this->client === null) {
            $this->client = $this->createClient();
        }
        return $this->client;
    }

    /**
     * Get parser by guessing content based on the
     * mime type, extension, or preset format.
     *
     * @return Scraper\Format\ParserAbstract
     */
    public function getParser()
    {
        if ($this->parser === null) {
            $parts = pathinfo($this->uri);

            $parserClass = $this->format ? ucfirst(strtolower($this->format)) : 'Html';

            if (!empty($this->mimeType) && $this->format === null
                && array_key_exists($this->mimeType, $this->mimeTypeMap)) {
               $parserClass = $this->mimeTypeMap[$this->mimeType];
            } else if (!empty($parts['extension']) && $this->format === null) {
                $parserClass = strtolower($parts['extension']);
                if (array_key_exists($parserClass, $this->extensionMap)) {
                    $parserClass = $this->extensionMap[$parserClass];
                }
            }
            $parserClass = 'Scraper\\Format\\' . ucfirst($parserClass) . 'Parser';
            return new $parserClass($this->rawData);
        }
        return $this->parser;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->get()->getParser()->getData();
    }

    /**
     * @param $type
     */
    public function setFormat($type)
    {
        $this->format = $type;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }
}