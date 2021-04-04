<?php

/*
    PHPSteam developed by Daniel Brendel

    (C) 2021 by Daniel Brendel

    Contact: dbrendel1988<at>gmail<dot>com
    GitHub: https://github.com/danielbrendel/

    Released under the MIT license
*/

namespace PHPSteam;

/**
 * Class SteamNews
 * 
 * Interface to ISteamNews
 */
class SteamNews extends SteamBase {
    const STEAM_INTERFACE = 'ISteamNews';

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
     * Get news for Steam App
     * 
     * @param $appId The ID of the Steam application
     * @param $count How many news entities shall be returned
     * @param $maxlength Maximum length of each news entry
     * @param $format Either 'json', 'xml' or 'vdf'
     */
    public function getNewsForApp($appId, $count, $maxlength, $format = 'json')
    {
        try {
            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetNewsForApp/v0002/?appid={$appId}&count={$count}&maxlength={$maxlength}&format={$format}";
            
            $result = parent::queryResource($url);

            if (!isset($result->appnews)) {
                throw new Exception('App news object not found for: ' . $url);
            }

            return $result->appnews;
        } catch (Exception $e) {
            throw $e;
        }
    }
}