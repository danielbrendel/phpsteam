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

        $this->assertEquals(count($result), count($steamIds));

        foreach ($result as $item) {
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

        if (count($result) > 0) {
            foreach ($result as $item) {
                $this->assertTrue(isset($item->steamid));
                $this->assertTrue(isset($item->relationship));
                $this->assertTrue(isset($item->friend_since));
            }
        } else {
            $this->addToAssertionCount(1);
        }
    }
}