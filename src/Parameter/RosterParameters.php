<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class RosterParameters extends Parameters
{
    public function __construct(
        public readonly ?string $team = null,
        public readonly ?string $year = null,
    ) {}
}
