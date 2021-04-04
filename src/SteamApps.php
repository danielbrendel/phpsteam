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
 * Class SteamApps
 * 
 * Interface to ISteamApps
 */
class SteamApps extends SteamBase {
    const STEAM_INTERFACE = 'ISteamApps';

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
     * Get Steam app list
     * 
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getAppList($format = 'json')
    {
        try {
            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetAppList/v2/?format={$format}";
            $result = parent::queryResource($url, $format);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Get servers at address
     * 
     * @param $addr IP or IP:Port
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function getServersAtAddress($addr, $format = 'json')
    {
        try {
            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/GetServersAtAddress/v1/?addr={$addr}&format={$format}";
            $result = parent::queryResource($url, $format);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Check if the specified version of a Steam app is up-to-date
     * 
     * @param $appid The Steam app ID
     * @param $version The install version
     * @param $format Either 'json', 'xml' or 'vdf'
     * @return mixed
     * @throws Exception
     */
    public function upToDateCheck($appid, $version, $format = 'json')
    {
        try {
            $url = "http://api.steampowered.com/" . self::STEAM_INTERFACE . "/UpToDateCheck/v1/?appid={$appid}&version={$version}&format={$format}";
            $result = parent::queryResource($url, $format);
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}