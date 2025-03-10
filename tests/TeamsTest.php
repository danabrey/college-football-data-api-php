<?php
namespace Tests;

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use DanAbrey\CollegeFootballDataApi\Model\TeamLocation;
use DanAbrey\CollegeFootballDataApi\Model\Team;
use DanAbrey\CollegeFootballDataApi\Parameter\TeamsParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class TeamsTest extends TestCase
{
    public function test_teams_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/teams.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        
        $teams = $testApi->teams();
        
        self::assertSame('https://apinext.collegefootballdata.com/teams', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($teams);
        $this->assertCount(674, $teams);
        
        $this->assertInstanceOf(Team::class, $teams[0]);
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

        self::assertSame('https://apinext.collegefootballdata.com/teams?conference=SEC', $mockResponse->getRequestUrl());
    }
}
