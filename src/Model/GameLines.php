<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class GameLines
{
    /**
     * 
     */
    public function __construct(
        public readonly int $id,
        public readonly int $season,
        public readonly int $week,
        public readonly string $seasonType,
        public readonly string $startDate,
        public readonly string $homeTeam,
        public readonly string $homeConference,
        public readonly int $homeScore,
        public readonly string $awayTeam,
        public readonly string $awayConference,
        public readonly int $awayScore,
        public readonly array $lines,
    ) {}
}
