<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    const EXCHANGE_URL = 'https://developers.paysera.com/tasks/api/currency-exchange-rates';
    const BASE_CURRENCY = 'EUR';

    public function fetchCurrencyRates(): array
    {
        try {
            $exchangeRates = [];
            $response = Http::get(self::EXCHANGE_URL);
            $exchangeRates = json_decode($response->body(), true);
            if (!isset($exchangeRates['rates'])) {
                throw new \Exception('Exchange rates not found in API response');
            }

            return $exchangeRates['rates'];
        } catch (\Throwable $th) {
            throw new \Exception('Error fetching exchange rates: ' . $th->getMessage());
        }
    }
    

    public function convertToBaseCurrencyAmount(string $currency, string $amount): string
    {
        $exchangeRates = Cache::get('exchangeRates');
        if ($currency != self::BASE_CURRENCY) {
            $rate = $exchangeRates[$currency];
            if(is_null($rate)){
                throw new \Exception('Exchange rates not found in API response');
            }
            $amount = $amount / $rate;
        }
        return $amount;
    }
}
