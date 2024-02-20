<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class GameMedia
{
    public function __construct(
        public readonly int $id,
        public readonly int $season,
        public readonly int $week,
        public readonly string $seasonType,
        public readonly string $startTime,
        public readonly bool $isStartTimeTBD,
        public readonly string $homeTeam,
        public readonly ?string $homeConference = null,
        public readonly string $awayTeam,
        public readonly ?string $awayConference = null,
        public readonly string $mediaType,
        public readonly string $outlet
    ) {}
}
