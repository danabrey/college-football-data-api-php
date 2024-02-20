<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

class CalendarParameters extends Parameters
{
    public function __construct(
        public readonly int $year,
    ) {}
}
