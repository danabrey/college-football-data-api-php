<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Game
{
    public function __construct(
        public readonly int $id,
        public readonly int $season,
        public readonly int $week,
        public readonly string $season_type,
        public readonly string $start_date,
        public readonly bool $start_time_tbd,
        public readonly bool $completed,
        public readonly bool $neutral_site,
        public readonly bool $conference_game,
        public readonly ?int $attendance,
        public readonly ?int $venue_id,
        public readonly ?string $venue,
        public readonly int $home_id,
        public readonly string $home_team,
        public readonly ?string $home_conference,
        public readonly ?string $home_division,
        public readonly ?int $home_points,
        public readonly ?array $home_line_scores,
        public readonly ?float $home_post_win_prob,
        public readonly ?int $home_pregame_elo,
        public readonly ?int $home_postgame_elo,
        public readonly int $away_id,
        public readonly string $away_team,
        public readonly ?string $away_conference,
        public readonly ?string $away_division,
        public readonly ?int $away_points,
        public readonly ?array $away_line_scores,
        public readonly ?float $away_post_win_prob,
        public readonly ?int $away_pregame_elo,
        public readonly ?int $away_postgame_elo,
        public readonly ?float $excitement_index,
        public readonly ?string $highlights,
        public readonly ?string $notes
    ) {}
}
