<?php

namespace App\Http\Services;

class CurrencyConverterService
{
    public function roundAmount(float $amount)
    {
        $decimalPlaces = $this->findDecimalPlaces($amount);
        $multiplier = pow(10, $decimalPlaces);
        return number_format(ceil($amount * $multiplier) / $multiplier, 2);
    }

    /**
     * @param float $amount
     * @return float
     */
    public function findDecimalPlaces(float $amount): float
    {
        $parts = explode(".", $amount);
        $decimalPart = isset($parts[1]) ? $parts[1] : "";
        $decimalPlaces = 1;
        if (substr($decimalPart, 0, 1) == "0") {
            $decimalPlaces = 2;
        }

        return $decimalPlaces;
    }
}
