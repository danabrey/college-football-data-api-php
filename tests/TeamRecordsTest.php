<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use DanAbrey\CollegeFootballDataApi\Model\Team;
use DanAbrey\CollegeFootballDataApi\Parameter\TeamsParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class TeamRecordsTest extends TestCase
{
    public function test_team_records_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/teamRecords.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );
        
        $teamRecords = $testApi->teamRecords();
        
        self::assertSame('https://apinext.collegefootballdata.com/records', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($teamRecords);
        $this->assertCount(665, $teamRecords);
        
        $this->assertInstanceOf(\DanAbrey\CollegeFootballDataApi\Model\TeamRecord::class, $teamRecords[0]);
        
        $teamRecord = $teamRecords[0];

        $this->assertEquals(2023, $teamRecord->year);
        $this->assertEquals(2, $teamRecord->teamId);
        $this->assertEquals('Auburn', $teamRecord->team);
        $this->assertEquals('SEC', $teamRecord->conference);
        $this->assertEquals('West', $teamRecord->division);
        $this->assertEquals(6.402269708738939, $teamRecord->expectedWins);
        $this->assertEquals(13, $teamRecord->total['games']);
        $this->assertEquals(6, $teamRecord->total['wins']);
        $this->assertEquals(7, $teamRecord->total['losses']);
        $this->assertEquals(0, $teamRecord->total['ties']);
        $this->assertEquals(8, $teamRecord->conferenceGames['games']);
        $this->assertEquals(3, $teamRecord->conferenceGames['wins']);
        $this->assertEquals(5, $teamRecord->conferenceGames['losses']);
        $this->assertEquals(0, $teamRecord->conferenceGames['ties']);
        $this->assertEquals(7, $teamRecord->homeGames['games']);
        $this->assertEquals(3, $teamRecord->homeGames['wins']);
        $this->assertEquals(4, $teamRecord->homeGames['losses']);
        $this->assertEquals(0, $teamRecord->homeGames['ties']);
        $this->assertEquals(5, $teamRecord->awayGames['games']);
        $this->assertEquals(3, $teamRecord->awayGames['wins']);
        $this->assertEquals(2, $teamRecord->awayGames['losses']);
        $this->assertEquals(0, $teamRecord->awayGames['ties']);
    }

    /**
     * @testWith ["year", 2023, "https://apinext.collegefootballdata.com/records?year=2023"]
     *           ["team", "Florida", "https://apinext.collegefootballdata.com/records?team=Florida"]
     *           ["conference", "SEC", "https://apinext.collegefootballdata.com/records?conference=SEC"]
     */
    public function test_team_records_filter($key, $value, $url)
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/teamRecords.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $parameters = new \DanAbrey\CollegeFootballDataApi\Parameter\TeamRecordParameters(...[$key => $value]);
        $teams = $testApi->teamRecords($parameters);

        self::assertSame($url, $mockResponse->getRequestUrl());
    }
}
