<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class PlayerSeasonStatsTest extends TestCase
{
    public function test_player_stats_season_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/playerSeasonStats.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );
        
        $playerSeasonStats = $testApi->playerSeasonStats(new \DanAbrey\CollegeFootballDataApi\Parameter\PlayerSeasonStatsParameters(
            year: 2023,
        ));
        
        self::assertSame('https://apinext.collegefootballdata.com/stats/player/season?year=2023', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($playerSeasonStats);
        $this->assertCount(601, $playerSeasonStats);
        
        $this->assertInstanceOf(\DanAbrey\CollegeFootballDataApi\Model\PlayerSeasonStat::class, $playerSeasonStats[0]);

        /** @var \DanAbrey\CollegeFootballDataApi\Model\PlayerSeasonStat $playerSeasonStat */
        $playerSeasonStat = $playerSeasonStats[0];

        $this->assertEquals(5150247, $playerSeasonStat->playerId);
        $this->assertEquals('Malik Benson',  $playerSeasonStat->player);
        $this->assertEquals('Alabama', $playerSeasonStat->team);
        $this->assertEquals('SEC', $playerSeasonStat->conference);
        $this->assertEquals('defensive', $playerSeasonStat->category);
        $this->assertEquals('PD', $playerSeasonStat->statType);
        $this->assertEquals(0, $playerSeasonStat->stat);
    }

    /**
     * @testWith ["team", "Florida", "https://apinext.collegefootballdata.com/stats/player/season?year=2023&team=Florida"]
     *           ["conference", "SEC", "https://apinext.collegefootballdata.com/stats/player/season?year=2023&conference=SEC"]
     */
    public function test_player_season_stats_filter($key, $value, $url)
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/playerSeasonStats.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $values = [$key => $value];
        $values['year'] = '2023';
        
        $parameters = new \DanAbrey\CollegeFootballDataApi\Parameter\PlayerSeasonStatsParameters(...$values);
        $teams = $testApi->playerSeasonStats($parameters);

        self::assertSame($url, $mockResponse->getRequestUrl());
    }
}
