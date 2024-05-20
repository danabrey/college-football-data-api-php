<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class PlayerSeasonStatsParameters extends Parameters
{
    public function __construct(
        public readonly int $year,
        public readonly ?string $team = null,
        public readonly ?string $conference = null,
        public readonly ?int $startWeek = null,
        public readonly ?int $endWeek = null,
        public readonly ?string $seasonType = null,
        public readonly ?string $category = null,
    ) {}
}
