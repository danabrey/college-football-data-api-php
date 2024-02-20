<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class TeamSeason
{
    public function __construct(
        public readonly string $school,
        public readonly string $year,
        public readonly int $games,
        public readonly int $wins,
        public readonly int $losses,
        public readonly int $ties,
        public readonly ?int $preseason_rank = null,
        public readonly ?int $postseason_rank = null,
        public readonly ?float $srs = null,
        public readonly ?float $sp_overall = null,
        public readonly ?float $sp_offense = null,
        public readonly ?float $sp_defense = null,
    ) {}
}
