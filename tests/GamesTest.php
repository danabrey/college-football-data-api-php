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
        
        self::assertSame('https://api.collegefootballdata.com/games?year=2023', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($games);
        $this->assertCount(335, $games);
        
        $this->assertInstanceOf(\DanAbrey\CollegeFootballDataApi\Model\Game::class, $games[0]);
        
        $game = $games[0];
        
        $this->assertEquals(401550883, $game->id);
        $this->assertEquals(2023, $game->season);
        $this->assertEquals(1, $game->week);
        $this->assertEquals('regular', $game->season_type);
        $this->assertEquals('2023-08-26T17:00:00.000Z', $game->start_date);
        $this->assertFalse($game->start_time_tbd);
        $this->assertTrue($game->completed);
        $this->assertFalse($game->neutral_site);
        $this->assertFalse($game->conference_game);
        $this->assertNull($game->attendance);
        $this->assertEquals(5910, $game->venue_id);
        $this->assertEquals('Callaway Stadium', $game->venue);
        $this->assertEquals(548, $game->home_id);
        $this->assertEquals('LaGrange College', $game->home_team);
        $this->assertEquals('USA South', $game->home_conference);
        $this->assertEquals('iii', $game->home_division);
        $this->assertNull($game->home_points);
        $this->assertNull($game->home_line_scores);
        $this->assertNull($game->home_post_win_prob);
        $this->assertNull($game->home_pregame_elo);
        $this->assertNull($game->home_postgame_elo);
        $this->assertEquals(125762, $game->away_id);
        $this->assertEquals('Florida Memorial University', $game->away_team);
        $this->assertNull($game->away_conference);
        $this->assertNull($game->away_division);
        $this->assertNull($game->away_points);
        $this->assertNull($game->away_line_scores);
        $this->assertNull($game->away_post_win_prob);
        $this->assertNull($game->away_pregame_elo);
        $this->assertNull($game->away_postgame_elo);
        $this->assertNull($game->excitement_index);
        $this->assertNull($game->highlights);
        $this->assertNull($game->notes);
    }

    /**
     * @testWith ["week", 1, "https://api.collegefootballdata.com/games?year=2023&week=1"]
     *           ["seasonType", "regular", "https://api.collegefootballdata.com/games?year=2023&seasonType=regular"]
     *           ["team", "Florida", "https://api.collegefootballdata.com/games?year=2023&team=Florida"]
     *           ["home", "Florida", "https://api.collegefootballdata.com/games?year=2023&home=Florida"]
     *           ["away", "Florida", "https://api.collegefootballdata.com/games?year=2023&away=Florida"]
     *           ["conference", "SEC", "https://api.collegefootballdata.com/games?year=2023&conference=SEC"]
     *           ["division", "fbs", "https://api.collegefootballdata.com/games?year=2023&division=fbs"]
     *           ["id", 401550883, "https://api.collegefootballdata.com/games?year=2023&id=401550883"]
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
