<?php

use PHPUnit\Framework\TestCase;
use PHPSteam\PlayerService;

/**
 * TestCase for PHPSteam\PlayerService
 */
final class PlayerServiceTest extends TestCase
{
    public function testGetOwnedGames()
    {
        $obj = new PlayerService($_ENV['STEAM_API_KEY']);
        $result = $obj->getOwnedGames($_ENV['STEAM_PLAYER_ID']);

        $this->assertTrue(isset($result->game_count));
        $this->assertTrue(isset($result->games));
        $this->assertIsArray($result->games);
        $this->assertEquals(count($result->games), $result->game_count);

        foreach ($result->games as $item) {
            $this->assertTrue(isset($item->appid));
            $this->assertTrue(isset($item->name));
        }
    }

    public function testGetRecentlyPlayedGames()
    {
        $obj = new PlayerService($_ENV['STEAM_API_KEY']);
        $result = $obj->getRecentlyPlayedGames($_ENV['STEAM_PLAYER_ID']);

        $this->assertTrue(isset($result->total_count));
        $this->assertTrue(isset($result->games));
        $this->assertIsArray($result->games);

        foreach ($result->games as $item) {
            $this->assertTrue(isset($item->appid));
            $this->assertTrue(isset($item->name));
        }
    }
}