<?php

use PHPUnit\Framework\TestCase;
use PHPSteam\SteamBase;

/**
 * TestCase for PHPSteam\SteamBase
 */
final class SteamBaseTest extends TestCase
{
    public function testQueryResource()
    {
        $method = new ReflectionMethod("PHPSteam\SteamBase", "queryResource");
        $method->setAccessible(true);

        $obj = new SteamBase($_ENV['STEAM_API_KEY']);
        $result = $method->invoke($obj, 'http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid=440&count=3&maxlength=300&format=json');

        $this->assertIsObject($result);
        $this->assertTrue(isset($result->appnews->appid));
        $this->assertEquals($result->appnews->appid, 440);
        $this->assertTrue(isset($result->appnews->newsitems));
        $this->assertTrue(count($result->appnews->newsitems) === 3);
    }
}