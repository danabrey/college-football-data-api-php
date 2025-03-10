<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class 
GameMediaTest extends TestCase
{
    public function test_game_media_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/gamesMedia.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $params = new \DanAbrey\CollegeFootballDataApi\Parameter\GameMediaParameters(year: 2023);

        $gameMedia = $testApi->gameMedia($params);

        self::assertSame('https://apinext.collegefootballdata.com/games/media?year=2023', $mockResponse->getRequestUrl());

        $this->assertIsArray($gameMedia);
        $this->assertCount(952, $gameMedia);

        $this->assertInstanceOf(\DanAbrey\CollegeFootballDataApi\Model\GameMedia::class, $gameMedia[0]);

        $game = $gameMedia[0];

        $this->assertEquals(401551789, $game->id);
    }

    /**
     * @testWith ["week", 1, "https://apinext.collegefootballdata.com/games/media?year=2023&week=1"]
     *           ["seasonType", "regular", "https://apinext.collegefootballdata.com/games/media?year=2023&seasonType=regular"]
     *           ["team", "Florida", "https://apinext.collegefootballdata.com/games/media?year=2023&team=Florida"]
     *           ["conference", "SEC", "https://apinext.collegefootballdata.com/games/media?year=2023&conference=SEC"]
     *           ["mediaType", "xxx", "https://apinext.collegefootballdata.com/games/media?year=2023&mediaType=xxx"]
     *           ["classification", "xxx", "https://apinext.collegefootballdata.com/games/media?year=2023&classification=xxx"]
     */
    public function test_games_media_filter($key, $value, $url)
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/gamesMedia.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $parameters = new \DanAbrey\CollegeFootballDataApi\Parameter\GameMediaParameters(...[$key => $value], year: 2023);
        $teams = $testApi->gameMedia($parameters);

        self::assertSame($url, $mockResponse->getRequestUrl());
    }
}
