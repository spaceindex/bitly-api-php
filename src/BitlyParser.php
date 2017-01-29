<?php

namespace Bitly;

class BitlyParser
{
    /** @var string */
    protected $bitlyPattern = '/([\w-]+:\/\/)[bit\.ly|amzn\.to|ebay\.to]*\/\S*/';

    /**
     * Parse the text and find possible Bitly links
     * @param string $text
     * @return array
     */
    public function parse(string $text): array
    {
        $matches = [];
        preg_match_all($this->bitlyPattern, $text, $matches);
        return $matches[0];
    }

    /**
     * Check if the link a Bitly link
     * @param string $link
     * @return bool
     */
    public function isBitly(string $link): bool
    {
        return preg_match($this->bitlyPattern, $link) > 0;
    }
}