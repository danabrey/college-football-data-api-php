<?php
namespace DanAbrey\CollegeFootballDataApi\Parameter;

abstract class Parameters
{
    public function toQueryString(): string
    {
        $queryString = '';

        foreach ($this as $key => $value) {
            if ($value !== null) {
                $queryString .= $key . '=' . $value . '&';
            }
        }

        return $queryString ? '?' . rtrim($queryString, '&') : '';
    }
}
