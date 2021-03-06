<?php

namespace Phil404\RiotAPI\Tests;

use Phil404\RiotAPI\Models\Champion\Champion;
use Phil404\RiotAPI\Models\Region;
use Phil404\RiotAPI\ChampionV3;
use PHPUnit\Framework\TestCase;

class ChampionV3Test extends TestCase
{
    public function testGetChampions()
    {
        if (!file_exists("apiKey.txt")) {
            self::markTestSkipped("ApiKey not found!");
        } else {
            $response = ChampionV3::getChampions(Region::EUW);

            self::assertTrue(is_array($response));
            self::assertTrue($response[0] instanceof Champion);
        }
    }

    public function testGetChampionById()
    {
        $championId = 412;
        if (!file_exists("apiKey.txt")) {
            self::markTestSkipped("ApiKey not found!");
        } else {
            $response = ChampionV3::getChampionById(
                Region::EUW,
                $championId
            );

            self::assertTrue($response instanceof Champion);
        }
    }
}