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
        $result = $obj->getPlayerAchievements($_ENV['STEAM_TEST_APP2'], $_ENV['STEAM_PLAYER_ID_PRIVATE']);

        $this->assertTrue(isset($result->success));
    }
}