<?php

use DanAbrey\CollegeFootballDataApi\CollegeFootballData;
use DanAbrey\CollegeFootballDataApi\Model\PlayerSearchResult;
use DanAbrey\CollegeFootballDataApi\Model\Team;
use DanAbrey\CollegeFootballDataApi\Parameter\PlayerSearchParameters;
use DanAbrey\CollegeFootballDataApi\Parameter\TeamsParameters;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class PlayerSearchTest extends TestCase
{    
    public function test_player_search_denormalization()
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/playerSearch.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );
        
        $playerSearchResults = $testApi->playerSearch(new PlayerSearchParameters('Joe Burrow'));
        
        self::assertSame('https://api.collegefootballdata.com/player/search?searchTerm=Joe%20Burrow', $mockResponse->getRequestUrl());
        
        $this->assertIsArray($playerSearchResults);
        $this->assertCount(100, $playerSearchResults);
        
        $this->assertInstanceOf(PlayerSearchResult::class, $playerSearchResults[0]);
        
        $this->assertEquals(4259818, $playerSearchResults[0]->id);
        $this->assertEquals('Alabama A&M', $playerSearchResults[0]->team);
        $this->assertEquals('Aadreekis Conner', $playerSearchResults[0]->name);
        $this->assertEquals('Aadreekis', $playerSearchResults[0]->firstName);
        $this->assertEquals('Conner', $playerSearchResults[0]->lastName);
        $this->assertEquals(210, $playerSearchResults[0]->weight);
        $this->assertEquals(74, $playerSearchResults[0]->height);
        $this->assertEquals(1, $playerSearchResults[0]->jersey);
        $this->assertEquals('S', $playerSearchResults[0]->position);
        $this->assertEquals('Port Gibson, MS', $playerSearchResults[0]->hometown);
        $this->assertEquals('#790000', $playerSearchResults[0]->teamColor);
        $this->assertEquals('#ffffff', $playerSearchResults[0]->teamColorSecondary);
    }

    /**
     * @testWith ["position", "QB", "https://api.collegefootballdata.com/player/search?searchTerm=Joe%20Burrow&position=QB"]
     *           ["team", "LSU", "https://api.collegefootballdata.com/player/search?searchTerm=Joe%20Burrow&team=LSU"]
     *           ["year", 2020, "https://api.collegefootballdata.com/player/search?searchTerm=Joe%20Burrow&year=2020"]
     */
    public function test_player_search_filter($key, $value, $url)
    {
        $mockResponse = new MockResponse(file_get_contents(__DIR__ . '/data/playerSearch.json'));
        $testApi = new CollegeFootballData(
            'test',
            new MockHttpClient($mockResponse)
        );

        $parameters = new \DanAbrey\CollegeFootballDataApi\Parameter\PlayerSearchParameters(...[$key => $value], searchTerm: 'Joe Burrow');
        $teams = $testApi->playerSearch($parameters);

        self::assertSame($url, $mockResponse->getRequestUrl());
    }
}
