<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Player
{
    public function __construct(
        public readonly int $id,
        public readonly string $first_name,
        public readonly string $last_name,
        public readonly string $team,
        public readonly int $height,
        public readonly int $weight,
        public readonly int $jersey,
        public readonly int $year,
        public readonly string $position,
        public readonly ?string $home_city,
        public readonly ?string $home_state,
        public readonly ?string $home_country,
        public readonly ?float $home_latitude,
        public readonly ?float $home_longitude,
        public readonly ?string $home_county_fips,
        public readonly array $recruit_ids,
    ) {}
}
