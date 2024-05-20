<?php

namespace DanAbrey\CollegeFootballDataApi;


use DanAbrey\CollegeFootballDataApi\Model\Conference;
use DanAbrey\CollegeFootballDataApi\Model\Game;
use DanAbrey\CollegeFootballDataApi\Model\GameMedia;
use DanAbrey\CollegeFootballDataApi\Model\PlayerGame;
use DanAbrey\CollegeFootballDataApi\Model\PlayerSearchResult;
use DanAbrey\CollegeFootballDataApi\Model\PlayerSeasonStat;
use DanAbrey\CollegeFootballDataApi\Model\Team;
use DanAbrey\CollegeFootballDataApi\Model\TeamRecord;
use DanAbrey\CollegeFootballDataApi\Model\Week;
use DanAbrey\CollegeFootballDataApi\Parameter\CalendarParameters;
use DanAbrey\CollegeFootballDataApi\Parameter\GameMediaParameters;
use DanAbrey\CollegeFootballDataApi\Parameter\PlayerGameStatsParameters;
use DanAbrey\CollegeFootballDataApi\Parameter\GamesParameters;
use DanAbrey\CollegeFootballDataApi\Parameter\PlayerSearchParameters;
use DanAbrey\CollegeFootballDataApi\Parameter\PlayerSeasonStatsParameters;
use DanAbrey\CollegeFootballDataApi\Parameter\TeamRecordParameters;
use DanAbrey\CollegeFootballDataApi\Parameter\TeamsParameters;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CollegeFootballData
{
    protected HttpClientInterface $client;
    private Serializer $serializer;

    public function __construct(protected string $apiToken, ?HttpClientInterface $client = null)
    {
        $this->client = $client ?? HttpClient::create();
        $this->serializer = new Serializer([new ObjectNormalizer(), new ArrayDenormalizer()]);
    }
    
    protected function request(string $path, ?string $queryString = null)
    {
        $response = $this->client->request('GET', 'https://api.collegefootballdata.com/' . $path . $queryString, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiToken,
            ],
        ]);
        
        return json_decode($response->getContent(), true);
    }

    public function games(GamesParameters $parameters): array
    {
        $response = $this->request('games', $parameters->toQueryString());

        return $this->serializer->denormalize($response, Game::class. '[]');
    }
    
    public function teamRecords(?TeamRecordParameters $parameters = null)
    {
        $response = $this->request('records', $parameters?->toQueryString());
        
        return $this->serializer->denormalize($response, TeamRecord::class. '[]');
    }

    public function calendar(CalendarParameters $parameters = null)
    {
        $response = $this->request('calendar', $parameters->toQueryString());

        return $this->serializer->denormalize($response, Week::class. '[]');
    }
    
    public function gameMedia(GameMediaParameters $parameters)
    {
        $response = $this->request('games/media', $parameters->toQueryString());

        return $this->serializer->denormalize($response, GameMedia::class. '[]');
    }

    public function playerGamesStats(PlayerGameStatsParameters $parameters)
    {
        $response = $this->request('games/players', $parameters->toQueryString());

        return $this->serializer->denormalize($response, PlayerGame::class. '[]');
    }
    
    public function teams(?TeamsParameters $parameters = null): array
    {
        $response = $this->request('teams', $parameters?->toQueryString());
        
        return $this->serializer->denormalize($response, Team::class. '[]');
    }

    public function playerSearch(?PlayerSearchParameters $parameters = null): array
    {
        $response = $this->request('player/search', $parameters?->toQueryString());

        return $this->serializer->denormalize($response, PlayerSearchResult::class. '[]');
    }
    
    public function conferences(): array
    {
        $response = $this->request('conferences');

        return $this->serializer->denormalize($response, Conference::class. '[]');
    }
    
    public function playerSeasonStats(PlayerSeasonStatsParameters $parameters)
    {
        $response = $this->request('stats/player/season', $parameters->toQueryString());

        return $this->serializer->denormalize($response, PlayerSeasonStat::class. '[]');
    }
}
