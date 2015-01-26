<?php

namespace Scraper\Source;

use GuzzleHttp;
use Faker;

/**
 * HTTP Source
 *
 * Class HttpSource
 * @package Scraper\Source
 */
class HttpSource extends SourceAbstract {
    /**
     * Custom request headers for given source
     *
     * @var array
     */
    protected $requestHeaders = array();

    /**
     * Use a custom user agent for request
     *
     * @var bool|string
     */
    protected $userAgent = false;

    /**
     * Set a fake but realistic looking user agent
     * string in request headers.
     *
     * @param $bool
     */
    public function setFakeIdentity($bool)
    {
        $this->userAgent = false;
        if ($bool) {
            $faker = Faker\Factory::create();
            $this->userAgent = $faker->userAgent;
        }
    }

    /**
     * Set request options for HttpGuzzle\Client
     *
     * @return array
     */
    public function getOptions()
    {
        $headers = [];
        if ($this->userAgent) {
            $headers[] = 'User-Agent: ' . $this->userAgent;
        }
        return array(
            'headers'   =>  $headers,
        );
    }

    /**
     * Execute HTTP request and save results
     *
     * @return $this
     */
    public function get()
    {
        if ($this->rawData === null) {
            $client = $this->getClient();
            $result = $client->get($this->uri, $this->getOptions());

            $headers = $result->getHeaders();
            if (isset($headers['Content-Type'])) {
                $contentType = explode(';', $headers['Content-Type'][0]);
                $this->mimeType = trim($contentType[0]);
            }

            $this->rawData = $result->getBody()->getContents();
        }

        return $this;
    }

    /**
     * @return GuzzleHttp\Client
     */
    public function createClient()
    {
        return new GuzzleHttp\Client();
    }
}