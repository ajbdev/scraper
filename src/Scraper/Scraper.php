<?php
/**
 * Created by PhpStorm.
 * User: andybaird
 * Date: 1/25/15
 * Time: 12:36 AM
 */

namespace Scraper;


use Scraper\Source\SourceAbstract;

class Scraper {
    public function scrape(SourceAbstract $source, $queryString)
    {
        $source->get();
        $parser = $source->getParser();

        return $parser->query($queryString);
    }
} 