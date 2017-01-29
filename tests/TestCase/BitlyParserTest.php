<?php
namespace SpaceIndex\Test\TestCase;

use PHPUnit\Framework\TestCase;
use Bitly\BitlyParser;

class BitlyParserTest extends TestCase
{
    /** @var  BitlyParser */
    protected $biltyParser;

    public function setUp()
    {
        parent::setUp();
        $this->biltyParser = new BitlyParser();
    }

    public function testParse()
    {
        $arrayLinks = $this->biltyParser->parse($this->getBitlyTextForTesting());
        $arrayLinks = array_flip($arrayLinks);
        $this->assertCount(3, $arrayLinks);
        $this->assertArrayHasKey('http://bit.ly/hfsh35', $arrayLinks);
        $this->assertArrayHasKey('http://ebay.to/hfsh35', $arrayLinks);
        $this->assertArrayHasKey('http://amzn.to/hfsh35', $arrayLinks);
        $this->assertArrayNotHasKey('http://youtube.com/ghrewg3', $arrayLinks);
    }

    public function testEmptyParse()
    {
        $arrayLinks = $this->biltyParser->parse("");
        $this->assertCount(0, $arrayLinks);
    }

    public function testIsBitly()
    {
        $this->assertTrue($this->biltyParser->isBitly($this->getCorrectBitlyLink()), 'bitly link failed');
        $this->assertTrue($this->biltyParser->isBitly($this->getCorrectAmazonLink()), 'amazon link failed');
        $this->assertTrue($this->biltyParser->isBitly($this->getCorrecteBayLink()), 'ebay link failed');
        $this->assertFalse($this->biltyParser->isBitly($this->getWrongLink()), "wrong link failed");
        $this->assertFalse($this->biltyParser->isBitly($this->getNoLink()), "no link failed");
    }

    private function getBitlyTextForTesting()
    {
        return "Hallo http://bit.ly/hfsh35 und http://ebay.to/hfsh35 super http://amzn.to/hfsh35 wrong http://youtube.com/ghrewg3";
    }

    private function getCorrectBitlyLink()
    {
        return "http://bit.ly/hfsh35";
    }

    private function getCorrectAmazonLink()
    {
        return "http://amzn.to/hfsh35";
    }

    private function getCorrecteBayLink()
    {
        return "http://ebay.to/hfsh35";
    }

    private function getWrongLink()
    {
        return "http://youtube.com/ghrewg3";
    }

    private function getNoLink()
    {
        return "Alle meine Endchen";
    }
}