<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class PlayerSeasonStat
{
    public function __construct(
        public readonly int $playerId,
        public readonly string $player,
        public readonly string $team,
        public readonly string $conference,
        public readonly string $category,
        public readonly string $statType,
        public readonly string $stat,
    ) {}
}
