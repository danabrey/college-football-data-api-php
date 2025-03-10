<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use DanAbrey\CollegeFootballDataApi\Model\Team;
use DanAbrey\CollegeFootballDataApi\Parameter\TeamsParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class GamesTest extends TestCase
{
    public function test_games_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/games.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $params = new \DanAbrey\CollegeFootballDataApi\Parameter\GamesParameters(year: 2023);
        
        $games = $testApi->games($params);
        
        self::assertSame('https://apinext.collegefootballdata.com/games?year=2023', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($games);
        $this->assertCount(381, $games);
        
        $this->assertInstanceOf(\DanAbrey\CollegeFootballDataApi\Model\Game::class, $games[0]);
        
        $game = $games[0];
        
        $this->assertEquals(401525434, $game->id);
        $this->assertEquals(2023, $game->season);
        $this->assertEquals(1, $game->week);
        $this->assertEquals('regular', $game->seasonType);
        $this->assertEquals('2023-08-26T18:30:00.000Z', $game->startDate);
        $this->assertFalse($game->startTimeTBD);
        $this->assertTrue($game->completed);
        $this->assertTrue($game->neutralSite);
        $this->assertFalse($game->conferenceGame);
        $this->assertEquals(49000, $game->attendance);
        $this->assertEquals(3504, $game->venueId);
        $this->assertEquals('Aviva Stadium', $game->venue);
        $this->assertEquals(87, $game->homeId);
        $this->assertEquals('Notre Dame', $game->homeTeam);
        $this->assertEquals('FBS Independents', $game->homeConference);
        $this->assertEquals(42, $game->homePoints);
        $this->assertEquals([
            0 => 14,
            1 => 14,
            2 => 7,
            3 => 7,
        ], $game->homeLineScores);
        $this->assertEquals('0.998958343504533', $game->homePostgameWinProbability);
        $this->assertEquals(1733, $game->homePregameElo);
        $this->assertEquals(1819, $game->homePostgameElo);
        $this->assertEquals(2426, $game->awayId);
        $this->assertEquals('Navy', $game->awayTeam);
        $this->assertEquals('American Athletic', $game->awayConference);
        $this->assertEquals(3, $game->awayPoints);
        $this->assertEquals([
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 3,
        ], $game->awayLineScores);
        $this->assertEquals('0.0010416564954669472', $game->awayPostgameWinProbability);
        $this->assertEquals(1471, $game->awayPregameElo);
        $this->assertEquals(1385, $game->awayPostgameElo);
        $this->assertEquals('1.3469076611', $game->excitementIndex);
        $this->assertEquals('', $game->highlights);
        $this->assertNull($game->notes);
    }

    /**
     * @testWith ["week", 1, "https://apinext.collegefootballdata.com/games?year=2023&week=1"]
     *           ["seasonType", "regular", "https://apinext.collegefootballdata.com/games?year=2023&seasonType=regular"]
     *           ["team", "Florida", "https://apinext.collegefootballdata.com/games?year=2023&team=Florida"]
     *           ["home", "Florida", "https://apinext.collegefootballdata.com/games?year=2023&home=Florida"]
     *           ["away", "Florida", "https://apinext.collegefootballdata.com/games?year=2023&away=Florida"]
     *           ["conference", "SEC", "https://apinext.collegefootballdata.com/games?year=2023&conference=SEC"]
     *           ["division", "fbs", "https://apinext.collegefootballdata.com/games?year=2023&division=fbs"]
     *           ["id", 401550883, "https://apinext.collegefootballdata.com/games?year=2023&id=401550883"]
     */
    public function test_games_filter($key, $value, $url)
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/games.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );
        
        $parameters = new \DanAbrey\CollegeFootballDataApi\Parameter\GamesParameters(...[$key => $value], year: 2023);
        $teams = $testApi->games($parameters);

        self::assertSame($url, $mockResponse->getRequestUrl());
    }
}
