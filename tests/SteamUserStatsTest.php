<?php

use PHPUnit\Framework\TestCase;
use PHPSteam\SteamUserStats;

/**
 * TestCase for PHPSteam\SteamUserStats
 */
final class SteamUserStatsTest extends TestCase
{
    public function testGetGlobalAchievementPercentagesForApp()
    {
        $obj = new SteamUserStats($_ENV['STEAM_API_KEY']);
        $result = $obj->getGlobalAchievementPercentagesForApp($_ENV['STEAM_TEST_APP2']);

        $this->assertTrue(isset($result->achievements));

        foreach ($result->achievements as $item) {
            $this->assertTrue(isset($item->name));
            $this->assertTrue(isset($item->percent));
        }
    }

    public function testGetPlayerAchievements()
    {
        $obj = new SteamUserStats($_ENV['STEAM_API_KEY']);
        $result = $obj->getPlayerAchievements($_ENV['STEAM_TEST_APP2'], $_ENV['STEAM_PLAYER_ID']);

        $this->assertTrue(isset($result->success));
        $this->assertTrue(isset($result->gameName));
        $this->assertTrue(count($result->achievements) > 0);

        foreach ($result->achievements as $item) {
            $this->assertTrue(isset($item->apiname));
            $this->assertTrue(isset($item->achieved));
            $this->assertTrue(isset($item->unlocktime));
        }
    }

    public function testGetUserStatsForGame()
    {
        $obj = new SteamUserStats($_ENV['STEAM_API_KEY']);
        $result = $obj->getUserStatsForGame($_ENV['STEAM_TEST_APP2'], $_ENV['STEAM_PLAYER_ID']);

        $this->assertTrue(isset($result->steamID));
        $this->assertTrue(isset($result->gameName));
        $this->assertTrue(count($result->stats) > 0);

        foreach ($result->stats as $item) {
            $this->assertTrue(isset($item->name));
            $this->assertTrue(isset($item->value));
        }
    }
}