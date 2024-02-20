<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class PlayerSearchParameters extends Parameters
{
    public function __construct(
        public readonly string $searchTerm,
        public readonly ?string $position = null,
        public readonly ?string $team = null,
        public readonly ?int $year = null,
    ) {}
}
