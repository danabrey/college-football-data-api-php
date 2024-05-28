<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class TeamSeasonStat
{
    public function __construct(
        public readonly int $season,
        public readonly string $team,
        public readonly string $conference,
        public readonly string $statName,
        public readonly int $statValue,
    ) {}
}
