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

        $this->assertTrue(isset($result->appid));
        $this->assertEquals($result->appid, $_ENV['STEAM_TEST_APP']);
        $this->assertTrue(count($result->newsitems) >= 3);

        for ($i = 0; $i < count($result->newsitems); $i++) {
            $this->assertTrue(isset($result->newsitems[$i]->title));
            $this->assertTrue(isset($result->newsitems[$i]->url));
            $this->assertTrue(isset($result->newsitems[$i]->author));
            $this->assertTrue(isset($result->newsitems[$i]->contents));
        }
    }
}