<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Venue
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $capacity,
        public readonly bool $grass,
        public readonly string $city,
        public readonly string $state,
        public readonly string $zip,
        public readonly string $country_code,
        public readonly array $location,
        public readonly float $elevation,
        public readonly int $year_constructed,
        public readonly bool $dome,
        public readonly string $timezone,
    ) {}
}
