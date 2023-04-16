<?php

namespace App\Http\Services;
use Akaunting\Money\Currency;
use App\Actions\ParseCsvFile;
use App\Http\Factory\FeeOperationFactory;
use Illuminate\Support\Facades\Cache;

class FeeCalculationService
{
    public function __construct(
        protected ExchangeRateService $exchangeRateService,
        protected CurrencyConverterService $converter,
        protected ParseCsvFile $parseCsvFile
    ){}
    
    /**
     * @param string $filePath
     * @return void
     */
    public function feeCalculate(string $filePath): void
    {
        $csvValues = $this->parseCsvFile->handle($filePath);
        $exchangeRates = $this->exchangeRateService->fetchCurrencyRates();
        Cache::put('exchangeRates', $exchangeRates);
    
        foreach ($csvValues as $value) {
            echo $this->calculation($value);
        }
        $this->flushCookiesValues();
    }
    
    /**
     * @param array $fileElement
     * @return void
     */
    public function calculation(array $fileElement): void
    {
        list($date, $userId, $userType, $operationType, $amount, $currency) = array_values($fileElement);

        $operation = FeeOperationFactory::createFeeOperation($operationType);
        $commissionFee = $operation->calculateCommissionFee($date, $userId, $userType, $operationType, $amount, $currency);

        // Round the commission fee to 2 decimal places and add it to the total
        $commissionFee = $this->converter->roundAmount($commissionFee);
        
        // Print the transaction and commission fee
        // echo "$date | $userId | $userType | $operationType | $amount | $currency | $commissionFee\n";
        echo "$commissionFee\n";

    }

    /**
     * @return void
     */
    public function flushCookiesValues(): void
    {
        Cache::flush();
    }
}
