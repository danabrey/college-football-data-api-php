<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use DanAbrey\CollegeFootballDataApi\Model\Player;
use DanAbrey\CollegeFootballDataApi\Model\Team;
use DanAbrey\CollegeFootballDataApi\Parameter\TeamsParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class RosterTest extends TestCase
{
    public function test_roster_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/roster.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        
        $roster = $testApi->roster();
        
        self::assertSame('https://api.collegefootballdata.com/roster', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($roster);
        $this->assertCount(138, $roster);
        
        $this->assertInstanceOf(Player::class, $roster[0]);
    }

    public function test_teams_filter_by_conference()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/teams.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $parameters = new TeamsParameters(conference: 'SEC');
        $teams = $testApi->teams($parameters);

        self::assertSame('https://api.collegefootballdata.com/teams?conference=SEC', $mockResponse->getRequestUrl());
    }
}
