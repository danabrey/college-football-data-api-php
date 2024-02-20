<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Week
{
    public function __construct(
        public int $season,
        public int $week,
        public string $seasonType,
        public string $firstGameStart,
        public string $lastGameStart
    ) {}
}
