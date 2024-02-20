<?php

namespace DanAbrey\CollegeFootballDataApi\Model;

class Conference
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $short_name,
        public readonly ?string $abbreviation = null,
        public readonly string $classification,
    ) {}
}
