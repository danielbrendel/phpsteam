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
 * Class SteamBase
 * 
 * Base Steam operations and setup
 */
class SteamBase {
    /**
     * @var string $apiKey Holds the API key which is needed for certain operations
     */
    protected $apiKey = '';

    /**
     * Construct the class
     * 
     * @return void
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Set the API key
     * 
     * @param string $apiKey
     * @return void
     */
    protected function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Get API key
     * 
     * @return string
     */
    protected function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Perform query to web resource
     * 
     * @param string url
     * @return mixed
     * @throws Exception
     */
    protected function queryResource(string $url)
    {
        try {
            $handle = curl_init($url);

            curl_setopt($handle, CURLOPT_HEADER, false);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($handle);

            if(curl_error($handle) !== '') {
                throw new Exception(curl_error($handle));
            }

            curl_close($handle);

            return json_decode($response);
        } catch (Exception $e) {
            throw $e;
        }
    }
}