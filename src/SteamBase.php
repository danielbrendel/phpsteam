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
}