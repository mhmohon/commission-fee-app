<?php

namespace App\Http\Services;
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
     * @return array
     */
    public function feeCalculate(string $filePath): array
    {
        $calculationFee = [];
        $csvValues = $this->parseCsvFile->handle($filePath);
        $exchangeRates = $this->exchangeRateService->fetchCurrencyRates();
        Cache::put('exchangeRates', $exchangeRates);
        foreach ($csvValues as $value) {
            $calculationFee[] = $this->calculation($value);
        }
        $this->flushCookiesValues();
        return $calculationFee;
    }
    
    /**
     * @param array $fileElement
     * @return string
     */
    public function calculation(array $fileElement): string
    {
        list($date, $userId, $userType, $operationType, $amount, $currency) = array_values($fileElement);

        $operation = FeeOperationFactory::createFeeOperation($operationType);
        $commissionFee = $operation->calculateCommissionFee($date, $userId, $userType, $operationType, $amount, $currency);

        // Round the commission fee to 2 decimal places and add it to the total
        $commissionFee = $this->converter->roundAmount($commissionFee);
        
        return $commissionFee;
    }

    /**
     * @return void
     */
    public function flushCookiesValues(): void
    {
        Cache::flush();
    }
}
