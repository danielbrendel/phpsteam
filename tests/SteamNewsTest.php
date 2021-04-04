<?php

use PHPUnit\Framework\TestCase;
use PHPSteam\SteamNews;

/**
 * TestCase for PHPSteam\SteamNews
 */
final class SteamNewsTest extends TestCase
{
    public function testGetNewsForApp()
    {
        $obj = new SteamNews($_ENV['STEAM_API_KEY']);
        $result = $obj->getNewsForApp($_ENV['STEAM_TEST_APP'], 3, 1024);

        $this->assertTrue(isset($result->appnews->appid));
        $this->assertEquals($result->appnews->appid, $_ENV['STEAM_TEST_APP']);
        $this->assertTrue(count($result->appnews->newsitems) >= 3);

        foreach ($result->appnews->newsitems as $item) {
            $this->assertTrue(isset($item->title));
            $this->assertTrue(isset($item->url));
            $this->assertTrue(isset($item->author));
            $this->assertTrue(isset($item->contents));
        }
    }
}