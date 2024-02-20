<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class TeamGame
{
    public function __construct(
        public readonly int $id,
        public readonly array $teams,
    ) {}
}
