<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Recruit
{
    public function __construct(
        public readonly int $id,
        public readonly int $athleteId,
        public readonly string $recruitType,
        public readonly int $year,
        public readonly int $ranking,
        public readonly string $name,
        public readonly string $school,
        public readonly string $committedTo,
        public readonly string $position,
        public readonly float $height,
        public readonly int $weight,
        public readonly int $stars,
        public readonly float $rating,
        public readonly string $city,
        public readonly string $stateProvince,
        public readonly string $country,
        public readonly array $hometownInfo,
    ) {}
}
