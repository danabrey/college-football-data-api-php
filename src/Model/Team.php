<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Team
{
    public function __construct(
        public readonly string      $id,
        public readonly string   $school,
        public readonly ?string   $mascot = null,
        public readonly ?string   $abbreviation = null,
        public readonly ?string   $alt_name1 = null,
        public readonly ?string   $alt_name2 = null,
        public readonly ?string   $alt_name3 = null,
        public readonly ?string   $conference = null,
        public readonly ?string   $classification = null,
        public readonly ?string   $color = null,
        public readonly ?string   $alt_color = null,
        public readonly ?array    $logos = null,
        public readonly ?string   $twitter = null,
        public readonly TeamLocation $location
    ) {}
}
