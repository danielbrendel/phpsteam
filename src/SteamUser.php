<?php

/*
    PHPSteam developed by Daniel Brendel

    (C) 2021 by Daniel Brendel

    Contact: dbrendel1988<at>gmail<dot>com
    GitHub: https://github.com/danielbrendel/

    Released under the MIT license
*/

namespace PHPSteam;

use Exception;

/**
 * Class SteamUser
 * 
 * Interface to ISteamUser
 */
class SteamUser extends SteamBase {
    const STEAM_INTERFACE = 'ISteamUser';

    /**
     * Construct the object
     * 
     * @return void
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
    }

    /**
     * Get basic profile information of Steam user
     * 
     * @param $steamIds An array of SteamIDs
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getPlayerSummaries(array $steamIds, $format = 'json')
    {
        try {
            $steamIdsString = implode(',', $steamIds);

            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetPlayerSummaries/v0002/?key={$this->apiKey}&steamids={$steamIdsString}&format={$format}";  
            $result = parent::queryResource($url, $format);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get friend list of player
     * 
     * @param $steamId The Steam ID of the player
     * @param $relationship Either 'all' or 'friend'
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getFriendList($steamId, $relationship = 'friend', $format = 'json')
    {
        try {
            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetFriendList/v0001/?key={$this->apiKey}&steamid={$steamId}&relationship={$relationship}&format={$format}";
            $result = parent::queryResource($url, $format);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}