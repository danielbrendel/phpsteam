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

    /**
     * Get app reviews
     * 
     * @param $appid The Steam AppID
     * @param $filter 'recent' for sorting by creation time, 'updated' for sorting by last update time, 'all' for sorting by helpfulness
     * @param $language Specify language of reviews to get
     * @param $day_range From now to N days in the past to look for helpful reviews (only applicable for the 'all' filter)
     * @param $cursor Used for paginating reviews
     * @param $review_type 'all', 'positive' or 'negative'
     * @param $purchase_type 'all', 'steam' or 'non_steam_purchase'
     * @param $num_per_page By default ip to 20, maximum is 100 rows to be returned
     */
    public function getAppReviews($appid, $filter, $language, $day_range, $cursor, $review_type, $purchase_type, $num_per_page = 20)
    {
        try {
            $url = "http://store.steampowered.com/appreviews/{$appid}?json=1&filter={$filter}&language={$language}&day_range={$day_range}&cursor={$cursor}&review_type={$review_type}&purchase_type={$purchase_type}&num_per_page={$num_per_page}";
            $result = parent::queryResource($url, 'json');
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }
}