<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Game
{
    public function __construct(
        public readonly int $id,
        public readonly int $season,
        public readonly int $week,
        public readonly string $seasonType,
        public readonly string $startDate,
        public readonly bool $startTimeTBD,
        public readonly bool $completed,
        public readonly bool $neutralSite,
        public readonly bool $conferenceGame,
        public readonly ?int $attendance,
        public readonly ?int $venueId,
        public readonly ?string $venue,
        public readonly int $homeId,
        public readonly string $homeTeam,
        public readonly ?string $homeConference,
        public readonly ?int $homePoints,
        public readonly ?array $homeLineScores,
        public readonly ?float $homePostgameWinProbability,
        public readonly ?int $homePregameElo,
        public readonly ?int $homePostgameElo,
        public readonly int $awayId,
        public readonly string $awayTeam,
        public readonly ?string $awayConference,
        public readonly ?int $awayPoints,
        public readonly ?array $awayLineScores,
        public readonly ?float $awayPostgameWinProbability,
        public readonly ?int $awayPregameElo,
        public readonly ?int $awayPostgameElo,
        public readonly ?float $excitementIndex,
        public readonly ?string $highlights,
        public readonly ?string $notes
    ) {}
}
