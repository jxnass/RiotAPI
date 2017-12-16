<?php

namespace Phil404\RiotAPI;

use Phil404\RiotAPI\Models\Summoner\Summoner;

class SummonerV3
{
    private static $_route = "lol/summoner/v3/summoners";

    public static function getSummonerById(string $region, int $id)
    {
        $apiHandler = new ApiHandler();
        $apiHandler->setRegion($region);
        $response = $apiHandler->sendRequest(SummonerV3::$_route."/".$id);

        if (is_null($response)) return null;

        $summoner = new Summoner();
        $summoner->setName($response['name']);
        return $summoner;
    }
}