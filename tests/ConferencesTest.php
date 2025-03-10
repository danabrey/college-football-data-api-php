<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use DanAbrey\CollegeFootballDataApi\Model\Conference;
use DanAbrey\CollegeFootballDataApi\Model\Team;
use DanAbrey\CollegeFootballDataApi\Model\TeamLocation;
use DanAbrey\CollegeFootballDataApi\Parameter\TeamsParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class ConferencesTest extends TestCase
{
    public function test_conferences_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/conferences.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $conferences = $testApi->conferences();
        
        self::assertSame('https://apinext.collegefootballdata.com/conferences', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($conferences);
        $this->assertCount(105, $conferences);
        
        $this->assertInstanceOf(Conference::class, $conferences[0]);
        
        $this->assertEquals('1', $conferences[0]->id);
        $this->assertEquals('ACC', $conferences[0]->name);
        $this->assertEquals('Atlantic Coast Conference', $conferences[0]->shortName);
        $this->assertEquals('ACC', $conferences[0]->abbreviation);
        $this->assertEquals('fbs', $conferences[0]->classification);

    }
}
