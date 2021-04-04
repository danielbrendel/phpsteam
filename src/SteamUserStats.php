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
 * Class SteamUserStats
 * 
 * Interface to ISteamUserStats
 */
class SteamUserStats extends SteamBase {
    const STEAM_INTERFACE = 'ISteamUserStats';

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
     * Get global achievements overview of a specific game in percentages
     * 
     * @param $gameId The ID of the Steam game
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getGlobalAchievementPercentagesForApp($gameId, $format = 'json')
    {
        try {
            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetGlobalAchievementPercentagesForApp/v0002/?gameid={$gameId}&format={$format}";
            $result = parent::queryResource($url, $format);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get list of achievements for a Steam user of a game
     * 
     * @param $appId The Steam game ID
     * @param $steamId The Steam ID of the player
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getPlayerAchievements($appId, $steamId, $format = 'json')
    {
        try {
            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetPlayerAchievements/v0001/?appid={$appId}&key={$this->apiKey}&steamid={$steamId}&format={$format}";
            $result = parent::queryResource($url, $format);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get user statistics for game
     * 
     * @param $appId The Steam game ID
     * @param $steamId The Steam ID of the player
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getUserStatsForGame($appId, $steamId, $format = 'json')
    {
        try {
            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetUserStatsForGame/v0002/?appid={$appId}&key={$this->apiKey}&steamid={$steamId}&format={$format}";
            $result = parent::queryResource($url, $format);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}