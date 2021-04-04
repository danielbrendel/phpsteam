# PHPSteam - A simple API to the Steam Web API for PHP

## Description
This package is a simple API for PHP that allows you to conveniently use the <a href="https://developer.valvesoftware.com/wiki/Steam_Web_API">Steam Web API</a>.
It supports all interfaces and their related methods. The package is installable via Composer.
Some methods will require a Steam API key. You can obtain one <a href="https://steamcommunity.com/dev/apikey">here</a>.

## Installation
To install the package run the following composer command:
```code
composer require danielbrendel/phpsteam 
```
Then simply create an instance of the desired helper class, e.g.:
```php
<?php

require_once __DIR__ . '/../vendor/autoload.php'; //Don't forget to use Composer autoloader if not already

use PHPSteam; //Require the package namespace

$obj = new SteamNews('your api key goes here'); //Access helper methods via $obj
```

## Interfaces and methods
Following there is a list of all supported interfaces and their methods.

### SteamNews
```php
/**
 * Get news for Steam App
 * 
 * @param $appId The ID of the Steam application
 * @param $count How many news entities shall be returned
 * @param $maxlength Maximum length of each news entry
 * @param $format Either 'json', 'xml' or 'vdf'
 * @return mixed
 * @throws Exception
 */
public function getNewsForApp($appId, $count, $maxlength, $format = 'json')
```

### SteamUser
```php
/**
 * Get basic profile information of Steam user
 * 
 * @param $steamIds An array of SteamIDs
 * @param $format Either 'json', 'xml' or 'vdf'
 * @return mixed
 * @throws Exception
 */
public function getPlayerSummaries(array $steamIds, $format = 'json')
```

```php
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
```

### SteamUserStats
```php
/**
 * Get global achievements overview of a specific game in percentages
 * 
 * @param $gameId The ID of the Steam game
 * @param $format Either 'json', 'xml' or 'vdf'
 * @return mixed
 * @throws Exception
 */
public function getGlobalAchievementPercentagesForApp($gameId, $format = 'json')
```

```php
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
```

```php
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
```

### SteamApps
```php
/**
 * Get Steam app list
 * 
 * @param $format Either 'json', 'xml' or 'vdf'
 * @return mixed
 * @throws Exception
 */
public function getAppList($format = 'json')
```

```php
/**
 * Get servers at address
 * 
 * @param $addr IP or IP:Port
 * @param $format Either 'json', 'xml' or 'vdf'
 * @return mixed
 * @throws Exception
 */
public function getServersAtAddress($addr, $format = 'json')
```

```php
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
```

### PlayerService
```php
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
```

```php
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
```

## Testing
In order to run the tests you need to install PHPUnit.
Some methods require a Steam API key, so in order to run the tests successfully, you need to
create the configuration script file <b>tests/steam_key.php</b>. Then set your Steam API key
as follows:
```php
<?php

/**
 * Set your Steam key here
 */
$_ENV['STEAM_API_KEY'] = 'your key here';
```
You can also modify the following environment variables in <b>phpunit.xml</b> for testing:
```xml
<env name="STEAM_API_KEY" value="test"/> <!-- This shall not be edited, use steam_key.php instead -->
<env name="STEAM_TEST_APP" value="1001860"/> <!-- A test application with basic data (e.g. no achievements) -->
<env name="STEAM_TEST_APP2" value="730"/> <!-- A full featured game supporting achievements etc. -->
<env name="STEAM_PLAYER_ID" value="76561198876154375"/> <!-- Steam ID of a player to obtain information -->
<env name="STEAM_GAME_SERVER" value="127.0.0.1"/> <!-- IP address of a server running one or more game servers (different ports) -->
```

Then run the tests via the following command from the project root:
```
"vendor/bin/phpunit"
```
