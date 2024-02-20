<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class TeamsParameters extends Parameters
{
    public function __construct(
        public readonly ?string $conference = null,
    ) {}
}
