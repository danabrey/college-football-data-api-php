<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use DanAbrey\CollegeFootballDataApi\Parameter\CalendarParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class CalendarTest extends TestCase
{
    public function test_calendar_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/calendar.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );
        
        $calendar = $testApi->calendar(new CalendarParameters(year: 2023));
        
        self::assertSame('https://api.collegefootballdata.com/calendar?year=2023', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($calendar);
        $this->assertCount(21, $calendar);
        
        $this->assertInstanceOf(\DanAbrey\CollegeFootballDataApi\Model\Week::class, $calendar[0]);

        $week = $calendar[0];

        $this->assertEquals(2023, $week->season);
        $this->assertEquals(1, $week->week);
        $this->assertEquals('regular', $week->seasonType);
        $this->assertEquals('2023-08-26T17:00:00.000Z', $week->firstGameStart);
        $this->assertEquals('2023-09-05T00:00:00.000Z', $week->lastGameStart);
    }

    /**
     * @testWith ["year", 2022, "https://api.collegefootballdata.com/calendar?year=2022"]
     */
    public function test_calendar_filter($key, $value, $url)
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/calendar.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $parameters = new \DanAbrey\CollegeFootballDataApi\Parameter\CalendarParameters(...[$key => $value]);
        $teams = $testApi->calendar($parameters);

        self::assertSame($url, $mockResponse->getRequestUrl());
    }
}
