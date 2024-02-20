<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Drive
{
    public function __construct(
        public readonly int $id,
        public readonly string $offense,
        public readonly string $offense_conference,
        public readonly string $defense,
        public readonly string $defense_conference,
        public readonly int $game_id,
        public readonly int $drive_number,
        public readonly bool $scoring,
        public readonly int $start_period,
        public readonly int $start_yardline,
        public readonly int $start_yards_to_goal,
        public readonly array $start_time,
        public readonly int $end_period,
        public readonly int $end_yardline,
        public readonly int $end_yards_to_goal,
        public readonly array $end_time,
        public readonly int $plays,
        public readonly int $yards,
        public readonly string $drive_result,
        public readonly bool $is_home_offense,
        public readonly int $start_offense_score,
        public readonly int $start_defense_score,
        public readonly int $end_offense_score,
        public readonly int $end_defense_score,
    ) {}
}
