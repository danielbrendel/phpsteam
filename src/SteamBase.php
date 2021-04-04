<?php

namespace PHPSteam;

use GuzzleHttp\Guzzle;

class SteamBase {
    protected $apiKey = '';

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    protected function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    protected function getApiKey($apiKey)
    {
        return $this->apiKey;
    }

    protected function queryResource($url)
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