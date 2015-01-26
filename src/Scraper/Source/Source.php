<?php

namespace Scraper\Source;

/**
 * Factory for creating a source
 *
 * Class Source
 * @package Scraper\Source
 */
class Source {
    /**
     * Create source based on URI scheme
     *
     * @param $uri
     * @return HttpSource
     * @throws \RuntimeException
     */
    public static function create($uri) {
        $parts = parse_url($uri);
        $scheme = strtolower($parts['scheme']);

        switch ($scheme) {
            case 'http':
            case 'https':
                $src = new HttpSource($uri);
                break;
            default:
                throw new \RuntimeException('Source not found for scheme ' . $scheme);
        }

        return $src;
    }
} 