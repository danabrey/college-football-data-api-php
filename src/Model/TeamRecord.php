<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class TeamRecord
{
    public function __construct(
        public int $year,
        public int $teamId,
        public string $team,
        public string $conference,
        public string $division,
        public float $expectedWins,
        public array $total,
        public array $conferenceGames,
        public array $homeGames,
        public array $awayGames
    ) {}

}
