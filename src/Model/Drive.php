<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Drive
{
    public function __construct(
        public readonly int $id,
        public readonly string $offense,
        public readonly string $offenseConference,
        public readonly string $defense,
        public readonly string $defenseConference,
        public readonly int $gameId,
        public readonly int $driveNumber,
        public readonly bool $scoring,
        public readonly int $startPeriod,
        public readonly int $startYardline,
        public readonly int $startYardsToGoal,
        public readonly array $startTime,
        public readonly int $endPeriod,
        public readonly int $endYardline,
        public readonly int $endYardsToGoal,
        public readonly array $endTime,
        public readonly int $plays,
        public readonly int $yards,
        public readonly string $drive_Result,
        public readonly bool $isHomeOffense,
        public readonly int $startOffenseScore,
        public readonly int $startDefenseScore,
        public readonly int $endOffenseScore,
        public readonly int $endDefenseScore,
    ) {}
}
