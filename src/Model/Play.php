<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Play
{
    public function __construct(
        public readonly int $id,
        public readonly int $drive_id,
        public readonly int $game_id,
        public readonly int $drive_number,
        public readonly int $play_number,
        public readonly string $offense,
        public readonly string $offense_conference,
        public readonly int $offense_score,
        public readonly string $defense,
        public readonly string $home,
        public readonly string $away,
        public readonly string $defense_conference,
        public readonly int $defense_score,
        public readonly int $period,
        public readonly array $clock,
        public readonly int $offense_timeouts,
        public readonly int $defense_timeouts,
        public readonly int $yard_line,
        public readonly int $yards_to_goal,
        public readonly int $down,
        public readonly int $distance,
        public readonly int $yards_gained,
        public readonly bool $scoring,
        public readonly string $play_type,
        public readonly string $play_text,
        public readonly float $ppa,
        public readonly string $wallclock
    ) {}
}
