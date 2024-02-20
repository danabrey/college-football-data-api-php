<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class PlayType
{
    public function __construct(
        public readonly int $id,
        public readonly string $text,
        public readonly string $abbreviation,
    ) {}
}
