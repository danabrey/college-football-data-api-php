<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class TeamLocation
{
    public function __construct(
        public readonly ?string $venue_id = null,
        public readonly ?string $name = null,
        public readonly ?string $city = null,
        public readonly ?string $state = null,
        public readonly ?string $zip = null,
        public readonly ?string $country_code = null,
        public readonly ?string $timezone = null,
        public readonly ?float  $latitude = null,
        public readonly ?float  $longitude = null,
        public readonly ?float  $elevation = null,
        public readonly ?int    $capacity = null,
        public readonly ?int    $year_constructed = null,
        public readonly ?bool   $grass = null,
        public readonly ?bool   $dome = null,
    )
    {
    }
}
