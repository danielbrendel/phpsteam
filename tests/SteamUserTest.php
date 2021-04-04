<?php

use PHPUnit\Framework\TestCase;
use PHPSteam\SteamUser;

/**
 * TestCase for PHPSteam\SteamUser
 */
final class SteamUserTest extends TestCase
{
    public function testGetPlayerSummaries()
    {
        $steamIds = [
            $_ENV['STEAM_PLAYER_ID']
        ];

        $obj = new SteamUser($_ENV['STEAM_API_KEY']);
        $result = $obj->getPlayerSummaries($steamIds);
        
        $this->assertTrue(isset($result->response->players));
        $this->assertEquals(count($result->response->players), count($steamIds));

        foreach ($result->response->players as $item) {
            $this->assertTrue(isset($item->steamid));
            $this->assertTrue(isset($item->personaname));
            $this->assertTrue(isset($item->avatar));
            $this->assertTrue(isset($item->profileurl));
        }
    }

    public function testGetFriendList()
    {
        $obj = new SteamUser($_ENV['STEAM_API_KEY']);
        $result = $obj->getFriendList($_ENV['STEAM_PLAYER_ID']);
        
        $this->assertTrue(isset($result->friendslist->friends));

        if (count($result->friendslist->friends) > 0) {
            foreach ($result->friendslist->friends as $item) {
                $this->assertTrue(isset($item->steamid));
                $this->assertTrue(isset($item->relationship));
                $this->assertTrue(isset($item->friend_since));
            }
        }
    }
}