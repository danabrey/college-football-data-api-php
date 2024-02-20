<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class PlayerGameStatsParameters extends Parameters
{
    public function __construct(
        public readonly int $year,
        public readonly ?int $week = null,
        public readonly ?string $seasonType = null,
        public readonly ?string $team = null,
        public readonly ?string $conference = null,
        public readonly ?string $category = null,
        public readonly ?int $gameId = null,
    ) {}
}
