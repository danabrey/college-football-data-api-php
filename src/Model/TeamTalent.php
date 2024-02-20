<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class TeamTalent
{
    public function __construct(
        public readonly int $year,
        public readonly string $school,
        public readonly float $talent,
    ) {}
}
