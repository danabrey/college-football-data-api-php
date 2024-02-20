<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class PlayerSearchResult
{
    public function __construct(
        public readonly int $id,
        public readonly string $team,
        public readonly string $name,
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly ?int $weight,
        public readonly ?int $height,
        public readonly ?int $jersey,
        public readonly ?string $position,
        public readonly ?string $hometown,
        public readonly ?string $teamColor,
        public readonly ?string $teamColorSecondary
    ) {}
}
