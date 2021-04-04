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
 * Class PlayerService
 * 
 * Interface to IPlayerService
 */
class PlayerService extends SteamBase {
    const STEAM_INTERFACE = 'IPlayerService';

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
     * Get a list of games a player owns along with some information
     * 
     * @param $steamId The Steam ID of the player
     * @param $include_appinfo Whether to include additional app information
     * @param $include_played_free_games Whether to include free games, too
     * @param $appids_filter An array of App IDs to be filtered
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getOwnedGames($steamId, $include_appinfo = 1, $include_played_free_games = 1, $appids_filter = array(), $format = 'json')
    {
        try {
            $filter = urlencode(json_encode(array('appids_filter' => $appids_filter)));
            $input_json = count($appids_filter) > 0 ? "&input_json={$filter}" : "";

            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetOwnedGames/v0001/?key={$this->apiKey}&steamid={$steamId}&include_appinfo={$include_appinfo}&include_played_free_games={$include_played_free_games}&format={$format}{$input_json}";
            
            $result = parent::queryResource($url, $format);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get the recently played list of a Steam user
     * 
     * @param $steamId The Steam ID of the player
     * @param $count Limit the response to an amount of games, or zero for no limitation
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getRecentlyPlayedGames($steamId, $count = 0, $format = 'json')
    {
        try {
            $input_count = $count > 0 ? "&count={$count}" : "";

            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetRecentlyPlayedGames/v0001/?key={$this->apiKey}&steamid={$steamId}&format={$format}{$input_count}";
            
            $result = parent::queryResource($url, $format);

            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}