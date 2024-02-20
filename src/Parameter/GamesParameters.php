<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class GamesParameters extends Parameters
{
    public function __construct(
        public readonly int $year,
        public readonly ?int $week = null,
        public readonly ?string $seasonType = null,
        public readonly ?string $team = null,
        public readonly ?string $home = null,
        public readonly ?string $away = null,
        public readonly ?string $conference = null,
        public readonly ?string $division = null,
        public readonly ?int $id = null
    ) {}
}
