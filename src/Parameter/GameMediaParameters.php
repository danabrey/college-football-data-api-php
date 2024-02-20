<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class GameMediaParameters extends Parameters
{
    public function __construct(
        public readonly int $year,
        public readonly ?int $week = null,
        public readonly ?string $seasonType = null,
        public readonly ?string $team = null,
        public readonly ?string $conference = null,
        public readonly ?string $mediaType = null,
        public readonly ?string $classification = null,
    ) {}
}
