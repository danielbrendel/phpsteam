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
        
        $this->assertTrue(isset($result->response->game_count));
        $this->assertTrue(isset($result->response->games));
        $this->assertIsArray($result->response->games);
        $this->assertEquals(count($result->response->games), $result->response->game_count);

        foreach ($result->response->games as $item) {
            $this->assertTrue(isset($item->appid));
            $this->assertTrue(isset($item->name));
        }
    }

    public function testGetRecentlyPlayedGames()
    {
        $obj = new PlayerService($_ENV['STEAM_API_KEY']);
        $result = $obj->getRecentlyPlayedGames($_ENV['STEAM_PLAYER_ID']);

        $this->assertTrue(isset($result->response->total_count));
        $this->assertTrue(isset($result->response->games));
        $this->assertIsArray($result->response->games);

        foreach ($result->response->games as $item) {
            $this->assertTrue(isset($item->appid));
            $this->assertTrue(isset($item->name));
        }
    }
}