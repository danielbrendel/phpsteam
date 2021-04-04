<?php

use PHPUnit\Framework\TestCase;
use PHPSteam\SteamApps;

/**
 * TestCase for PHPSteam\SteamApps
 */
final class SteamAppsTest extends TestCase
{
    public function testGetAppList()
    {
        $obj = new SteamApps($_ENV['STEAM_API_KEY']);
        $result = $obj->getAppList();

        $this->assertTrue(isset($result->applist->apps));
    }

    public function testGetServersAtAddress()
    {
        $obj = new SteamApps($_ENV['STEAM_API_KEY']);
        $result = $obj->getServersAtAddress($_ENV['STEAM_GAME_SERVER']);

        $this->assertTrue(isset($result->response->success));
        $this->assertTrue(isset($result->response->servers));
        $this->assertIsArray($result->response->servers);

        foreach ($result->response->servers as $item) {
            $this->assertTrue(isset($item->addr));
            $this->assertTrue(isset($item->appid));
            $this->assertTrue(isset($item->region));
        }
    }

    public function testUpToDateCheck()
    {
        $obj = new SteamApps($_ENV['STEAM_API_KEY']);
        $result = $obj->upToDateCheck($_ENV['STEAM_TEST_APP2'], '1');

        $this->assertTrue(isset($result->response->success));
        $this->assertTrue(isset($result->response->up_to_date));
        $this->assertTrue(isset($result->response->version_is_listable));
        $this->assertTrue(isset($result->response->required_version));
        $this->assertTrue(isset($result->response->message));
    }
}