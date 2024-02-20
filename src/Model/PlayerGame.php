<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class PlayerGame
{
    public function __construct(
        public readonly int $id,
        public readonly array $teams,
    ) {}
}
