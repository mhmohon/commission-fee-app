<?php

namespace App\Http\Operations;

use App\Http\Contracts\UserFeeCalculation;
use App\Http\Services\ExchangeRateService;
use Illuminate\Support\Facades\Cache;

class PrivateUserFeeOperation implements UserFeeCalculation
{
    public function calculateFeeByUser($date, $userId, $userType, $operationType, $amount, $currency)
    {
        $exchangeRate = new ExchangeRateService();
        $amount = $exchangeRate->convertToBaseCurrencyAmount($currency, $amount);
        $fees = Cache::get('fees') ?? [];
        // Calculate the commission fee
        $withdrawals = array_filter($fees, function($fee) use($userId, $date) {
            return $fee['userId'] == $userId && $fee['date'] >= date('Y-m-d', strtotime($date.' -1 week')) && $fee['date'] <= $date;
        });
        $total_withdrawal_amount = array_sum(array_column($withdrawals, 'amount'));
        $remaining_free_amount = max(0, 1000 - $total_withdrawal_amount);
        $commissionFee = max(0, (($amount - $remaining_free_amount) * 0.3) / 100);

        $this->insertCalculationFee($date, $userId, $operationType, $amount, $commissionFee);
        return $commissionFee;
    }

    public function insertCalculationFee($date, $userId, $operationType, $amount, $commissionFee)
    {
        $feeData[] = [
            'date' => $date,
            'userId' => $userId,
            'operation_type' => $operationType,
            'amount' => $amount,
            'fee_amount' => $commissionFee
        ];
        Cache::put('fees', $feeData);
    }
}
