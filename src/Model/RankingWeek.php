<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class RankingWeek
{
    public function __construct(
        public readonly int $season,
        public readonly string $seasonType,
        public readonly int $week,
        public readonly array $polls,
    ) {}
}
