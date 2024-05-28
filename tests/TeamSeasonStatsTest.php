<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class TeamSeasonStatsTest extends TestCase
{
    public function test_team_stats_season_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/teamSeasonStats.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );
        
        $teamSeasonStats = $testApi->teamSeasonStats(new \DanAbrey\CollegeFootballDataApi\Parameter\TeamSeasonStatsParameters(
            year: 2023,
        ));
        
        self::assertSame('https://api.collegefootballdata.com/stats/season?year=2023', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($teamSeasonStats);
        $this->assertCount(32, $teamSeasonStats);
        
        $this->assertInstanceOf(\DanAbrey\CollegeFootballDataApi\Model\TeamSeasonStat::class, $teamSeasonStats[0]);

        /** @var \DanAbrey\CollegeFootballDataApi\Model\TeamSeasonStat $teamSeasonStat */
        $teamSeasonStat = $teamSeasonStats[0];
        
        $this->assertEquals(2023, $teamSeasonStat->season);
        $this->assertEquals('Alabama', $teamSeasonStat->team);
        $this->assertEquals('SEC', $teamSeasonStat->conference);
        $this->assertEquals('turnovers', $teamSeasonStat->statName);
        $this->assertEquals(11, $teamSeasonStat->statValue);
    }

    /**
     * @testWith ["team", "Florida", "https://api.collegefootballdata.com/stats/season?year=2023&team=Florida"]
     *           ["conference", "SEC", "https://api.collegefootballdata.com/stats/season?year=2023&conference=SEC"]
     */
    public function test_team_season_stats_filter($key, $value, $url)
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/teamSeasonStats.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $values = [$key => $value];
        $values['year'] = '2023';
        
        $parameters = new \DanAbrey\CollegeFootballDataApi\Parameter\TeamSeasonStatsParameters(...$values);
        $teams = $testApi->teamSeasonStats($parameters);

        self::assertSame($url, $mockResponse->getRequestUrl());
    }
}
