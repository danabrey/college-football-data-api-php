<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class TeamMatchup
{
    public function __construct(
        public readonly string $team1,
        public readonly string $team2,
        public readonly int $startYear,
        public readonly int $endYear,
        public readonly int $team1Wins,
        public readonly int $team2Wins,
        public readonly int $ties,
        public readonly array $games,
    ) {}
}
