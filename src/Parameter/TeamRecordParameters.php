<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class TeamRecordParameters extends Parameters
{
    public function __construct(
        public ?int $year = null,
        public ?string $team = null,
        public ?string $conference = null,
    ) {}
}
